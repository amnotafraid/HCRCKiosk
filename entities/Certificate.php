<?php
// entities/Certificate.php
use Doctrine\Common\Collections\ArrayCollection;

class Certificate
{
  protected $id;

  // variables
  protected $continuing_education_hours;  // string - ""/"varies"/"###" if "" then this is credit hours
  protected $credit_hours;                // string - ""/"##-##" if "" then this is continuing education
  protected $name;                        // name of the certificate
  
  // true/false
  protected $brookhaven;                  // true - this certificate offered at Brookhaven
  protected $cedar_valley;                // true - this certificate offered at Cedar Valley
  protected $eastfield;                   // true - this certificate offered at Eastfield
  protected $el_centro;                   // true - this certificate offered at El Centro
  protected $mountain_view;               // true - this certificate offered at Mountain View
  protected $north_lake;                  // true - this certificate offered at North Lake
  protected $richland;                    // true - this certificate offered at Richland

  // collections
  protected $brookhaven_effectives = null;// effectiveness measures
  protected $cedar_valley_effectives = null;// effectiveness measures
  protected $eastfield_effectives = null; // effectiveness measures
  protected $el_centro_effectives = null; // effectiveness measures
  protected $mountain_view_effectives = null;// effectiveness measures
  protected $north_lake_effectives = null;  // effectiveness measures
  protected $richland_effectives = null;  // effectiveness measures
  
  public function getId() { return $this->id; }

  // $name;                        // name of the certificate
  public function getName() { return $this->name; }
  public function setName($name) { $this->name = $name; }

  // $continuing_education_hours;  // string - ""/"varies"/"###" if "" then this is credit hours
  public function getContinuingEducationHours() { return $this->continuing_education_hours; }
  public function setContinuingEducationHours($continuing_education_hours) { $this->continuing_education_hours = $continuing_education_hours; }

  // $credit_hours;                // string - ""/"##-##" if "" then this is continuing education
  public function getCreditHours() { return $this->credit_hours; }
  public function setCreditHours($credit_hours) { $this->credit_hours = $credit_hours; }

  // $brookhaven;                  // true - this certificate offered at Brookhaven
  public function getBrookhaven() { return $this->brookhaven; }
  public function setBrookhaven ($brookhaven) { if (!is_bool($brookhaven)) { throw new Exception("Invalid argument"); } $this->brookhaven = $brookhaven; }

  // $richland;                // true - this certificate offered at Cedar Valley
  public function getCedarValley() { return $this->cedar_valley; }
  public function setCedarValley ($cedar_valley) { if (!is_bool($cedar_valley)) { throw new Exception("Invalid argument"); } $this->cedar_valley = $cedar_valley; }

  // $eastfield;                   // true - this certificate offered at Eastfield
  public function getEastfield() { return $this->eastfield; }
  public function setEastfield ($eastfield) { if (!is_bool($eastfield)) { throw new Exception("Invalid argument"); } $this->eastfield = $eastfield; }

  // $el_centro;                   // true - this certificate offered at El Centro
  public function getElCentro() { return $this->el_centro; }
  public function setElCentro ($el_centro) { if (!is_bool($el_centro)) { throw new Exception("Invalid argument"); } $this->el_centro = $el_centro; }

  // $mountain_view;               // true - this certificate offered at Mountain View
  public function getMountainView() { return $this->mountain_view; }
  public function setMountainView ($mountain_view) { if (!is_bool($mountain_view)) { throw new Exception("Invalid argument"); } $this->mountain_view = $mountain_view; }

  // $north_lake;                  // true - this certificate offered at North Lake
  public function getNorthLake() { return $this->north_lake; }
  public function setNorthLake ($north_lake) { if (!is_bool($north_lake)) { throw new Exception("Invalid argument"); } $this->north_lake = $north_lake; }

  // $richland;                    // true - this certificate offered at Richland
  public function getRichland() { return $this->richland; }
  public function setRichland ($richland) { if (!is_bool($richland)) { throw new Exception("Invalid argument"); } $this->richland = $richland; }

  public function __construct()
  {
    $this->brookhaven_effectives = new ArrayCollection ();
    $this->cedar_valley_effectives = new ArrayCollection ();
    $this->eastfield_effectives = new ArrayCollection ();
    $this->el_centro_effectives = new ArrayCollection ();
    $this->mountain_view_effectives = new ArrayCollection ();
    $this->north_lake_effectives = new ArrayCollection ();
    $this->richland_effectives = new ArrayCollection ();
  }
  
