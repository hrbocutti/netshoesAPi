<?php


namespace ApiMktpNetshoesV1\model;

use \ArrayAccess;

class ProductTypeListResource implements ArrayAccess {
  static $swaggerTypes = array(
      'items' => 'array[ProductTypeResource]',
      'links' => 'array[Link]'
  );

  static $attributeMap = array(
      'items' => 'items',
      'links' => 'links'
  );

  
  public $items; /* array[ProductTypeResource] */
  public $links; /* array[Link] */

  public function __construct(array $data = null) {
    $this->items = $data["items"];
    $this->links = $data["links"];
  }

  public function offsetExists($offset) {
    return isset($this->$offset);
  }

  public function offsetGet($offset) {
    return $this->$offset;
  }

  public function offsetSet($offset, $value) {
    $this->$offset = $value;
  }

  public function offsetUnset($offset) {
    unset($this->$offset);
  }
}
