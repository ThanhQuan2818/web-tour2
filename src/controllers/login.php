<?php
session_start();//khởi động phiên bản cho phép lưu trữ và truy cập
if (isset($_SESSION['user_id'])) {//kiểm tra biến session đã đc đặt hay chưa.Nếu tồn tại nghĩa là người dùng đã đăng nhập sẽ dẫn đén trang index bằng header
    header("Location: /web-tour/index.php");
}
if (isset($_POST['username'])) {//kiểm tra sự kiện POST 
    include "../config/connectDB.php";
    $username = $_POST['username'];
    $check_user = "SELECT * from users where user_username = '$username'";
    $check_user_result = mysqli_query($conn, $check_user);
    if (mysqli_num_rows($check_user_result) == 0) {
        echo "<script>alert('Tên đăng nhập không tồn tại!')</script>";
        echo "<script>window.location.href = '/web-tour/src/Pages/Login.php'</script>";
    } else {
        $check_user_result_row = mysqli_fetch_assoc($check_user_result);
        if (password_verify($_POST['password'], $check_user_result_row['user_password'])) {
            $_SESSION['user_id'] = $check_user_result_row['user_id'];
            $_SESSION['username'] = $check_user_result_row['user_username'];
            $_SESSION['role'] = $check_user_result_row['user_role'];
            header("Location: /web-tour/index.php");
        } else {
            echo "<script>alert('Sai mật khẩu!')</script>";
            echo "<script>window.location.href = '/web-tour/src/Pages/Login.php'</script>";
            exit();
        }
    }
    mysqli_close($conn);
}
?>