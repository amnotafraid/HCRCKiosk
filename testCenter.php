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
	<!--<link rel="stylesheet" type="text/css" href="css/reset.css" />-->
	<link rel="stylesheet" type="text/css" href="css/testStyle.css" />
	<!--<link rel="stylesheet" type="text/css" href="css/media-queries.css" />-->
	
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
        return;
        // calculate wrapper height and top-margin
        var contentHeight = getViewportHeight();
        alert("contentHeight = " + contentHeight);
        // To accommodate content, the wrapper may be taller.
        // We set the minimum height.
        var wrapperMinHeight = Math.min(1024, contentHeight * 0.9);
        alert("wrapperMinHeight = " + wrapperMinHeight);
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
</head>

<body id="home">
	<div id="wrapper">
		
		<header>
			<h1 class="center">Health Careers</h1>
		</header>
				
      <hr/>
		<div id="main-content">
         <div class="prop"></div> <!-- this is to set a minimum height -->
         <div class="clearfix"></div>
		</div>
		<hr/>
		<footer>
			<p class="center">&copy; 2012 - Dallas County Community College District</p>
		</footer>		
		
	</div> <!-- END Wrapper -->
	
</body>
</html>