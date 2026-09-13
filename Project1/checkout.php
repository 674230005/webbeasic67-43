<?php
session_start();

require_once 'Database.php';

$db = new Database();
$conn = $db->connect();

/* เปิดให้แสดง Error ของ PDO */
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


/* =========================
   ดึงตะกร้า
========================= */

$cart = $_SESSION['cart'] ?? [];

$cartItems = [];


/*
    รองรับ Cart หลายรูปแบบ

    แบบที่ 1
    [1, 2, 3]

    แบบที่ 2
    [1 => 2, 5 => 1]

    แบบที่ 3
    [
        [
            'id' => 1,
            'quantity' => 2
        ]
    ]
*/

if (!empty($cart) && is_array($cart)) {

    $keys = array_keys($cart);

    $isList = ($keys === range(0, count($keys) - 1));


    /* =========================
       แบบ [1,2,3]
    ========================= */

    if ($isList) {

        foreach ($cart as $item) {

            if (is_array($item)) {

                $bookId = (int)(
                    $item['id']
                    ?? $item['book_id']
                    ?? 0
                );

                $quantity = (int)(
                    $item['quantity']
                    ?? $item['qty']
                    ?? 1
                );

                if ($bookId > 0) {

                    $cartItems[$bookId] =
                        ($cartItems[$bookId] ?? 0)
                        + max(1, $quantity);
                }

            } elseif (is_numeric($item)) {

                $bookId = (int)$item;

                if ($bookId > 0) {

                    $cartItems[$bookId] =
                        ($cartItems[$bookId] ?? 0) + 1;
                }
            }
        }


    /* =========================
       แบบ [id => quantity]
    ========================= */

    } else {

        foreach ($cart as $key => $item) {

            if (is_array($item)) {

                $bookId = (int)(
                    $item['id']
                    ?? $item['book_id']
                    ?? $key
                );

                $quantity = (int)(
                    $item['quantity']
                    ?? $item['qty']
                    ?? 1
                );

            } else {

                $bookId = (int)$key;
                $quantity = (int)$item;
            }


            if ($bookId > 0) {

                $cartItems[$bookId] =
                    ($cartItems[$bookId] ?? 0)
                    + max(1, $quantity);
            }
        }
    }
}


/* =========================
   ดึงข้อมูลหนังสือ
========================= */

$books = [];
$total = 0;

if (!empty($cartItems)) {

    $bookIds = array_keys($cartItems);

    $placeholders = implode(
        ',',
        array_fill(
            0,
            count($bookIds),
            '?'
        )
    );


    $sql = "
        SELECT *
        FROM books
        WHERE id IN ($placeholders)
        ORDER BY id
    ";


    $stmt = $conn->prepare($sql);

    $stmt->execute($bookIds);

    $books = $stmt->fetchAll(PDO::FETCH_ASSOC);


    foreach ($books as &$book) {

        $id = (int)$book['id'];

        $quantity =
            $cartItems[$id] ?? 1;

        $book['quantity'] = $quantity;

        $book['subtotal'] =
            (float)$book['price'] * $quantity;

        $total += $book['subtotal'];
    }

    unset($book);
}


/* =========================
   ตัวแปร
========================= */

$error = '';

$success = false;

$orderId = 0;


