<?php
    require 'MySqlInfo.php';
    require 'authLibraries.php';
    redirectIfNotInRole("Manager");

    //$LoginRowID = $_SESSION['LoginRowID'];
    $PlayerID = $_POST['PlayerID'];
    $TrainingID = $_POST['TrainingID'];
    $ManagerID = $_SESSION['LoginRowID'];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $UpdateStats = $conn->prepare("INSERT INTO AssignTraining (PlayerID, ManagerID, TrainingID) VALUES(:PlayerID, :ManagerID, :TrainingID)");
            $UpdateStats->bindParam(':PlayerID', $PlayerID);
            $UpdateStats->bindParam(':TrainingID', $TrainingID);
            $UpdateStats->bindParam(':ManagerID', $ManagerID);
            $UpdateStats->execute();

            header("Location: assignTraining.php?msg=Added+Player+Into+Training");
        } catch (PDOException $e) {
          if(strpos($e->getMessage(), 'Duplicate entry') !== false)
          {
            header("Location: assignTraining.php?msg=This+Player+Is+Already+Assigned+To+This+Training.");
          } else {
            echo "Error: " . $e->getMessage();
          }
        }
    }
