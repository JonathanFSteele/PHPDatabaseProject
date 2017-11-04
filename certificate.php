<?php
  // error_reporting(E_ALL);
  // ini_set('display_errors', 'on');
  require 'authLibraries.php';
  redirectIfNotInRole("Manager");
?>
<head>
  <title>Certificates</title>
  <?php require "master_head.php"  ?>
  <?php require 'MySqlInfo.php' ?>
</head>
<body>
  <?php require "master_navbar.php" ?>
  <div class="jumbotron">
    <div class="container">
      <h1 class="display-3">Certificates</h1>
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

    $LoginID = $_SESSION["LoginID"];

    //************************************************************
    // ManagerView View
    //************************************************************
    echo "<h2>My Info</h2></h2>";
    echo "<table class='table table-striped'>";
    echo "<tr><th>LoginID</th><th>Name</th><th>Password</th><th>Birthday</th><th>Address</th><th>Email</th><th>PhoneNumber</th><th>Certificate</th></tr>";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare("SELECT LoginID, Name, Password, Birthday, Address, Email, PhoneNumber, Certificate FROM ManagerView WHERE LoginID=:LoginID");
        $stmt->bindParam(':LoginID', $LoginID);
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
    // ManagerView View
    //************************************************************
    echo "<h2>Other Managers Info</h2></h2>";
    echo "<table class='table table-striped'>";
    echo "<tr><th>LoginID</th><th>Name</th><th>Password</th><th>Birthday</th><th>Address</th><th>Email</th><th>PhoneNumber</th><th>Certificate</th></tr>";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare("SELECT LoginID, Name, Password, Birthday, Address, Email, PhoneNumber, Certificate FROM ManagerView WHERE LoginID NOT IN(SELECT LoginID FROM ManagerView WHERE LoginID=:LoginID)");
        $stmt->bindParam(':LoginID', $LoginID);
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

    if(isset($_POST['btn-upload']))
    {

     $file = rand(1000,100000)."-".$_FILES['file']['name'];
     $file_loc = $_FILES['file']['tmp_name'];
     $file_size = $_FILES['file']['size'];
     $file_type = $_FILES['file']['type'];
     $folder="uploads/";

     $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
     $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     $stmt = $conn->prepare("INSERT ManagerCertificate Certifcate=:File WHERE LoginID=:LoginID");
     $stmt->bindParam(':LoginID', $LoginID);
     $stmt->bindParam(':File', $file);
     $stmt->execute();

     //move_uploaded_file($file_loc,$folder.$file);
     //$sql="INSERT INTO tbl_uploads(file,type,size) VALUES('$file','$file_type','$file_size')";
     //mysql_query($sql);
    }
    ?>
    <form action="upload.php" method="post" enctype="multipart/form-data">
      <input type="file" name="file" />
      <button type="submit" name="btn-upload">upload</button>
    </form>
  </div>
  <footer class="footer" style="background-color: #e9ecef;">
    <div class="container">
      <?php include 'footer.php';?>
      <?php include 'master_foot.php' ?>
    </div>
  </footer>
</body>
