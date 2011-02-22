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
  }
  
  function test_space() {
    $this->assertEqual(Pairtree::encode('hello world'), 'hello^20world');
  }
  
  function test_slash() {
     $this->assertEqual(Pairtree::encode('/'),'=');
  }
  
  function test_urn() {
    $this->assertEqual(Pairtree::encode('http://n2t.info/urn:nbn:se:kb:repos-1'), 'http+==n2t,info=urn+nbn+se+kb+repos-1');
  }
  
  function test_wtf() {
    $this->assertEqual(Pairtree::encode('what-the-*@?#!^!?'), "what-the-^2a@^3f#!^5e!^3f");
  }

}

?>
