<?php
$title = $route['vars']['gif'] . ".gif − Gifotomat";
$single = TRUE;
?>
<?php require __DIR__ . '/header.php' ?>

	<div class="col">
		<div class="back"><a href="<?= url_to('') ?>">← <?= translate('home') ?></a></div>
		<p class="imgbox">
			<img src="/gifs/<?php echo $route['vars']['gif'] ?>.gif" width="400" height="480" alt="<?php echo $route['vars']['gif'] ?>.gif">
		</p>
		<p class="urlbox"><?php echo url_to($route['vars']['gif']) ?></p>
	</div>
<?php require __DIR__ . '/footer.php' ?>
