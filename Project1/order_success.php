<?php
session_start();

if (!isset($_SESSION['order'])) {
    header("Location: index.php");
    exit;
}

$order = $_SESSION['order'];
?>

<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <title>สั่งซื้อสำเร็จ | 67Shop</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<header class="navbar">

    <div class="logo">
        📚 67Shop
    </div>

</header>

<main class="success-container">

    <div class="success-card">

        <div class="success-icon">
            ✓
        </div>

        <span class="success-label">
            ORDER SUCCESS
        </span>

        <h1>
            สั่งซื้อสำเร็จ!
        </h1>

        <p>
            ขอบคุณที่ใช้บริการ 67Shop
        </p>

        <div class="order-info">

            <p>
                <b>ผู้ซื้อ:</b>
                <?= htmlspecialchars($order['name']) ?>
            </p>

            <p>
                <b>เบอร์โทร:</b>
                <?= htmlspecialchars($order['phone']) ?>
            </p>

            <p>
                <b>วิธีชำระเงิน:</b>
                <?= htmlspecialchars($order['payment']) ?>
            </p>

            <p>
                <b>ยอดชำระ:</b>
                <strong>
                    ฿<?= number_format($order['total']) ?>
                </strong>
            </p>

        </div>

        <a href="index.php" class="home-btn">
            ← กลับไปเลือกหนังสือ
        </a>

    </div>

</main>

</body>
</html>