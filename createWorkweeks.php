<?php
// The file Workweek.xml contains an XML document with a root element
// and at least an element /[root]/title.
// capitalize object names (Certificate), lower case attributes
// settle on camel case for names

require_once "bootstrap.php";

if (file_exists('xml/Workweek.xml')) {
    $xml = simplexml_load_file('xml/Workweek.xml');
    
    $xmlWorkweeks = $xml->workweeks->children();
    echo "number of workweeks: " . count($xmlWorkweeks);

    foreach ($xmlWorkweeks as $xmlWorkweek) {
      $workweek = new Workweek();
      $workweek->setText((string)$xmlWorkweek->text);
      $entityManager->persist($workweek);
      echo $workweek->toString("<br>");
    }

  $entityManager->flush();
    
//    print_r($xml);
} else {
    exit('Failed to open xml/Workweek.xml.');
}
?>
