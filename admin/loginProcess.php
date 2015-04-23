<?
session_start();
error_reporting(E_ALL);
ini_set("display_errors", 1);

$adminid     = $_POST['adminid'];
$adminpw     = $_POST['adminpw'];

if ($adminid == "admin" && $adminpw == "whwldk!@"){
	 $_SESSION['admin'] = "Y";
     echo "<script>location.href='./index.php'</script>";
}else{
	echo "<script>alert('아이디와 패스워드를 다시 확인 바랍니다.');location.href='./login.php'</script>";
}


?>