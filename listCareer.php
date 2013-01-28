<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<!--
Project:        Kiosk website
Organization:   Dallas County Community College District
                Health Careers Resource Center
Author:         amnotafraid
Published on:   
-->
<?php
if (session_id() == '') {
  session_start(); // start up your PHP session! 
}
?>
<head>  
	<meta charset="utf-8" />
	<title>Career List</title>
	<link rel="stylesheet" type="text/css" href="css/reset.css" />
	<link rel="stylesheet" type="text/css" href="css/style.css" />
	<link rel="stylesheet" type="text/css" href="css/media-queries.css" />
	
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
	<link href='http://fonts.googleapis.com/css?family=Droid+Serif:700,400,400italic,700italic' rel='stylesheet' type='text/css'>
   <link href='http://fonts.googleapis.com/css?family=Droid+Sans:700,400,400italic,700italic' rel='stylesheet' type='text/css'>
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
        var headerHeight = $("header").height();
        var footerHeight = $("footer").height();
        var areaHeight = contentHeight
                         - headerHeight
                         - footerHeight;

        // To accommodate content, the wrapper may be taller.
        // We set the minimum height.
        var wrapperMinHeight = Math.min(1024, areaHeight * 0.9);
        var wrapperTopMargin = ((areaHeight - wrapperMinHeight) / 2) + headerHeight;

        // div#wrapper set margin-top and height
        // width is taken care of by width:90% in stylesheet
        $('div#wrapper').css({
          "margin-top" : wrapperTopMargin,
          "min-height" : wrapperMinHeight
        });

        var mainContentMinHeight = wrapperMinHeight
                                - $("header").height()
                                - $("footer").height();
                              
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
<!--
    For help with this code, please see:
    http://abouthalf.com/2010/10/25/internet-explorer-9-gradients-with-rounded-corners/
    This assists in creating a button with rounded corners and filled by a gradient
    in IE9

    Below, if this is IE9, then clear the background filter and replace with
    the gradient.svg

-->
<!--[if  ie 9]>
<style type="text/css" media="screen">
        .mainbutton, .mainbutton:active, .bignavbutton, .bignavbutton:active
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
  <div class="dark-background">
   <!--[if IE]>
   <div id="IEroot">
   <![endif]-->
      <?php
      // List the careers and give a link
      require_once "bootstrap.php";
      $credit = $_GET['credit'];
      // if $credit = no, then get non-credit careers
      $continuing_education_value = FALSE;
      if (strcasecmp($credit, 'no') == 0) {
        $continuing_education_value = TRUE;
      }
      // hdr_str is passed in a URL parameter
      $hdr_str = $_GET['hdr_str'];
      ?>
   
    <header>
        <h1 class="shadow_text"><?php echo $hdr_str;?></h1>
    </header>
				
	<div id="wrapper">
      <?php
      $query = $entityManager->createQuery(
          'SELECT c FROM Career c 
            WHERE c.continuing_education = :continuing_education_value
            ORDER BY c.career_name ASC');

      $query->setParameter('continuing_education_value', $continuing_education_value);
      $careers = $query->getResult();
      $count = count($careers);
      $index_array = array();

      for ($i = 0; $i < $count; $i++) {
        $career = $careers[$i];
        $index_array[$i] = $career->getId();
        $href = "showCareer.php?index=".$i."&i_count=".$count."&credit=".$credit."&hdr_str=".$hdr_str;
        ?>
        <div class="mainbuttonbox">
            <a href="<?echo $href?>" class="mainbutton"><?echo $career->getCareerName()?></a>
        </div>
        <?  
      }
      if(isset($_SESSION['index_array'])) {
          unset($_SESSION['index_array']);
      }
      $_SESSION['index_array'] = $index_array;
      ?>
      <!--<div class="clearfix"></div-->
	</div> <!-- END Wrapper -->
   
   <footer>
      <div class="bignavbuttonbox">
          <a href="switchboard.php" class="bignavbutton">Home</a>
      </div>
      <p>Copyright &copy; <? print(Date("Y")); ?> Health Careers Resource Center | DCCCD</p>
   </footer>		
   <!--[if IE]>
   </div>
   <![endif]-->	
</div>
</body>
</html>