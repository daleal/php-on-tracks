<?php
class Database {
  // Singleton for the database
  private static $database = null;  // Restrict outside access

  private function __construct() {

  }

  public static function setup_database() {
    // Create a new instance of the database
    self::$database = new PDO(
      "pgsql:host=".getenv('DB_HOST').";dbname=".getenv('DB_NAME'),  // databse url
      getenv('DB_USERNAME'),  // database username
      getenv('DB_PASSWORD')  // database password
    );
    self::$database->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    self::$database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }

  public static function get_database() {
    if (is_null(self::$database)) {
      self::setup_database();
    }
    return self::$database;

  }
}

?>
