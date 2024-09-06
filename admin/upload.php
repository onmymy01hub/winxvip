
<?php 
include 'bd_a.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['images'])) {
    // รับค่าความกว้างและความสูงจากฟอร์ม
    $new_width = intval($_POST['width']);
    $new_height = intval($_POST['height']);

    if ($new_width > 0 && $new_height > 0) {
        $files = $_FILES['images'];

        for ($i = 0; $i < count($files['name']); $i++) {
            $file_tmp_path = $files['tmp_name'][$i];
            $file_name = basename($files['name'][$i]);
            $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

            if (in_array($file_ext, ['jpg', 'jpeg', 'png', 'gif'])) {
                $result = $conn->query("SELECT MAX(CAST(SUBSTRING_INDEX(name, '.', 1) AS UNSIGNED)) as max_num FROM images");
                $row = $result->fetch_assoc();
                $new_number = str_pad($row['max_num'] + 1, 3, '0', STR_PAD_LEFT);

                $webp_file_name = $new_number . '.webp';
                $webp_file_path = 'uploads/' . $webp_file_name;

                if (!file_exists('uploads')) {
                    mkdir('uploads', 0777, true);
                }

                // สร้างภาพจากไฟล์ที่อัปโหลดตามนามสกุลไฟล์
                $image = null;
                switch ($file_ext) {
                    case 'jpg':
                    case 'jpeg':
                        $image = imagecreatefromjpeg($file_tmp_path);
                        break;
                    case 'png':
                        $image = imagecreatefrompng($file_tmp_path);
                        break;
                    case 'gif':
                        $image = imagecreatefromgif($file_tmp_path);
                        break;
                }

                // ตรวจสอบว่าการสร้างภาพสำเร็จหรือไม่
                if ($image === false || $image === null) {
                    echo "เกิดข้อผิดพลาดในการเปิดไฟล์รูปภาพ $file_name!";
                    continue; // ข้ามไฟล์นี้และทำงานต่อไปยังไฟล์ถัดไป
                }

                // ตรวจสอบขนาดของภาพต้นฉบับ
                $original_width = imagesx($image);
                $original_height = imagesy($image);

                // สร้างภาพใหม่ที่มีขนาดตามที่ผู้ใช้ระบุ
                $resized_image = imagecreatetruecolor($new_width, $new_height);
                imagecopyresampled($resized_image, $image, 0, 0, 0, 0, $new_width, $new_height, $original_width, $original_height);

                if (imagewebp($resized_image, $webp_file_path)) {
                    $stmt = $conn->prepare("INSERT INTO images (name) VALUES (?)");
                    $stmt->bind_param("s", $webp_file_name);
                    if (!$stmt->execute()) {
                        echo "เกิดข้อผิดพลาดในการบันทึกชื่อไฟล์ในฐานข้อมูล!";
                    }
                    $stmt->close();
                } else {
                    echo 'เกิดข้อผิดพลาดในการแปลงไฟล์!';
                }

                imagedestroy($image);
                imagedestroy($resized_image);
            } else {
                echo "กรุณาอัปโหลดไฟล์ JPG, PNG หรือ GIF เท่านั้น! ไฟล์ $file_name ไม่รองรับ";
            }
        }

        header("refresh:0.1; url=index.php");
    } else {
        echo 'ค่าความกว้างและความสูงต้องมากกว่า 0!';
    }
} else {
    echo 'ไม่มีไฟล์ถูกอัปโหลด!';
}

$conn->close();
