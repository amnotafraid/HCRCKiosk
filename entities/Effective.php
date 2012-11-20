<?php
// entities/Effective.php

/* 
 * This class is to store measures of effectiveness for a certificate at a certain college.
 * The measure might be something like 'Licensure exam pass rates for DCCCD students' or 
 * 'Employment rates for DCCCD graduates'.  Each measure of effectiveness should have a 
 * source, which is identified by footnote.  This entity has to be associated with a certificate
 * and a college.
 */
class Effective
{
  protected $id;

  // variables
  protected $footnote;          // source of statistic
  protected $measure;           // text for measure of effectiveness
  protected $percentage;        // value
  
  public function getId() { return $this->id; }
  
  // $footnote;          // source of statistic
  public function getFootnote() { return $this->footnote; }
  public function setFootnote($footnote) { $this->footnote = $footnote; }

  // $name;
  public function getMeasure() { return $this->measure; }
  public function setMeasure($measure) { $this->measure = $measure; }

  // $percentage;        // value
  public function getPercentage() { return $this->percentage; }
  public function setPercentage($percentage) { $this->percentage = $percentage; }

  
  public function toString($line_break) {
    $str = "EFFECTIVE" . $line_break
           . "measure = " . $this->measure . $line_break
           . "percentage = " . strval($this->percentage) . "%" . $line_break
           . "footnote = " . $this->footnote->toString($line_break) . $line_break;
    return $str;
  }

}