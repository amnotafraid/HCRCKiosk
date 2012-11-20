<?php
// entities/Growth.php

class Growth
{
  protected $id;

  // variables
  protected $footnote;       // where the information came from
  protected $location;
  protected $percentage_high;// the jobs for this career will grow by this percentage (high range)
  protected $percentage_low; // the jobs for this career will grow by this percentabe (low range)
  protected $through_year;   // through this year
  
  public function getId() { return $this->id; }
  
  // $footnote;       // where the information came from
  public function getFootnote() { return $this->footnote; }
  public function setFootnote($footnote) { $this->footnote = $footnote; }
  
  // $location;
  public function getLocation() { return $this->location; }
  public function setLocation ($location) { $this->location = $location; }

  // $percentage_high;// the jobs for this certificate will grow by this percentage
  public function getPercentageHigh() { return $this->percentage_high; }
  public function setPercentageHigh ($percentage_high) { $this->percentage_high = $percentage_high; }

  // $percentage_low; // the jobs for this certificate will grow by this percentage
  public function getPercentageLow() { return $this->percentage_low; }
  public function setPercentageLow ($percentage_low) { $this->percentage_low = $percentage_low; }

  // $through_year;   // through this year
  public function getThroughYear() { return $this->through_year; }
  public function setThroughYear ($through_year) { $this->through_year = $through_year; }

  public function toString($line_break) {
    $str = "GROWTH" . $line_break
           . "location = " . $this->location->toString($line_break)
           . "percentage_low = " . $this->percentage_low . $line_break
           . "percentage_high = " . $this->percentage_high . $line_break
           . "through_year = " . $this->through_year . $line_break
           . $this->footnote->toString($line_break);

    return $str;
  }

}