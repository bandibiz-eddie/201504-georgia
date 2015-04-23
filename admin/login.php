<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>조지아커피</title>
<link rel="stylesheet" href="./css/admin.css" />
<script src="./js/jquery-1.10.2.js"></script>
<script>
function check(){
	$("#theForm").submit();
}

</script>
</head>
<body> 
    <div class="login_position">
    	<form id="theForm" method="post" action="./loginProcess.php">     
        <div class="login_bg">
           <ul>
               <li>
                   <span class="stitle">ID</span>
                   <span class="sinfo"><input type="text" name="adminid" id="adminid" ></span>
               </li>
               <li>
                   <span class="stitle">Password</span>
                   <span class="sinfo"><input type="password" name="adminpw" id="adminpw"></span>
               </li> 
                       
           </ul>           
        </div>
        
        <div class="line_center sp_t30px"><p class="btn_red1"><a href="javascript:check()" class="block">LOG IN</a></p></div>
        </form>
    </div>
    
</body>
</html>