<?php
$str='[connection]';
$str+='host=192.168.23.50';
$str+='port=5900';
$str+='password=****************';
$str+='[options]';
$str+='use_encoding_0=1';
$str+='use_encoding_1=1';
$str+='use_encoding_2=1';
$str+='use_encoding_3=0';
$str+='use_encoding_4=1';
$str+='use_encoding_5=1';
$str+='use_encoding_6=0';
$str+='use_encoding_7=0';
$str+='use_encoding_8=0';
$str+='use_encoding_9=0';
$str+='use_encoding_10=0';
$str+='use_encoding_11=0';
$str+='use_encoding_12=0';
$str+='use_encoding_13=0';
$str+='use_encoding_14=0';
$str+='use_encoding_15=0';
$str+='use_encoding_16=1';
$str+='preferred_encoding=5';
$str+='restricted=0';
$str+='viewonly=0';
$str+='fullscreen=0';
$str+='autoDetect=1';
$str+='8bit=0';
$str+='shared=1 (1 = multiple connections; 0 = single connection)';
$str+='swapmouse=0';
$str+='belldeiconify=0';
$str+='emulate3=1';
$str+='emulate3timeout=100';
$str+='emulate3fuzz=4';
$str+='disableclipboard=0';
$str+='localcursor=1';
$str+='scale_num=1';
$str+='scale_den=1';
header('Content-Description: File Transfer');
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="192-168-0-1.vnc"');
header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma: public');
header('Content-Length: ' . strlen($str));
echo $str;
?>