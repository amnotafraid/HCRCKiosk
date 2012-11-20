<?php
// entities/Info.php

/*
 * This class is just too simple!  Each instance is a bullet point.  The instances
 * are collected under duties, outlooks, more_infos in careers.
 */

class Info
{
  protected $id;

  // variables
  protected $text;           // this is the text in the bullet point
  
  public function getId() { return $this->id; }
  
  // $text;       // this is the text in the bullet point
  public function getText() { return $this->text; }
  public function setText($text) { $this->text = $text; }
  
  public function toString($line_break) {
    $str = "INFO" . $line_break
           . $this->text . $line_break;

    return $str;
  }

}