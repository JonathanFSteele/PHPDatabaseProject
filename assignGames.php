<?php
  // error_reporting(E_ALL);
  // ini_set('display_errors', 'on');
  require 'authLibraries.php';
  require 'getDropdowns.php';
  redirectIfNotInRole("Manager");
?>
<head>
  <title>Assign Games</title>
  <?php require "master_head.php"  ?>
  <?php require 'MySqlInfo.php' ?>
</head>
<body>
  <?php require "master_navbar.php" ?>
  <div class="jumbotron">
    <div class="container">
      <h1 class="display-3">Assign Games</h1>
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
          if(parent::key() == 'PlayID'){
            $this->id = parent::current();
          }
          if(parent::key() == 'Action') {
            return "<td style='border:1px solid black;'><form method='post' action='assignGamesDelete.php'><button class='btn-danger' type='submit' name='Delete' value='".$this->id."'>Unassign</button></form></td>";
          }
          else {
            return "<td style='border:1px solid black;'>" . parent::current(). "</td>";
          }
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

    $LoginID = $_SESSION["LoginID"];


    //************************************************************
    // PlayGame View
    //************************************************************
    echo "<h2>Assign Players</h2></h2>";
    echo "<h5 style='color: red;'>".$_GET['msg']."</h5>";
    echo "<form method='post' action='assignGamesAdd.php'>".getPlayerDropdown().getGamesDropdown().
    "<button class='btn-primary' type='submit'>Assign Player</button></form>";
    echo "<table class='table table-striped'>";
    echo "<tr><th>Play ID</th><th>Game ID</th><th>Playing Venue</th><th>Assigned</th><th></th></tr>";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare("SELECT * FROM PlayGame");
        //$stmt->bindParam(':LoggedInID', $LoginID);
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
