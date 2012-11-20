<?php
// entities/Salary.php
class Salary
{
  protected $id;

  // variables
  protected $footnote;      // where the information came from
  protected $hourly_high;   // earning per hour (high range)
  protected $hourly_low;    // earning per hour (low range)
  protected $location;
  protected $yearly_high;   // earning per year (high range)
  protected $yearly_low;    // earning per year (low range)
  
  public function getId() { return $this->id; }
  
  // $footnote;       // where the information came from
  public function getFootnote() { return $this->footnote; }
  public function setFootnote($footnote) { $this->footnote = $footnote; }
  
  // $hourly_high;   // earning per hour (high range)
  public function getHourlyHigh() { return $this->hourly_high; }
  public function setHourlyHigh($hourly_high) { $this->hourly_high = $hourly_high; }
  
  // $hourly_low;   // earning per hour (low_range)
  public function getHourlyLow() { return $this->hourly_low; }
  public function setHourlyLow($hourly_low) { $this->hourly_low = $hourly_low; }
  
  // $location;
  public function getLocation() { return $this->location; }
  public function setLocation ($location) { $this->location = $location; }

  // $yearly_high;   // earning per year (high range)
  public function getYearlyHigh() { return $this->yearly_high; }
  public function setYearlyHigh($yearly_high) { $this->yearly_high = $yearly_high; }
  
  // $yearly_low;   // earning per year (low range)
  public function getYearlyLow() { return $this->yearly_low; }
  public function setYearlyLow($yearly_low) { $this->yearly_low = $yearly_low; }
  
  public function toString($line_break) {
    $str =  "SALARY" . $line_break
            . "location = " . $this->location->getText() . $line_break
            . "hourly_low = " . $this->hourly_low . $line_break
            . "hourly_high = " . $this->hourly_high . $line_break
            . "yearly_low = " . $this->yearly_low . $line_break
            . "yearly_high = " . $this->yearly_high . $line_break
            . $this->footnote->toString($line_break) . $line_break;
    
    return $str;
  }

}