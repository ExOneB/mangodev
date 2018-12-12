<?php
  require "libs/rb.php";
  R::setup( "mysql:host=localhost;dbname=mangodev",
        "admin", "admin" );

  session_start();
?>
