<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giỏ Hàng</title>
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
        .product {
            border: 1px solid #ddd;
            padding: 15px;
            margin-bottom: 15px;
            border-radius: 4px;
            background-color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .product-info h3 {
            margin: 0 0 10px 0;
        }
        .product-info p {
            margin: 5px 0;
            color: #666;
        }
        .add-to-cart-btn {
            padding: 8px 15px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .add-to-cart-btn:hover {
            background-color: #45a049;
        }
        .cart-section {
            margin-top: 30px;
            padding: 15px;
            background-color: #e3f2fd;
            border-radius: 4px;
        }
        .cart-section h2 {
            margin-top: 0;
        }
        .cart-empty {
            color: #888;
            font-style: italic;
        }
        .cart-item {
            padding: 8px;
            background-color: white;
            margin: 5px 0;
            border-radius: 3px;
            border-left: 3px solid #2196F3;
        }
        .clear-cart-btn {
            padding: 8px 15px;
            background-color: #f44336;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 10px;
        }
        .clear-cart-btn:hover {
            background-color: #da190b;
        }
    </style>
</head>
<body>
    <?php
    session_start();

    // Khởi tạo giỏ hàng nếu chưa có
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    // Xử lý thêm sản phẩm vào giỏ
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_to_cart'])) {
        $product_id = $_POST['product_id'] ?? '';
        if (!empty($product_id)) {
            $_SESSION['cart'][] = $product_id;
        }
    }

    // Xử lý xóa giỏ hàng
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['clear_cart'])) {
        $_SESSION['cart'] = [];
    }

    // Danh sách sản phẩm mẫu (hardcoded)
    $products = [
        ['id' => '1', 'name' => 'Laptop', 'price' => '15.000.000 VNĐ', 'description' => 'Laptop chất lượng cao'],
        ['id' => '2', 'name' => 'Chuột', 'price' => '500.000 VNĐ', 'description' => 'Chuột không dây'],
        ['id' => '3', 'name' => 'Bàn Phím', 'price' => '2.000.000 VNĐ', 'description' => 'Bàn phím cơ Gaming'],
        ['id' => '4', 'name' => 'Màn Hình', 'price' => '5.000.000 VNĐ', 'description' => 'Màn hình 4K 27 inch'],
    ];
    ?>

    <div class="container">
        <h1>🛒 Giỏ Hàng (Shopping Cart)</h1>

        <h2>Sản Phẩm Có Sẵn</h2>
        <?php foreach ($products as $product): ?>
            <div class="product">
                <div class="product-info">
                    <h3><?php echo htmlspecialchars($product['name']); ?></h3>
                    <p><?php echo htmlspecialchars($product['description']); ?></p>
                    <p><strong>Giá: <?php echo htmlspecialchars($product['price']); ?></strong></p>
                </div>
                <form method="POST" action="" style="margin: 0;">
                    <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($product['id']); ?>">
                    <button type="submit" name="add_to_cart" class="add-to-cart-btn">Thêm vào giỏ</button>
                </form>
            </div>
        <?php endforeach; ?>

        <div class="cart-section">
            <h2>📋 Chi Tiết Giỏ Hàng</h2>
            
            <?php if (empty($_SESSION['cart'])): ?>
                <p class="cart-empty">Giỏ hàng của bạn đang trống</p>
            <?php else: ?>
                <p><strong>Số sản phẩm trong giỏ: <?php echo count($_SESSION['cart']); ?></strong></p>
                <div>
                    <?php foreach ($_SESSION['cart'] as $index => $product_id): ?>
                        <?php
                        // Tìm tên sản phẩm
                        $product_name = 'Sản phẩm #' . htmlspecialchars($product_id);
                        foreach ($products as $p) {
                            if ($p['id'] === $product_id) {
                                $product_name = $p['name'];
                                break;
                            }
                        }
                        ?>
                        <div class="cart-item">
                            ID: <?php echo htmlspecialchars($product_id); ?> - <?php echo htmlspecialchars($product_name); ?>
                        </div>
                    <?php endforeach; ?>
                </div>

                <form method="POST" action="" style="margin-top: 15px;">
                    <button type="submit" name="clear_cart" class="clear-cart-btn">🗑️ Xóa Giỏ Hàng</button>
                </form>
            <?php endif; ?>

            <p style="margin-top: 20px; color: #666; font-size: 0.9em;">
                💡 <strong>Hướng dẫn:</strong> Nhấn F5 để refresh trang. Giỏ hàng sẽ vẫn giữ nguyên nhờ Session!
            </p>
        </div>
    </div>
</body>
</html>
