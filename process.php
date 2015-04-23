<?
session_start();

function check_referer(){
    $host = 'http://'.getenv('HTTP_HOST');
    if($host == substr(getenv('HTTP_REFERER'),0,strlen($host)))
        return 1;
    else
        return 0;
}

$refer_check = check_referer();

if ($refer_check){
	
	require_once "./db_con.php";
	
	$user_name		= $_POST["user_name"];
	$mobile			= $_POST["mobile"];
	
	$mysql 			= new CMySQLDB();
	
	$query 					= sprintf("insert into EVENT_201504_USER (user_name , mobile , reg_date) values ('%s','%s',now())",  iconv("UTF-8", "EUC-KR", $user_name), $mobile);
	$result	    			= $mysql->SetQuery($query);
	$array					=@mysql_fetch_array($result);	
	
	
}else{
	echo "Error";
}
?>