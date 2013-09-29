<?php
$title = 'Page non trouvée :( − Gifotomat';
$body_classes = 'p404';
?>
<?php require __DIR__ . '/header.php' ?>

	<div class="col">
		<div class="back"><a href="<?php echo BASE_URL ?>">← Accueil</a></div>
		<div class="imgbox">
			<p>La page demandée est introuvable !</p>
		</div>
		<div class="backimg"><a href="<?php echo BASE_URL ?>"><img width="190" height="175" src="/404.png" alt="Gifotomat"></a></div>
	</div>
<?php require __DIR__ . '/footer.php' ?>
