<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0" />
<title>조지아커피를 만나세요.</title>
<head>
	<meta property="og:locale" content="ko_KR" />
	<meta property="og:url" content="http://georgiacoffee.gift">
    <meta property="og:title" content="조지아커피도 함께 가는 내친구의 집은 어디인가">
    <meta property="og:type" content="website">
     <meta property="og:image" content="http://georgiacoffee.gift/images/sns_img.jpg" />

	
    <link type="text/css" href="./css/m_event.css" rel="stylesheet" />
    <script type="text/javascript" src="./js/jquery-1.11.2.min.js"></script>
	<script type="text/javascript" src="./js/sns.js"></script>
	<script src="https://developers.kakao.com/sdk/js/kakao.min.js"></script>
</head>

<script>
function check(){
	var user_name		 = $.trim($("#user_name").val());
	var sns_type		 = $.trim($("#sns_type").val());
	
	var mobile1			 = $("#mobile1 > option:selected").val();	
	var mobile2			 = $.trim($("#mobile2").val());	
	var mobile3			 = $.trim($("#mobile3").val());
	var mobile = mobile1 + "-" + mobile2 + "-" + mobile3;	
	
	if (sns_type == ""){
		alert("SNS를 공유해 주세요.");
		return;
	}
		        
	if(user_name == ""){
		alert("이름을 입력해 주세요.");
		$("#user_name").focus()
		return;
	}
	
	var regExp = /^01([0|1|6|7|8|9]?)-?([0-9]{3,4})-?([0-9]{4})$/;
	if ( !regExp.test( mobile) ) {
	    alert("잘못된 휴대폰 번호입니다.");
	    $("#mobile1").focus();
	    return;
	} 
	

	if ( $(":checkbox[name='privacy_check']:checked").length==0){
        alert('개인정보수집을 동의해 주세요.');
        return;       
    }
    	
    $.ajax({
        type:"POST",
        data:{user_name : user_name, mobile : mobile},
        url: "/process.php",
        success: function(result){
        	alert("참여 완료 되었습니다.");        	
        }
    });
	
}

</script>


<body>
	<input type="hidden" id="sns_type">
    <div class="wrap">
        <div class="main_wrap">
            <p class="main_title img100"><img src="images/event_title.png" alt="조지아커피를 만나세요. " /></p>
            <div class="movie_wrap">
                <div class="movie_play" >
					<iframe width="100%" height="100%" src="https://www.youtube.com/embed/M8cfsAQ8RGo" frameborder="0" allowfullscreen></iframe>
                </div>
            </div>
            <div class="event_wrap">
                <p class="event_title img100"><img src="images/event_info.jpg" alt="이벤트 정보" /></p>
                <p></p>
                <ul class="sns_wrap">
                    <li><a href="javascript:snsShare('kakao')"><img src="images/btn_cacao.jpg" alt="카카오" /></a></li>
                    <li><a href="javascript:snsShare('story')"><img src="images/btn_castory.jpg" alt="카카오스토리" /></a></li>
                    <li><a href="javascript:snsShare('facebook')"><img src="images/btn_fb.jpg" alt="페이스북" /></a></li>
                    <li><a href="javascript:snsShare('twitter')"><img src="images/btn_tw.jpg" alt="트위터" /></a></li>
                </ul>
                <div class="event_input">
                    <div class="user_input">
                        <ul>
                            <li><span><img src="images/txt_name.jpg" alt="이름" /></span>
                                <input type="text" id="user_name">
                            </li>
                            <li><span><img src="images/txt_phone.jpg" alt="핸드폰" /></span>
                                <select name="mobile1" id="mobile1">
                                    <option value="010">010</option>
                                    <option value="010">011</option>
                                    <option value="016">016</option>
                                    <option value="017">017</option>
                                    <option value="018">018</option>
                                    <option value="019">019</option>
                                </select>-<input type="tel" maxlength="4" id="mobile2" >-<input type="tel" maxlength="4" id="mobile3">
                            </li>
                        </ul>
                    </div>
                    <p class="regist"><a href="javascript:check()"><img src="images/btn_submit.jpg" alt="응모하기" /></a></p>
                </div>
                <div class="privacy_wrap">
                    <p><input type="checkbox" id="privacy_check" name="privacy_check"/><label for="privacy_check"><img src="images/privacy_title.jpg" alt="개인정보 및 활동동의" /></label></p>
                    <p class="privacy_txt"><img src="images/privacy_txt.jpg" alt="개인정보 수집이용내역" /></p>
                </div>
                
            </div>
            <p class="georgia_ci"><img src="images/Georgia_ci.png" alt="조지아커피" /></p>
        </div>
        <div class="footer">
            <p class="footer_txt"><img src="images/footer_txt.jpg" alt="이벤트 안내사항" /></p>
        </div>
        
        
    </div>
</body>
</html>
