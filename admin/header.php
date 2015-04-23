<?
session_start();
//error_reporting(E_ALL);
//ini_set("display_errors", 1);


if($_SESSION['admin'] != "Y"){
	echo "<script>location.href='./login.php'</script>";
	exit;
	
}
require_once "../db_con.php";
?>