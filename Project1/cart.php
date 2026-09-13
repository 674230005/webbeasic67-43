<?php
session_start();
require_once "BookStore.php";

$store = new BookStore();

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if (isset($_GET['remove'])) {
    unset($_SESSION['cart'][(int)$_GET['remove']]);
    header("Location: cart.php");
    exit;
}

if (isset($_GET['clear'])) {
    $_SESSION['cart'] = [];
    header("Location: cart.php");
    exit;
}

$items = [];
$total = 0;

foreach ($_SESSION['cart'] as $id => $qty) {
    $book = $store->find((int)$id);
    if ($book) {
        $subtotal = $book->getPrice() * $qty;
        $total += $subtotal;
        $items[] = ['book' => $book, 'qty' => $qty, 'subtotal' => $subtotal];
    }
}
?>
<!DOCTYPE html>
<html lang="th">
<head>
<meta charset="UTF-8">
<title>ตะกร้า | 67Shop</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<div class="top-line"></div>
<header class="header">
    <a class="brand" href="index.php"><span class="brand-icon">67</span><span><strong>67Shop</strong><small>GOOD BOOKS • BETTER DAYS</small></span></a>
    <div class="header-links" style="margin-left:auto"><a href="index.php">← กลับร้าน</a></div>
</header>
<nav><div class="nav-inner"><a class="active" href="cart.php">🛒 ตะกร้าสินค้า</a></div></nav>

<section class="cart-page">
    <div class="section-head"><span>SHOPPING CART</span><h2>ตะกร้าของคุณ</h2></div>

    <?php if (!$items): ?>
        <div class="cart-empty">
            <div>🛒</div>
            <h2>ยังไม่มีหนังสือในตะกร้า</h2>
            <p>เลือกหนังสือที่ชอบแล้วกลับมาอีกครั้ง</p>
            <a class="btn-main" href="index.php#books">เลือกหนังสือ →</a>
        </div>
    <?php else: ?>
        <div class="cart-list">
        <?php foreach ($items as $item): $book=$item['book']; ?>
            <div class="cart-item">
                <div class="mini-cover <?= htmlspecialchars($book->getColor()) ?>">✦</div>
                <div class="cart-info">
                    <div class="category"><?= htmlspecialchars($book->getCategory()) ?></div>
                    <h3><?= htmlspecialchars($book->getTitle()) ?></h3>
                    <p><?= htmlspecialchars($book->getAuthor()) ?> · <?= $item['qty'] ?> เล่ม</p>
                </div>
                <strong>฿<?= number_format($item['subtotal']) ?></strong>
                <a class="remove" href="?remove=<?= $book->getId() ?>">ลบ</a>
            </div>
        <?php endforeach; ?>
        </div>
        <div class="cart-summary">
            <a href="?clear=1" class="clear">ล้างตะกร้า</a>
            <div><span>ยอดรวม</span><strong>฿<?= number_format($total) ?></div>
            <a href="checkout.php" class="checkout-btn">สั่งซื้อสินค้า →</a>
        </div>
    <?php endif; ?>
</section>
<footer><b>67Shop</b> &nbsp; • &nbsp; OOP & OOAD Project</footer>
</body>
</html>
