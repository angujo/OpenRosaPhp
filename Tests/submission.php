<?php
/**
 * Created for openrosaphp.
 * User: Angujo Barrack
 * Date: 2018-12-06
 * Time: 6:00 AM
 */

require '../autoload.php';
require '../vendor/autoload.php';
require 'BodyTest.php';

\Angujo\OpenRosaPhp\Http::validateUser(function ($username) { return 'does'; });

\Angujo\OpenRosaPhp\Http::submission(function ($data) {
    print_r($data);
});