<?php
  // error_reporting(E_ALL);
  // ini_set('display_errors', 'on');
  require 'authLibraries.php';
  redirectIfNotInRole("Manager");
?>
<head>
  <title>Games</title>
  <?php require "master_head.php"  ?>
  <?php require 'MySqlInfo.php' ?>
</head>
<body>
  <?php require "master_navbar.php" ?>
  <div class="jumbotron">
    <div class="container">
      <h1 class="display-3">Games</h1>
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
          if(parent::key() == 'GameID'){
            $this->id = parent::current();
          }
          if(parent::key() == 'Action') {
            return "<td style='border:1px solid black;'><form method='get' action='gamesEdit.php'><button class='btn-info' type='submit' name='Update' value='".$this->id."'>Edit</button></form></td>";
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
    // Game View
    //************************************************************
    echo "<h2>List of Games</h2></h2>";
    echo "<h5 style='color: red;'>".$_GET['msg']."</h5>";
    echo "<form method='get' action='gamesEdit.php'><button class='btn-primary' type='submit' name='Update' value='0'>Add Game</button></form>";
    echo "<table class='table table-striped'>";
    echo "<tr><th>GameID</th><th>Date</th><th>Playing Venue</th><th>Opponent Team</th><th>Result</th><th></th></tr>";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare("SELECT * FROM GameView");
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
