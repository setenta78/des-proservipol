<?php
session_start();
 session_unregister("session_video_14");
  session_destroy();
  //devuelvo al usuario al formulario
  header("Location: index.php");
  /*
  echo "<script type='text/javascript'> window.location='index.php'; </script>'";
  */
?>