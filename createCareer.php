  <?php
// the next time you work on this add text to media so you can display something
use Doctrine\Common\Collections\ArrayCollection;
require_once "bootstrap.php";

//$filename = 'xml/MedicalAssisting.xml';
//$filename = 'xml/VeterinaryTechnology.xml';
//$filename = 'xml/MagneticResonanceImaging.xml';
//$filename = 'xml/MedicalPracticeManager.xml';
//$filename = 'xml/PharmacyTechnician.xml';
//$filename = 'xml/RadiologicSciences.xml';
//$filename = 'xml/MedicalStaffServices.xml';
//$filename = 'xml/MedicalFrontOffice.xml';
//$filename = 'xml/Nursing.xml';
//$filename = 'xml/SurgicalTechnology.xml';
//$filename = 'xml/InvasiveCardiovascularTechnology.xml';
//$filename = 'xml/SubstanceAbuseCounseling.xml';
//$filename = 'xml/SocialWork.xml';
//$filename = 'xml/Sonography.xml';
//$filename = 'xml/RespitoryCare.xml';
//$filename = 'xml/Biotechnology.xml';
//$filename = 'xml/MedicalLaboratory.xml';
//$filename = 'xml/Echocardiology.xml';
$filename = 'xml/Paramedic.xml';
if (file_exists($filename)) {
    $xml = simplexml_load_file($filename);
    
    // Find or create the career object
    $xmlCareer = $xml->career;
    if ($xmlCareer =="") {
      throw new Exception("Invalid career xml file");
    }
    
    // set up arrays
    $dql = "SELECT c FROM College c";
    $query = $entityManager->createQuery($dql);
    $colleges = $query->getResult();

    $dql = "SELECT w FROM Workweek w";
    $query = $entityManager->createQuery($dql);
    $workweeks = $query->getResult();

    $dql = "SELECT l FROM Location l";
    $query = $entityManager->createQuery($dql);
    $locations = $query->getResult();

    $footnotes = new ArrayCollection();

    // Find a career by career_name
    $career = $entityManager->getRepository('Career')->findOneBy(array('career_name' => (string)$xmlCareer->career_name));
    if (is_null($career)) {
      $career = new Career();
    }

    // career - career_name, practicer_name
      $career->setCareerName((string)$xmlCareer->career_name);
      $career->setPracticerName((string)$xmlCareer->practicer_name);

    // career - typical_workweek - first look to see if this workweek exists
      $xmlTypicalWorkweek = $xmlCareer->typical_workweek;

      reset ($workweeks);
      $id = -1;  // -1 indicates no match was found

      // loop through the workweeks that already exist
      foreach($workweeks AS $workweek) {
          if (strcmp ($workweek->getText(),
                      (string)($xmlTypicalWorkweek->workweek->text)) == 0) {
            // if a matching workweek is found, exit with $id set
            $id = $workweek->getId();
            break;
          }
      }

      if ($id == -1) {
        // if a matching workweek wasn't found, create a new one
        $workweek = new Workweek();
        $workweek->setText((string)$xmlTypicalWorkweek->workweek->text);
        $entityManager->persist($workweek);
        echo $workweek->toString("<br>");
        $workweeks[count($workweeks)] = $workweek;
      }

      $career->setTypicalWorkweek($workweek);
    
    // career - administrative, clinical, diagnostic
      $career->setAdministrative(get_bool((string)$xmlCareer->administrative));
      $career->setClinical(get_bool((string)$xmlCareer->clinical));
      $career->setDiagnostic(get_bool((string)$xmlCareer->diagnostic));
      
    // career - loop through certificates
      $xmlCertificates = $xmlCareer->certificates->children();
      if ($xmlCertificates != "") {
        $iCertificate = 0;
        $cCertificate = count($xmlCertificates);
        foreach ($xmlCertificates as $xmlCertificate) {
          $iCertificate++;
          if ($iCertificate > $cCertificate) {
            break;
          }
          // create a certificate object
            $certificate = new Certificate();

          // certificate - variables
            $certificate->setContinuingEducationHours((string)$xmlCertificate->continuing_education_hours);
            $certificate->setCreditHours((string)$xmlCertificate->credit_hours);
            $certificate->setName((string)$xmlCertificate->name);
            $certificate->setBrookhaven(get_bool((string)$xmlCertificate->brookhaven));
            $certificate->setCedarValley(get_bool((string)$xmlCertificate->cedar_valley));
            $certificate->setEastfield(get_bool((string)$xmlCertificate->eastfield));
            $certificate->setElCentro(get_bool((string)$xmlCertificate->el_centro));
            $certificate->setMountainView(get_bool((string)$xmlCertificate->mountain_view));
            $certificate->setNorthLake(get_bool((string)$xmlCertificate->north_lake));
            $certificate->setRichland(get_bool((string)$xmlCertificate->richland));

          // certificate - brookhaven_effectives
            if ($xmlCertificate->brookhaven_effectives != "") {
              $xmlBrookhavenEffectives = $xmlCertificate->brookhaven_effectives->children();
              $brookhaven_effectives = get_effectives ($xmlBrookhavenEffectives, $footnotes);
              if (!is_null($brookhaven_effectives)) {
                foreach ($brookhaven_effectives AS $brookhaven_effective) {
                  $entityManager->persist($brookhaven_effective);
                  $certificate->assignBrookhavenEffective($brookhaven_effective);
                }
              }
            }
            
          // certificate - cedar_valley_effectives
            if ($xmlCertificate->cedar_valley_effectives != "") {
              $xmlCedarValleyEffectives = $xmlCertificate->cedar_valley_effectives->children();
              $cedar_valley_effectives = get_effectives ($xmlCedarValleyEffectives, $footnotes);
              if (!is_null($cedar_valley_effectives)) {
                foreach ($cedar_valley_effectives AS $cedar_valley_effective) {
                  $entityManager->persist($cedar_valley_effective);
                  $certificate->assignCedarValleyEffective($cedar_valley_effective);
                }
              }
            }
            
          // certificate - eastfield_effectives
            if ($xmlCertificate->eastfield_effectives != "") {
              $xmlEastfieldEffectives = $xmlCertificate->eastfield_effectives->children();
              $eastfield_effectives = get_effectives ($xmlEastfieldEffectives, $footnotes);
              if (!is_null($eastfield_effectives)) {
                foreach ($eastfield_effectives AS $eastfield_effective) {
                  $entityManager->persist($eastfield_effective);
                  $certificate->assignEastfieldEffective($eastfield_effective);
                }
              }
            }
            
          // certificate - el_centro_effectives
            if ($xmlCertificate->el_centro_effectives != "") {
              $xmlElCentroEffectives = $xmlCertificate->el_centro_effectives->children();
              $el_centro_effectives = get_effectives ($xmlElCentroEffectives, $footnotes);
              if (!is_null($el_centro_effectives)) {
                foreach ($el_centro_effectives AS $el_centro_effective) {
                  $entityManager->persist($el_centro_effective);
                  $certificate->assignElCentroEffective($el_centro_effective);
                }
              }
            }
            
          // certificate - mountain_view_effectives
            if ($xmlCertificate->mountain_view_effectives != "") {
              $xmlMountainViewEffectives = $xmlCertificate->mountain_view_effectives->children();
              $mountain_view_effectives = get_effectives ($xmlMountainViewEffectives, $footnotes);
              if (!is_null($mountain_view_effectives)) {
                foreach ($mountain_view_effectives AS $mountain_view_effective) {
                  $entityManager->persist($mountain_view_effective);
                  $certificate->assignMountainViewEffective($mountain_view_effective);
                }
              }
            }
            
          // certificate - north_lake_effectives
            if ($xmlCertificate->north_lake_effectives != "") {
              $xmlNorthLakeEffectives = $xmlCertificate->north_lake_effectives->children();
              $north_lake_effectives = get_effectives ($xmlNorthLakeEffectives, $footnotes);
              if (!is_null($north_lake_effectives)) {
                foreach ($north_lake_effectives AS $north_lake_effective) {
                  $entityManager->persist($north_lake_effective);
                  $certificate->assignNorthLakeEffective($north_lake_effective);
                }
              }
            }
            
          // certificate - richland_effectives
            if ($xmlCertificate->richland_effectives != "") {
              $xmlRichlandEffectives = $xmlCertificate->richland_effectives->children();
              $richland_effectives = get_effectives ($xmlRichlandEffectives, $footnotes);
              if (!is_null($richland_effectives)) {
                foreach ($richland_effectives AS $richland_effective) {
                  $entityManager->persist($richland_effective);
                  $certificate->assignRichlandEffective($richland_effective);
                }
              }
            }
            
          $entityManager->persist($certificate);
          echo $certificate->toString("<br>");
          // career - certificate
          $career->assignCertificate($certificate);
        } // endloop certificates
      }// endif certificates exist

    // career - dutys
      $xmlDutys = $xmlCareer->dutys->children();
      // loop through dutys
      if ($xmlDutys != "") {
        $iDuty = 0;
        $cDuty = count($xmlDutys);
        foreach ($xmlDutys as $xmlDuty) {
          $iDuty++;
          if ($iDuty > $cDuty) {
            break;
          }
          $xmlInfo = $xmlDuty->info;
          $info = new Info();
          $info->setText((string)$xmlInfo->text);

          $entityManager->persist($info);
          echo $info->toString("<br>");
          $career->assignDuty($info);
        } // endfor loop dutys
      } // endif dutys exist
      
    // career - growths
      $xmlGrowths = $xmlCareer->growths->children();
      // loop through growths
      if ($xmlGrowths != "") {
        $iGrowth = 0;
        $cGrowth = count($xmlGrowths);
        foreach ($xmlGrowths as $xmlGrowth) {
          // create a growth object
          $iGrowth++;
          if ($iGrowth > $cGrowth) {
            break;
          }
          $growth = new Growth();

          // growth - footnote - only if there is one
            if ($xmlGrowth->footnote != "") {
              $xmlFootnote = $xmlGrowth->footnote;
              $footnote = NULL;
              reset ($footnotes);
              foreach ($footnotes as $tempFootnote) {
                if (strcmp ($tempFootnote->getText(),
                            (string) $xmlFootnote->text) == 0) {
                  $footnote = $tempFootnote;
                  break;
                }
              }

              // no footnote found in the career, so make a new one
              if (is_null($footnote)) {
                  $footnote = new Footnote();
                  $footnote->setText((string)$xmlFootnote->text);
                  $footnotes[count($footnotes)] = $footnote;
              }

              $growth->setFootnote($footnote);
            }

          // growth - percentage, through_year
            $growth->setPercentageLow((int)$xmlGrowth->percentage_low);
            $growth->setPercentageHigh((int)$xmlGrowth->percentage_high);
            $growth->setThroughYear((int)$xmlGrowth->through_year);

          // location
            // You want to see if there is already a location object for the one used
            // and then use that one if it exists.

            reset ($locations);
            $id = -1; // -1 indicates matching location not found

            // growth - loop through the locations that already exist
            foreach ($locations as $location) {
              if (strcmp ($location->getText(),
                          (string) ($xmlGrowth->location->text)) == 0) {
                // if there's a match, exit with $id set
                $id = $location->getId();
                break;
              }
            }

            if ($id == -1) {
              // if a matching location wasn't found, create a new one
              $location = new Location();
              $location->setText((string) ($xmlGrowth->location->text));
              $entityManager->persist($location);
              echo $location->toString("<br>");
              $locations[count($locations)] = $location;
            }

            $growth->setLocation($location);

          // persist and assign the growth
          $entityManager->persist($growth);
          echo $growth->toString("<br>");
          $career->assignGrowth($growth);
        } //endfor loop Growths
      } //endif Growth exist

    // career - medias
      $xmlMedias = $xmlCareer->medias->children();
      // loop through medias
      if ($xmlMedias != "") {
        $iMedia = 0;
        $cMedia = count($xmlMedias);
        foreach ($xmlMedias as $xmlMedia) {
          // create a media object
          $iMedia++;
          if ($iMedia > $cMedia) {
            break;
          }
          $media = new Media();

          // media - alt_text, height, path, width, corner, type
            $media->setAltText((string) $xmlMedia->alt_text);
            $media->setHeight((string) $xmlMedia->height);
            $media->setPath((string) $xmlMedia->path);
            $media->setWidth((string) $xmlMedia->width);
            $media->setCorner((string) $xmlMedia->corner);
            $media->setType((string) $xmlMedia->type);

          $entityManager->persist($media);
          $career->assignMedia($media);
          echo $media->toString("<br>");
        } //endloop media
      }//endif medias exist
        
      
    // career - more_infos
      $xmlMoreInfos = $xmlCareer->more_infos->children();
      if ($xmlMoreInfos != "") {
      // loop through more_infos
        $iMoreInfo = 0;
        $cMoreInfo = count($xmlMoreInfos);
        foreach ($xmlMoreInfos as $xmlMoreInfo) {
          $iMoreInfo++;
          if ($iMoreInfo > $cMoreInfo) {
            break;
          }
          $xmlInfo = $xmlMoreInfo->info;
          $info = new Info();
          $info->setText((string)$xmlInfo->text);

          $entityManager->persist($info);
          echo $info->toString("<br>");
          $career->assignMoreInfo($info);
        }//endfor loop more infos
      }//endif more infos exist
      
    // career - outlooks
      $xmlOutlooks = $xmlCareer->outlooks->children();
      if ($xmlOutlooks != "") {
        $iOutlook = 0;
        $cOutlook = count($xmlOutlooks);
        foreach ($xmlOutlooks as $xmlOutlook) {
          $iOutlook++;
          if ($iOutlook > $cOutlook) {
            break;
          }
          $xmlInfo = $xmlOutlook->info;
          $info = new Info();
          $info->setText((string)$xmlInfo->text);

          $entityManager->persist($info);
          echo $info->toString("<br>");
          $career->assignOutlook($info);
        }  // end loop outlooks
      } // endif outlooks exist
      
    // career - possible_workweeks
      $xmlPossibleWorkweeks = $xmlCareer->possible_workweeks->children();
      if ($xmlPossibleWorkweeks != "") {
      //reset ($possibleWorkweeks);
        $iPossibleWorkweek = 0;
        $cPossibleWorkweeek = count($xmlPossibleWorkweeks);
        foreach ($xmlPossibleWorkweeks as $xmlPossibleWorkweek) {
          $iPossibleWorkweek++;
          if ($iPossibleWorkweek > $cPossibleWorkweeek) {
            break;
          }
          reset ($workweeks);
          $id = -1;  // -1 indicates no match was found

          // loop through the workweeks that already exist
          foreach($workweeks AS $workweek) {
              if (strcmp ($workweek->getText(),
                          (string)($xmlPossibleWorkweek->text)) == 0) {
                // if a matching workweek is found, exit with $id set
                $id = $workweek->getId();
                break;
              }
          }

          if ($id == -1) {
            // if a matching workweek wasn't found, create a new one
            $workweek = new Workweek();
            $workweek->setText((string)$xmlPossibleWorkweek->text);
            $entityManager->persist($workweek);
            echo $workweek->toString("<br>");
            $workweeks[count($workweeks)] = $workweek;
          }

          $career->assignPossibleWorkweek($workweek);
        } // end loop possible workweeks
      } // endif possible workweeks exist
      
    // career - salarys
      $xmlSalarys = $xmlCareer->salarys->children();
      // loop through salarys
      if ($xmlSalarys != "") {
        //reset ($xmlSalarys);
        $iSalary = 0;
        $cSalary = count($xmlSalarys);
        foreach ($xmlSalarys as $xmlSalary) {
          $iSalary++;
          if ($iSalary > $cSalary) { 
            break;
          }

          // create a salary object
          $salary = new Salary();

          // salary - footnote - only if there is one
            if ($xmlSalary->footnote != "") {
              $xmlFootnote = $xmlSalary->footnote;
              $footnote = NULL;
              reset ($footnotes);
              foreach ($footnotes as $tempFootnote) {
                if (strcmp ($tempFootnote->getText(),
                            (string) $xmlFootnote->text) == 0) {
                  $footnote = $tempFootnote;
                  break;
                }
              }

              // no footnote found in the career, so make a new one
              if (is_null($footnote)) {
                  $footnote = new Footnote();
                  $footnote->setText((string)$xmlFootnote->text);
                  $footnotes[count($footnotes)] = $footnote;
              }

              $salary->setFootnote($footnote);
            }

          // salary - hourly, yearly
            $salary->setHourlyLow((float)$xmlSalary->hourly_low);
            $salary->setHourlyHigh((float)$xmlSalary->hourly_high);
            $salary->setYearlyLow((int)$xmlSalary->yearly_low);
            $salary->setYearlyHigh((int)$xmlSalary->yearly_high);

          // salary - location
            // You want to see if there is already a location object for the one used
            // and then use that one if it exists.
            reset ($locations);
            $id = -1; // -1 indicates matching location not found

            // loop through the locations that already exist
            foreach ($locations as $location) {
              if (strcmp ($location->getText(),
                          (string) ($xmlSalary->location->text)) == 0) {
                // if there's a match, exit with $id set
                $id = $location->getId();
                break;
              }
            }

            if ($id == -1) {
              // if a matching location wasn't found, create a new one
              $location = new Location();
              $location->setText((string) ($xmlSalary->location->text));
              $entityManager->persist($location);
              $locations[count($locations)] = $location;
            }

            $salary->setLocation($location);
          // persist and assign the salary
          $entityManager->persist($salary);
          echo $salary->toString("<br>");
          $career->assignSalary($salary);
          } // end salary
      }//endif salary exists

    // This is the end of the parsing for the career.  There is an array of
    // footnotes that were collected.  This part assigns a symbol to the footnote.
    // One footnote may be used in multiple places on the page
    $symbol = 1;
    reset ($footnotes);
    for ($iFootnote = 0; $iFootnote < count($footnotes); $iFootnote++) {
      $footnote = $footnotes[$iFootnote];
      $footnote->setSymbol((string)$symbol);
      $entityManager->persist($footnote);
      $career->assignFootnote($footnote);
      $symbol++;
  }
  
  echo $career->toString("<br>");
  $entityManager->persist($career);
  $entityManager->flush();
    
//    print_r($xml);
} else {
    exit('Failed to open' . $filename);
}

