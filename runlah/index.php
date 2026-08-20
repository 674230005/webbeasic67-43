<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RUNLAH - ปฏิทินงานวิ่ง</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        body { background-color: #0e0e10; color: #ffffff; padding-bottom: 60px; }

        /* --- Navbar --- */
        .navbar {
            background-color: #121214;
            padding: 10px 4%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1px solid #1a1a1d;
            position: sticky;
            top: 0;
            z-index: 100;
        }
        .nav-left { display: flex; align-items: center; gap: 20px; }
        .logo { display: flex; align-items: center; text-decoration: none; }
        .logo-img { height: 80px; width: auto; display: block; object-fit: contain; }
        .nav-links { display: flex; gap: 20px; }
        .nav-links a { color: #a0a0a0; text-decoration: none; font-size: 13px; padding-bottom: 12px; margin-bottom: -12px; }
        .nav-links a.active { color: #ffffff; font-weight: bold; border-bottom: 2px solid #ff3b00; }
        
        .nav-right { display: flex; align-items: center; gap: 12px; }
        .search-box { background-color: #1a1a1e; border: 1px solid #2a2a30; border-radius: 6px; padding: 5px 10px; display: flex; align-items: center; gap: 8px; }
        .search-box input { background: transparent; border: none; color: #fff; outline: none; font-size: 12px; width: 100px; }
        .btn-to-register { background-color: #ff3b00; color: #fff; padding: 6px 14px; border-radius: 6px; text-decoration: none; font-size: 12px; font-weight: bold; transition: 0.2s; }
        .btn-to-register:hover { background-color: #e03400; }

        /* --- Main Layout Container --- */
        .container { max-width: 1100px; margin: 0 auto; padding: 25px 20px; }

        /* --- Hero Banner --- */
        .hero-card {
            width: 100%; height: 380px; border-radius: 16px;
            background: linear-gradient(to top, rgba(0,0,0,0.85) 0%, rgba(0,0,0,0.1) 60%),
                        url('https://images.unsplash.com/photo-1530143311094-34d807799e8f?auto=format&fit=crop&w=1200&q=80') center/cover no-repeat;
            display: flex; align-items: flex-end; padding: 30px; box-shadow: 0 10px 30px rgba(0,0,0,0.6);
            margin-bottom: 25px;
        }
        .hero-card h1 { font-size: 30px; font-weight: 800; line-height: 1.3; text-shadow: 0 2px 8px rgba(0,0,0,0.8); }

        /* --- Highlight Event Card (Nakhonsawan Speed Trail) --- */
        .event-highlight-card {
            background: #121215;
            border-radius: 16px;
            padding: 20px;
            display: grid;
            grid-template-columns: 1.2fr 1fr;
            gap: 25px;
            align-items: center;
            margin-bottom: 40px;
            border: 1px solid #1f1f24;
        }
        .highlight-img-wrapper img {
            width: 100%;
            height: 320px;
            object-fit: cover;
            border-radius: 12px;
            display: block;
        }
        .highlight-details {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        .highlight-details h2 { font-size: 24px; font-weight: bold; color: #ffffff; }
        .highlight-quote { color: #aaaaaa; font-size: 13px; line-height: 1.4; }
        .highlight-info {
            margin-top: 10px;
            display: flex;
            flex-direction: column;
            gap: 6px;
            font-size: 13px;
            color: #dddddd;
        }
        .highlight-info .date { color: #ffffff; font-weight: 600; }
        .highlight-info .organizer { color: #888890; font-size: 12px; margin-top: 6px; }
        .highlight-actions {
            display: flex;
            gap: 12px;
            margin-top: 15px;
        }
        .btn-detail {
            background: #222228;
            color: #ffffff;
            padding: 10px 22px;
            border-radius: 20px;
            text-decoration: none;
            font-size: 13px;
            font-weight: 500;
            transition: 0.2s;
        }
        .btn-detail:hover { background: #33333d; }
        .btn-apply {
            background: #1d72f3;
            color: #ffffff;
            padding: 10px 24px;
            border-radius: 20px;
            text-decoration: none;
            font-size: 13px;
            font-weight: bold;
            transition: 0.2s;
        }
        .btn-apply:hover { background: #155ec4; }

        /* --- Section Titles --- */
        .section-header-split { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 15px; }
        .section-title { font-size: 18px; font-weight: bold; margin-bottom: 15px; color: #ffffff; }

        /* --- Grid & Event Cards --- */
        .cards-grid-4 { display: grid; grid-template-columns: repeat(4, 1fr); gap: 16px; margin-bottom: 40px; }
        
        .event-card {
            background: #16161a; border-radius: 10px; overflow: hidden;
            border: 1px solid #222228; text-decoration: none; color: inherit;
            display: flex; flex-direction: column; transition: transform 0.2s, border-color 0.2s;
        }
        .event-card:hover { transform: translateY(-4px); border-color: #ff3b00; }
        .event-img { width: 100%; height: 130px; object-fit: cover; background-color: #222; }
        .event-body { padding: 12px; display: flex; flex-direction: column; gap: 6px; flex-grow: 1; }
        .event-title { font-size: 13px; font-weight: bold; color: #fff; line-height: 1.4; height: 36px; overflow: hidden; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; }
        .event-date { font-size: 11px; color: #ff3b00; font-weight: 600; }
        .event-location { font-size: 11px; color: #888890; line-height: 1.3; }

        /* --- Section: แนะนำเลย (Featured Grid) --- */
        .featured-layout { display: grid; grid-template-columns: 1.2fr 1fr; gap: 16px; }
        
        .big-event-card {
            background: #16161a; border-radius: 12px; overflow: hidden;
            border: 1px solid #222228; text-decoration: none; color: inherit;
            display: flex; flex-direction: column; transition: transform 0.2s;
        }
        .big-event-card:hover { transform: translateY(-4px); border-color: #ff3b00; }
        .big-event-card .event-img { height: 260px; }
        .big-event-card .event-body { padding: 16px; }
        .big-event-card .event-title { font-size: 16px; height: auto; margin-bottom: 6px; }

        .small-cards-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }

        /* Responsive */
        @media (max-width: 900px) {
            .event-highlight-card { grid-template-columns: 1fr; }
            .cards-grid-4 { grid-template-columns: repeat(2, 1fr); }
            .featured-layout { grid-template-columns: 1fr; }
            .section-header-split { grid-template-columns: 1fr; gap: 0; }
        }
        @media (max-width: 600px) {
            .cards-grid-4 { grid-template-columns: 1fr; }
            .small-cards-grid { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>

    <!-- แถบเมนูด้านบน -->
    <nav class="navbar">
        <div class="nav-left">
            <a href="index.php" class="logo">
                <img src="./img/logo.png" alt="RUNLAH Logo" class="logo-img">
            </a>
            <div class="nav-links">
                <a href="index.php" class="active">หน้าหลัก</a>
                <a href="calendar.php">ปฏิทินงานวิ่ง</a>
                <a href="results.php">ผลการแข่งขัน</a>
                <a href="organizer.php">สำหรับผู้จัดงาน</a>
            </div>
        </div>

        <div class="nav-right">
            <form action="search.php" method="GET" class="search-box">
                <input type="text" name="q" placeholder="ค้นหา">
                <button type="submit" style="background:none; border:none; cursor:pointer; color:#666; font-size:12px;">&#128099;</button>
            </form>
            <a href="register.php" class="btn-to-register">สมัครวิ่ง</a>
        </div>
    </nav>

    <!-- เนื้อหาหลัก -->
    <div class="container">

        <!-- 1. แบนเนอร์ปฏิทินงานวิ่งนครปฐม -->
        <section class="hero-card">
            <h1>ปฏิทินงานวิ่งใน จังหวัดนครปฐม<br>2569</h1>
        </section>

        <!-- 2. การ์ดไฮไลต์ Nakhonsawan Speed Trail -->
        <section class="event-highlight-card">
            <div class="highlight-img-wrapper">
                <a href="detail.php?id=nakhonsawan-speed-trail">
                    <img src="https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?auto=format&fit=crop&w=800&q=80" alt="Nakhonsawan Speed Trail">
                </a>
            </div>
            <div class="highlight-details">
                <h2>Nakhonsawan Speed Trail</h2>
                <p class="highlight-quote">“ขึ้นเขากบและเขาคีรีวงศ์ ชมอุทยานสวรรค์ แลไหว้พระธาตุ”</p>
                
                <div class="highlight-info">
                    <p class="date">22 พฤศจิกายน 2569</p>
                    <p class="location">สำนักสงฆ์เขารังจันทร์ทราราม หนองปลิง นครสวรรค์ จ.นครสวรรค์</p>
                    <p class="organizer">&#128101; ผู้จัดงาน: ชมรมคนวิ่งเมืองพระบาง</p>
                </div>

                <div class="highlight-actions">
                    <a href="detail.php?id=nakhonsawan-speed-trail" class="btn-detail">รายละเอียด</a>
                    <a href="register.php?id=nakhonsawan-speed-trail" class="btn-apply">สมัครเลย!</a>
                </div>
            </div>
        </section>

        <!-- 3. ส่วนเปิดใหม่ & ยอดนิยม -->
        <div class="section-header-split">
            <h2 class="section-title">เปิดใหม่</h2>
            <h2 class="section-title">ยอดนิยม</h2>
        </div>

        <div class="cards-grid-4">
            <a href="detail.php?id=knt-run-2026" class="event-card">
                <img src="https://images.unsplash.com/photo-1552674605-db6ffd4facb5?auto=format&fit=crop&w=500&q=80" class="event-img" alt="KNT RUN">
                <div class="event-body">
                    <div class="event-title">งานเดิน-วิ่ง การกุศล ครั้งที่ 29 KNT RUN 2026</div>
                    <div class="event-date">5 ธันวาคม 2569</div>
                    <div class="event-location">ลานเอนกประสงค์ หน้าศาลากลางจังหวัดนครปฐม</div>
                </div>
            </a>

            <a href="detail.php?id=fxrun-2026" class="event-card">
                <img src="https://images.unsplash.com/photo-1530549387789-4c1017266635?auto=format&fit=crop&w=500&q=80" class="event-img" alt="FXRUN">
                <div class="event-body">
                    <div class="event-title">FXRUN 2026 Run for Education "วิ่งส่งน้องเรียน"</div>
                    <div class="event-date">22 พฤศจิกายน 2569</div>
                    <div class="event-location">มหาวิทยาลัยเกษตรศาสตร์ กำแพงแสน</div>
                </div>
            </a>

            <a href="detail.php?id=kirei-kirei-2026" class="event-card">
                <img src="https://images.unsplash.com/photo-1461896836934-ffe607ba8211?auto=format&fit=crop&w=500&q=80" class="event-img" alt="Kirei Kirei">
                <div class="event-body">
                    <div class="event-title">Kirei Kirei Global HandWashing Day Run 2026</div>
                    <div class="event-date">4 ตุลาคม 2569</div>
                    <div class="event-location">สวนสิริเจริญกาล กรุงเทพมหานคร</div>
                </div>
            </a>

            <a href="detail.php?id=bueng-boraphet-2026" class="event-card">
                <img src="https://images.unsplash.com/photo-1516214104703-d870798883c5?auto=format&fit=crop&w=500&q=80" class="event-img" alt="Bueng Boraphet">
                <div class="event-body">
                    <div class="event-title">BUENG BORAPHET NIGHT RUN 2026</div>
                    <div class="event-date">26 กันยายน 2569</div>
                    <div class="event-location">บึงบอระเพ็ด จ.นครสวรรค์</div>
                </div>
            </a>
        </div>

        <!-- 4. ส่วนแนะนำเลย -->
        <h2 class="section-title">แนะนำเลย</h2>
        
        <div class="featured-layout">
            <a href="detail.php?id=khlong-pheka-2026" class="big-event-card">
                <img src="https://images.unsplash.com/photo-1476480862126-209bfaa8edc8?auto=format&fit=crop&w=800&q=80" class="event-img" alt="Khlong Pheka Trail">
                <div class="event-body">
                    <div class="event-title">คลองเพกา เทรล 2026</div>
                    <div class="event-date">18 ตุลาคม 2569</div>
                    <div class="event-location">งานซีรีส์ สนาม 3 จังหวัด ครั้งที่ 2 สามารถติดตามงานต่อไปได้ที่เพจ</div>
                </div>
            </a>

            <div class="small-cards-grid">
                <a href="detail.php?id=run-with-the-flow-2026" class="event-card">
                    <img src="https://images.unsplash.com/photo-1502904550040-7534597429ae?auto=format&fit=crop&w=500&q=80" class="event-img" alt="Run With The Flow">
                    <div class="event-body">
                        <div class="event-title">Run With The Flow 2026 (UDON)</div>
                        <div class="event-date">20 ธันวาคม 2569</div>
                        <div class="event-location">สวนสาธารณะหนองประจักษ์ จ.อุดรธานี</div>
                    </div>
                </a>

                <a href="detail.php?id=nakhonsawan-21" class="event-card">
                    <img src="https://images.unsplash.com/photo-1571008887538-b36bb32f4571?auto=format&fit=crop&w=500&q=80" class="event-img" alt="Nakhonsawan 21">
                    <div class="event-body">
                        <div class="event-title">Nakhonsawan 21</div>
                        <div class="event-date">4 มกราคม 2569</div>
                        <div class="event-location">อุทยานสวรรค์ จ.นครสวรรค์</div>
                    </div>
                </a>
            </div>
        </div>

    </div>

</body>
</html>