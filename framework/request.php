<?php
class Request
{
  public $url;  // Can be called outside the class

  public function __construct() {
    $this->url = $_SERVER["REQUEST_URI"];  // Give the request the URL requested
  }
}
?>
