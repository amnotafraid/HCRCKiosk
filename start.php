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
	<title>Start HCRC Kiosk</title>
	<link rel="stylesheet" type="text/css" href="css/reset.css" />
	<link rel="stylesheet" type="text/css" href="css/style.css" />
	<link rel="stylesheet" type="text/css" href="css/media-queries.css" />
   <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>
   <script type='text/javascript' src='js/jquery.easing.1.2.js'></script>
   <script type='text/javascript' src='js/jquery.circulate.js'></script>
   <script type='text/javascript' src='js/start.circulate.js'></script>
   <script type="text/javascript">//<![CDATA[
        $(document).ready(function() {
            startA();
            setTimeout(startB, 2000);
            setTimeout(startC, 4000);
            setTimeout(startD, 6000);
            setTimeout(startE, 8000);
            setTimeout(startF, 10000);
            setTimeout(startG, 12000);
        });
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
        .startbutton, .startbutton:active
        {
                filter: progid:DXImageTransform.Microsoft.gradient(enabled = false);
                background-image: url(images/gradients.svg);
                background-size: 100% 1100%;
                zoom: 1;
        }
</style>
<![endif]-->
</head>

<body>

  <div class="dark-background">
   <!--[if IE]>
   <div id="IEroot">
   <![endif]-->

    <div id="swirl-wrap">
	
        <div id="sphere-area">
            <img src="images/MRI.jpg" id="image-a" />
            <img src="images/Echocardiology.jpg" id="image-b" />
            <img src="images/Cardiovascular.jpg" id="image-c" />
            <img src="images/Biotechnology.jpg" id="image-d" />
            <img src="images/Paramedic.jpg" id="image-e" />
            <img src="images/Management.jpg" id="image-f" />
            <img src="images/MedicalAssisting.jpg" id="image-g" />
        </div>

    </div>

    <h5 class="center"><span></span>Touch here to find out more about health careers</h5>
   
    <div class="startbuttonbox">
        <a href="index.php" class="startbutton">Start</a>
    </div>
   
	
   <!--[if IE]>
   </div>
   <![endif]-->	
  </div>
</body>
</html>