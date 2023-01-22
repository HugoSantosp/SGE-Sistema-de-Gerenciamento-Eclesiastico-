<?php
   @session_start();

   if(@$_SESSION ['nivel_usuario'] != 'Pastor Presidente' && @$_SESSION ['nivel_usuario'] != 'Pastor Auxiliar'){
      echo "<script> window.location ='../index.php' </script>";

   
   }

?>