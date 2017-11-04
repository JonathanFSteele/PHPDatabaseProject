<?php
    require 'MySqlInfo.php';
    require 'authLibraries.php';
    redirectIfNotInRole("Manager");

    //$LoginRowID = $_SESSION['LoginRowID'];
    $ID = $_POST['Delete'];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $UpdateStats = $conn->prepare("DELETE FROM AssignTraining WHERE ID=:ID");
            $UpdateStats->bindParam(':ID', $ID);
            $UpdateStats->execute();

            header("Location: assignTraining.php?msg=Deleted+Player+From+Training");
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
