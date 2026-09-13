<?php
session_start();
require_once "BookStore.php";

$store = new BookStore();
$allBooks = $store->getBooks();

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if (isset($_GET['add'])) {
    $book = $store->find((int)$_GET['add']);
    if ($book) {
        $id = $book->getId();
        $_SESSION['cart'][$id] = ($_SESSION['cart'][$id] ?? 0) + 1;
    }
    header("Location: index.php?added=1#books");
    exit;
}

$keyword = trim($_GET['search'] ?? '');
$category = $_GET['category'] ?? 'ทั้งหมด';

$books = array_filter($allBooks, function($book) use ($keyword, $category) {
    $text = $keyword === '' ||
        stripos($book->getTitle(), $keyword) !== false ||
        stripos($book->getAuthor(), $keyword) !== false ||
        stripos($book->getCategory(), $keyword) !== false;

    $cat = $category === 'ทั้งหมด' || $book->getCategory() === $category;
    return $text && $cat;
});

$cartCount = array_sum($_SESSION['cart']);
$categories = ['ทั้งหมด','นิยาย','การ์ตูน','พัฒนาตนเอง','ความรู้','ธุรกิจ','เทคโนโลยี','วรรณกรรม'];
$icons = ['ทั้งหมด'=>'✦','นิยาย'=>'◈','การ์ตูน'=>'♢','พัฒนาตนเอง'=>'↗','ความรู้'=>'◎','ธุรกิจ'=>'▣','เทคโนโลยี'=>'⌘','วรรณกรรม'=>'❝'];
?>
<!DOCTYPE html>
<html lang="th">
<head>
<meta charset="UTF-8">
<title>67Shop | ร้านหนังสือ</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<div class="top-line"></div>

<header class="header">
    <a class="brand" href="index.php">
        <span class="brand-icon">67</span>
        <span><strong>67Shop</strong><small>GOOD BOOKS • BETTER DAYS</small></span>
    </a>

    <form class="search" method="get">
        <span>⌕</span>
        <input name="search" value="<?= htmlspecialchars($keyword) ?>" placeholder="ค้นหาชื่อหนังสือ ผู้เขียน หรือหมวดหมู่">
        <button>ค้นหา</button>
    </form>

    <div class="header-links">
        <a href="#books">หนังสือ</a>
        <a href="#category">หมวดหมู่</a>
        <a class="cart" href="cart.php">🛒 ตะกร้า <b><?= $cartCount ?></b></a>
    </div>
</header>

<nav>
    <div class="nav-inner">
        <a class="active" href="index.php">หน้าแรก</a>
        <a href="#books">หนังสือทั้งหมด</a>
        <a href="#category">หมวดหมู่</a>
        <a href="#promotion">โปรโมชั่น</a>
        <a href="#about">เกี่ยวกับเรา</a>
        <span class="nav-message"><a href="login.php">เข้าสู่ระบบ</a></span>
    </div>
</nav>

<?php if (isset($_GET['added'])): ?>
<div class="notice">✓ เพิ่มหนังสือลงตะกร้าแล้ว <a href="cart.php">ดูตะกร้า →</a></div>
<?php endif; ?>

<section class="hero">
    <div class="hero-content">
        <div class="hero-copy">
            <div class="pill">✦ ร้านหนังสือออนไลน์</div>
            <h1>ค้นพบหนังสือ<br><em>เล่มโปรด</em>ของคุณ</h1>
            <p>หนังสือดี ๆ อาจเปลี่ยนมุมมองของเราได้<br>เลือกเรื่องที่ใช่ แล้วเริ่มต้นหน้าถัดไปด้วยกัน</p>
            <div class="hero-actions">
                <a class="btn-main" href="#books">เริ่มเลือกหนังสือ <span>→</span></a>
                <a class="btn-ghost" href="#category">ดูหมวดหมู่</a>
            </div>
            <div class="stats">
                <span><b><?= count($allBooks) ?>+</b><small>หนังสือในร้าน</small></span>
                <span><b><?= count($categories)-1 ?></b><small>หมวดหมู่</small></span>
                <span><b>10%</b><small>ส่วนลดสมาชิกใหม่</small></span>
            </div>
        </div>

        <div class="hero-visual">
            <div class="circle c-big"></div>
            <div class="circle c-small"></div>
            <div class="floating-card">BEST<br><strong>SELLER</strong></div>
            <div class="book-show blue-book"><small>67SHOP</small><strong>READ<br>MORE</strong><i>GOOD BOOKS</i></div>
            <div class="book-show cream-book"><small>BOOK STORE</small><strong>YOUR<br>STORY</strong></div>
            <div class="spark">✦</div>
        </div>
    </div>
