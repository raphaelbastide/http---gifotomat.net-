<!doctype html>
<html lang="<?= $route['lang'] ?>">
<head><meta charset="utf-8">
<!--
<?php require __DIR__ . '/logo.txt' ?>
-->
	<title><?= (!empty($title))? $title : 'Gifotomat' ?></title>
	<meta name="viewport" content="width=device-width">
	<link rel="shortcut icon" href="/favicon.ico">
	<link rel="stylesheet" href="/css/main.css">
	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Lato:400,700,700italic">
	<meta property="og:title" content="<?= $title ?>">
	<meta property="og:locale" content="fr_FR">
	<meta property="og:site_name" content="Gifotomat">
<?php if (isset($single) && $single): ?>
	<meta property="og:type" content="article">
	<meta property="og:url" content="<?= BASE_URL . $route['vars']['gif'] ?>">
	<meta property="og:image" content="<?= BASE_URL .'gifs/'. $route['vars']['gif'] ?>.gif">
	<meta property="og:description" content="<?= $route['vars']['gif'] ?>.gif − Gifotomat">
<?php else: ?>
	<meta property="og:type" content="website">
	<meta property="og:url" content="<?= BASE_URL ?>">
	<meta property="og:image" content="<?= BASE_URL ?>gifs/_cabine.jpg">
	<meta property="og:description" content="Le Gifotomat est un générateur de GIFs animés produisant des doubles portraits.">
<?php endif; ?>
</head>
<body class="<?= $route['name']; if (!empty($body_classes)) echo ' '.$body_classes; ?>">
