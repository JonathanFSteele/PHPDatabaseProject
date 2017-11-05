<?php
    require 'MySqlInfo.php';
    require 'authLibraries.php';
    redirectIfNotInRole("Manager");

    //$LoginRowID = $_SESSION['LoginRowID'];
    $PlayerID = $_POST['PlayerID'];
    $GameID = $_POST['GameID'];
    //$ManagerID = $_SESSION['LoginRowID'];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $UpdateStats = $conn->prepare("INSERT INTO Play (PlayerID, GameID) VALUES(:PlayerID, :GameID)");
            $UpdateStats->bindParam(':PlayerID', $PlayerID);
            $UpdateStats->bindParam(':GameID', $GameID);
            $UpdateStats->execute();

            header("Location: assignGames.php?msg=Added+Player+To+Game");
        } catch (PDOException $e) {
          if(strpos($e->getMessage(), 'Duplicate entry') !== false)
          {
            header("Location: assignGames.php?msg=This+Player+Is+Already+Assigned+To+This+Game.");
          } else {
            echo "Error: " . $e->getMessage();
          }
        }
    }
