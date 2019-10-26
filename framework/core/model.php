<?php
class Model  // Empty model class template
{
  private function __construct() {

  }

  public static function get_by_id($id) {
    $sql  = "select * ";
    $sql .= "from ".singularize(tableize(get_called_class()))." ";
    $sql .= "where id = :id";
    $params = [
      'id' => $id
    ];

    $objects = Model::query($sql, $params);

    if (empty($objects)) {
      return null;
    } else {
      $called_class = get_called_class();
      return new $called_class($objects[0]);
    }
  }

  public static function all() {
    $sql  = "select * ";
    $sql .= "from ".singularize(tableize(get_called_class()));
    $params = [];

    $objects = Model::query($sql, $params);
    $called_class = get_called_class();

    for ($i = 0; $i < count($objects); $i++) {
      $objects[$i] = new $called_class($objects[$i]);
    }

    return $objects;
  }

  public static function query($sql, $params) {
    $request = Database::get_database()->prepare($sql);
    $result = $request->execute($params);

    if ($result) {
      return $request->fetchAll(PDO::FETCH_ASSOC);
    } else {
      return [];
    }
  }

}
?>
