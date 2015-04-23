<?php
   $uploadfile1="http://georgiacoffee.gift/images/sns_img.jpg";
   $uploadfile2="http://georgiacoffee.gift/images/sns_img.jpg";
   $ch = curl_init("https://kapi.kakao.com/v1/api/story/upload/multi");
   curl_setopt($ch, CURLOPT_HTTPHEADER, array("Authorization: Bearer xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx"));
   curl_setopt($ch, CURLOPT_POSTFIELDS, array('file[0]'=>"@$uploadfile1", 'file[1]'=>"@$uploadfile2"));
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
   $postResult = curl_exec($ch);
   curl_close($ch);
   print "$postResult";
?>