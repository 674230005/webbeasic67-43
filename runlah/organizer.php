<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>สำหรับผู้จัดงาน - RUNLAH</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        body { background-color: #0e0e10; color: #ffffff; min-height: 100vh; padding-bottom: 60px; }

        .navbar { background-color: #121214; padding: 12px 4%; display: flex; align-items: center; justify-content: space-between; border-bottom: 1px solid #1a1a1d; position: sticky; top: 0; z-index: 100; }
        .logo-img { height: 80px; }
        .nav-links a { color: #a0a0a0; text-decoration: none; font-size: 14px; margin-right: 20px; }
        .nav-links a.active { color: #fff; font-weight: bold; border-bottom: 2px solid #ff3b00; padding-bottom: 12px; }

        .container { max-width: 1000px; margin: 25px auto; padding: 0 20px; }

        .hero-card { position: relative; width: 100%; border-radius: 12px; overflow: hidden; background: #18181c; border: 1px solid #222; text-align: center; padding: 50px 20px; margin-bottom: 30px; }
        .hero-card h1 { font-size: 26px; margin-bottom: 12px; }
        .hero-card p { font-size: 13px; color: #aaa; max-width: 600px; margin: 0 auto 20px auto; }
        
        .btn-red { display: inline-block; background-color: #ff3b00; color: #fff; padding: 10px 22px; border-radius: 6px; text-decoration: none; font-weight: bold; font-size: 13px; margin-right: 10px; }
        .btn-outline { display: inline-block; background: transparent; border: 1px solid #444; color: #fff; padding: 10px 22px; border-radius: 6px; text-decoration: none; font-size: 13px; }

        /* Steps Flow */
        .steps-wrapper { display: flex; justify-content: space-around; margin: 30px 0; text-align: center; }
        .step-node { position: relative; font-size: 12px; color: #aaa; }
        .step-circle { width: 36px; height: 36px; background-color: #222; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 8px auto; font-weight: bold; color: #fff; border: 1px solid #333; }

        /* Stats Grid */
        .stats-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 15px; text-align: center; margin-bottom: 40px; }
        .stat-box { background: #121215; border: 1px solid #1f1f24; padding: 20px 10px; border-radius: 10px; }
        .stat-number { font-size: 22px; font-weight: bold; color: #1d72f3; margin-bottom: 4px; }
        .stat-label { font-size: 11px; color: #888; }

        /* Trusted Events Showcase Grid */
        .showcase-title { font-size: 16px; margin-bottom: 15px; text-align: center; color: #ccc; }
        .showcase-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(180px, 1fr)); gap: 12px; }
        .showcase-card { border-radius: 8px; overflow: hidden; height: 110px; border: 1px solid #222; }
        .showcase-card img { width: 100%; height: 100%; object-fit: cover; }
    </style>
</head>
<body>

    <nav class="navbar">
        <a href="index.php"><img src="img/logo.png" alt="RUNLAH" class="logo-img"></a>
        <div class="nav-links">
            <a href="index.php">หน้าหลัก</a>
            <a href="calendar.php">ปฏิทินงานวิ่ง</a>
            <a href="results.php">ผลการแข่งขัน</a>
            <a href="organizer.php" class="active">สำหรับผู้จัดงาน</a>
        </div>
    </nav>

    <div class="container">
        <div class="hero-card">
            <h1>เครื่องมือที่จะช่วยให้การจัดงานแข่ง<br>ของคุณง่ายขึ้นในทุกขั้นตอน</h1>
            <p>พัฒนาระบบรับสมัครงานวิ่ง ปรับแต่งหน้าเว็บได้เอง รองรับระบบรับชำระเงินที่หลากหลาย พร้อมทีมงานดูแลตลอดการใช้งาน</p>
            <div>
                <a href="#" class="btn-red">โปรโมทหรือจัดงานของคุณที่นี่</a>
                <a href="#" class="btn-outline">ติดต่อเรา</a>
            </div>
        </div>

        <!-- 4 Step Process -->
        <div class="steps-wrapper">
            <div class="step-node"><div class="step-circle">1</div>ส่งข้อมูล</div>
            <div class="step-node"><div class="step-circle">2</div>ลงทะเบียน</div>
            <div class="step-node"><div class="step-circle">3</div>วันแข่งขัน</div>
            <div class="step-node"><div class="step-circle">4</div>สรุปผล</div>
        </div>

        <!-- Statistics -->
        <div class="stats-grid">
            <div class="stat-box">
                <div class="stat-number">1,200+</div>
                <div class="stat-label">งานวิ่งที่เคยจัดผ่านเรา</div>
            </div>
            <div class="stat-box">
                <div class="stat-number">1,000,000+</div>
                <div class="stat-label">นักวิ่งในระบบทั้งหมด</div>
            </div>
            <div class="stat-box">
                <div class="stat-number">270+</div>
                <div class="stat-label">ผู้จัดงานทั่วประเทศ</div>
            </div>
            <div class="stat-box">
                <div class="stat-number">600,000+</div>
                <div class="stat-label">ผู้เข้าชมเว็บไซต์ต่อเดือน</div>
            </div>
        </div>

        <!-- Showcase Grid -->
        <div class="showcase-title">กิจกรรมที่ไว้วางใจ RUNLAH</div>
        <div class="showcase-grid">
            <div class="showcase-card"><img src="https://picsum.photos/300/200?random=21" alt="event"></div>
            <div class="showcase-card"><img src="https://picsum.photos/300/200?random=22" alt="event"></div>
            <div class="showcase-card"><img src="https://picsum.photos/300/200?random=23" alt="event"></div>
            <div class="showcase-card"><img src="https://picsum.photos/300/200?random=24" alt="event"></div>
        </div>
    </div>

</body>
</html>