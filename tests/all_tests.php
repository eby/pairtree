<?php
require_once('simpletest/autorun.php');
require_once('../pairtree.class.php');

class TestOfPairtree extends UnitTestCase {

  function assertRoundtrip($identifier) {
    $en = Pairtree::encode($identifier);
    $de = Pairtree::decode($en);
    $this->assertEqual($identifier,$de);
  }
  
  function test_a() {
    $this->assertEqual(Pairtree::encode('a'),'a');
    $this->assertRoundtrip('a');
  }
  
  function test_space() {
    $this->assertEqual(Pairtree::encode('hello world'), 'hello^20world');
    $this->assertRoundtrip('hello world');
  }
  
  function test_slash() {
     $this->assertEqual(Pairtree::encode('/'),'=');
     $this->assertRoundtrip('/');
  }
  
  function test_urn() {
    $this->assertEqual(Pairtree::encode('http://n2t.info/urn:nbn:se:kb:repos-1'), 'http+==n2t,info=urn+nbn+se+kb+repos-1');
    $this->assertRoundtrip('http://n2t.info/urn:nbn:se:kb:repos-1');
  }
  
  function test_wtf() {
    $this->assertEqual(Pairtree::encode('what-the-*@?#!^!?'), "what-the-^2a@^3f#!^5e!^3f");
    $this->assertRoundtrip('what-the-*@?#!^!?');
  }

  function test_weird() {
    $this->assertEqual(Pairtree::encode('\\"*+,<=>?^|'), "^5c^22^2a^2b^2c^3c^3d^3e^3f^5e^7c");
    $this->assertRoundtrip('\\"*+,<=>?^|');
  }
  
  function test_hardcore_unicode() {
    $this->assertRoundtrip("1. Euro Symbol: €.
   2. Greek: Μπορώ να φάω σπασμένα γυαλιά χωρίς να πάθω τίποτα.
   3. Íslenska / Icelandic: Ég get etið gler án þess að meiða mig.
   4. Polish: Mogę jeść szkło, i mi nie szkodzi.
   5. Romanian: Pot să mănânc sticlă și ea nu mă rănește.
   6. Ukrainian: Я можу їсти шкло, й воно мені не пошкодить.
   7. Armenian: Կրնամ ապակի ուտել և ինծի անհանգիստ չըներ։
   8. Georgian: მინას ვჭამ და არა მტკივა.
   9. Hindi: मैं काँच खा सकता हूँ, मुझे उस से कोई पीडा नहीं होती.
  10. Hebrew(2): אני יכול לאכול זכוכית וזה לא מזיק לי.
  11. Yiddish(2): איך קען עסן גלאָז און עס טוט מיר נישט װײ.
  12. Arabic(2): أنا قادر على أكل الزجاج و هذا لا يؤلمني.
  13. Japanese: 私はガラスを食べられます。それは私を傷つけません。
  14. Thai: ฉันกินกระจกได้ แต่มันไม่ทำให้ฉันเจ็บ ");
  }
  
  function test_french() {
    $this->assertRoundtrip("Années de Pèlerinage (Years of Pilgrimage) (S.160, S.161,\n\
 S.163) is a set of three suites by Franz Liszt for solo piano. Liszt's\n\
 complete musical style is evident in this masterwork, which ranges from\n\
 virtuosic fireworks to sincerely moving emotional statements. His musical\n\
 maturity can be seen evolving through his experience and travel. The\n\
 third volume is especially notable as an example of his later style: it\n\
 was composed well after the first two volumes and often displays less\n\
 showy virtuosity and more harmonic experimentation.");
  }
}

?>
