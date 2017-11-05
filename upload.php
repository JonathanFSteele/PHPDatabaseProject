<?php
  error_reporting(E_ALL);
  ini_set('display_errors', 'on');
  require 'MySqlInfo.php';
  require 'authLibraries.php';
  redirectIfNotInRole("Manager");
if (isset($_POST['btn-upload'])) {
    $file = rand(1000, 100000)."-".$_FILES['file']['name'];
    $file_loc = $_FILES['file']['tmp_name'];
    $file_size = $_FILES['file']['size'];
    $file_type = $_FILES['file']['type'];
    $folder="uploads/";

    // new file size in KB
    $new_size = $file_size/1024;
    // new file size in KB

    // make file name in lower case
    $new_file_name = strtolower($file);
    // make file name in lower case

    $final_file=str_replace(' ', '-', $new_file_name);

    $LoginRowID = $_SESSION["LoginRowID"];

    // echo "<br />FileLocation: ".$file_loc;
    // echo "<br />Folder: ".$folder;
    // echo "<br />FinalFile: ".$final_file;
    if (move_uploaded_file($file_loc, $folder.$final_file)) {
        //echo "<br />Trying to fopen this: ".$folder.$final_file;
        $blob = fopen($folder.$final_file, 'rb');
        //echo "<br />After fopen: ";
        //echo "<br />".$blob;
        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->prepare("INSERT ManagerCertificate (ManagerID, Certificate) VALUES(:LoginID, :File)");
            $stmt->bindParam(':LoginID', $LoginRowID);
            $stmt->bindParam(':File', $blob, PDO::PARAM_LOB);
            //  $stmt->bindParam(':File', $final_file);
            $stmt->execute();
            //echo "<br />After Insert: ";
            // $sql="INSERT INTO tbl_uploads(file,type,size) VALUES('$final_file','$file_type','$new_size')";
            // mysql_query($sql);

            header("Location: certificate.php?msg=successfully+uploaded+certificate.");
        } catch (PDOException $e) {
            header( "Location: certificate.php?msg=". $e->getMessage());
        }
    } else {
        header("Location: certificate.php?msg=error+uploading+file,+file+probably+too+big,+please+keep+it+under+100k");
    }
}
