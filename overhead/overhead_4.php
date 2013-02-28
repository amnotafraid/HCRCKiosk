<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<!--
Project:        Overhead kiosk website
Organization:   Dallas County Community College District
                Health Careers Resource Center
Author:         amnotafraid
Published on:   
-->
<head>
	<meta charset="utf-8" />
	<title>Overhead HCRC Kiosk 2</title>
	<link rel="stylesheet" type="text/css" href="../css/reset.css" />
	<link rel="stylesheet" type="text/css" href="../css/style.css" />
	<link rel="stylesheet" type="text/css" href="../css/media-queries.css" />
	
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" type="image/x-icon" href="../images/dcccd.ico">
	<link href='http://fonts.googleapis.com/css?family=Droid+Serif:700,400,400italic,700italic' rel='stylesheet' type='text/css'>
   <link href='http://fonts.googleapis.com/css?family=Droid+Sans:700,400,400italic,700italic' rel='stylesheet' type='text/css'>
	
	<!--[if IE]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
</head>

<body id="home">
  <div class="dark-background">
   <!--[if IE]>
   <div id="IEroot">
   <![endif]-->
    <header>
        <h1>Find a Health Career</h1>
    </header>
   
    <div id="wrapper-fixed">
      <div id="overhead-time-temp">
          <?php
          // Load the XML
          $xml_dallas = simplexml_load_file('http://www.weather.gov/xml/current_obs/KDAL.xml');

          // Get Current Dallas Love Field Temperature
          $dallas_temp = floor($xml_dallas->temp_f);
          ?>

          <div class="temperature-fixed">
            <p class="temperature-fixed-p">
              <?php
              echo $dallas_temp;
              ?>&deg;
            </p>
          </div>

          <div class="time-date-fixed">
            <div style="text-align:center;">
              <embed src=http://flash-clocks.com/free-flash-clocks-blog-topics/free-flash-clock-168.swf width=300 height=300 wmode=transparent type=application/x-shockwave-flash></embed>
            </div>
            <div class="date-box">
              <p class="date-p"><? print(Date("D m/d/y")); ?></p>
            </div>
        </div>
      </div>
    </div>

    <footer>
        <p>Copyright &copy; <? print(Date("Y")); ?> Health Careers Resource Center | DCCCD</p>
    </footer>		
		
   <!--[if IE]>
   </div>
   <![endif]-->	
</div>
</body>
</html>