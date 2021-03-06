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
            if (parent::key() == 'CertificateID') {
                $this->id = parent::current();
            }
            if (parent::key() == 'Action') {
                return "<td style='border:1px solid black;'><form method='get' action='getimage.php'><button class='btn-primary' type='submit' name='id' value='".$this->id."'>Download</button></form>

                <form method='post' action='certificateDelete.php'><button class='btn-danger' type='submit' name='Delete' value='".$this->id."'>Delete</button></form>

                <form action='uploadChange.php' method='post' enctype='multipart/form-data'>
                  <input type='hidden' name='id' value='".$this->id."'/>
                  <input type='file' name='file' />
                  <button type='submit' name='btn-upload'>upload</button>
                </form></td>";
            }
            if (parent::key() == 'Preview') {
                return "<td style='width:150px;border:1px solid black;'><img style='height: 100px;' src='getimage.php?id=".$this->id."' /></td>";
            } else {
                return "<td style='width:150px;border:1px solid black;'>" . parent::current(). "</td>";
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

    $LoginRowID = $_SESSION["LoginRowID"];


    //************************************************************
    // ManagerView View
    //************************************************************
    echo "<h2>Other Managers Info</h2></h2>";
    echo "<h5 style='color: red;'>".$_GET['msg']."</h5>";
    echo "<form action='upload.php' method='post' enctype='multipart/form-data'>
      <input type='file' name='file' />
      <button type='submit' name='btn-upload'>upload</button>
    </form>";
    echo "<table class='table table-striped'>";
    echo "<tr><th>CertificateID</th><th>Preview</th><th></th></tr>";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare("SELECT CertificateID, '' AS Preview, '' AS Action FROM ManagerCertificate WHERE ManagerID=:LoginRowID");
        $stmt->bindParam(':LoginRowID', $LoginRowID);
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

    if (isset($_POST['btn-upload'])) {
        $file = rand(1000, 100000)."-".$_FILES['file']['name'];
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
  </div>
  <footer class="footer" style="background-color: #e9ecef;">
    <div class="container">
      <?php include 'footer.php';?>
      <?php include 'master_foot.php' ?>
    </div>
  </footer>
</body>
