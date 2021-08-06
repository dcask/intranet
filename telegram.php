<?php
/*** PHP CODE ***/
/****************/
$prxy       = 'socks5://45.77.56.114:30205'; // адрес:порт прокси
//$prxy_auth = 'auth_user:auth_pass';       // логин:пароль для аутентификации
/****************/
$ch  = curl_init();
$url = "https://api.telegram.org/bot930043202:AAGNS5IZubWDe0ANEOCSALZCiKzdek8iWWo/getUpdates"; // где XXXXX - ваши значения
curl_setopt_array ($ch, array(CURLOPT_URL => $url, CURLOPT_RETURNTRANSFER => true)); 
/********************* Код для подключения к прокси *********************/
    curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_SOCKS5);  // тип прокси 
    curl_setopt($ch, CURLOPT_PROXY,  $prxy);                 // ip, port прокси
//    curl_setopt($ch, CURLOPT_PROXYUSERPWD, $prxy_auth);  // авторизация на прокси
    curl_setopt($ch, CURLOPT_HEADER, false);                // отключение передачи заголовков в запросе 
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);            // возврат результата в качестве строки
    curl_setopt($ch, CURLOPT_POST, 1);                      // использование простого HTTP POST
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);        // отмена проверки сертификата удаленным сервером
/***********************************************************************/
$result = curl_exec($ch);  // DIGITAL RESISTANCE!
echo $result;
curl_close($ch);
?>