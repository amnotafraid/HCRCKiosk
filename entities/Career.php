<?php
// entities/Career.php
use Doctrine\Common\Collections\ArrayCollection;

class Career
{
  protected $id;

  // variables
  protected $career_name;               // Name of career (Nursing)
  protected $practicer_name;            // Name of a person in the career (Nurse)
  protected $typical_workweek;          // what the normal workweek is like
  
  // true/false
  protected $administrative;            // true/false administrative career
  protected $clinical;                  // true/false clinical career
  protected $diagnostic;                // true/false diagnostic career

  // collections - all collections have plural names, which may be mispelled
  // (ie dutys instead of duty) to aid in search and replace when the getters and setters
  // are set up.
  protected $certificates = null;       // certificates offered in this career
  protected $dutys = null;              // info about what the person does
  protected $footnotes = null;          // footnotes about this career
  protected $growths = null;            // how much the career is growing in different locations
  protected $medias = null;             // media (pictures, videos) that go with this career
  protected $more_infos = null;         // miscellaneous information about this career
  protected $outlooks = null;           // info about prospects in this field
  protected $possible_workweeks = null; // possible workweeks
  protected $salarys = null;            // how much you can make in different locations
  
  
  public function getId() { return $this->id; }

  // $career_name;               // Name of career (Nursing)
  public function getCareerName() { return $this->career_name; }
  public function setCareerName($career_name) { $this->career_name = $career_name; }

  // $practicer_name;          // Name of a person in the career (Nurse)
  public function getPracticerName() { return $this->practicer_name; }
  public function setPracticerName($practicer_name) { $this->practicer_name = $practicer_name; }

  // $typical_workweek;          // what the normal workweek is like
  public function getTypicalWorkweek() { return $this->typical_workweek; }
  public function setTypicalWorkweek($typical_workweek) { $this->typical_workweek = $typical_workweek; }

  // $administrative;            // true/false administrative career
  public function getAdministrative () { return $this->administrative; }
  public function setAdministrative ($administrative) { if (!is_bool($administrative)) { throw new Exception("Invalid administrative"); } $this->administrative = $administrative; }
  
  // $clinical;                  // true/false clinical career
  public function getClinical () { return $this->clinical; }
  public function setClinical ($clinical) { if (!is_bool($clinical)) { throw new Exception("Invalid clinical"); } $this->clinical = $clinical; }
  
  // $diagnostic;                // true/false diagnostic career
  public function getDiagnostic () { return $this->clinical; }
  public function setDiagnostic ($diagnostic) { if (!is_bool($diagnostic)) { throw new Exception("Invalid diagnostic"); } $this->diagnostic = $diagnostic; }
  
  public function __construct()
  {
    $this->certificates = new ArrayCollection();
    $this->dutys = new ArrayCollection();
    $this->footnotes = new ArrayCollection();
    $this->growths = new ArrayCollection();
    $this->medias = new ArrayCollection();
    $this->more_infos = new ArrayCollection();
    $this->outlooks = new ArrayCollection();
    $this->possible_workweeks = new ArrayCollection();
    $this->salarys = new ArrayCollection();
  }
  
  // $certificates = null;       // certificates offered in this career
  public function assignCertificate($certificate) { $this->certificates[] = $certificate; }
  public function getCertificates() { return $this->certificates; }

  // $duties = null;             // info about what the person does
  public function assignDuty($duty) { $this->dutys[] = $duty; }
  public function getDutys() { return $this->dutys; }

  // $footnotes = null;          // footnotes about this career
  public function assignFootnote($footnote) { $this->footnotes[] = $footnote; }
  public function getFootnotes() { return $this->footnotes; }

  // $growths = null;            // how much the career is growing in different locations
  public function assignGrowth($growth) { $this->growths[] = $growth; }
  public function getGrowths() { return $this->growths; }

  // $medias = null;             // media (pictures, videos) that go with this career
  public function assignMedia($media) { $this->medias[] = $media; }
  public function getMedias() { return $this->medias; }

  // $more_infos = null;         // miscellaneous information about this career
  public function assignMoreInfo($more_info) { $this->more_infos[] = $more_info; }
  public function getMoreInfos() { return $this->more_infos; }

  // $outlooks = null;           // info about prospects in this field
  public function assignOutlook($outlook) { $this->outlooks[] = $outlook; }
  public function getOutlooks() { return $this->outlooks; }

  // $possible_workweeks = null; // possible workweeks
  public function assignPossibleWorkweek($possible_workweek) { $this->possible_workweeks[] = $possible_workweek; }
  public function getPossibleWorkweeks() { return $this->possible_workweeks; }

  // $salarys = null;           // how much you can make in different locations
  public function assignSalary($salary) { $this->salarys[] = $salary; }
  public function getSalarys() { return $this->salarys; }

  public function toString($line_break) {
    $str = "CAREER" . $line_break .
           "career_name = " . $this->career_name . $line_break .
           "practicer_name = " . $this->practicer_name . $line_break .
           "administrative = " . strval($this->administrative) . $line_break .
           "clinical = " . strval ($this->clinical) . $line_break .
           "diagnostic = " . strval ($this->diagnostic) . $line_break;

    if (isset($this->typical_workweek)) {
      $str .= "typical workweek = " . $this->getTypicalWorkweek()->toString($line_break);
    }

    $str .= "possible_workweeks = ";
    foreach ($this->getPossibleWorkweeks() as $workweek) {
      $str .= "  " . $workweek->toString($line_break) . ",";
    }
    
    return $str;
  }

}