<?php
/**
 *  Simple MVC
 *
 *  @author MN
 *  @created 2017-03-06
 */

define('DIR_ROOT', dirname(__DIR__) . DIRECTORY_SEPARATOR);

$loader = require DIR_ROOT . 'vendor/autoload.php';


$app = new App();