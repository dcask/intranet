<?php
$row = 1;
$hostname="";
if(isset($_GET['host'])) $hostname=$_GET['host'];
else{
  echo "<form method='get' action='/host.php'>";
  echo "<p>Hostname:";
  echo "<input name='host' type='text'/></p>";
  echo "<input type='submit' value='Get it'/>";
  echo "</form>";
  echo "<a href='gdgd.vnc'>click</a>";
}
echo "<table>";
$first="";$second="";
if ($hostname!=""&&($handle = fopen("/media/share/Служба ИТ и ТО/Куринский/computers/".$hostname.".csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
        $num = count($data);
      	$color=56+(($data[2]%2)+1)*20;
      	$colors=" style='background-color:hsl(".$color.",85%,62%)'";
      	echo "<tr'>";
        if($data[0]===$first) 
          echo "<td></td>\n";	
      	else echo "<td".$colors.">".mb_convert_encoding($data[0],"UTF-8","CP1251") . "</td>\n";
      	if($data[1]===$second&&$data[0]===$first) 
          echo "<td></td>\n";	
      	else echo "<td".$colors.">".mb_convert_encoding($data[1],"UTF-8","CP1251") . "</td>\n";
        
        echo "<td".$colors.">".mb_convert_encoding($data[3],"UTF-8","CP1251") . "</td>\n";
      	echo "</tr>";
      	$first=$data[0];
  		$second=$data[1];
    }
    fclose($handle);
}else{
  echo "<tr><td>Нет данных</td></tr>";
}
echo "</table>";
?>