/* =========================
   ยืนยันการสั่งซื้อ
========================= */

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name = trim(
        $_POST['name'] ?? ''
    );

    $phone = trim(
        $_POST['phone'] ?? ''
    );

    $address = trim(
        $_POST['address'] ?? ''
    );

    $payment = trim(
        $_POST['payment'] ?? ''
    );


    /* =========================
       ตรวจสอบข้อมูล
    ========================= */

    if (
        $name === ''
        || $phone === ''
        || $address === ''
        || $payment === ''
    ) {

        $error =
            'กรุณากรอกข้อมูลให้ครบทุกช่อง';

    } elseif (empty($books)) {

        $error =
            'ไม่มีสินค้าในตะกร้า';

    } elseif (
        !in_array(
            $payment,
            [
                'เก็บเงินปลายทาง',
                'โอนเงิน'
            ],
            true
        )
    ) {

        $error =
            'กรุณาเลือกวิธีชำระเงิน';

    } else {

        try {

            /* =========================
               เริ่ม Transaction
            ========================= */

            $conn->beginTransaction();


            /* =========================
               บันทึก Order
            ========================= */

            $sqlOrder = "
                INSERT INTO orders
                (
                    customer_name,
                    phone,
                    address,
                    payment_method,
                    total,
                    status
                )
                VALUES
                (
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?
                )
            ";


            $stmtOrder =
                $conn->prepare($sqlOrder);


            $stmtOrder->execute([
                $name,
                $phone,
                $address,
                $payment,
                $total,
                'รอดำเนินการ'
            ]);


            /* เอา ID คำสั่งซื้อ */
            $orderId =
                $conn->lastInsertId();


            /* =========================
               บันทึกสินค้า
            ========================= */

            $sqlItem = "
                INSERT INTO order_items
                (
                    order_id,
                    book_id,
                    quantity,
                    price
                )
                VALUES
                (
                    ?,
                    ?,
                    ?,
                    ?
                )
            ";


            $stmtItem =
                $conn->prepare($sqlItem);


            foreach ($books as $book) {

                $bookId =
                    (int)$book['id'];

                $quantity =
                    (int)$book['quantity'];

                $price =
                    (float)$book['price'];


                $stmtItem->execute([
                    $orderId,
                    $bookId,
                    $quantity,
                    $price
                ]);
            }


            /* =========================
               ยืนยันการบันทึก
            ========================= */

            $conn->commit();


            /* ล้างตะกร้า */

            $_SESSION['cart'] = [];


            $success = true;


        } catch (Exception $e) {

            /* ยกเลิก Transaction */

            if ($conn->inTransaction()) {
                $conn->rollBack();
            }


            /* แสดง Error จริง */

            $error =
                'เกิดข้อผิดพลาดในการบันทึกคำสั่งซื้อ: '
                . $e->getMessage();
        }
    }
}

?>


<!DOCTYPE html>
<html lang="th">

<head>

    <meta charset="UTF-8">

    <title>
        ชำระเงิน | 67Shop
    </title>


    <!-- ใช้ CSS เดิม -->

    <link
        rel="stylesheet"
        href="style.css"
    >

</head>


<body>


<!-- =========================
     Header
========================= -->

<header class="topbar">

    <div class="logo">

        <a href="index.php">
            📚 67Shop
        </a>

    </div>


    <div class="cart-link">

        <a href="cart.php">
            🛒 ตะกร้าสินค้า
        </a>

    </div>

</header>



<main class="checkout-container">


<?php if ($success): ?>


    <!-- =========================
         SUCCESS
    ========================= -->

    <div class="success-box">

        <div class="success-icon">
            ✓
        </div>


        <h1>
            สั่งซื้อสำเร็จ!
        </h1>


        <p>
            ขอบคุณที่สั่งซื้อสินค้ากับ 67Shop
        </p>


        <p class="order-number">

            หมายเลขคำสั่งซื้อ

            <strong>
                #<?= (int)$orderId ?>
            </strong>

        </p>


        <a
            href="index.php"
            class="checkout-btn"
        >
            กลับไปเลือกซื้อหนังสือ
        </a>

    </div>


