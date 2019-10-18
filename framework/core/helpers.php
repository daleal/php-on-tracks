<?php
function tableize($string) {
  return Doctrine\Common\Inflector\Inflector::tableize($string);
}

function classify($string) {
  return Doctrine\Common\Inflector\Inflector::classify($string);
}

function singularize($string) {
  return Doctrine\Common\Inflector\Inflector::singularize($string);
}

function pluralize($string) {
  return Doctrine\Common\Inflector\Inflector::pluralize($string);
}

function console_log($string) {
  echo "<script>console.log(".json_encode($string).");</script>";
}

function asset_url($relative_url) {
  return WEBROOT."application/assets/".$relative_url;
}

function include_url($relative_url) {
  return APPLICATION_ROOT.$relative_url;
}

function redirect_url($relative_url) {
  return substr(WEBROOT, 0, -1).$relative_url;
}

function array_keys_exists($arr, $keys) {
  return !array_diff_key(array_flip($keys), $arr);
}

function redirect_to($url) {
  header("Location: ".redirect_url($url));
  exit;
}

?>
