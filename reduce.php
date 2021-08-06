<?php
  ini_set('error_reporting', E_ALL);	
  $cartridge_name="none";
	if (isset($_GET['cartname'])) $cartridge_name=trim(str_replace('Замена','',$_GET['cartname']));
      
	$mysqli = new mysqli('127.0.0.1', 'intranet-user', 'St15q6mp', 'intranet');
if ($mysqli->connect_errno) {
        echo "Извините, возникла проблема на сайте";
        echo "Ошибка: Не удалась создать соединение с базой MySQL и вот почему: \n";
        echo "Номер ошибки: " . $mysqli->connect_errno . "\n";
        echo "Ошибка: " . $mysqli->connect_error . "\n";
        exit;
}
	$query = 'SELECT quantity FROM cartridges WHERE name="'.$cartridge_name.'"';
	echo "<h1>$query</h1>";
	if (!$result = $mysqli->query($query)){
		echo "Извините, возникла проблема в работе сайта.";
      	echo "Ошибка: Наш запрос не удался и вот почему: \n";
      	echo "Запрос: " . $sql . "\n";
      	echo "Номер ошибки: " . $mysqli->errno . "\n";
      	echo "Ошибка: " . $mysqli->error . "\n";
      	exit;
    }
	$columns = $result->fetch_assoc();
	$quantity=$columns['quantity']-1;
	$query = 'UPDATE cartridges SET quantity='.$quantity.' WHERE name="'.$cartridge_name.'"';
	
	if (!$result = $mysqli->query($query)) 	{
      echo "Извините, возникла проблема в работе сайта.";

      echo "Ошибка: Наш запрос не удался и вот почему: \n";
      echo "Запрос: " . $sql . "\n";
      echo "Номер ошибки: " . $mysqli->errno . "\n";
      echo "Ошибка: " . $mysqli->error . "\n";
      exit;
    };
	$result->free();
	$mysqli->close();
?>
