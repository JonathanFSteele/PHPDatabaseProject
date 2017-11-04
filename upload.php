<?php
error_reporting(E_ALL);
ini_set('display_errors', 'on');
  require 'MySqlInfo.php';
  require 'authLibraries.php';
  redirectIfNotInRole("Manager");
if(isset($_POST['btn-upload']))
{

 $file = rand(1000,100000)."-".$_FILES['file']['name'];
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

 $final_file=str_replace(' ','-',$new_file_name);

 $LoginID = $_SESSION["LoginID"];

 if(move_uploaded_file($file_loc,$folder.$final_file))
 {
   $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
   $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   $stmt = $conn->prepare("INSERT ManagerCertificate Certificate=:File WHERE LoginID=:LoginID");
   $stmt->bindParam(':LoginID', $LoginID);
   $stmt->bindParam(':File', $final_file);
   $stmt->execute();
  // $sql="INSERT INTO tbl_uploads(file,type,size) VALUES('$final_file','$file_type','$new_size')";
  // mysql_query($sql);
  ?>
  <script>
  alert('successfully uploaded');
        //window.location.href='uploadtest.php?success';
        </script>
  <?php
 }
 else
 {
  ?>
  <script>
  alert('error while uploading file');
        //window.location.href='uploadtest.php?fail';
        </script>
  <?php
 }
}
?>
