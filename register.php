<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Ký</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
        }
        .form-container {
            border: 1px solid #ccc;
            padding: 20px;
            border-radius: 5px;
            background-color: #f9f9f9;
        }
        input[type="email"],
        input[type="password"] {
            padding: 8px;
            width: 300px;
            border: 1px solid #ddd;
            border-radius: 4px;
            margin-bottom: 10px;
            display: block;
        }
        label {
            display: block;
            margin-top: 10px;
            font-weight: bold;
        }
        button {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 10px;
        }
        button:hover {
            background-color: #45a049;
        }
        .message {
            padding: 10px;
            margin-top: 10px;
            border-radius: 4px;
        }
        .success {
            background-color: #d4edda;
            color: #155724;
        }
        .error {
            background-color: #f8d7da;
            color: #721c24;
        }
        .link {
            margin-top: 15px;
        }
        .link a {
            color: #007bff;
            text-decoration: none;
        }
        .link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h1>Đăng Ký Tài Khoản</h1>
        
        <?php
        require_once 'db_connect.php';

        $message = '';
        $message_type = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            // Kiểm tra dữ liệu
            if (empty($email) || empty($password)) {
                $message = '❌ Vui lòng nhập đầy đủ Email và Mật khẩu!';
                $message_type = 'error';
            } else {
                try {
                    // Hash mật khẩu
                    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                    // Kiểm tra email đã tồn tại chưa
                    $check_email = $conn->prepare("SELECT COUNT(*) FROM students WHERE email = ?");
                    $check_email->execute([$email]);
                    $email_exists = $check_email->fetchColumn();

                    if ($email_exists > 0) {
                        $message = '❌ Email này đã được đăng ký!';
                        $message_type = 'error';
                    } else {
                        // Thêm người dùng vào database
                        $insert = $conn->prepare("INSERT INTO students (email, password) VALUES (?, ?)");
                        $insert->execute([$email, $hashed_password]);

                        $message = '✅ Đăng ký thành công! Bạn có thể <a href="login.php">đăng nhập tại đây</a>.';
                        $message_type = 'success';
                    }
                } catch (PDOException $e) {
                    $message = '❌ Lỗi: ' . htmlspecialchars($e->getMessage());
                    $message_type = 'error';
                }
            }
        }
        ?>

        <?php if ($message): ?>
            <div class="message <?php echo $message_type; ?>">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Mật khẩu:</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">Đăng Ký</button>
        </form>

        <div class="link">
            Đã có tài khoản? <a href="login.php">Đăng nhập tại đây</a>
        </div>
    </div>
</body>
</html>
