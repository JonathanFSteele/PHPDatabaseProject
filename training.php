<?php
  // error_reporting(E_ALL);
  // ini_set('display_errors', 'on');
  require 'authLibraries.php';
  redirectIfNotInRole("Manager");
?>
<head>
  <title>Training</title>
  <?php require "master_head.php"  ?>
  <?php require 'MySqlInfo.php' ?>
</head>
<body>
  <?php require "master_navbar.php" ?>
  <div class="jumbotron">
    <div class="container">
      <h1 class="display-3">Training</h1>
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
          if(parent::key() == 'ID'){
            $this->id = parent::current();
            return "";
          }
          if(parent::key() == 'Action') {
            return "<td style='border:1px solid black;'><form method='get' action='trainingEdit.php'><button class='btn-info' type='submit' name='Update' value='".$this->id."'>Edit</button></form>&nbsp;<form method='post' action='trainingDelete.php'><button class='btn-danger' type='submit' name='Delete' value='".$this->id."'>Delete</button></form></td>";
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
    // Training View
    //************************************************************
    echo "<h2>Training</h2></h2>";
    echo "<form method='get' action='trainingEdit.php'><button class='btn-primary' type='submit' name='Update' value='0'>Add Training</button></form>";
    echo "<table class='table table-striped'>";
    echo "<tr><th>Training Name</th><th>Instructions</th><th>Time Period In Hour</th><th></th></tr>";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare("SELECT * FROM TrainingAdmin");
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
