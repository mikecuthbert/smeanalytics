<?php

session_start();

include('header.php');
include('database.php');

  if (isset($_SESSION["sme_active_session"])) {

              include('config.php');
              include('menu.php');
              include('powerbi_report.php');
              include('app.php');

              }

        else {
              include('login.php');
            }

?>
