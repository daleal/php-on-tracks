<?php
class Controller  // Master controller class
{
  var $vars = [];  // Setup empty vars
  var $layout = "default";  // Setup default layout (empty)

  public function __construct() {
    // Load helpers
    if (file_exists(APPLICATION_ROOT."helpers/globals.php")) {
      include APPLICATION_ROOT."helpers/globals.php";
    }
    if (file_exists(APPLICATION_ROOT."helpers/".tableize(str_replace('Controller', '', get_called_class())).".php")) {
      include APPLICATION_ROOT."helpers/".tableize(str_replace('Controller', '', get_called_class())).".php";
    }

    // Load models
    foreach (glob(APPLICATION_ROOT."models/*.php") as $filename) {
      include $filename;
    }
  }

  function set($new_vars) {
    $this->vars = array_merge($this->vars, $new_vars);
  }

  function render($filename) {
    extract($this->vars);
    ob_start();  // Render file in buffer
    // Get view content:
    include APPLICATION_ROOT."views/".tableize(str_replace('Controller', '', get_class($this))).'/'.$filename.'.php';
    $content_for_layout = ob_get_clean();  // Get buffer content
    if ($this->layout == false) {
      $content_for_layout;  // Render vainilla buffer content
    } else {
      include APPLICATION_ROOT."views/layouts/".$this->layout.'.php';  // Render layout
    }
  }

  private function secure_input($data) {
    // Filter input
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

  protected function secure_form($form) {
    // Filter form input
    $filtered_form = [];
    foreach ($form as $key => $value) {
      $filtered_form[$key] = $this->secure_input($value);
    }
    return $filtered_form;
  }
}
?>
