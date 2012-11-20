<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<!--
Project:        Kiosk website
Organization:   Dallas County Community College District
                Health Careers Resource Center
Author:         amnotafraid
Published on:   
-->
<head>  
	<meta charset="utf-8" />
	<title>Career Details</title>
	<link rel="stylesheet" type="text/css" href="css/reset.css" />
	<link rel="stylesheet" type="text/css" href="css/style.css" />
	<link rel="stylesheet" type="text/css" href="css/media-queries.css" />
	
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
	<link href='http://fonts.googleapis.com/css?family=Droid+Serif:700,400,400italic,700italic' rel='stylesheet' type='text/css'>
   <link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
   <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>
   <script type="text/javascript" src="js/jquery.slidertron-1.1.js"></script>
   <script type="text/javascript">//<![CDATA[
      $(document).ready(function() {
        resizeWrapper();

        $(window).resize(function() {
          resizeWrapper();
        });
        
        });
        
      function resizeWrapper() {
        // calculate wrapper height and top-margin
        var contentHeight = getViewportHeight();
        // To accommodate content, the wrapper may be taller.
        // We set the minimum height.
        var wrapperMinHeight = Math.min(1024, contentHeight * 0.9);
        var wrapperTopMargin = (contentHeight - wrapperMinHeight) / 2;

        // div#wrapper set margin-top and height
        // width is taken care of by width:90% in stylesheet
        $('div#wrapper').css({
          "margin-top" : wrapperTopMargin,
          "min-height": wrapperMinHeight
        });

        var mainContentMinHeight = wrapperMinHeight
                                - $("header").height()
                                - $("footer").height();
                              
        $('div.prop').css({
          "min-height": mainContentMinHeight
        });
                         
      }

      function getViewportWidth() {
        if (window.innerWidth) {
          return window.innerWidth;
          }
        else if (document.body && document.body.offsetWidth) {
          return document.body.offsetWidth;
          }
        else {
          return 0;
          }
        }

      function getViewportHeight() {
        if (window.innerHeight) {
          return window.innerHeight;
        }
        else if (document.body && document.body.offsetHeight) {
          return document.body.offsetHeight;
        }
        else {
          return 0;
        }
      }
//]]></script>
<!--[if  ie 9]>
<style type="text/css" media="screen">
        .navbutton, .navbutton:active
        {
                filter: progid:DXImageTransform.Microsoft.gradient(enabled = false);
                background-image: url(images/gradients.svg);
                background-size: 100% 1100%;
                zoom: 1;
        }
</style>
<![endif]-->
</head>

