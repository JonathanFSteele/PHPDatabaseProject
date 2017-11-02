<?php
  if(!session_id()) session_start();
    $GlobalEmail = "None";
  if(!isset($_SESSION['GlobalEmail'])) {
      $_SESSION['GlobalEmail'] = $GlobalEmail;
  }
 ?>