<?php else: ?>


    <!-- =========================
         TITLE
    ========================= -->

    <div class="checkout-title">

        <span>
            CHECKOUT
        </span>

        <h1>
            ชำระเงิน
        </h1>

        <p>
            กรอกข้อมูลเพื่อยืนยันการสั่งซื้อ
        </p>

    </div>



    <!-- =========================
         ERROR
    ========================= -->

    <?php if ($error !== ''): ?>

        <div class="error-box">

            <?= htmlspecialchars($error) ?>

        </div>

    <?php endif; ?>



    <!-- =========================
         FORM
    ========================= -->

    <form method="POST">

        <div class="checkout-grid">


            <!-- =========================
                 ข้อมูลผู้ซื้อ
            ========================= -->

            <section class="checkout-card">

                <h2>
                    ข้อมูลผู้ซื้อ
                </h2>


                <label>
                    ชื่อ - นามสกุล
                </label>

                <input
                    type="text"
                    name="name"
                    placeholder="กรอกชื่อ - นามสกุล"
                    value="<?= htmlspecialchars(
                        $_POST['name'] ?? ''
                    ) ?>"
                    required
                >


                <label>
                    เบอร์โทรศัพท์
                </label>

                <input
                    type="text"
                    name="phone"
                    placeholder="กรอกเบอร์โทรศัพท์"
                    value="<?= htmlspecialchars(
                        $_POST['phone'] ?? ''
                    ) ?>"
                    required
                >


                <label>
                    ที่อยู่จัดส่ง
                </label>

                <textarea
                    name="address"
                    placeholder="กรอกที่อยู่สำหรับจัดส่ง"
                    required
                ><?= htmlspecialchars(
                    $_POST['address'] ?? ''
                ) ?></textarea>


                <h2>
                    วิธีชำระเงิน
                </h2>


                <!-- =========================
                     เก็บเงินปลายทาง
                ========================= -->

                <label class="payment-option">

                    <input
                        type="radio"
                        name="payment"
                        value="เก็บเงินปลายทาง"
                        <?= (
                            ($_POST['payment'] ?? '')
                            === 'เก็บเงินปลายทาง'
                        )
                        ? 'checked'
                        : ''
                        ?>
                        required
                    >

                    <div>

                        <strong>
                            💵 เก็บเงินปลายทาง
                        </strong>

                        <small>
                            ชำระเงินเมื่อได้รับสินค้า
                        </small>

                    </div>

                </label>


                <!-- =========================
                     โอนเงิน
                ========================= -->

                <label class="payment-option">

                    <input
                        type="radio"
                        name="payment"
                        value="โอนเงิน"
                        <?= (
                            ($_POST['payment'] ?? '')
                            === 'โอนเงิน'
                        )
                        ? 'checked'
                        : ''
                        ?>
                    >

                    <div>

                        <strong>
                            🏦 โอนเงิน
                        </strong>

                        <small>
                            โอนเงินผ่านธนาคาร
                        </small>

                    </div>

                </label>


                <!-- =========================
                     ปุ่มยืนยัน
                ========================= -->

                <button
                    type="submit"
                    class="checkout-btn"
                >
                    ยืนยันการสั่งซื้อ →
                </button>


                <a
                    href="cart.php"
                    class="back-cart"
                >
                    ← กลับไปตะกร้าสินค้า
                </a>

            </section>



            <!-- =========================
                 สรุปคำสั่งซื้อ
            ========================= -->

            <section class="checkout-card order-summary">

                <h2>
                    สรุปคำสั่งซื้อ
                </h2>


                <?php if (empty($books)): ?>


                    <div class="empty-cart">

                        <div>
                            🛒
                        </div>

                        <p>
                            ไม่มีสินค้าในตะกร้า
                        </p>


                        <a href="BookStore.php">
                            เลือกซื้อหนังสือ
                        </a>

                    </div>


                <?php else: ?>


                    <?php foreach ($books as $book): ?>

                        <div class="order-item">


                            <div class="book-info">

                                <h3>

                                    <?= htmlspecialchars(
                                        $book['title']
                                    ) ?>

                                </h3>


                                <p>

                                    <?= htmlspecialchars(
                                        $book['author']
                                    ) ?>

                                </p>


                                <small>

                                    จำนวน
                                    <?= (int)$book['quantity'] ?>
                                    เล่ม

                                </small>

                            </div>


                            <strong>

                                ฿<?= number_format(
                                    $book['subtotal'],
                                    0
                                ) ?>

                            </strong>


                        </div>

                    <?php endforeach; ?>


                    <!-- =========================
                         ยอดรวม
                    ========================= -->

                    <div class="total-row">

                        <span>
                            ยอดรวม
                        </span>


                        <strong>

                            ฿<?= number_format(
                                $total,
                                0
                            ) ?>

                        </strong>

                    </div>


                <?php endif; ?>


            </section>


        </div>

    </form>


<?php endif; ?>


</main>


</body>
</html>