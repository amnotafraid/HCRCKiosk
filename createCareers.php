<?php

require_once "bootstrap.php";

$filename = 'xml/Careers.xml';

if (file_exists($filename)) {
    $xml = simplexml_load_file($filename);
    
    $xmlCareers = $xml->careers->children();
    echo "number of careers: " . count($xmlCareers);

    foreach ($xmlCareers as $xmlCareer) {
      $career = new Career();
      $career->setCareerName((string)$xmlCareer->career_name);
      $entityManager->persist($career);
      echo "career: " . $career->getCareerName();
    }

    $entityManager->flush();
} else {
    exit('Failed to open' . $filename);
}

?>
