<?php

require '../autoload.php';
require '../vendor/autoload.php';
require 'BodyTest.php';


BodyTest::log('[METHOD] --------------------------------------'.$_SERVER['REQUEST_METHOD'].'--------------------------------------');

$bt=new BodyTest();
header('X-OpenRosa-Accept-Content-Length: '.BodyTest::byteconvert(ini_get('post_max_size')));
header('X-OpenRosa-Version:1.0');
header('Content-Type:text/xml:charset=utf-8');

if(0===strcasecmp($_SERVER['REQUEST_METHOD'],'head')){
BodyTest::log('[NO_CONTENT] ');
header('HTTP/1.1 204 No Content');
die();
}
BodyTest::log('[HEADERS] '.json_encode(getallheaders()));
BodyTest::log('[POST] '.json_encode($_POST));
BodyTest::log('[GET] '.json_encode($_GET));
BodyTest::log('[INPUT] '.file_get_contents("php://input"));
header('HTTP/1.1 201 Received');
BodyTest::log('[FILE] '.json_encode($_FILES));

?>
<?xml version="1.0"?>
<OpenRosaResponse xmlns="http://openrosa.org/http/response">
    <message nature="submit_success"><?=date('H:m:s') ?> Form successfully uploaded!</message>
</OpenRosaResponse>