<?php
/**
 * ENVIRONMENT SETTINGS
 */
define('DEV', true);


if (DEV === true) {
	error_reporting(E_ALL);
	ini_set('display_errors', '1');
} else {
	error_reporting(~E_ALL);
	ini_set('display_errors', '0');
}


/**
 * GENERAL PATHS
 */
define('DIR_VIEWS', DIR_ROOT . 'src' . DIRECTORY_SEPARATOR . 'View' . DIRECTORY_SEPARATOR);
define('DIR_CACHE', DIR_ROOT . 'var' . DIRECTORY_SEPARATOR . 'cache' . DIRECTORY_SEPARATOR);

define('URL_DOMAIN', filter_input(INPUT_SERVER, 'HTTP_HOST', FILTER_SANITIZE_URL));
define('URI', filter_input(INPUT_SERVER, 'REQUEST_URI', FILTER_SANITIZE_URL));
define('URL', '//' . URL_DOMAIN . URI);
define('URL_ASSETS', '/static/');
define('URL_STATIC', '/img/');
define('URL_STATIC_FULL', URL . 'img/');