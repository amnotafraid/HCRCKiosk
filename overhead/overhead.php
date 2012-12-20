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
	<title>Overhead HCRC Kiosk</title>
	<link rel="stylesheet" type="text/css" href="../css/reset.css" />
	<link rel="stylesheet" type="text/css" href="../css/style.css" />
	<link rel="stylesheet" type="text/css" href="../css/media-queries.css" />
	
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
	<link href='http://fonts.googleapis.com/css?family=Droid+Serif:700,400,400italic,700italic' rel='stylesheet' type='text/css'>
   <link href='http://fonts.googleapis.com/css?family=Droid+Sans:700,400,400italic,700italic' rel='stylesheet' type='text/css'>
   <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>
   <script type="text/javascript" src="../js/jquery.slidertron-1.1.js"></script>
   <script type="text/javascript">//<![CDATA[
      $(document).ready(function() {
        resizeWrapper();

        $(window).resize(function() {
          resizeWrapper();
        });
        
      });

      $(function() {
          $('#slider').slidertron({
            viewerSelector: '.viewer',
            indicatorSelector: '.indicator span',
            reelSelector: '.reel',
            slidesSelector: '.slide',
            speed: 'slow',
            advanceDelay: 4000
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

        //var wrapperHeight = Math.min(1024, contentHeight * 0.9);
        var wrapperMinHeight = Math.min(areaHeight * 0.9) - 90;
        var wrapperHeight = wrapperMinHeight;
        //var wrapperTopMargin = (contentHeight - wrapperHeight) / 2;
        var wrapperTopMargin = ((areaHeight - wrapperMinHeight) / 2) + headerHeight;

        $('div#wrapper').css({
          "margin-top" : wrapperTopMargin,
          "min-height" : wrapperMinHeight
        });
        
        
        var viewerHeight = wrapperHeight
                           - $("div.indicator").height()
                           - parseInt($("#slider").css("margin-top"), 10);
                         
        var slideHeight = viewerHeight;
        var slideWidth = $("div.viewer").width();

        $('div.viewer').css({
          height: viewerHeight
        });
        
        padding = parseInt($("#slider .slide").css("margin-top"), 10)
        
        paddingTotal = .04 * slideWidth;
        
        $('div.slide').css({
          height: slideHeight,
          width: slideWidth + paddingTotal /*(slideWidth + 40)*/
        });

        $('div.slide-double-portrait').css({
          height: (slideHeight - paddingTotal),
          width: ((slideWidth - (paddingTotal * 2))/2)
        });
        
        var fontSize = (slideHeight - paddingTotal) / 2;
        
        $('div.slide-double-portrait .temperature-box').css({
          height: (slideHeight - paddingTotal),
          "line-height": "2.0"
        });
        
        $('div.slide-double-portrait .temperature-box .temperature-p').css({
          "font-size" : fontSize
        })
        
        fontSize = fontSize / 4;
        var clockHeight = 300;
        var dateHeight = slideHeight - paddingTotal - clockHeight;
        
        //$('object').attr('width', '450px');
        var clockWidth = Math.min (slideHeight - paddingTotal,
                                   (slideWidth - (paddingTotal * 2))/2);
        var clockWidthPx = clockWidth + 'px';
        $('embed').attr('width', clockWidthPx);
        
        $('div.slide-double-portrait .date-box').css({
          height: dateHeight,
          "line-height" : (dateHeight / fontSize),
          "font-size" : fontSize
        });
        
        $('div.slide-double-landscape').css({
          height: ((slideHeight - (paddingTotal * 2))/2),
          width: (slideWidth - paddingTotal)
        });

        $('div.slide-landscape').css({
          height: (slideHeight - paddingTotal),
          width: (slideWidth - paddingTotal)
        });
        
        /*$('div.slide').html("<p>" +
                            "slideHeight = " + slideHeight + "</p><p>" +
                            "slideWidth = " + (slideWidth) + "</p>");
       $('div.slide').css({
         background: "url(../images/Untitled.png)"
       });*/
        
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
				
	<div id="wrapper">
		
		<section id="main-content">
			<hr/>
        <div id="slider">
            <div class="viewer">
              <div class="reel">
                  <div class="slide">
                      <img src="../images/programs-and-careers.png" />
                  </div>
                  <div class="slide">
                    <img src="../images/come-visit-us.png" />
                  </div>
                  <div class="slide">
                    <img src="../images/programs-and-careers.png" />
<!--                    <div class="slide-double-landscape">
                      <h4 class="center">Find out about</h4>
                      <h4 class="center">health care programs here</h4>
                    </div>
                    <div class ="slide-double-landscape">
                        <img src="../images/careers.jpg" style="width:100%; height:100%;" />
                    </div>-->
                  </div> 
                  <div class="slide slide-background">
                    <?php

                    // Load the XML
                    $xml_dallas = simplexml_load_file('http://www.weather.gov/xml/current_obs/KDAL.xml');

                    // Get Current Dallas Love Field Temperature
                    $dallas_temp = floor($xml_dallas->temp_f);
                    ?>
                    <div class="slide-double-portrait">
                      <div class="temperature-box">
                        <p class="temperature-p">
                          <?php
                          echo $dallas_temp;
                          ?>&deg;
                        </p>
                      </div>
                    </div>
                    <div class="slide-double-portrait">
                      <embed src=http://flash-clocks.com/free-flash-clocks-blog-topics/free-flash-clock-168.swf width=300 height=300 wmode=transparent type=application/x-shockwave-flash></embed>
                      <div class="date-box">
                        <p class="date-p"><? print(Date("D m/d/y")); ?></p>
                      </div>
                    </div>
                  </div>
              </div>
            </div>
            <div class="indicator">
              <span>1</span>
              <span>2</span>
              <span>3</span>
              <span>4</span>
            </div>
        </div>
         <div class="clearfix"></div>
		</section>
		<hr/>
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