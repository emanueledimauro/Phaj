<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
 
  <title>Phaj</title>

</head>
<body>
<div id="main-content"></div>

<script src="js/jquery.js"></script>
<script src="js/lib.js"></script>

  <script>
  $( function() {
  
  $("#main-content").addFunct("hello").addText("firstname","emanuele").addParam("lastname","di mauro").addParam("age","47")
  $("#main-content").goAjax()  

  } );
  </script> 
</body>
</html>