<?php
// The file College.xml contains an XML document with a root element
// and at least an element /[root]/title.
// capitalize object names (Certificate), lower case attributes
// settle on camel case for names

require_once "bootstrap.php";

if (file_exists('xml/Colleges.xml')) {
    $xml = simplexml_load_file('xml/Colleges.xml');
    
    $xmlColleges = $xml->colleges->children();
    echo "number of locations: " . count($xmlColleges);

    foreach ($xmlColleges as $xmlCollege) {
      $college = new College();
      $college->setName((string)$xmlCollege->name);
      $entityManager->persist($college);
      echo $college->toString("<br>");
    }

  $entityManager->flush();
    
//    print_r($xml);
} else {
    exit('Failed to open xml/College.xml.');
}
?>
