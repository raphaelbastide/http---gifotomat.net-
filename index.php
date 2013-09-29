<?php
// ini_set('display_errors','On');
// error_reporting(E_ALL);

define('GIFS_DIR', __DIR__ . '/gifs/');
define('BASE_URL', 'http://gifotomat.net/');
require __DIR__ . '/lib/utils.php';

$page_id = isset($_GET['id'])? $_GET['id'] : '';

$route = get_route($page_id);
require __DIR__ . '/'. $route['name'] .'.php';
