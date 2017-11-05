<?php
//error_reporting(E_ALL);
//ini_set('display_errors', 'on');
require 'MySqlInfo.php';
if (isset($_GET['id'])) {
    $fileid = $_GET['id'];
    try {

      //Generate stuff on page again...
      $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $stmt = $conn->prepare("SELECT * FROM ManagerCertificate WHERE CertificateID =:fileid ");
      $stmt->bindParam(':fileid', $fileid);
      $stmt->execute();

      // set the resulting array to associative
      $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
      foreach (new RecursiveArrayIterator($stmt->fetchAll()) as $k=>$v) {
          $filename = 'certificate.jpeg';
          $mimetype = 'image/jpeg';
          $filedata = $v['Certificate'];
          header("Content-length: ".strlen($filedata));
          header("Content-type: ".$mimetype);
          header("Content-disposition: download; filename=".$filename); //disposition of download forces a download
          echo $filedata;
      }
    } //try
    catch (PDOException $e) {
        $error = '<br>Database ERROR fetching requested file.';
        echo $error;
        die();
    } //catch
} //isset
?>
