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
        .mainbutton, .mainbutton:active
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
   
    <header>
        <h1 class="shadow_text">Health Careers</h1>
    </header>
				
	<div id="wrapper">
      <!-- <div class="prop"></div> this is to set a minimum height -->
      <?php
      // List the careers and give a link
      require_once "bootstrap.php";

      $query = $entityManager->createQuery('SELECT c FROM Career c');
      $careers = $query->getResult();
      $count = count($careers);

      for ($i = 0; $i < $count; $i++) {
        $career = $careers[$i];
        $href = "showCareer.php?id=".$career->getId()."&max_id=".$count;
        ?>
        <div class="mainbuttonbox">
            <a href="<?echo $href?>" class="mainbutton"><?echo $career->getCareerName()?></a>
        </div>
        <?  
      }
      ?>
      <!--<div class="clearfix"></div-->
	</div> <!-- END Wrapper -->
   
   <footer>
       <p>Copyright &copy; <? print(Date("Y")); ?> Health Careers Resource Center | DCCCD</p>
   </footer>		
   <!--[if IE]>
   </div>
   <![endif]-->	
</div>
</body>
</html>