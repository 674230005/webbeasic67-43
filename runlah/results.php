<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ผลการแข่งขัน - RUNLAH</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        body { background-color: #0e0e10; color: #ffffff; min-height: 100vh; padding-bottom: 50px; }

        .navbar { background-color: #121214; padding: 12px 4%; display: flex; align-items: center; justify-content: space-between; border-bottom: 1px solid #1a1a1d; position: sticky; top: 0; z-index: 100; }
        .logo-img { height: 80px; }
        .nav-links a { color: #a0a0a0; text-decoration: none; font-size: 14px; margin-right: 20px; }
        .nav-links a.active { color: #fff; font-weight: bold; border-bottom: 2px solid #ff3b00; padding-bottom: 12px; }

        .container { max-width: 1100px; margin: 25px auto; padding: 0 20px; }

        .hero-banner { position: relative; width: 100%; height: 220px; border-radius: 12px; overflow: hidden; margin-bottom: 20px; }
        .hero-banner img { width: 100%; height: 100%; object-fit: cover; filter: brightness(0.5); }
        .hero-text { position: absolute; bottom: 30px; left: 30px; }
        .hero-text h1 { font-size: 30px; color: #fff; }
        .hero-text p { font-size: 13px; color: #ccc; margin-top: 5px; }

        .search-bar { margin-bottom: 25px; }
        .search-bar input { width: 100%; max-width: 350px; padding: 10px 14px; background: #1a1a1e; border: 1px solid #2a2a30; border-radius: 8px; color: #fff; outline: none; }

        .results-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(220px, 1fr)); gap: 18px; }
        .result-card { background-color: #121215; border: 1px solid #1f1f24; border-radius: 10px; overflow: hidden; transition: 0.2s; text-decoration: none; color: #fff; }
        .result-card:hover { transform: translateY(-4px); border-color: #333; }
        .result-card img { width: 100%; height: 150px; object-fit: cover; }
        .card-body { padding: 12px; }
        .card-body h4 { font-size: 14px; margin-bottom: 6px; line-height: 1.3; }
        .card-body p { font-size: 11px; color: #888; }
    </style>
</head>
<body>

    <nav class="navbar">
        <a href="index.php"><img src="img/logo.png" alt="RUNLAH" class="logo-img"></a>
        <div class="nav-links">
            <a href="index.php">หน้าหลัก</a>
            <a href="calendar.php">ปฏิทินงานวิ่ง</a>
            <a href="results.php" class="active">ผลการแข่งขัน</a>
            <a href="organizer.php">สำหรับผู้จัดงาน</a>
        </div>
    </nav>

    <div class="container">
        <div class="hero-banner">
            <img src="https://images.unsplash.com/photo-1461896836934-ffe607ba8211?auto=format&fit=crop&w=1200" alt="Results Banner">
            <div class="hero-text">
                <h1>ผลการแข่งขัน</h1>
                <p>ค้นหาผลเวลาและสถิติต่างๆ ที่ได้รับการรับรองระบบจาก RUNLAH</p>
            </div>
        </div>

        <div class="search-bar">
            <input type="text" placeholder="🔍 ค้นหาผลการแข่งขัน">
        </div>

        <div class="results-grid">
            <a href="#" class="result-card">
                <img src="https://picsum.photos/300/200?random=11" alt="event">
                <div class="card-body">
                    <h4>งานวิ่งมินิมาราธอน 2026</h4>
                    <p>15 สิงหาคม 2569</p>
                    <p>หาดจอมเทียน จ.ชลบุรี</p>
                </div>
            </a>
            <a href="#" class="result-card">
                <img src="https://picsum.photos/300/200?random=12" alt="event">
                <div class="card-body">
                    <h4>หัวหิน มินิมาราธอน 2026</h4>
                    <p>9 สิงหาคม 2569</p>
                    <p>อุทยานราชภักดิ์ จ.ประจวบคีรีขันธ์</p>
                </div>
            </a>
            <a href="#" class="result-card">
                <img src="https://picsum.photos/300/200?random=13" alt="event">
                <div class="card-body">
                    <h4>เขื่อนภูมิพล มินิมาราธอน</h4>
                    <p>2 สิงหาคม 2569</p>
                    <p>เขื่อนภูมิพล จ.ตาก</p>
                </div>
            </a>
            <a href="#" class="result-card">
                <img src="https://picsum.photos/300/200?random=14" alt="event">
                <div class="card-body">
                    <h4>เขาใหญ่ เทรล 2026</h4>
                    <p>26 กรกฎาคม 2569</p>
                    <p>อุทยานแห่งชาติเขาใหญ่</p>
                </div>
            </a>
        </div>
    </div>

</body>
</html>