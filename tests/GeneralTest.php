<?php

use PHPUnit\Framework\TestCase;
use Slim\Views\Handlebars;

class GeneralTest extends TestCase {
  public function test_all() {
    $hbs = new Handlebars(dirname(__FILE__) . '/tpl');
    $hbs["named"] = "sidebar";
    $res = $hbs->fetch('main', ['name'=>'Matteo']);
    $oracle = "Hi Matteo!sidebar:sidebar";
    $this->assertEquals($res, $oracle);
    $res = $hbs->fetch('main', ['name'=>'Matteo','named'=>'Matt']);
    $oracle = "Hi Matteo!sidebar:Matt";
    $this->assertEquals($res, $oracle);
  }
}