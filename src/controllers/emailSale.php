<?php
include 'web-tour/src/config/connectDB.php';
if(isset($_POST['email'])){
$mail=$_POST['email'];
mysqli_query($conn,"INSERT INTO email_sales (email_sale) value('$mail')");
echo "<script>
alert('Đã đăng ký nhận tin thành công!!!');
window.location.href='web-tour/index.php';
</script>";
}
?>
