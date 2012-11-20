<?php
// entities/Workweek.php

/*
 * This class is to show a kind of workweek -- part time, shift work, etc.
 */

class Workweek
{
  protected $id;

  // variables
  protected $text;           // this is the workweek description
  
  public function getId() { return $this->id; }
  
  // $text;       // this is the workweek description
  public function getText() { return $this->text; }
  public function setText($text) { $this->text = $text; }
  
  public function toString($line_break) {
    $str = "WORKWEEK" . $line_break . $this->text . $line_break;

    return $str;
  }

}