<body id="home">
	<div id="wrapper">
   <?php
   // List the careers and give a link
   use Doctrine\Common\Collections\ArrayCollection;
   require_once "bootstrap.php";
   $id = $_GET['id'];
   $max_id = $_GET['max_id'];
      if ($id == $max_id) {
        $next = 1;
      } else {
        $next = $id + 1;
      }
      if ($id == 1) {
        $prev = $max_id;
      } else {
        $prev = $id - 1;
      }
   $career = $entityManager->find("Career", (int)$id);
   if (is_null($career)) {
     echo "Shriek!";
   } else {
     $popups = new ArrayCollection();
   ?>
		
		<header>
        <div id="header-left">
          <div class="navbuttonbox">
              <a href="index.php" class="navbutton">Main</a>
          </div>
        </div>
        <div id="header-center">
          <h1><?echo $career->getCareerName();?></h1>
        </div>
        <div id="header-right">
          <?
          $href_prev = "showCareer.php?id=".$prev."&max_id=".$max_id;
          $href_next = "showCareer.php?id=".$next."&max_id=".$max_id;
          ?>
          <div class="navbuttonbox">
            <a href="<?echo $href_prev?>" class="navbutton">Previous</a>
          </div>
          <div class="navbuttonbox">
            <a href="<?echo $href_next?>" class="navbutton">Next</a>
          </div>
        </div>
		</header>
				
		<div id="main-content">
			<hr/>
           <div class="prop"></div> <!-- this is to set a minimum height -->
           <section class="left-col">
              <h2>What does a <?echo $career->getPracticerName();?> do?</h2>
              <?php

              $dutys = $career->getDutys();

              echo "<ul>";
              foreach ($dutys AS $duty) {
                  echo "<li>".$duty->getText()."</li>";
              }
              echo "</ul>";
              ?>

              <h2>What is the career outlook?</h2>
              <?php

              $outlooks = $career->getOutlooks();

              echo "<ul>";
              foreach ($outlooks AS $outlook) {
                echo "<li>".$outlook->getText()."</li>";
              }
              echo "</ul>";
              ?>

              <?php

              $certificates = $career->getCertificates();
              $effectives = new ArrayCollection();
              $columns = array (    /* count for how many check marks in each column */
                  "Brookhaven" => 0,
                  "Cedar Valley" => 0,
                  "Eastfield" => 0,
                  "El Centro" => 0,
                  "Mountain View" => 0,
                  "North Lake" => 0,
                  "Richland" => 0
                );

              // Create a query to get the colleges in order
              $queryBuilder = $entityManager->createQueryBuilder();
              $queryBuilder->add('select', 'c')
                           ->add('from', 'College c')
                           ->add('orderBy', 'c.name ASC');
              $query = $queryBuilder->getQuery();
              $colleges = $query->getResult();
              
              foreach ($certificates AS $certificate) {
                if ($certificate->getBrookhaven()) {
                  $columns["Brookhaven"]++;
                }
                if ($certificate->getCedarValley()) {
                  $columns["Cedar Valley"]++;
                }
                if ($certificate->getEastfield()) {
                  $columns["Eastfield"]++;
                }
                if ($certificate->getElCentro()) {
                  $columns["El Centro"]++;
                }
                if ($certificate->getMountainView()) {
                  $columns["Mountain View"]++;
                }
                if ($certificate->getNorthLake()) {
                  $columns["North Lake"]++;
                }
                if ($certificate->getRichland()) {
                  $columns["Richland"]++;
                }
              }
              reset($certificates);
              
              echo "<table>";
              echo "<caption>Certificates</caption>";
              echo "<tr>";
              echo "<th>Awards and Coursework</th>";
              foreach ($columns as $key=>$value) {
                  if ($value > 0) {
                    echo "<th>".$key."</th>";
                  }
                }
              reset($columns);
              
              echo "<th>Credit hours</th>";
              echo "<th>Continuing Education contact hours</th>";
              echo "</tr>";
              
              foreach ($certificates AS $certificate) {
                echo "<tr>";
                echo "<td>".$certificate->getName()."</td>";
                if ($columns["Brookhaven"] > 0) {
                  echo "<td>";
                  if ($certificate->getBrookhaven()) {
                    echo "<span class=\"icon green\">Q</span>";
                    generate_popop ($certificate->getBrookhavenEffectives(), $popups, "Brookhaven");
                  }
                  echo "</td>";
                }
                if ($columns["Cedar Valley"] > 0) {
                  echo "<td>";
                  if ($certificate->getCedarValley()) {
                      echo "<span class=\"icon green\">Q</span>";
                      generate_popop ($certificate->getCedarValleyEffectives(), $popups, "Cedar Valley");
                  }
                  echo "</td>";
                }
                if ($columns["Eastfield"] > 0) {
                  echo "<td>";
                  if ($certificate->getEastfield()) {
                    echo "<span class=\"icon green\">Q</span>";
                    generate_popop ($certificate->getEastfieldEffectives(), $popups, "Eastfield");
                  }
                  echo "</td>";
                }
                if ($columns["El Centro"] > 0) {
                  echo "<td>";
                  if ($certificate->getElCentro()) {
                    echo "<span class=\"icon green\">Q</span>";
                    generate_popop ($certificate->getElCentroEffectives(), $popups, "El Centro");
                  }
                  echo "</td>";
                }
                if ($columns["Mountain View"] > 0) {
                  echo "<td>";
                  if ($certificate->getMountainView()) {
                    echo "<span class=\"icon green\">Q</span>";
                    generate_popop ($certificate->getMountainViewEffectives(), $popups, "Mountain View");
                  }
                  echo "</td>";
                }
                if ($columns["North Lake"]) {
                  echo "<td>";
                  if ($certificate->getNorthLake()) {
                    echo "<span class=\"icon green\">Q</span>";
                    generate_popop ($certificate->getNorthLakeEffectives(), $popups, "North Lake");
                  }
                  echo "</td>";
                }
                if ($columns["Richland"]) {
                  echo "<td>";
                  if ($certificate->getRichland()) {
                    echo "<span class=\"icon green\">Q</span>";
                    generate_popop ($certificate->getRichlandEffectives(), $popups, "Richland");
                  }
                  echo "</td>";
                }
                echo "<td>".$certificate->getCreditHours()."</td>";
                echo "<td>".$certificate->getContinuingEducationHours()."</td>";
                echo "</tr>";
              
              }
              echo "</table>";

              if (count($popups) > 0) {
                echo "<h2>Measures of Effectiveness</h2>";
                foreach ($popups AS $popup) {
                  echo $popup;
                }
              }
              ?>
              <h2>What more do I need to know?</h2>
              <?php

              $more_infos = $career->getMoreInfos();

              echo "<ul>";
              foreach ($more_infos AS $more_info) {
                  echo "<li>".$more_info->getText()."</li>";
              }
              echo "</ul>";
              ?>
            </section> <!--END Left Column-->
            <aside class="sidebar">
            <?php
            
            $medias = $career->getMedias();

            foreach ($medias AS $media) {
              if (strcmp($media->getCorner(), 'upper_right') == 0
                  && strcmp($media->getType(), 'image') == 0) {
                  echo "<img src=\"".$media->getPath().
                       "\" width=\"".$media->getWidth().
                       "\" height=\"".$media->getHeight().
                       "\" alt=\"".$media->getAltText().
                       "\" title=\"".$media->getAltText()."\">"; 
              }
            }

            $growths = $career->getGrowths();
            if (count($growths) > 0) {
              echo "<h2>Growth</h2>";

              foreach ($growths AS $growth) {
                echo "<p class=\"underscore\">".$growth->getLocation()->getText();
                $footnote = $growth->getFootnote();
                if (!is_null($footnote)) {
                  echo generate_footnote_symbol($footnote);
                }
                echo "</p>";
                if ($growth->getPercentageLow() == $growth->getPercentageHigh()) {
                  $growth_percentage = $growth->getPercentageLow()."%";
                } else {
                  $growth_percentage = $growth->getPercentageLow()."-".$growth->getPercentageHigh()."%";
                }
                echo "<p>".$growth_percentage." through ".$growth->getThroughYear()."</p>";
              }
            }
            
            $salarys = $career->getSalarys();
            if (count($salarys) > 0) {
              echo "<h2>Salary</h2>";
              
              foreach ($salarys AS $salary) {
                echo "<p class=\"underscore\">".$salary->getLocation()->getText();
                $footnote = $salary->getFootnote();
                if (!is_null($footnote)) {
                  echo generate_footnote_symbol($footnote);
                }
                echo "</p>";
                if ($salary->getHourlyLow() == $salary->getHourlyHigh()) {
                  $hourly_wage = sprintf("%01.2f", $salary->getHourlyLow());
                } else {
                  $hourly_wage = sprintf("%01.2f - %01.2f", $salary->getHourlyLow(), $salary->getHourlyHigh());
                }
                if ($salary->getYearlyLow() == $salary->getYearlyHigh()) {
                  $yearly_wage = number_format($salary->getYearlyLow());
                } else {
                  $yearly_wage = number_format($salary->getYearlyLow())." - ".number_format($salary->getYearlyHigh());
                }
                
                echo "<p>Hourly: $".$hourly_wage."</p>";
                echo "<p>Yearly: $".$yearly_wage."</p>";
              }
            }

            if ($career->getTypicalWorkweek() != ""
                && count($career->getPossibleWorkweeks()) != 0) {
                echo "<h2>Work schedule</h2>";
                
                if ($career->getTypicalWorkweek() != "") {
                  echo "<p class=\"underscore\">Typical Workweek</p>";
                  echo "<p>".$career->getTypicalWorkweek()->getText()."</p>";
                  echo "<br>";
                  }
                  
                if (count($career->getPossibleWorkweeks()) != 0) {
                  echo "<p class=\"underscore\">Possible</p>";
                  foreach ($career->getPossibleWorkweeks() AS $workweek) {
                    echo "<p>".$workweek->getText()."</p>";
                    }
                  }
                }
            ?>
            </aside>
         <div class="clearfix">
           <?
           foreach($career->getFootnotes() AS $footnote) {
             echo "<p>";
             echo generate_footnote_symbol($footnote);
             echo $footnote->getText()."</p>";
           }
           ?>
         </div>
		</div>
		<hr/>
		<footer>
			<p>Copyright &copy; 2012 Health Careers Resource Center | DCCCD</p>
		</footer>		
		<?
       }
      function generate_footnote_symbol($footnote){
          switch( $footnote->getSymbol() ){
              case '1':
              {
                return "<span class=\"icon red\">J</span>";
              }
              case '2':
              {
                return "<span class=\"icon blue\">J</span>";
              }
              default:
              {
                return "<span class=\"icon green\">J</span>";
              }
          }
      }
      function generate_popop ($effectives, $popups, $college) {
        if (count($effectives) == 0) {
          return;
        } else {
          $str  = "<div id=\"popup".(count($popups) + 1)."\">";
          $str .= "<table>";
          $str .= "<tr>";
          $str .= "<th>Measures of Effectiveness</th>";
          $str .= "<th>".$college."</th>";
          $str .= "</tr>";
          foreach ($effectives AS $effective) {
            $str .= "<tr>";
            $str .= "<td>".$effective->getMeasure();
            $footnote = $effective->getFootnote();
            if (!is_null($footnote)) {
              $str .= generate_footnote_symbol($footnote);
            }
            $str .= "</td><td>";
            $str .= $effective->getPercentage()."%";
            $str .= "</td>";
          }
          $str .= "</table>";
          $str .= "</div>";
          
          $popups[count($popups)] = $str;
        }
      }
     ?>
	</div> <!-- END Wrapper -->
	
</body>
</html>
