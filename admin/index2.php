<?
require_once "./header.php";
//error_reporting(E_ALL);
//ini_set("display_errors", 1);
$mysql 			= new CMySQLDB();


$start_date = $_GET['start_date'];
$end_date   = $_GET['end_date'];

$mid_sql 	= "";

if ($start_date != ""){
	$mid_sql .= " and  DATE_FORMAT(reg_date,'%Y-%m-%d') >= '" . $start_date ."'";
}

if ($end_date != ""){
	$mid_sql .= " and  DATE_FORMAT(reg_date,'%Y-%m-%d') <= '" . $end_date ."'";
}

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>조지아커피</title>
<link rel="stylesheet" href="./css/admin.css" />
<script src="./js/jquery-1.10.2.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>

</head>

<script>
$( document ).ready(function() {
    //$('.nailthumb-container').nailthumb({width:100,height:100,method:'resize',replaceAnimation:null,fitDirection:'center center'});
});
$(function() {
	$( "#start_date" ).datepicker({
		dateFormat: "yy-mm-dd",
	});
	$( "#end_date" ).datepicker({
		dateFormat: "yy-mm-dd",
	});
});
</script>



<body> 
<div class="wrap"> 
    <div class="top_logo">

        <p class="btn_out btn po_right" ><a href="./logout.php" class="block">로그아웃</a></p>
    </div>
    <div class="menu">
        <ul>
            <li><a href="./index.php" >페이지뷰</a></li>
            <li class='menu_on'><a href="./index2.php" >공유 정보</a></li>
            <li><a href="./index3.php" >참여 정보</a></li>
        </ul>
    </div> 


	
	
	<div class="mem_list sp_t30px">
	   <table width="90%" cellpadding="5" cellspacing="0" border="1" align="center" style="border-collapse:collapse; border:1px gray solid;">
<?
$query 			= sprintf("SELECT COUNT((CASE WHEN sns_type = 'K' THEN 1 ELSE NULL END)) 'k',COUNT((CASE WHEN sns_type = 'S' THEN 1 ELSE NULL END)) 's',COUNT((CASE WHEN sns_type = 'F' THEN 1 ELSE NULL END)) 'f',COUNT((CASE WHEN sns_type = 'T' THEN 1 ELSE NULL END)) 't', DATE_FORMAT(reg_date,'%%Y-%%m-%%d') reg_date FROM EVENT_201504_SNS where sns_type != '' group by DATE_FORMAT(reg_date,'%%Y-%%m-%%d')  order by reg_date desc  " , $mid_sql);

$result 		= $mysql->SetQuery($query);


?>
		<tr>
			<td>날짜</td>
			<td>카카오톡</td>
			<td>카카오스토리</td>
			<td>페이스북</td>
			<td>트위터</td>
		</tr> 
<?php while($array=@mysql_fetch_array($result)) :?>			
		<tr>
			<td><?=$array["reg_date"]?></td>
			<td><?=$array["k"]?></td>
			<td><?=$array["s"]?></td>
			<td><?=$array["f"]?></td>
			<td><?=$array["t"]?></td>
		</tr>
<?php endwhile ?>			
		</table>

	</div>

</div>   
<div style="margin-top:50px"></div>    
</body>
</html>
