<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ปฏิทินงานวิ่ง - RUNLAH</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        body { background-color: #0e0e10; color: #ffffff; min-height: 100vh; padding-bottom: 50px; }

        .navbar { background-color: #121214; padding: 12px 4%; display: flex; align-items: center; justify-content: space-between; border-bottom: 1px solid #1a1a1d; position: sticky; top: 0; z-index: 100; }
        .logo-img { height: 80px; }
        .nav-links a { color: #a0a0a0; text-decoration: none; font-size: 14px; margin-right: 20px; }
        .nav-links a.active { color: #fff; font-weight: bold; border-bottom: 2px solid #ff3b00; padding-bottom: 12px; }

        .container { max-width: 1100px; margin: 25px auto; padding: 0 20px; }
        
        .hero-banner { position: relative; width: 100%; height: 260px; border-radius: 12px; overflow: hidden; margin-bottom: 25px; }
        .hero-banner img { width: 100%; height: 100%; object-fit: cover; filter: brightness(0.6); }
        .hero-text { position: absolute; bottom: 25px; left: 30px; font-size: 26px; font-weight: bold; color: #fff; }

        .calendar-layout { display: grid; grid-template-columns: 320px 1fr; gap: 20px; }
        
        /* Calendar Widget */
        .calendar-card { background-color: #121215; border: 1px solid #1f1f24; border-radius: 12px; padding: 20px; height: fit-content; }
        .cal-header { display: flex; justify-content: space-between; margin-bottom: 15px; font-weight: bold; font-size: 15px; }
        .cal-grid { display: grid; grid-template-columns: repeat(7, 1fr); gap: 6px; text-align: center; font-size: 12px; }
        .cal-day-head { color: #888; padding-bottom: 5px; }
        .cal-date { padding: 8px 0; border-radius: 6px; cursor: pointer; color: #ccc; }
        .cal-date:hover { background-color: #1f1f28; }
        .cal-date.active { background-color: #1d72f3; color: #fff; font-weight: bold; }

        /* Event List */
        .events-list { display: flex; flex-direction: column; gap: 12px; }
        .date-title { font-size: 13px; color: #888; margin-bottom: 5px; }
        .event-item { background-color: #121215; border: 1px solid #1f1f24; border-radius: 10px; padding: 12px; display: flex; gap: 15px; align-items: center; transition: 0.2s; text-decoration: none; color: #fff; }
        .event-item:hover { border-color: #333; transform: translateY(-2px); }
        .event-img { width: 60px; height: 60px; border-radius: 8px; object-fit: cover; }
        .event-info h4 { font-size: 15px; margin-bottom: 4px; }
        .event-info p { font-size: 12px; color: #aaa; }
    </style>
</head>
<body>

    <nav class="navbar">
        <a href="index.php"><img src="img/logo.png" alt="RUNLAH" class="logo-img"></a>
        <div class="nav-links">
            <a href="index.php">หน้าหลัก</a>
            <a href="calendar.php" class="active">ปฏิทินงานวิ่ง</a>
            <a href="results.php">ผลการแข่งขัน</a>
            <a href="organizer.php">สำหรับผู้จัดงาน</a>
        </div>
    </nav>

    <div class="container">
        <div class="hero-banner">
            <img src="https://images.unsplash.com/photo-1530541930197-ff16ac917b0e?auto=format&fit=crop&w=1200" alt="Running">
            <div class="hero-text">กิจกรรมการวิ่งในประเทศไทย<br>สัปดาห์นี้</div>
        </div>

        <div class="calendar-layout">
            <div class="calendar-card">
                <div class="cal-header">
                    <span>&lt;</span>
                    <span>สิงหาคม 2569</span>
                    <span>&gt;</span>
                </div>
                <div class="cal-grid">
                    <div class="cal-day-head">อา</div><div class="cal-day-head">จ</div><div class="cal-day-head">อ</div>
                    <div class="cal-day-head">พ</div><div class="cal-day-head">พฤ</div><div class="cal-day-head">ศ</div><div class="cal-day-head">ส</div>
                    
                    <span></span><span></span><span></span><span></span><span></span><span>1</span><span>2</span>
                    <span>3</span><span>4</span><span>5</span><span>6</span><span>7</span><span>8</span><span>9</span>
                    <span>10</span><span>11</span><span>12</span><span>13</span><span>14</span><span>15</span><span>16</span>
                    <span>17</span><span>18</span><span>19</span><span class="cal-date active">20</span><span>21</span><span>22</span><span>23</span>
                    <span>24</span><span>25</span><span>26</span><span>27</span><span>28</span><span>29</span><span>30</span>
                </div>
            </div>

            <div class="events-list">
                <div class="date-title">วันเสาร์ที่ 22 สิงหาคม พ.ศ. 2569</div>
                
                <a href="detail.php" class="event-item">
                    <img src="https://picsum.photos/100/100?random=1" class="event-img" alt="event">
                    <div class="event-info">
                        <h4>AIMS Sub Series Songkhla 2026</h4>
                        <p>22 สิงหาคม 2569 | เขื่อนหาดใหญ่ อ.หาดใหญ่ จ.สงขลา</p>
                    </div>
                </a>

                <a href="detail.php" class="event-item">
                    <img src="https://picsum.photos/100/100?random=2" class="event-img" alt="event">
                    <div class="event-info">
                        <h4>หมอชวนวิ่ง มินิมาราธอน 2026</h4>
                        <p>22 สิงหาคม 2569 | โรงพยาบาลมหาราช จ.นครราชสีมา</p>
                    </div>
                </a>

                <a href="detail.php" class="event-item">
                    <img src="https://picsum.photos/100/100?random=3" class="event-img" alt="event">
                    <div class="event-info">
                        <h4>READY+ TRAIL 2026</h4>
                        <p>22-23 สิงหาคม 2569 | วัดเขาพระครู จ.ชลบุรี</p>
                    </div>
                </a>
            </div>
        </div>
    </div>

</body>
</html>