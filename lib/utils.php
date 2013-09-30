<?php

function get_gifs() {
  $all_gifs = glob(GIFS_DIR.'/*.gif');
  natsort($all_gifs);
  $all_gifs = array_reverse($all_gifs, FALSE);
  $all_gifs = array_map(function($gif) {
    return basename($gif);
  }, $all_gifs);
  return $all_gifs;
}

function gif_exists($gif_id) {
  return file_exists(GIFS_DIR . '/' . $gif_id . '.gif');
}

function url_to($path) {
  global $route;
  $url = BASE_URL;
  if (isset($route) && $route['lang_prefix']) {
    $url .= $route['lang'].'/';
  }
  return "$url$path";
}

function get_route($path, $langs) {
  $vars = [];
  $params = [];
  $lang_prefix = FALSE;

  // Path params.  array_filter() removes empty params, and array_values()
  // reinits the array index()
  if ($path) {
    $params = array_values(array_filter(explode('/', $path)));
  }

  // Language
  if (count($params) && in_array($params[0], $langs)) {
    $page_lang = $params[0];
    array_shift($params);

  } else {
    // Default language
    $page_lang = $langs[0];
  }

  // Is there a language prefix in the URL?
  $lang_prefix = $page_lang !== $langs[0];

  // JSON version of the URL
  $is_json = FALSE;
  if (end($params) == 'json') {
    $is_json = TRUE;
    array_pop($params);
  }

  // GIFs pagination
  if (count($params) == 2
      && $params[0] == 'p'
      && is_numeric($params[1])) {
    $ptype = 'home';
    $vars['page'] = $params[1];

  // Single GIF
  } elseif (count($params) == 1
            && is_numeric($params[0])
            && gif_exists($params[0])) {
    $ptype = 'single';
    $vars['gif'] = $params[0];

  // Homepage
  } elseif (!count($params)) {
    $ptype = 'home';
    $vars['page'] = 1;

  } else {
    $ptype = '404';
  }

  return array(
    'name' => $ptype,
    'vars' => $vars,
    'json' => $is_json,
    'lang' => $page_lang,
    'lang_prefix' => $lang_prefix,
  );
}

function translate($key, $placeholders=[]) {
  global $translations;
  if (!isset($translations[$key])) return NULL;
  $value = $translations[$key];
  if ($placeholders) {
    $value = vsprintf($value, $placeholders);
  }
  return $value;
}
