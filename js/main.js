
$(function(){
	$(document).on("keyup", "input:text[numberOnly]", function() {$(this).val( $(this).val().replace(/[^0-9]/gi,"") );});
	
});

function check(is_mobile){
	var user_name		 = $.trim($("#user_name").val());
	var gender			 = $(":input:radio[name=gender]:checked").val();
	var age				 = $.trim($("#age").val());
	var user_height		 = $.trim($("#user_height").val());	
	var mobile1			 = $("#mobile1 > option:selected").val();	
	var mobile2			 = $.trim($("#mobile2").val());
	var mobile3			 = $.trim($("#mobile3").val());
	var job				 = $("#job > option:selected").val();	
	var zipcode1		 = $.trim($("#zipcode1").val());
	var zipcode2		 = $.trim($("#zipcode2").val());
	var zipcode 		 = zipcode1 + "-" + zipcode2;
	var address1		 = $.trim($("#address1").val());
	var address2		 = $.trim($("#address2").val());
	
	var email1			 = $.trim($("#email1").val());
	var email2			 = $("#email2 > option:selected").val();	
	var email3			 = $.trim($("#email3").val());
	
	
	var active_check	 = $(":input:radio[name=active_check]:checked").val()
	var bicycle_type	 = $(":input:radio[name=bicycle_type]:checked").val()
	var wish			 = $.trim($("#wish").val());
	var resolution		 = $.trim($("#resolution").val());
	
	
		        
	if(user_name == ""){
		alert("이름을 입력해 주세요.");
		$("#user_name").focus()
		return;
	}

	if(gender == undefined){
		alert("성별을 선택해 주세요.");
		$("#man").focus()
		return;
	}
	
	
	if(age == ""){
		alert("나이를 입력해 주세요.");
		$("#age").focus()
		return;
	}
	
	if(user_height == ""){
		alert("신장을 입력해 주세요.");
		$("#user_height").focus()
		return;
	}
	
	

	if(mobile1 == "" || mobile2 == "" || mobile3 == ""){
		alert("연락처를 입력해 주세요.");
		$("#mobile1").focus();
		return;
	}
	var mobile = mobile1 + "-" + mobile2 + "-" + mobile3;
	
	var regExp = /^01([0|1|6|7|8|9]?)-?([0-9]{3,4})-?([0-9]{4})$/;
	if ( !regExp.test( mobile) ) {
	    alert("잘못된 휴대폰 번호입니다.");
	    $("#mobile1").focus();
	    return;
	} 
	
	if (address1 == ""){
		$("#zipcode1").focus();
		alert("우편번호를 검색해 주세요.");
	    return;
	}
	
	if (address2 == ""){
		$("#address2").focus();
		alert("상세 주소를 입력해 주세요.");
	    return;
	}
	
	
	if (email1 == ""){
		$("#email1").focus();
		alert("이메일 주소를 입력해 주세요.");
	    return;
	}
	
    if (email2 == ""){
    	alert("이메일을 선택해 주세요.");	
    	return;
	}
	
	if (email2 == "etc"){
    	var email 			 = email1 + "@" + email3;
	}else{
		var email 			 = email1 + "@" + email2;
	}

	var regExp = /([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
	if(!regExp.test(email)) {
         alert('이메일 주소가 유효하지 않습니다');
         $('#email1').focus();
         return;
    }

	var regExp = /(http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/;
	sns = true;
	var i = 0;
	$('input[name="sns_url[]"]').each(function() { 
	
		if (i==0){
			
			if ($(this).val() == ""){
				alert("블로그 URL을 입력해 주세요.");
				$(this).focus();
				sns = false;
				return false;
			}else{
				/*

			    if(!regExp.test($(this).val())){
			    	alert("정확한 URL을 입력해 주세요.");
			    	$(this).focus();
			    	sns = false;
			        return false;
			    }	
*/
			} 
		}else{
			
			if ($(this).val() == ""){
				alert("SNS URL을 입력해 주세요.");
				$(this).focus();
				sns = false;
				return false;
			}else{
				/*

			    if(!regExp.test($(this).val())){
			    	alert("정확한 URL을 입력해 주세요.");
			    	$(this).focus();
			    	sns = false;
			        return false;
				}
*/
			} 
		}
	
		
		i++;
	}); 
	
	if(!sns){
		return;
	}

	club = true;
	
	
	if (active_check == undefined){
	    alert("동호회 활동 여부를 선택해 주세요.");
	    $("#active").focus();
	    return;
	}
	
	$('input[name="club_url[]"]').each(function() { 
		if ($( "input[name='club_url[]']" ).val() == ""){
			alert("활동하는 동호회 URL을 입력해 주세요.");
			$(this).focus();
			club = false;
			return false;
		}else{
			
		    /*
if(!regExp.test($(this).val())){
		    	alert("정확한 URL을 입력해 주세요.");
		    	$(this).focus();
		    	club = false;
		        return false;
		    }else{
			    club = true;
		    }	
*/
		} 
		i++;
	}); 
	
	if(!club){
		return;
	}

	if (bicycle_type == undefined){
        alert('자전거 유형을 선택해 주세요.');
        return;       
    }
    
	
	
	if (wish == ""){
		$("#wish").focus();
		alert("3000시간의 법칙 챌린저를 통해 변하고 싶은 것을 입력해 주세요.");
	    return;
	}
	
	if (resolution == ""){
		$("#resolution").focus();
		alert("3000시간의 법칙 챌린저에 임한는 각오를 입력해 주세요..");
	    return;
	}
	
	
	if ( $(":checkbox[name='pravacy1']:checked").length==0){
        alert('개인정보수집에 동의해 주세요.');
        return;        

    }
    
    if ( $(":checkbox[name='pravacy2']:checked").length==0){
        alert('개인정보취급위탁에 동의해 주세요.');
        return;        

    }
    

    sns_url = $('input[name="sns_url[]"]').map(function() {
		return $(this).val();
	}).get().join('|||');
	club_url = $('input[name="club_url[]"]').map(function() {
		return $(this).val();
	}).get().join('|||');

	
	if (is_mobile == "Y"){
    	$("#btn_commit").attr('src' , '/images/ajax-loader.gif');  
		$("#btn_commit").css('width' , '32px');  
	}else{
    	$("#btn_commit").attr('src' , '/images/ajax-loader.gif');  
	}
	
    $.ajax({
        type:"POST",
        data:{user_name : user_name, gender : gender, age : age,user_height : user_height, mobile : mobile, job : job, zipcode : zipcode, address1 : address1, address2 : address2,email : email, sns_url : sns_url, club_url : club_url, active_check : active_check, bicycle_type : bicycle_type, wish : wish, resolution : resolution , is_mobile : is_mobile},
        url: "/process.asp",
        success: function(result){
        	$("#user_idx").val($.trim(result));
        	if (is_mobile == "Y"){
	        	location.href="/m/complete.asp?user_idx=" + result;
        	}else{
        	
        		var pop_center = popCenter(753);
			
				$('.pop_complete').css("top" , pop_center + $(window).scrollTop());       	
				$("#btn_commit").attr('src' , '/images/btn_input.png');            
			    $('.pop_input').addClass('hide');
			    $('.pop_complete').removeClass('hide'); 
			    
			     
        	}
        	
        }
    });
	
}

