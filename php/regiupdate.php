<?php 
include('dbconn.php');

$mb_id = trim($_POST['mb_id']);
$mb_password = trim($_POST['mb_password']);
$mb_name = trim($_POST['mb_name']);

date_default_timezone_set('Asia/Seoul');
$mb_datetime = date('Y-m-d H:i:s', time());

echo $mb_id . '<br>';
echo $mb_password . '<br>';
echo $mb_name . '<br>';
echo $mb_datetime . '<br>';


$sql = "select PASSWORD('$mb_password') AS pass"; //8.0이하 버전암호화 방식

//$mb_password = PASSWORD_HASH('$mb_password',PASSWORD_DEFAULT); //8.1이상

$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($result);
$mb_password = $row['pass'];

// echo $mb_password;

$sql = "insert into korair_member(mb_id,mb_password, mb_name, mb_datetime) value('$mb_id','$mb_password','$mb_name','$mb_datetime')";

$result = mysqli_query($conn,$sql);

if($result){
  echo "<script>alert('회원가입이 완료되었습니다.');</script>";
  echo "<script>location.replace('../login.php');</script>";
  exit;
}else{
  echo "회원가입 실패 : " . mysqli_error($conn);
  mysqli_close($conn); 
}
?>
