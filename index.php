<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/font-awesome.min.css">

  
  <title>Phaj</title>

</head>
<body>
<div id="main-content"></div>

<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>  
<script src="js/lib.js"></script>

  <script>
  $( function() {
  
  $("#main-content").addFunct("saluta").addText("nome","emanuele").addParam("cognome","di mauro")
  $("#main-content").goAjax()  

  } );
  </script> 
</body>
</html>