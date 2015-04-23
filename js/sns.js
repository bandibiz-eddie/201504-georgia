$(document).ready(function() {
    Kakao.init('1b7f6e317fb15a3132d752f21541c8eb');
	updateShare();
});


window.fbAsyncInit = function() {
	FB.init({
      appId      : '1555405611395248',
      xfbml      : true,
      version    : 'v2.3'
    });

};

(function(d, s, id) {
	var js, fjs = d.getElementsByTagName(s)[0];
	if (d.getElementById(id)) return;
	js = d.createElement(s); js.id = id;
	js.src = "//connect.facebook.net/ko_KR/sdk.js";
	fjs.parentNode.insertBefore(js, fjs);
} (document, 'script', 'facebook-jssdk'));




function html_popupCenterWindow(url, wname, w, h, f) {
    var gab = 20;
    var wx = (window.screen.width - w) / 2;
    var wy = (window.screen.height - h) / 2;
    if (wy > gab) {
        wy -= gab;
    }
    var features = "width=" + w + ",height=" + h + ",left=" + wx + ",top=" + wy + ",toolbar=no,menubar=no,location=no,status=no";
    if (f != null) {
        features += "," + f;
    }
    var p = window.open(url, wname, features);
    if (p != null) {
        p.focus();
        return p;
    }
}

var sUrl        = "http://georgiacoffee.gift";

function snsShare(vType) {
    
	$("#sns_type").val(vType);
	
    if( vType != "") {
        if (vType == "twitter") {        
		    
		    ttag        = "조지아커피도 함께 가는 내친구의 집은 어디인가";
        	html_popupCenterWindow("http://twitter.com/share?text=" + encodeURIComponent(ttag)  + "&url=" + encodeURIComponent(sUrl) , "twitterShare", 800, 345, "scrollbars=1");

			updateShare("T");
			
        }else if( vType == "facebook"){ 
			sHeadLine   = "조지아커피도 함께 가는 내친구의 집은 어디인가"
		    ttag        = "";
		    sImage		= "http://georgiacoffee.gift/images/sns_img.jpg";
            FB.ui({
	            method: "feed",
	            name: sHeadLine,
	            link: sUrl,
	            picture: sImage,
	            description: ttag
	        }, function(response) {
	            if (response && response.post_id) {
					
					updateShare("F");
					
	            }
	        });

	    }else if(vType == "story"){

		    Kakao.Auth.login({
	            success: function(authObj) {
	                var refreshToken = Kakao.Auth.getRefreshToken();
	                if (refreshToken) {
	                    Kakao.API.request({
	                        url: '/v1/api/story/linkinfo',
	                        data: {
	                            url: sUrl
	                        }
	                    }).then(function(res) {
	                        // 이전 API 호출이 성공한 경우 다음 API를 호출합니다.
	                        return Kakao.API.request({
	                            url: '/v1/api/story/post/link',
	                            data: {
	                                link_info: res
	                            }
	                        });
	                    }).then(function(res) {
	                        return Kakao.API.request({
	                            url: '/v1/api/story/mystory',
	                            data: {
	                                id: res.id
	                            }
	                        });
	                    }).then(function(res) {
	                    	updateShare("S");
	                        //alert(JSON.stringify(res));
	                    }, function(err) {
	                        //alert(JSON.stringify(err));
	                    });
	                }
	            }
	        });

	    }else if(vType == "kakao"){
		  
		    Kakao.Link.sendTalkLink({
	            label: "조지아커피도 함께 가는 내친구의 집은 어디인가\nhttp://georgiacoffee.gift",
	            image: {
	                src: "http://georgiacoffee.gift/images/sns_img.jpg",
	                width: "300",
	                height: "158"
	            }
	        });
	        updateShare("K");
			
		}
    } 
}

function updateShare(sns){
	$.ajax({
        type:"POST",
        data:{sns_type : sns},
        url: "/update_share.php",
        success: function(result){
        	//location.href = sUrl;
        }
    });	
}

