<?php
class Router
{
  static public function parse($url, $request) {
    $url = trim($url);  // Remove beginning and trailing whitespaces

    if ($url == WEBROOT) {
      $request->controller = "static_views";
      $request->action = "index";
      $request->params = [];
    } else {
      $explode_url = explode("/", $url);  // Split $url by "/"
      $explode_url = array_slice($explode_url, WEBROOT == "/" ? 1 : 2);  // Remove url bloat

      $request->controller = $explode_url[0];
      $request->action = $explode_url[1];
      $request->params = array_slice($explode_url, 2);  // Get a list of params
    }
  }
}
?>
