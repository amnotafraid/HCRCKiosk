<?php
// bootstrap.php

require_once 'entities/Career.php';
require_once 'entities/Certificate.php';
require_once 'entities/College.php';
require_once 'entities/Effective.php';
require_once 'entities/Footnote.php';
require_once 'entities/Growth.php';
require_once 'entities/Info.php';
require_once 'entities/Location.php';
require_once 'entities/Media.php';
require_once 'entities/Salary.php';
require_once 'entities/Workweek.php';

if (!class_exists("Doctrine\Common\Version", false))
{
  require_once "bootstrap_doctrine.php";
}

?>
