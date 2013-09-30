<?php
$title = 'Page non trouvée :( − Gifotomat';
$body_classes = 'p404';
?>
<?php require __DIR__ . '/header.php' ?>

	<div class="col">
		<div class="back"><a href="<?= url_to('') ?>">← <?= translate('home') ?></a></div>
		<div class="imgbox">
			<p><?= translate('404 not found') ?></p>
		</div>
		<div class="backimg"><a href="<?= url_to('') ?>"><img width="190" height="175" src="/404.png" alt="Gifotomat"></a></div>
	</div>
<?php require __DIR__ . '/footer.php' ?>
