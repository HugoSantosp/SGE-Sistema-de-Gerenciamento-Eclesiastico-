
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="sweetalert2.all.min.js"></script>
<script src="sweetalert2.min.js"></script>
<link rel="stylesheet" href="sweetalert2.min.css">
<script type="text/javascript" src="js/alerta-loguin.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<?php
    @session_start();
    
    echo "<script> $(function() { Exit('Finalizando Sessão, Aguarde Por Favor')}) </script>";

    @session_destroy();

?>