  // $brookhaven_effectives = null;           // effectiveness measures
  public function assignBrookhavenEffective($brookhaven_effective) { $this->brookhaven_effectives[] = $brookhaven_effective; }
  public function getBrookhavenEffectives() { return $this->brookhaven_effectives; }

  // $richland_effectives = null;           // effectiveness measures
  public function assignCedarValleyEffective($cedar_valley_effective) { $this->cedar_valley_effectives[] = $cedar_valley_effective; }
  public function getCedarValleyEffectives() { return $this->cedar_valley_effectives; }

  // $eastfield_effectives = null;           // effectiveness measures
  public function assignEastfieldEffective($eastfield_effective) { $this->eastfield_effectives[] = $eastfield_effective; }
  public function getEastfieldEffectives() { return $this->eastfield_effectives; }

  // $el_centro_effectives = null;           // effectiveness measures
  public function assignElCentroEffective($el_centro_effective) { $this->el_centro_effectives[] = $el_centro_effective; }
  public function getElCentroEffectives() { return $this->el_centro_effectives; }

  // $mountain_view_effectives = null;           // effectiveness measures
  public function assignMountainViewEffective($mountain_view_effective) { $this->mountain_view_effectives[] = $mountain_view_effective; }
  public function getMountainViewEffectives() { return $this->mountain_view_effectives; }

  // $north_lake_effectives = null;           // effectiveness measures
  public function assignNorthLakeEffective($north_lake_effective) { $this->north_lake_effectives[] = $north_lake_effective; }
  public function getNorthLakeEffectives() { return $this->north_lake_effectives; }

  // $richland_effectives = null;           // effectiveness measures
  public function assignRichlandEffective($richland_effective) { $this->richland_effectives[] = $richland_effective; }
  public function getRichlandEffectives() { return $this->richland_effectives; }

  public function toString($line_break) {
    $str = "CERTIFICATE" . $line_break .
           "name = " . $this->name . $line_break;
    
    if (strlen($this->continuing_education_hours) != 0) {
      $str .= "continuing_education_hours = " . $this->continuing_education_hours . $line_break;
    } else {
      if (strlen($this->credit_hours) != 0) {
        $str .= "credit_hours = " . $this->credit_hours . $line_break;
      }
    }

    $str .= "brookhaven - ";
    if ($this->brookhaven) {
      $str .= "yes" . $line_break;
      if (count($this->brookhaven_effectives) > 0) {
        foreach ($this->brookhaven_effectives as $effective) {
          $str .= $effective->toString($line_break);
        }
      }
    } else {
      $str .= "no" . $line_break;
    }
    $str .= "cedar_valley - ";
    if ($this->cedar_valley) {
      $str .= "yes" . $line_break;
      if (count($this->cedar_valley_effectives) > 0) {
        foreach ($this->cedar_valley_effectives as $effective) {
          $str .= $effective->toString($line_break);
        }
      }
    } else {
      $str .= "no" . $line_break;
    }
    $str .= "eastfield - ";
    if ($this->eastfield) {
      $str .= "yes" . $line_break;
      if (count($this->eastfield_effectives) > 0) {
        foreach ($this->eastfield_effectives as $effective) {
          $str .= $effective->toString($line_break);
        }
      }
    } else {
      $str .= "no" . $line_break;
    }
    $str .= "el_centro - ";
    if ($this->el_centro) {
      $str .= "yes" . $line_break;
      if (count($this->el_centro_effectives) > 0) {
        foreach ($this->el_centro_effectives as $effective) {
          $str .= $effective->toString($line_break);
        }
      }
    } else {
      $str .= "no" . $line_break;
    }
    $str .= "mountain_view - ";
    if ($this->mountain_view) {
      $str .= "yes" . $line_break;
      if (count($this->mountain_view_effectives) > 0) {
        foreach ($this->mountain_view_effectives as $effective) {
          $str .= $effective->toString($line_break);
        }
      }
    } else {
      $str .= "no" . $line_break;
    }
    $str .= "north_lake - ";
    if ($this->north_lake) {
      $str .= "yes" . $line_break;
      if (count($this->north_lake_effectives) > 0) {
        foreach ($this->enorth_lake_effectives as $effective) {
          $str .= $effective->toString($line_break);
        }
      }
    } else {
      $str .= "no" . $line_break;
    }
    $str .= "richland - ";
    if ($this->richland) {
      $str .= "yes" . $line_break;
      if (count($this->richland_effectives) > 0) {
        foreach ($this->richland_effectives as $effective) {
          $str .= $effective->toString($line_break);
        }
      }
    } else {
      $str .= "no" . $line_break;
    }

    return $str;
  }

}