<?php

use Angujo\OpenRosaPhp\Utils\Log;
/**
 * Created for openrosaphp.
 * User: Angujo Barrack
 * Date: 2018-12-06
 * Time: 6:00 AM
 */

require '../autoload.php';
require '../vendor/autoload.php';
require 'BodyTest.php';

BodyTest::log('[REQUEST RECEIVED] '.$_SERVER['REQUEST_METHOD']);

Log::debug(function($msg){
    BodyTest::log($msg);
});

\Angujo\OpenRosaPhp\Http::validateUser(function ($username) { return 'does'; });

\Angujo\OpenRosaPhp\Http::submission(function (array $data) {
    BodyTest::log(json_encode($data));
});