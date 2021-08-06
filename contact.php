<?php session_start(); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>

<title>Contact Form - Sample</title>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.0/jquery.min.js"></script>
<meta name="description" content="">
<meta name="keywords"    content="">
<link rel="stylesheet" type="text/css" href="common.css">
  <link rel="stylesheet" type="text/css" href="reset.css">

</head>
<body>
<h1 class="title">Обратная связь</h1>
  <script async src="https://cse.google.com/cse.js?cx=001865984051932042146:x7vp1yrbnxq"></script>
<div class="gcse-search"></div>
  </div>
<?php

$contact_form_fields = array(
  array('name'    => 'ИМЯ:',
        'type'    => 'name',
        'require' => 1),
  array('name'    => 'E-MAIL:',
        'type'    => 'email',
        'require' => 1),
  array('name'    => 'ТЕЛЕФОН:',
        'type'    => 'input',
        'require' => 1),
  array('name'    => 'ТЕМА:',
        'type'    => 'subject',
        'require' => 1),
  array('name'    => 'СООБЩЕНИЕ:',
        'type'    => 'textarea',
        'require' => 1),
  array('name'    => 'ВЛОЖЕНИЕ:',
        'type'    => 'upload',
        'require' => 0,
        'maxsize' => 128*1024),
  array('name'    => 'ПРОВЕРОЧНЫЙ КОД:',
        'type'    => 'turing',
        'require' => 1,
        'url'     => 'image.php',
        'prompt'  => 'ВВЕДИТЕ КОД, УКАЗАННЫЙ ВЫШЕ'),
  array('name'    => '',
        'type'    => 'checkbox',
        'require' => 1,
        'prompt'  => 'Я СОГЛАСЕН НА ОБРАБОТКУ МОИХ ПЕРСОНАЛЬНЫХ ДАННЫХ'));

$contact_form_graph           = false;
$contact_form_xhtml           = false;

$contact_form_email           = "kurinskiyas@mailrusgeology.ru";
$contact_form_encoding        = "utf-8";
$contact_form_default_subject = "Тема по умолчанию";
$contact_form_message_prefix  = "Доставлено с формы сайта\r\n==============================\r\n\r\n";

include_once "contact-form.php";

?>
</body>
</html>
