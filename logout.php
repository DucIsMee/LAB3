<?php
session_start();

// Xóa session và chuyển hướng về trang login
session_destroy();
header('Location: login.php');
exit();
?>
