<?php
    require 'MySqlInfo.php';
    require 'authLibraries.php';
    redirectIfNotInRole("Manager");

    //$LoginRowID = $_SESSION['LoginRowID'];
    $ID = $_POST['Delete'];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

      try {

        //Generate stuff on page again...
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare("SELECT * FROM AssignTraining WHERE TrainingID=:ID");
        $stmt->bindParam(':ID', $ID);
        $stmt->execute();
        $count = $stmt->rowCount();

        if($count > 0)
        {
          header("Location: training.php?msg=Cant+Delete+Training+Because+".$count."+Players+Still+Attached.");
        }
        else {
          $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
          $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $UpdateStats = $conn->prepare("DELETE FROM Training WHERE ID=:ID");
          $UpdateStats->bindParam(':ID', $ID);
          $UpdateStats->execute();

          header("Location: training.php?msg=Deleted+Training");
        }
      } catch (PDOException $e) {
          echo "Error: " . $e->getMessage();
      }
    }
?>
