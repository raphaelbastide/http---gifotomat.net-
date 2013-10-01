<?php
require __DIR__ . '/lib/markdown.php';
require __DIR__ . '/lib/pagination.class.php';

$all_gifs = get_gifs(GIFS_DIR);
$page = (int)$route['vars']['page'];
$pagination = new Pagination();
$p = $pagination->calculate_pages(count($all_gifs), 10, $page);

$gifs = array_slice($all_gifs, ($page-1) * 10, 10);

$title = 'Gifotomat';
if ($page > 1) {
	$title = "Page {$page} − " . $title;
}

// Pagination HTML
$pagination_html = '';
if ($p['last'] != 1) {
	$pagination_html .= "\t\t\t".'<div id="pagination">'. $p['current'] .' / '. $p['last'] .'</div>'."\n";
}
if ($p['previous'] && $p['current'] != 1) {
	$pagination_html .= "\t\t\t".'<div id="prev"><a href="'. url_to(($p['previous'] == 1)? '' : 'p/'.$p['previous']) .'" title="'.translate('previous page').'">⇠</a></div>'."\n";
}
if ($p['next'] && $p['next'] != 1 && $p['current'] != $p['last']) {
	$pagination_html .= "\t\t\t".'<div id="next"><a href="'. url_to('p/'.$p['next']) .'" title="'.translate('next page').'">⇢</a></div>'."\n";
}

$body_classes = ($page > 1)? 'paginated' : '';

// JSON
if ($route['json']) {
	exit(json_encode(array(
		'page' => $page,
		'title' => $title,
		'gifs' => $gifs,
		'pagination' => $pagination_html
	)));
}

?>
<?php require __DIR__ . '/header.php' ?>
	<h1 id="logo">
		<a href="<?= url_to('') ?>">
			Gifotomat
		</a>
	</h1>
	<div id="left" class="col">
	  <p class="langpicker">
	    <a class="fr" title="Passer en langue Française" href="/fr">FR</a>
	    <a class="en" title="Switch to English" href="/">ENG</a>
	  </p>
		<?php $infos_file_prefix = $route['lang_prefix']? '-'.$route['lang'] : ''; ?>
		<?= Markdown(file_get_contents(GIFS_DIR . "/_infos${infos_file_prefix}.md")) ?>
	</div>
	<div id="right" class="col">
		<h2>Compositions</h2>
		<ul id="images">
<?php foreach($gifs as $gif): ?>
<?php if(in_array(pathinfo($gif, PATHINFO_EXTENSION), array('gif'))):  ?>
			<li>
				<a href="<?= url_to(substr($gif, 0, -4)) ?>"><img src="<?= BASE_URL . 'gifs/' . $gif ?>" width="400" height="480" alt=""></a>
				<p><?= $gif ?></p>
			</li>
<?php endif; ?>
<?php endforeach; ?>
		</ul>
		<div id="nav">
<?= $pagination_html ?>
		</div>
	</div>
	<script type="text/x-template" id="tpl-image">
		<li>
			<a href="<?= BASE_URL ?>{path}"><img src="<?= BASE_URL . 'gifs/' ?>{gif}" width="400" height="480" alt=""></a>
			<p>{gif}</p>
		</li>
	</script>
	<script type="text/x-template" id="tpl-image">
		<li>
			<a href="<?= BASE_URL ?>{path}"><img src="<?= BASE_URL . 'gifs/' ?>{gif}" width="400" height="480" alt=""></a>
			<p>{gif}</p>
		</li>
	</script>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
	<script src="/main.js"></script>
<?php require __DIR__ . '/footer.php' ?>
