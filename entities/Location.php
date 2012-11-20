<?php
// entities/Location.php

/*
 * This entity is to create a set of locations for Growth and Salary entities.
 * The locations might be 'Texas', 'Dallas County', 'United States'
 */

class Location
{
  protected $id;

  // variables
  protected $text;
  
  public function getId() { return $this->id; }
  
  // $text;       // where the information came from
  public function getText() { return $this->text; }
  public function setText($text) { $this->text = $text; }
  
  public function toString($line_break) {
    $str = "LOCATION" . $line_break
           . $this->text . $line_break;

    return $str;
  }

}