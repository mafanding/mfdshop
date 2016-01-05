<?php
defined("ALLOW")||exit("not allow!");
abstract class Db{
abstract public function query($sql);
abstract protected function __construct();
abstract public function close(); 
}
?>