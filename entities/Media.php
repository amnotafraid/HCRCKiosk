<?php
// entities/Media.php

/*
 * This is to store a kind of media for a career page.  The $path is where the media is
 * relative to the root of the project, eg.  'images/slide05.jpg'.  You can also put
 * absolute paths in there, such as, http://wpc.2A70.edgecastcdn.net/002A70/CareerVideos/31-9092.00.flv
 * The type shows what kind of media you have.  For choices see comments in the code.
 * The corner shows which area you want the video to show in.  For choices, see comments
 * in the code.
 */

class Media
{
  protected $id;

  // variables
  protected $alt_text;          // alternate text alt=""
  protected $height;            // height in pixels to display
  protected $path;              // This is the relative or absolute path to the media
  protected $width;             // width in pixels to display

  // enums
  protected $corner;            // This is the corner that the video will be embedded in
  const CORNER_UPPER_LEFT = 'upper_left';
  const CORNER_UPPER_RIGHT = 'upper_right';
  const CORNER_LOWER_LEFT = 'lower_left';
  const CORNER_LOWER_RIGHT = 'lower_right';
  const CORNER_BACKGROUND = 'background'; // mis-nomer!  this is for the background
  const CORNER_THUMBNAIL = 'thumbnail'; // another mis-nomer -- this is a small image
  protected $type;              // This is the type of media this refers to
  const MEDIA_IMAGE = 'image';
  const MEDIA_FLASH_VIDEO = 'flash_video';
  
  
  public function getId() { return $this->id; }
  
  // $alt_text;          // alternate text alt=""
  public function getAltText() { return $this->alt_text; }
  public function setAltText($alt_text) { $this->alt_text = $alt_text; }
  
  // $height;            // height in pixels to display
  public function getHeight() { return $this->height; }
  public function setHeight($height) { $this->height = $height; }
  
  // $path;              // This is the relative or absolute path to the media
  public function getPath() { return $this->path; }
  public function setPath($path) { $this->path = $path; }
  
  // $width;             // width in pixels to display
  public function getWidth() { return $this->width; }
  public function setWidth($width) { $this->width = $width; }
  
  // $corner;            // This is the corner that the video will be embedded in
  public function getCorner() { return $this->corner; }
  public function setCorner($corner) { if (!in_array($corner, array(self::CORNER_UPPER_LEFT, self::CORNER_UPPER_RIGHT, self::CORNER_LOWER_LEFT, self::CORNER_LOWER_RIGHT, self::CORNER_BACKGROUND, self::CORNER_THUMBNAIL))) { throw new Exception("Invalid corner"); } $this->corner = $corner; }
  
  // $type;              // This is the type of media this refers to
  public function getType() { return $this->type; }
  public function setType($type) { if (!in_array($type, array(self::MEDIA_IMAGE, self::MEDIA_FLASH_VIDEO))) { throw new Exception("Invalid type"); } $this->type = $type; }

  public function toString($line_break) {
    $str = "MEDIA" . $line_break
           . "alt_text = " . $this->alt_text . $line_break
           . "height = " . $this->height . $line_break
           . "path = " . $this->path . $line_break
           . "width = " . $this->width . $line_break
           . "corner = " . $this->corner . $line_break
           . "type = " . $this->type . $line_break;

    return $str;
  }

}