function get_bool($value){
    switch( strtolower($value) ){
        case 'true': return true;
        case 'false': return false;
        default: return NULL;
    }
}

function get_effectives ($xmlEffectives, $footnotes) {
  $effectives = NULL;
  
  if ($xmlEffectives != "") {
  // loop through effectives
    $effectives = new ArrayCollection();

    $iEffective = 0;
    $cEffective = count($xmlEffectives);
    foreach ($xmlEffectives as $xmlEffective) {
      $iEffective++;
      if ($iEffective > $cEffective) {
        break;
      }
      $effective = new Effective();
      // effective - footnote - only if there is one
        if ($xmlEffective->footnote != "") {
          $xmlFootnote = $xmlEffective->footnote;
          $footnote = NULL;
          reset ($footnotes);
          foreach ($footnotes as $tempFootnote) {
            if (strcmp ($tempFootnote->getText(),
                        (string) $xmlFootnote->text) == 0) {
              $footnote = $tempFootnote;
              break;
            }
          }

          // no footnote found in the career, so make a new one
          if (is_null($footnote)) {
              $footnote = new Footnote();
              $footnote->setText((string)$xmlFootnote->text);
              $footnotes[count($footnotes)] = $footnote;
          }

          $effective->setFootnote($footnote);
        }

      // effective - measure, percentage
        $effective->setMeasure((string)$xmlEffective->measure);
        $effective->setPercentage((float)$xmlEffective->percentage);
        
        $effectives[count($effectives)] = $effective;
        echo $effective->toString("<br>");
    } // end effective loop
  } // end if there is an effective

  return $effectives;
}
?>
