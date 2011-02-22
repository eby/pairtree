<?php
require_once('simpletest/autorun.php');
require_once('../pairtree.class.php');

class TestOfPairtree extends UnitTestCase {

  function assertRoundtrip($identifier) {
    $en = Pairtree::encode($identifier);
    $de = Pairtree::decode($en);
    $this->assertEqual($en,$de);
  }
  
  function test_a() {
    $this->assertEqual(Pairtree::encode('a'),'a');
    $this->assertRoundtrip('a');
  }

}

?>
