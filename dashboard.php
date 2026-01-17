<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
        }
        .container {
            border: 1px solid #ccc;
            padding: 20px;
            border-radius: 5px;
            background-color: #f9f9f9;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        h1 {
            margin: 0;
        }
        .logout-btn {
            padding: 10px 20px;
            background-color: #f44336;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
        }
        .logout-btn:hover {
            background-color: #da190b;
        }
        .welcome-message {
            padding: 15px;
            background-color: #d4edda;
            color: #155724;
            border-radius: 4px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <?php
    session_start();

    // Kiểm tra nếu chưa đăng nhập, chuyển hướng về login.php
    if (!isset($_SESSION['user'])) {
        header('Location: login.php');
        exit();
    }

    $user_email = htmlspecialchars($_SESSION['user']);
    ?>

    <div class="container">
        <div class="header">
            <h1>Dashboard</h1>
            <a href="logout.php" class="logout-btn">Đăng xuất</a>
        </div>

        <div class="welcome-message">
            ✅ Xin chào, <strong><?php echo $user_email; ?></strong>
        </div>

        <p>Bạn đã đăng nhập thành công vào hệ thống!</p>
    </div>
</body>
</html>
