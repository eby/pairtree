<?php

class Pairtree {
 
  public function encode($identifier) {
    $encode_regex = "/[\"*+,<=>?\\\^|]|[^\x21-\x7e]/";
    $escaped_string = preg_replace_callback($encode_regex, 'Pairtree::strtohex', $identifier);
    $escaped_string = str_replace(array('/',':','.'), array('=','+',','),$escaped_string);
    return $escaped_string;
  }
  
  public function decode($identifier) {
    $decode_regex = "/\\^(..)/";
    $decoded_string = str_replace(array('=','+',','), array('/',':','.'), $identifier);
    $decoded_string = preg_replace_callback($decode_regex, 'Pairtree::hextostr', $decoded_string);
    return $decoded_string;
  }
  
  private function hextostr($matches) {
    $s= '';
    $x = trim($matches[0],'^');
    foreach(explode("\n",trim(chunk_split($x,2))) as $h) $s.=chr(hexdec($h)); 
    return($s); 
  } 

  private function strtohex($matches) { 
    $s= '';
    $x= $matches[0];
    foreach(str_split($x) as $c) $s.= '^'.sprintf("%02x",ord($c)); 
    return($s); 
  }
  
  public function id_to_path($identifier) {
    $encoded_identifier = self::encode($identifier);
    $number = preg_match_all('/..?/',$encoded_identifier,$matches);
    $path = implode('/', $matches[0]);
    return $path;
  } 

}

?>