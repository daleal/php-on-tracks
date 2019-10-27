<?php
class Model  // Empty model class template
{
  private function __construct($data) {
    foreach ($data as $key => $value)
    {
      $this->$key = $value;
    }
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
      return new $objects[0];
    }
  }

  public static function all() {
    $sql  = "select * ";
    $sql .= "from ".singularize(tableize(get_called_class()));
    $params = [];

    $objects = Model::query($sql, $params);

    return $objects;
  }

  public static function query($sql, $params) {
    $request = Database::get_database()->prepare($sql);
    $result = $request->execute($params);

    if ($result) {
      $objects = $request->fetchAll(PDO::FETCH_ASSOC);
      $called_class = get_called_class();

      for ($i = 0; $i < count($objects); $i++) {
        $objects[$i] = new $called_class($objects[$i]);
      }
      return $objects;
    } else {
      return [];
    }
  }

}
?>
