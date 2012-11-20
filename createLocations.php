<?php
// The file Location.xml contains an XML document with a root element
// and at least an element /[root]/title.
// capitalize object names (Certificate), lower case attributes
// settle on camel case for names

require_once "bootstrap.php";

if (file_exists('xml/Location.xml')) {
    $xml = simplexml_load_file('xml/Location.xml');
    
    $xmlLocations = $xml->locations->children();
    echo "number of locations: " . count($xmlLocations);

    foreach ($xmlLocations as $xmlLocation) {
      $location = new Location();
      $location->setText((string)$xmlLocation->text);
      $entityManager->persist($location);
      echo $location->toString("<br>");
    }

  $entityManager->flush();
    
//    print_r($xml);
} else {
    exit('Failed to open xml/Location.xml.');
}
?>