</section>

<section id="category" class="category-wrap">
    <div class="section-head"><span>EXPLORE</span><h2>เลือกตามสไตล์ที่ชอบ</h2></div>
    <div class="categories">
        <?php foreach ($categories as $cat): ?>
            <a class="<?= $category === $cat ? 'selected' : '' ?>" href="index.php?category=<?= urlencode($cat) ?>#books">
                <b><?= $icons[$cat] ?></b><?= $cat ?>
            </a>
        <?php endforeach; ?>
    </div>
</section>

<section id="books" class="books">
    <div class="section-head book-head">
        <div><span>OUR COLLECTION</span><h2><?= ($keyword || $category !== 'ทั้งหมด') ? 'ผลการค้นหา' : 'หนังสือแนะนำ' ?></h2></div>
        <a href="index.php#books">ดูทั้งหมด →</a>
    </div>

    <?php if (!$books): ?>
        <div class="empty">ไม่พบหนังสือที่ค้นหา ลองค้นหาคำอื่นดูนะ</div>
    <?php else: ?>
    <div class="book-grid">
        <?php foreach ($books as $book): ?>
        <article class="book-card">
            <a class="cover <?= htmlspecialchars($book->getColor()) ?>" href="?add=<?= $book->getId() ?>#books">
                <span class="cover-top"><?= htmlspecialchars($book->getCategory()) ?></span>
                <span class="cover-icon">✦</span>
                <strong><?= htmlspecialchars($book->getTitle()) ?></strong>
                <small><?= htmlspecialchars($book->getAuthor()) ?></small>
                <i>67SHOP</i>
            </a>
            <div class="book-info">
                <div class="category"><?= htmlspecialchars($book->getCategory()) ?></div>
                <h3><?= htmlspecialchars($book->getTitle()) ?></h3>
                <p><?= htmlspecialchars($book->getAuthor()) ?></p>
                <div class="price-row">
                    <strong>฿<?= number_format($book->getPrice()) ?></strong>
                    <a href="?add=<?= $book->getId() ?>#books" class="add">＋</a>
                </div>
            </div>
        </article>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>
</section>

<section id="promotion" class="promotion">
    <div class="promo-icon">10%</div>
    <div><span>67SHOP MEMBER</span><h2>สมาชิกใหม่ ลดทันที 10%</h2><p>ซื้อหนังสือเล่มแรกกับเรา รับส่วนลดพิเศษ</p></div>
    <a href="#" class="btn-light">สมัครสมาชิก →</a>
</section>

<section id="about" class="about">
    <div class="about-box">
        <span>ABOUT 67SHOP</span>
        <h2>หนังสือหนึ่งเล่ม<br>อาจเปิดโลกอีกใบ</h2>
        <p>67Shop คือร้านหนังสือออนไลน์จำลองสำหรับโปรเจกต์ OOP และ OOAD ออกแบบให้ใช้งานง่ายและเป็นระบบ</p>
        <a href="#books">เลือกหนังสือของคุณ →</a>
    </div>
    <div class="about-deco">“</div>
</section>

<footer><b>67Shop</b> &nbsp; • &nbsp; Good Books, Better Days &nbsp; • &nbsp; OOP & OOAD Project</footer>
</body>
</html>
