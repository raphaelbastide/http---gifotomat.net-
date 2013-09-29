<?php

function get_gifs() {
  $all_gifs = array_diff(scandir(GIFS_DIR), array('.', '..', '_infos.md', '_cabine.jpg'));
  natsort($all_gifs);
  $all_gifs = array_reverse($all_gifs, FALSE);
  return $all_gifs;
}

function gif_exists($gif_id) {
  return file_exists(GIFS_DIR . '/' . $gif_id . '.gif');
}

function get_route($path) {
  $vars = array();
  $params = $path
            ? array_values(array_filter(explode('/', $path)))
            : array();

  $is_json = FALSE;
  if (end($params) == 'json') {
    $is_json = TRUE;
    array_pop($params);
  }

  if (count($params) == 2
      && $params[0] == 'p'
      && is_numeric($params[1])) {
    $ptype = 'home';
    $vars['page'] = $params[1];

  } elseif (count($params) == 1
            && is_numeric($params[0])
            && gif_exists($params[0])) {
    $ptype = 'single';
    $vars['gif'] = $params[0];

  } elseif (!count($params)) {
    $ptype = 'home';
    $vars['page'] = 1;

  } else {
    $ptype = '404';
  }

  return array(
    'name' => $ptype,
    'vars' => $vars,
    'json' => $is_json
  );
}
