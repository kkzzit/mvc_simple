<?php
/**
 *  Simple MVC
 *
 *  @author MN
 *  @copyright MN 2017-03-06
 *  @version 1.0.0
 */

define('DIR_ROOT', dirname(__DIR__) . DIRECTORY_SEPARATOR);

$loader = require DIR_ROOT . 'vendor/autoload.php';


$app = new App();