<?php

class Pairtree {
 
  public function encode($identifier) {
    $encode_regex = "/[\"*+,<=>?\\\^|]|[^\x21-\x7e]/";
    $escaped_string = preg_replace_callback($encode_regex, 'Pairtree::strtohex', $identifier);
    $escaped_string = str_replace(array('/',':','.'), array('=','+',','),$escaped_string);
    return $escaped_string;
  }
  
  public function decode($identifier) {
  
  }
  
  private function hextostr($matches) {
    $s=''; 
    foreach(explode("\n",trim(chunk_split($x,2))) as $h) $s.=chr(hexdec($h)); 
    return($s); 
  } 

  private function strtohex($matches) { 
    $s='';
    $x=$matches[0];
    foreach(str_split($x) as $c) $s.= '^'.sprintf("%02x",ord($c)); 
    return($s); 
  } 

}

?>