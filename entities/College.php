<?php
// entities/College.php
use Doctrine\Common\Collections\ArrayCollection;

class College
{
  protected $id;

  // variables
  protected $name;
  // a college has certificates and a certificate has colleges,
  // but the college is the owning side

  // collections - all collections have plural names, which may be mispelled
  // (ie dutys instead of duty) to aid in search and replace when the getters and setters
  // are set up.
  protected $certificates = null;
  
  public function getId() { return $this->id; }
  
  // $name;
  public function getName() { return $this->name; }
  public function setName($name) { $this->name = $name; }

  public function __construct()
  {
    $this->certificates = new ArrayCollection();
  }
  
  // $certificates = null;
  public function assignCertificate($certificate) { $certificate->assignCollege($this); $this->certificates[] = $certificate; }
  public function getCertificates() { return $this->certificates; }

  public function toString($line_break) {
    $str = "COLLEGE" . $line_break .
           "name = " . $this->name;

    $str .= ", certificates =";
    foreach ($this->getCertificates() as $certificate) {
      $str .= "  " . $certificate->getName() . ",";
    }
    
    $str .= $line_break;
    return $str;
  }

}