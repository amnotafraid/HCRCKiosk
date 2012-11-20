<?php
// entities/Footnote.php

/* 
 * This class is to store sources of information.  It consists of a symbol and some
 * text.  The symbol has to be managed by the career, which 'knows' how many footnotes
 * it has.  The procedure would be to create a footnote, set the text, ask the career
 * what symbol it should have, store it with the Effective, Salary, or Growth, and then
 * add it to the collection of footnotes on the career.
 */
class Footnote
{
  protected $id;

  // variables
  protected $symbol;            // the symbol that marks the statistic
  protected $text;              // the source of the information
  
  public function getId() { return $this->id; }
  
  // $symbol;            // the symbol that marks the statistic
  public function getSymbol() { return $this->symbol; }
  public function setSymbol($symbol) { $this->symbol = $symbol; }

  // $text;              // the source of the information
  public function getText() { return $this->text; }
  public function setText($text) { $this->text = $text; }

  public function toString($line_break) {
    $str = "FOOTNOTE" . $line_break
           . $this->symbol
           . " " . $this->text . $line_break;
    return $str;
  }

}