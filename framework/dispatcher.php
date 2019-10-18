<?php
class Dispatcher
{
  private $request;  // Only for use within the object

  public function dispatch() {
    $this->request = new Request();
    // Parse url into $this->request
    Router::parse($this->request->url, $this->request);
    $controller = $this->loadController();
    // Call the action within the controller with params
    call_user_func_array([$controller, $this->request->action], $this->request->params);
  }

  public function loadController() {
    // Get non camel cased name
    $non_camel_case_name = tableize($this->request->controller).'_controller';
    // Get class name
    $name =  classify($non_camel_case_name);
    // Get file name to load it at runtime
    $file = APPLICATION_ROOT.'controllers/'.$non_camel_case_name.'.php';
    // Load controller file
    require($file);
    // Load controller $name
    $controller = new $name();
    return $controller;
  }
}
?>
