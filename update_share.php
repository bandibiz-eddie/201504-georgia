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
	
	$sns_type		= $_POST["sns_type"];
	$res			= $_POST["res"];
	
	$mysql 			= new CMySQLDB();
	
	$query 					= sprintf("insert into EVENT_201504_SNS (sns_type, reg_date) values ('%s',now())", $sns_type);
	$result	    			= $mysql->SetQuery($query);
	$array					=@mysql_fetch_array($result);	
	
	
}else{
	echo "Error";
}
?>