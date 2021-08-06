<?php
$data = file_get_contents('/media/share/Служба ИТ и ТО/Куринский/computers/invent.htm'); 
echo mb_convert_encoding($data,"UTF-8","CP1251") ;
?>
