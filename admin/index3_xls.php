<?




header( "Content-type: application/vnd.ms-excel" );   
header( "Content-type: application/vnd.ms-excel; charset=utf-8");  
header( "Content-Disposition: attachment; filename = georgia.xls" );   
header( "Content-Description: PHP4 Generated Data" ); 

require_once "./header.php";
//error_reporting(E_ALL);
//ini_set("display_errors", 1);

$mysql 			= new CMySQLDB();


$start_date = $_GET['start_date'];
$end_date   = $_GET['end_date'];
$is_mobile  = $_GET['is_mobile'];
$mid_sql 	= "";


if ($is_mobile == "W"){
	$mid_sql .= " and  is_mobile != 'Y' ";
}elseif($is_mobile == "M"){
	$mid_sql .= " and  is_mobile = 'Y' ";
}


if ($start_date != ""){
	$mid_sql .= " and  DATE_FORMAT(reg_date,'%Y-%m-%d') >= '" . $start_date ."'";
}

if ($end_date != ""){
	$mid_sql .= " and  DATE_FORMAT(reg_date,'%Y-%m-%d') <= '" . $end_date ."'";
}



$query 			= sprintf("select * from EVENT_201504_USER where idx > 0 %s  order by idx desc ", $mid_sql);
$result 		= $mysql->SetQuery($query);



?>

	   <table>
	       <thead>
	           <tr>
	               <th scope="col">이름</td>
	               <th scope="col">핸드폰번호</td>
				   <th scope="col">참여일</td>

	           </tr>
	       </thead>
	       <tbody>

	                
<?php while($array=@mysql_fetch_array($result)) :?>	
	           <tr>
	           		<td style="mso-number-format: '\@';"><?=iconv("EUC-KR", "UTF-8", $array["user_name"])?></td> 
	           		<td style="mso-number-format: '\@';"><?=$array["mobile"]?></td> 
	                <td style="mso-number-format: '\@';"><?=$array["reg_date"]?></td>                    
	           </tr>
         
<?php endwhile ?>	
 	             
	       </tbody>          
	   </table>
	