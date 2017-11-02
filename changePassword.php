<?php
  if(!session_id()) session_start();
    $GlobalEmail = "None";
    $Table = "None";
  if(!isset($_SESSION['GlobalEmail'])) {
      $_SESSION['GlobalEmail'] = $GlobalEmail;
      $_SESSION['Table'] = $Table;
  }
 ?>
