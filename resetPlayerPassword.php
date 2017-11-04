<?php
    //error_reporting(E_ALL);
    //ini_set('display_errors', 'on');
    require 'MySqlInfo.php';
    require 'authLibraries.php';
    redirectIfNotInRole("Manager");

    $PlayerID = $_POST["subBtn"];
    $NewPassword = $_POST["newPassword"];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      try {
          //echo "WE ARE POSTING ".$EmailAddress;
          $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
          $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $UpdateStats = $conn->prepare("UPDATE Player SET Password=:NewPassword WHERE ID=:PlayerID");
          $UpdateStats->bindParam(':PlayerID', $PlayerID);
          $UpdateStats->bindParam(':NewPassword', $NewPassword);
          $UpdateStats->execute();

          header("Location: playerManagement.php?msg=player+password+reset.");
      } catch (PDOException $e) {
          echo "Error: " . $e->getMessage();
      }

    }
?>
