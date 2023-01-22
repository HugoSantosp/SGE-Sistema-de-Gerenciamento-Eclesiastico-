<?php
   @session_start();

   if(@$_SESSION ['nivel_usuario'] != 'Pastor Presidente'){
      echo "<script> window.location ='../index.php' </script>";

   
   }

?>