<?php
// กำหนด Step ปัจจุบัน (เริ่มต้นที่ Step 1)
$step = isset($_POST['step']) ? (int)$_POST['step'] : 1;

// ข้อมูลตัวแปรหลัก
$fullname = isset($_POST['fullname']) ? trim($_POST['fullname']) : '';
$phone    = isset($_POST['phone']) ? trim($_POST['phone']) : '';
$email    = isset($_POST['email']) ? trim($_POST['email']) : '';
$distance = isset($_POST['distance']) ? trim($_POST['distance']) : '';

// คำนวณราคาตามระยะทาง
$price_map = [
    '5KM'  => 600,
    '11KM' => 1000,
    '25KM' => 1600,
    '40KM' => 2000
];
$price = isset($price_map[$distance]) ? $price_map[$distance] : 0;

$message = "";
$status_class = "";

// ประมวลผลเมื่อถึงขั้นตอนที่ 3 (ยืนยันชำระเงิน + อัปโหลดสลิป)
if ($step == 3 && $_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['confirm_payment'])) {
    $host = "localhost";
    $user = "root";
    $pass = "";
    $dbname = "runlah_db";

    $conn = new mysqli($host, $user, $pass, $dbname);
    if ($conn->connect_error) {
        $message = "เชื่อมต่อฐานข้อมูลล้มเหลว: " . $conn->connect_error;
        $status_class = "error";
    } else {
        $conn->set_charset("utf8mb4");

        // จัดการอัปโหลดไฟล์สลิป
        $slip_filename = "";
        if (isset($_FILES['slip']) && $_FILES['slip']['error'] == UPLOAD_ERR_OK) {
            $upload_dir = "uploads/";
            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0777, true);
            }
            
            $file_ext = pathinfo($_FILES['slip']['name'], PATHINFO_EXTENSION);
            $slip_filename = time() . '_' . uniqid() . '.' . $file_ext;
            $target_filepath = $upload_dir . $slip_filename;

            if (!move_uploaded_file($_FILES['slip']['tmp_name'], $target_filepath)) {
                $message = "เกิดข้อผิดพลาดในการอัปโหลดสลิป";
                $status_class = "error";
            }
        }

        if (empty($message) && !empty($fullname) && !empty($phone) && !empty($email) && !empty($distance)) {
            // บันทึกข้อมูลลงฐานข้อมูล
            $stmt = $conn->prepare("INSERT INTO runners (fullname, phone, email, distance, slip_image) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("sssss", $fullname, $phone, $email, $distance, $slip_filename);
            
            if ($stmt->execute()) {
                $message = "ชำระเงินและส่งสลิปเรียบร้อยแล้ว! ขอบคุณที่ร่วมกิจกรรมครับ";
                $status_class = "success";
            } else {
                $message = "เกิดข้อผิดพลาดในการบันทึกข้อมูล: " . $conn->error;
                $status_class = "error";
            }
            $stmt->close();
        } elseif (empty($message)) {
            $message = "กรุณากรอกข้อมูลและแนบสลิปให้ครบถ้วน";
            $status_class = "error";
        }
        $conn->close();
    }
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ลงทะเบียนสมัครวิ่ง - RUNLAH</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        body { background-color: #0e0e10; color: #ffffff; min-height: 100vh; padding-bottom: 50px; }

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

        /* --- Step Progress Bar --- */
        .steps-container {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
            max-width: 650px;
            margin: 35px auto 25px auto;
            padding: 0 20px;
        }
        .step-item { display: flex; flex-direction: column; gap: 10px; }
        .step-line { height: 3px; background-color: #2a2a32; border-radius: 2px; }
        .step-item.active .step-line { background-color: #1d72f3; }
        .step-title { font-size: 13px; color: #777780; font-weight: 500; }
        .step-item.active .step-title { color: #ffffff; font-weight: bold; }

        /* --- Form Container --- */
        .form-wrapper {
            max-width: 650px;
            margin: 0 auto;
            padding: 35px;
            background-color: #121215;
            border-radius: 14px;
            border: 1px solid #1f1f24;
            box-shadow: 0 8px 24px rgba(0,0,0,0.5);
        }
        .form-header { text-align: left; margin-bottom: 25px; }
        .form-header h2 { font-size: 20px; font-weight: bold; color: #fff; }
        .form-header p { font-size: 13px; color: #888890; margin-top: 5px; }

        .form-group { margin-bottom: 20px; }
        .form-group label { display: block; margin-bottom: 8px; font-size: 13px; color: #cccccc; }
        .form-group input, .form-group select {
            width: 100%;
            padding: 12px 14px;
            background-color: #1a1a1e;
            border: 1px solid #2a2a30;
            border-radius: 8px;
            color: #ffffff;
            font-size: 14px;
            outline: none;
            transition: border-color 0.2s;
        }
        .form-group input[type="file"] { padding: 9px 14px; cursor: pointer; }
        .form-group input:focus, .form-group select:focus { border-color: #ff3b00; }

        /* --- Summary Box (Step 2) --- */
        .summary-box {
            background-color: #1a1a1e;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 25px;
            border: 1px solid #2a2a30;
        }
        .summary-item {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid #282830;
            font-size: 14px;
        }
        .summary-item:last-child { border-bottom: none; }
        .summary-item .label { color: #888890; }
        .summary-item .value { font-weight: bold; color: #ffffff; }
        .summary-item.total .value { color: #ff3b00; font-size: 18px; }

        /* --- QR Code Section (Step 3) --- */
        .qr-wrapper {
            text-align: center;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 12px;
            max-width: 240px;
            margin: 0 auto 15px auto;
        }
        .qr-wrapper img { width: 100%; height: auto; display: block; }
        .payment-info { text-align: center; font-size: 13px; color: #aaa; margin-bottom: 25px; }

        /* --- Buttons --- */
        .btn-group { display: flex; gap: 12px; margin-top: 10px; }
        .btn-submit {
            flex: 1;
            padding: 14px;
            background-color: #1d72f3;
            color: #ffffff;
            border: none;
            border-radius: 8px;
            font-size: 15px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.2s;
            text-align: center;
            text-decoration: none;
        }
        .btn-submit:hover { background-color: #155ec4; }
        .btn-secondary { background-color: #222228; color: #ccc; }
        .btn-secondary:hover { background-color: #33333d; color: #fff; }

        /* --- Alert Messages --- */
        .alert {
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
            text-align: center;
        }
        .alert.success { background-color: rgba(0, 200, 81, 0.15); color: #00C851; border: 1px solid #00C851; }
        .alert.error { background-color: rgba(255, 53, 71, 0.15); color: #ff3547; border: 1px solid #ff3547; }

        .back-link {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #888890;
            text-decoration: none;
            font-size: 13px;
        }
        .back-link:hover { color: #ffffff; }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar">
        <div class="nav-left">
            <a href="index.php" class="logo">
                <img src="img/logo.png" alt="RUNLAH Logo" class="logo-img">
            </a>
            <div class="nav-links">
                <a href="index.php">หน้าหลัก</a>
                <a href="calendar.php">ปฏิทินงานวิ่ง</a>
                <a href="results.php">ผลการแข่งขัน</a>
                <a href="organizer.php">สำหรับผู้จัดงาน</a>
            </div>
        </div>

        <div class="nav-right">
            <div class="search-box">
                <input type="text" placeholder="ค้นหา">
                <span style="color:#666; font-size:12px;">&#128099;</span>
            </div>
        </div>
    </nav>

    <!-- Step Progress Bar -->
    <div class="steps-container">
        <div class="step-item <?php echo ($step >= 1) ? 'active' : ''; ?>">
            <div class="step-line"></div>
            <div class="step-title">1. กรอกแบบฟอร์ม</div>
        </div>
        <div class="step-item <?php echo ($step >= 2) ? 'active' : ''; ?>">
            <div class="step-line"></div>
            <div class="step-title">2. ยืนยัน</div>
        </div>
        <div class="step-item <?php echo ($step >= 3) ? 'active' : ''; ?>">
            <div class="step-line"></div>
            <div class="step-title">3. ชำระเงิน</div>
        </div>
    </div>

    <!-- Form Section -->
    <div class="form-wrapper">

        <?php if (!empty($message)): ?>
            <div class="alert <?php echo $status_class; ?>">
                <?php echo $message; ?>
            </div>
            <a href="index.php" class="btn-submit" style="display:block;">กลับสู่หน้าหลัก</a>

        <?php elseif ($step == 1): ?>
            <!-- ================= STEP 1: กรอกแบบฟอร์ม ================= -->
            <div class="form-header">
                <h2>แบบฟอร์มลงทะเบียนสมัครวิ่ง</h2>
                <p>กรอกข้อมูลของคุณเพื่อเข้าร่วมกิจกรรม</p>
            </div>

            <form method="POST" action="register.php">
                <input type="hidden" name="step" value="2">
                
                <div class="form-group">
                    <label>ชื่อ - นามสกุล</label>
                    <input type="text" name="fullname" value="<?php echo htmlspecialchars($fullname); ?>" placeholder="ตัวอย่าง: สมชาย ใจดี" required>
                </div>

                <div class="form-group">
                    <label>เบอร์โทรศัพท์</label>
                    <input type="tel" name="phone" value="<?php echo htmlspecialchars($phone); ?>" placeholder="08X-XXX-XXXX" required>
                </div>

                <div class="form-group">
                    <label>อีเมล</label>
                    <input type="email" name="email" value="<?php echo htmlspecialchars($email); ?>" placeholder="xxxx@gmail.com" required>
                </div>

                <div class="form-group">
                    <label>เลือกระยะทางวิ่ง</label>
                    <select name="distance" required>
                        <option value="">-- กรุณาเลือกระยะทาง --</option>
                        <option value="5KM" <?php if($distance == '5KM') echo 'selected'; ?>>5 KM (600 บาท)</option>
                        <option value="11KM" <?php if($distance == '11KM') echo 'selected'; ?>>11 KM (1,000 บาท)</option>
                        <option value="25KM" <?php if($distance == '25KM') echo 'selected'; ?>>25 KM (1,600 บาท)</option>
                        <option value="40KM" <?php if($distance == '40KM') echo 'selected'; ?>>40 KM (2,000 บาท)</option>
                    </select>
                </div>

                <button type="submit" class="btn-submit">ถัดไป (ไปยังหน้ายืนยัน)</button>
            </form>

        <?php elseif ($step == 2): ?>
            <!-- ================= STEP 2: ยืนยันข้อมูล ================= -->
            <div class="form-header">
                <h2>ตรวจสอบและยืนยันข้อมูล</h2>
                <p>กรุณาตรวจสอบความถูกต้องก่อนเข้าสู่ขั้นตอนชำระเงิน</p>
            </div>

            <div class="summary-box">
                <div class="summary-item">
                    <span class="label">ชื่อ-นามสกุล:</span>
                    <span class="value"><?php echo htmlspecialchars($fullname); ?></span>
                </div>
                <div class="summary-item">
                    <span class="label">เบอร์โทรศัพท์:</span>
                    <span class="value"><?php echo htmlspecialchars($phone); ?></span>
                </div>
                <div class="summary-item">
                    <span class="label">อีเมล:</span>
                    <span class="value"><?php echo htmlspecialchars($email); ?></span>
                </div>
                <div class="summary-item">
                    <span class="label">ระยะทาง:</span>
                    <span class="value"><?php echo htmlspecialchars($distance); ?></span>
                </div>
                <div class="summary-item total">
                    <span class="label">ยอดชำระทั้งหมด:</span>
                    <span class="value"><?php echo number_format($price); ?> บาท</span>
                </div>
            </div>

            <form method="POST" action="register.php">
                <input type="hidden" name="step" value="3">
                <input type="hidden" name="fullname" value="<?php echo htmlspecialchars($fullname); ?>">
                <input type="hidden" name="phone" value="<?php echo htmlspecialchars($phone); ?>">
                <input type="hidden" name="email" value="<?php echo htmlspecialchars($email); ?>">
                <input type="hidden" name="distance" value="<?php echo htmlspecialchars($distance); ?>">

                <div class="btn-group">
                    <button type="button" class="btn-submit btn-secondary" onclick="history.back()">แก้ไขข้อมูล</button>
                    <button type="submit" class="btn-submit">ยืนยัน และไปชำระเงิน</button>
                </div>
            </form>

        <?php elseif ($step == 3): ?>
            <!-- ================= STEP 3: ชำระเงิน & แนบสลิป ================= -->
            <div class="form-header" style="text-align: center;">
                <h2>ชำระเงินและแนบหลักฐาน</h2>
                <p>สแกน QR Code เพื่อชำระเงินจำนวน <strong style="color:#ff3b00;"><?php echo number_format($price); ?> บาท</strong></p>
            </div>

            <div class="qr-wrapper">
                <img src="https://api.qrserver.com/v1/create-qr-code/?size=250x250&data=PROMPTPAY_PAYMENT_DEMO_<?php echo $price; ?>" alt="PromptPay QR Code">
            </div>

            <div class="payment-info">
                <p>บัญชี: บริษัท รันลา จำกัด (RUNLAH)</p>
                <p>ธนาคารกสิกรไทย: 123-4-56789-0</p>
            </div>

            <form method="POST" action="register.php" enctype="multipart/form-data">
                <input type="hidden" name="step" value="3">
                <input type="hidden" name="confirm_payment" value="1">
                <input type="hidden" name="fullname" value="<?php echo htmlspecialchars($fullname); ?>">
                <input type="hidden" name="phone" value="<?php echo htmlspecialchars($phone); ?>">
                <input type="hidden" name="email" value="<?php echo htmlspecialchars($email); ?>">
                <input type="hidden" name="distance" value="<?php echo htmlspecialchars($distance); ?>">

                <div class="form-group">
                    <label>แนบสลิปการโอนเงิน (ไฟล์รูปภาพ)</label>
                    <input type="file" name="slip" accept="image/*" required>
                </div>

                <button type="submit" class="btn-submit">ยืนยันการแจ้งชำระเงิน</button>
            </form>

        <?php endif; ?>

        <!-- ปุ่มย้อนกลับแบบไดนามิกตาม Step -->
        <?php if ($step == 1): ?>
            <a href="index.php" class="back-link">&larr; ย้อนกลับไปหน้าหลัก</a>
        <?php elseif ($step == 2): ?>
            <a href="#" onclick="history.back(); return false;" class="back-link">&larr; ย้อนกลับไปกรอกแบบฟอร์ม</a>
        <?php elseif ($step == 3): ?>
            <a href="#" onclick="history.back(); return false;" class="back-link">&larr; ย้อนกลับไปยืนยันข้อมูล</a>
        <?php endif; ?>

    </div>

</body>
</html>