<?
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




$query 			= sprintf("select idx	from EVENT_201504_USER where idx > 0  %s  " , $mid_sql);
$result 		= $mysql->SetQuery($query);
$buyTotalCount 	= mysql_num_rows($result);




$pageNum = ($_GET['page']) ? $_GET['page'] : 1;
$list = ($_GET['list']) ? $_GET['list'] : 20;


$b_pageNum_list = 10; //블럭에 나타낼 페이지 번호 갯수
$block = ceil($pageNum/$b_pageNum_list); //현재 리스트의 블럭 구하기


$cur_num          = $buyTotalCount - $list *($pageNum-1);
 

$b_start_page = ( ($block - 1) * $b_pageNum_list ) + 1; //현재 블럭에서 시작페이지 번호
$b_end_page = $b_start_page + $b_pageNum_list - 1; //현재 블럭에서 마지막 페이지 번호

$total_page =  ceil($buyTotalCount/$list); //총 페이지 수


$start_record = $list*($pageNum-1);
$record_to_get = $list;


$query 			= sprintf("select * from EVENT_201504_USER where idx > 0 %s  order by idx desc LIMIT %s,%s " , $mid_sql, $start_record , $record_to_get);

$result 		= $mysql->SetQuery($query);

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
            <li><a href="./index2.php" >공유 정보</a></li>
            <li class='menu_on'><a href="./index3.php" >참여 정보</a></li>
        </ul>
    </div> 
    
    <div class="find_form" style="text-align:right;margin-top:10px">
    	<form action="./index3.php" method="get">
    		<input type="text" id="start_date" name="start_date" value="<?=$start_date?>"> ~ <input type="text" id="end_date" name="end_date" value="<?=$end_date?>">
		
			<button name="">검색</button>
    	</form>
    </div> 

	
	
	<div class="mem_list sp_t30px">
	   <table>
	       <thead>
	           <tr>
	               <th scope="col" width="">번호</td>
	               <th scope="col" width="">이름</td>
	               <th scope="col" width="">핸드폰번호</td>
	               <th scope="col" width="">참여일</td>
	           </tr>
	       </thead>
	       <tbody>
<?php while($array=@mysql_fetch_array($result)) :?>	
	           <tr >
	           		<td><?=$cur_num?></td> 
	           		<td><?=iconv("EUC-KR", "UTF-8", $array["user_name"])?></td> 
	           		<td><?=$array["mobile"]?></td> 
	         
	                <td><?=substr($array["reg_date"],0,10)?></td>                 
	           </tr>
	<? $cur_num--; ?>	
	
         
<?php endwhile ?>	



				<tr>
					<td colspan="9">
				<div class="page">	
				
<?						
if ($b_end_page > $total_page) 
        $b_end_page = $total_page;
     
 
if($pageNum <= 1){
?>
        <!--<li class="first">◀◀</li>-->
<?
}else{
?>
        <!--<li class="first"><a href="/index.php" title="첫페이지로 이동">◀◀</a></li>-->
<?
}
if($block <=1){
?>
        <a href="#" class="perview"><</a>	
<?
}else{
?>
		<a href="./index3.php?page=<?=$b_start_page-1?>&start_date=<?=$start_date?>&end_date=<?=$end_date?>&is_mobile=<?=$is_mobile?>" class="perview"><</a>	
       
<?
}
 
$k = 1;
for($j = $b_start_page; $j <=$b_end_page; $j++){
	
    if($pageNum == $j){
?>
        <span <? if($k==1) echo "class='first'" ?> ><?=$j?></span>
<?
	}else{
?>
        <a href="./index3.php?page=<?=$j?>&start_date=<?=$start_date?>&end_date=<?=$end_date?>&is_mobile=<?=$is_mobile?>" <? if($k==1) echo "class='first'" ?>><?=$j?></a>
<?
     }             
    $k++;
}
 
$total_block = ceil($total_page/$b_pageNum_list);

if($block >= $total_block){
?>
		<a href="#" class="next">></a>
<?}else{?>    
		<a href="./index3.php?page=<?=$b_end_page+1?>&start_date=<?=$start_date?>&end_date=<?=$end_date?>&is_mobile=<?=$is_mobile?>" class="next">></a>
<?
}
if($pageNum >= $total_page){
?>
 
       <!-- <li class="last"><a href="index.php?page=<?=$total_page?>"  title="마지막 이동">▶▶</a></li>-->
         
<?
}
else{
?>
		<!--<li class="last"><a href="#" title="마지막페이지로 이동">▶▶</a></li>-->
 
<?
}
 ?>								
					</td>
				</tr>  	             
	       </tbody>          
	   </table>
	   <p class="btn btn_gray3"><a href="./index3_xls.php?start_date=<?=$start_date?>&end_date=<?=$end_date?>&is_mobile=<?=$is_mobile?>" class="block">엑셀다운로드</a></p>
	</div>

</div>   
<div style="margin-top:50px"></div>    
</body>
</html>
