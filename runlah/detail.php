<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>นครสวรรค์ สปีด เทรล - RUNLAH</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        body { background-color: #0e0e10; color: #ffffff; padding-bottom: 60px; line-height: 1.6; }

        /* Navbar */
        .navbar {
            background-color: #121214; padding: 12px 4%; display: flex; align-items: center;
            justify-content: space-between; border-bottom: 1px solid #1a1a1d; position: sticky; top: 0; z-index: 100;
        }
        .logo-img { height: 80px; width: auto; }
        .nav-links a { color: #a0a0a0; text-decoration: none; font-size: 14px; margin-right: 20px; }
        .nav-links a.active { color: #fff; font-weight: bold; }

        /* Container */
        .container { max-width: 900px; margin: 30px auto; padding: 0 20px; }

        /* Banner */
        .event-banner { width: 100%; border-radius: 12px; overflow: hidden; margin-bottom: 25px; border: 1px solid #1f1f24; }
        .event-banner img { width: 100%; height: auto; display: block; }

        /* Header Info */
        .event-header h1 { font-size: 28px; margin-bottom: 15px; color: #ffffff; }
        .info-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 12px; margin-bottom: 20px; font-size: 14px; color: #cccccc; }
        .info-item { display: flex; align-items: center; gap: 8px; }

        /* Register Button */
        .btn-register {
            display: inline-block; background-color: #1d72f3; color: #fff; padding: 12px 28px;
            border-radius: 25px; text-decoration: none; font-weight: bold; font-size: 15px; margin: 15px 0 35px 0;
            transition: background 0.2s;
        }
        .btn-register:hover { background-color: #155ec4; }

        /* Content Card */
        .section-card {
            background-color: #121215; border: 1px solid #1f1f24; border-radius: 12px;
            padding: 20px; margin-bottom: 25px;
        }
        .section-title { font-size: 16px; font-weight: bold; color: #fff; margin-bottom: 15px; }

        /* Images Inside Card */
        .content-img { width: 100%; border-radius: 8px; margin-bottom: 15px; display: block; }

        /* Category Table */
        .age-table { width: 100%; border-collapse: collapse; margin-top: 10px; margin-bottom: 20px; font-size: 13px; }
        .age-table th, .age-table td { border: 1px solid #2a2a32; padding: 10px; text-align: center; }
        .age-table th { background-color: #ff5500; color: #fff; font-weight: bold; }
        .age-table tr:nth-child(even) { background-color: #1a1a1e; }
        .category-header { color: #888890; font-size: 14px; font-weight: bold; margin: 15px 0 8px 0; }


        .race-kit-card {
        background-color: #121215;
        border: 1px solid #1f1f24;
        border-radius: 12px;
        padding: 20px 24px;
        color: #ffffff;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        max-width: 900px;
        margin: 0 auto 25px auto;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
    }

    .card-header {
        font-size: 16px;
        font-weight: bold;
        color: #ffffff;
        margin-bottom: 12px;
    }

    .card-divider {
        border: none;
        border-top: 1px solid #222228;
        margin-bottom: 20px;
    }

    .date-title {
        font-size: 18px;
        font-weight: bold;
        color: #ffffff;
        margin-bottom: 12px;
    }

    .info-group p {
        font-size: 14px;
        color: #cccccc;
        margin-bottom: 6px;
        line-height: 1.6;
    }

    .info-group strong {
        color: #ffffff;
    }

    .info-group a, .section-block a {
        color: #3b82f6;
        text-decoration: underline;
    }

    .info-group a:hover, .section-block a:hover {
        color: #60a5fa;
    }

    .section-block {
        margin-top: 18px;
    }

    .section-heading {
        font-size: 14px;
        font-weight: bold;
        color: #ffffff;
        margin-bottom: 8px;
        line-height: 1.5;
    }

    .custom-list {
        list-style-type: disc;
        padding-left: 24px;
    }

    .custom-list li {
        font-size: 14px;
        color: #cccccc;
        margin-bottom: 6px;
        line-height: 1.5;
    }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar">
        <a href="index.php"><img src="img/logo.png" alt="RUNLAH" class="logo-img"></a>
        <div class="nav-links">
            <a href="index.php">หน้าหลัก</a>
            <a href="index.php" class="active">ปฏิทินงานวิ่ง</a>
        </div>
    </nav>

    <div class="container">
        <!-- Event Poster -->
        <div class="event-banner">
            <img src="img/poster.jpg" alt="นครสวรรค์ สปีด เทรล">
        </div>

        <!-- Event Details -->
        <div class="event-header">
            <h1>นครสวรรค์ สปีด เทรล</h1>
            <div class="info-grid">
                <div class="info-item">📅 <strong>วันที่จัดงาน:</strong> 22 พฤศจิกายน 2026</div>
                <div class="info-item">📍 <strong>ที่ตั้ง:</strong> วัดป่าเขารังจันทนาราม หนองปลิง นครสวรรค์</div>
                <div class="info-item">👥 <strong>ผู้จัด:</strong> ชมรมวิ่งคนเมืองพระบาง</div>
                <div class="info-item">🏷️ <strong>ประเภท:</strong> การวิ่งเทรล การวิ่งครอสคันทรี อัลตร้าเทรล</div>
            </div>
            <a href="register.php" class="btn-register">ลงทะเบียนเลย!</a>
        </div>

        <!-- Shirt Section -->
        <div class="section-card">
            <div class="section-title">เสื้อแข่ง.</div>
            <img src="img/NPRU.png" alt="เสื้อแข่ง" class="content-img">
        </div>

        <!-- Maps Section -->
        <div class="section-card">
            <div class="section-title">แผนที่เส้นทางทางแข่งขัน</div>
            <p style="color:#aaa; font-size:13px; margin-bottom:10px;">40KM (ELEVATION 1,000m) | 25KM (ELEVATION 800m) | 11KM (ELEVATION 400m)</p>
            <img src="img/MAP.png" alt="แผนที่" class="content-img">
            
        </div>

        <!-- Award Categories Section -->
        <div class="section-card">
            <div class="section-title">รางวัลและกลุ่มรุ่นอายุ (รางวัลแยกชาย 5 รางวัล / หญิง 5 รางวัล)</div>

            <div class="category-header">🔰 ระยะ TRAIL 40 กม. / 25 กม. / 11 กม.</div>
            <table class="age-table">
                <thead>
                    <tr>
                        <th style="width:50%;">ชาย (Male)</th>
                        <th style="width:50%;">หญิง (Female)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr><td>รุ่นอายุไม่เกิน 29 ปี</td><td>รุ่นอายุไม่เกิน 29 ปี</td></tr>
                    <tr><td>รุ่นอายุ 30 – 39 ปี</td><td>รุ่นอายุ 30 – 39 ปี</td></tr>
                    <tr><td>รุ่นอายุ 40 – 49 ปี</td><td>รุ่นอายุ 40 – 49 ปี</td></tr>
                    <tr><td>รุ่นอายุ 50 ปีขึ้นไป</td><td>รุ่นอายุ 50 ปีขึ้นไป</td></tr>
                </tbody>
            </table>

            <div class="category-header">🔰 ระยะทาง 5 กม.</div>
            <table class="age-table">
                <thead>
                    <tr>
                        <th style="width:50%;">ชาย (Male)</th>
                        <th style="width:50%;">หญิง (Female)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr><td>รุ่นอายุไม่เกิน 15 ปี (5 รางวัล)</td><td>รุ่นอายุไม่เกิน 15 ปี (5 รางวัล)</td></tr>
                    <tr><td>รุ่นอายุ 16 ปีขึ้นไป (10 รางวัล)</td><td>รุ่นอายุ 16 ปีขึ้นไป (10 รางวัล)</td></tr>
                </tbody>
            </table>
        </div>
<div class="race-kit-card">
    <div class="card-header">ชุดแข่ง</div>
    <hr class="card-divider">
    
    <div class="card-body">
        <h3 class="date-title">วันเสาร์ที่ 21 พฤศจิกายน 2026</h3>
        
        <div class="info-group">
            <p><strong>เวลาทำการ :</strong> 10.00 น. - 18.00 น.</p>
            <p><strong>สถานที่ :</strong> วัดป่าเขารังจันทนาราม หนองปลิง นครสวรรค์</p>
            <p><strong>แผนที่ Google :</strong> <a href="https://maps.app.goo.gl/eGwacnu1AuuJzQpt5" target="_blank">https://maps.app.goo.gl/eGwacnu1AuuJzQpt5</a></p>
        </div>

        <div class="section-block">
            <p class="section-heading">สำหรับการรับสินค้าด้วยตนเอง โปรดนำสิ่งต่อไปนี้มาด้วย:</p>
            <ul class="custom-list">
                <li>หมายเลขติดตามการลงทะเบียนหรือบาร์โค้ด (ส่งอีเมลหรือตรวจสอบได้จาก <a href="#">ที่นี่</a>)</li>
                <li>บัตรประจำตัวประชาชน/หนังสือเดินทาง</li>
            </ul>
        </div>

        <div class="section-block">
            <p class="section-heading">ผู้เข้าร่วมที่ไม่สามารถมารับชุดอุปกรณ์การแข่งขัน (REPC) ได้ในวันและเวลาที่กำหนด สามารถมอบอำนาจให้ตัวแทนมารับแทนได้ โดยตัวแทนที่ได้รับมอบอำนาจจะต้องแสดงเอกสารดังต่อไปนี้เมื่อมารับชุดอุปกรณ์:</p>
            <ul class="custom-list">
                <li>หมายเลขติดตามการลงทะเบียนหรือบาร์โค้ด (ส่งอีเมลหรือตรวจสอบได้จาก <a href="#">ที่นี่</a>)</li>
                <li>บัตรประจำตัวประชาชน/หนังสือเดินทางของผู้แทน</li>
                <li>สำเนาบัตรประจำตัวประชาชน/หนังสือเดินทางของผู้เข้าร่วม</li>
            </ul>
        </div>
    </div>
</div>


<div class="info-group">
            <p>ผู้สมัครอายุต่ำกว่า 12 ปี ต้องได้รับความยินยอมจากผู้ปกครองก่อนเข้าร่วมการแข่งขัน
ผู้เข้าร่วมต้องมารับชุดอุปกรณ์การแข่งขัน (Race Kit) ด้วยตนเอง พร้อมแสดงเอกสารยืนยันตัวตน เช่น
บัตรประจำตัวประชาชน
ใบขับขี่
หนังสือเดินทาง
การตัดสินผลการแข่งขันจะใช้ เวลาอย่างเป็นทางการ (Official Time) จากนาฬิกาของการแข่งขัน พร้อมตรวจสอบจากหมายเลขนักวิ่ง (BIB) และจุดตรวจ (Checkpoint)
นักวิ่งต้องมาถึงจุดปล่อยตัวก่อนเวลาที่กำหนด ลงทะเบียนให้เรียบร้อย และออกตัวจากจุดสตาร์ทตามที่ผู้จัดกำหนด
ระหว่างการแข่งขัน นักวิ่งต้อง
ติดหมายเลข BIB ไว้ด้านหน้าให้เห็นชัด
วิ่งตามเส้นทางที่กำหนด
ผ่านจุดตรวจทุกจุด
หากออกนอกเส้นทาง อาจถูกตัดสิทธิ์ทันที
ควรรักษามารยาทในการวิ่ง
ไม่วิ่งเป็นแถวขวางทาง
มองด้านหลังก่อนเปลี่ยนเลนหรือแซง
หากต้องหยุด ให้หลบออกข้างทาง
ห้ามใช้อุปกรณ์หรือสวมใส่สิ่งของที่อาจก่อให้เกิดอันตรายต่อผู้ร่วมแข่งขัน
ห้ามแต่งกายหรือแสดงพฤติกรรมที่ไม่เหมาะสม เช่น
ใช้คำหยาบคาย
แสดงความคิดเห็นทางการเมือง
ดูหมิ่นศาสนาหรือความเชื่อ
โฆษณาสินค้าหรือกิจกรรมโดยไม่ได้รับอนุญาต
ห้ามใช้อุปกรณ์หรือส่งเสียงที่อาจทำให้ผู้อื่นเข้าใจผิดว่าเป็นสัญญาณจากเจ้าหน้าที่
ห้ามกระทำการใด ๆ ที่เป็นการกีดขวางเส้นทางการแข่งขันหรือเส้นชัย
ต้องหยุดหรือหลีกทางให้รถพยาบาลและเจ้าหน้าที่ฉุกเฉินเมื่อจำเป็น
ผู้เข้าร่วมต้องปฏิบัติตามคำแนะนำของเจ้าหน้าที่และกรรมการตลอดการแข่งขัน
ผู้ที่ได้รับรางวัลต้องรายงานตัวภายใน 30 นาที หลังเข้าเส้นชัย หากไม่มารายงานตัวภายในเวลาที่กำหนด ถือว่าสละสิทธิ์
การรับรางวัลต้องแสดง
หมายเลขประจำตัวนักวิ่ง (BIB)
ป้ายแสดงอันดับ
บัตรประชาชน หรือบัตรราชการที่มีรูปถ่าย หรือหนังสือเดินทาง
หากไม่แสดงเอกสารภายในเวลาที่กำหนด จะถูกตัดสิทธิ์รับรางวัล
การยื่นประท้วงผลการแข่งขันสามารถดำเนินการได้ภายใน 30 นาที หลังเข้าเส้นชัย
กรณีที่ไม่มีระบุไว้ในระเบียบนี้ ให้ยึดตามกฎการแข่งขันของ สมาคมกรีฑาแห่งประเทศไทย ในพระบรมราชูปถัมภ์
รูปภาพ วิดีโอ เสียง บทความ และสถิติการแข่งขันเป็นลิขสิทธิ์ของผู้จัดงาน โดย
ผู้จัดสามารถเผยแพร่ผ่านสื่อต่าง ๆ ได้
นักวิ่งสามารถใช้ภาพหรือวิดีโอของตนเองได้
ห้ามนำภาพหรือวิดีโอของงานไปใช้เพื่อการค้าโดยไม่ได้รับอนุญาต
คำตัดสินของคณะกรรมการจัดการแข่งขันถือเป็นที่สิ้นสุด
ผู้สมัครรับรองว่ามีสุขภาพแข็งแรงและพร้อมเข้าร่วมการแข่งขัน รวมทั้งยอมรับว่าการเข้าร่วมการแข่งขันเป็นความรับผิดชอบและความเสี่ยงของตนเอง ผู้จัดงานจะไม่รับผิดชอบต่อการบาดเจ็บ ความสูญเสีย หรือผลกระทบที่เกิดขึ้นจากการแข่งขันทุกกรณี</p>
    

</div>

</div>
<div style="text-align: center; margin-top: 20px;">
    <a href="register.php" class="btn-register" style="padding: 15px 40px; font-size: 16px;">สมัครวิ่งรายการนี้</a>
</div>

</body>
</html>