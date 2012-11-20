<!DOCTYPE html><html><head>
<style type="text/css">

div.button_text {
  line-height: 3em;
  text-overflow: ellipsis;
  white-space: nowrap;
  overflow: hidden;
}

.main_button{
 border:1px solid #b7b7b7;
 -webkit-border-radius: 3px;
 -moz-border-radius: 3px;
 border-radius: 3px;
 margin:2%;
 font-family:arial, helvetica, sans-serif;
 padding: 10px 10px 10px 10px;
 text-shadow: -1px -1px 0 rgba(0,0,0,0.3);
 filter: progid:DXImageTransform.Microsoft.Shadow(rgba(0,0,0,0.3), direction=225);
 font-weight:bold;
 text-align: center;
 color: #FFFFFF;
 background-color: #d3d3d3;
 width:33%;
 height:3em;
 background-image: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #d3d3d3), color-stop(100%, #707070));
 background-image: -webkit-linear-gradient(top, #d3d3d3, #707070);
 background-image: -moz-linear-gradient(top, #d3d3d3, #707070);
 background-image: -ms-linear-gradient(top, #d3d3d3, #707070);
 background-image: -o-linear-gradient(top, #d3d3d3, #707070);
 background-image: linear-gradient(top, #d3d3d3, #707070);filter:progid:DXImageTransform.Microsoft.gradient(GradientType=0,startColorstr=#d3d3d3, endColorstr=#707070);
}

.main_button:active{
 border:1px solid #a0a0a0; background-color: #707070;
 background-image: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#707070), color-stop(100%, #d3d3d3));
 background-image: -webkit-linear-gradient(top, #707070, #d3d3d3);
 background-image: -moz-linear-gradient(top, #707070, #d3d3d3);
 background-image: -ms-linear-gradient(top, #707070, #d3d3d3);
 background-image: -o-linear-gradient(top, #707070, #d3d3d3);
 background-image: linear-gradient(top, #707070, #d3d3d3);filter:progid:DXImageTransform.Microsoft.gradient(GradientType=0,startColorstr=#707070, endColorstr=#d3d3d3);
}

.main_button a {
  color:white;
  text-decoration:none; 
}
       
.main_button a:active {
  outline:none;
  }

h1 {
  color: white;
  font-family: Helvetica,Arial,sans-serif;
  font-weight: bold;
  font-size: 1.2em;
  text-shadow: #333 2px 2px 3px;
  padding-bottom:2px;
}
.shadow {
  display: none;
}
.ielte9 > h1 > span {
  position: absolute;
  color: white;
}
.ielte9 > h1 > span.shadow {
  display: inline-block;
  zoom: 1;
  color: #333;
  filter: progid:DXImageTransform.Microsoft.Blur(pixelradius=2);
} 

</style></head>
<body>

<!--<input type="button" class="main_button" value="Hello" />

    <div class="main_box">
        <a href="BiotechnologyNew.php" class="main_button">Biotechnology</a></br>
    </div>-->

    <div class="main_button">
      <div class="button_text">
        <a href="Veterinary.php">very long name that will need to be in two lines</a>
      </div>
    </div>
    <div class="main_button">
      <div class="button_text">
        <a href="Veterinary.php">Another button</a></br>
      </div>
    </div>
    <div class="main_button">
      <div class="button_text">
        <a href="Veterinary.php">A third button</a></br>
      </div>
    </div>

</body>
</html>