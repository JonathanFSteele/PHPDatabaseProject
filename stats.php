<?php
  error_reporting(E_ALL);
  ini_set('display_errors', 'on');
  require 'authLibraries.php';
  redirectIfNotLoggedIn();
?>
<head>
  <title>Home</title>
  <?php require "master_head.php"  ?>
  <?php require 'MySqlInfo.php' ?>
</head>
<body>
  <?php require "master_navbar.php" ?>
  <div class="jumbotron">
    <div class="container">
      <h1 class="display-3"><?php echo $_SESSION['LoginID'] ?>'s Stats</h1>
    </div>
  </div>
  <div class="container">
    <?php

    class TableRows extends RecursiveIteratorIterator
    {
        public function __construct($it)
        {
            parent::__construct($it, self::LEAVES_ONLY);
        }

        public function current()
        {
            return "<td style='width:150px;border:1px solid black;'>" . parent::current(). "</td>";
        }

        public function beginChildren()
        {
            echo "<tr>";
        }

        public function endChildren()
        {
            echo "</tr>" . "\n";
        }
    }

    $LoggedInID = $_SESSION["LoginRowID"];
    $LoginID = $_SESSION["LoginID"];

    //************************************************************
    // Yearly Statistics
    //************************************************************
    echo "<h2>Yearly Stats</h2>";
    echo "<table class='table table-striped'>";
    echo "<tr><th>YearForStats</th><th>TotalPoints</th><th>ASPG</th></tr>";

    try {
      //echo "LoggedInID: ".$LoggedInID;
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare("SELECT YearForStats, TotalPoints, ASPG FROM PlayerData WHERE PlayerID=:LoggedInID");
        $stmt->bindParam(':LoggedInID', $LoggedInID);
        $stmt->execute();

        // set the resulting array to associative
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        foreach (new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
            echo $v;
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    $conn = null;
    echo "</table>";

    //************************************************************
    // AssignedGames View
    //************************************************************
    echo "<h2>Assigned Games</h2>";
    echo "<table class='table table-striped'>";
    echo "<tr><th>Date</th><th>Playing Venue</th><th>Opponent Team</th><th>Result</th></tr>";

    try {
      //echo "LoggedInID: ".$LoggedInID;
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare("SELECT Date, PlayingVenue, OpponentTeam, Result FROM PlayGameView WHERE PlayerID=:LoggedInID");
        $stmt->bindParam(':LoggedInID', $LoggedInID);
        $stmt->execute();

        // set the resulting array to associative
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        foreach (new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
            echo $v;
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    $conn = null;
    echo "</table>";

    //************************************************************
    // AssignedTraining View
    //************************************************************
    echo "<h2>Assigned Training</h2>";
    echo "<table class='table table-striped'>";
    echo "<tr><th>Training</th><th>Instructions</th><th>Assigned By</th></tr>";

    try {
      //echo "LoggedInID: ".$LoggedInID;
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare("SELECT TrainingName, Instruction, ManagerName FROM TrainingView WHERE PlayerID=:LoggedInID");
        $stmt->bindParam(':LoggedInID', $LoggedInID);
        $stmt->execute();

        // set the resulting array to associative
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        foreach (new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
            echo $v;
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    $conn = null;
    echo "</table>";

    ?>
  </div>
  <footer class="footer" style="background-color: #e9ecef;">
    <div class="container">
      <?php include 'footer.php';?>
      <?php include 'master_foot.php' ?>
    </div>
  </footer>
</body>
