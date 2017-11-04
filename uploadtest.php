<?php
//include_once 'dbconfig.php';
require 'MySqlInfo.php';
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>File Uploading With PHP and MySql</title>
<link rel="stylesheet" href="style.css" type="text/css" />
</head>
<body>
  <div id="header">
  <label>File Uploading With PHP and MySql</label>
  </div>
  <div id="body">
   <form action="upload.php" method="post" enctype="multipart/form-data">
   <input type="file" name="file" />
   <button type="submit" name="btn-upload">upload</button>
   </form>
      <br /><br />
      <?php
   if (isset($_GET['success'])) {
       ?>
          <label>File Uploaded Successfully...  <a href="certifcate.php">click here to view file.</a></label>
          <?php
   } elseif (isset($_GET['fail'])) {
       ?>
          <label>Problem While File Uploading !</label>
          <?php
   } else {
       ?>
          <label>Try to upload any files(PDF, DOC, EXE, VIDEO, MP3, ZIP,etc...)</label>
          <?php
   }
   ?>
  </div>

<!-- <div id="header">
<label>File Uploading With PHP and MySql</label>
</div>
<div id="body">
 <table width="80%" border="1">
    <tr>
    <th colspan="4">your uploads...<label><a href="index.php">upload new files...</a></label></th>
    </tr>
    <tr>
    <td>File Name</td>
    <td>File Type</td>
    <td>File Size(KB)</td>
    <td>View</td>
    </tr>
    <?php
 $sql="SELECT * FROM tbl_uploads";
 $result_set=mysql_query($sql);
 while ($row=mysql_fetch_array($result_set)) {
     ?>
        <tr>
        <td><?php echo $row['file'] ?></td>
        <td><?php echo $row['type'] ?></td>
        <td><?php echo $row['size'] ?></td>
        <td><a href="uploads/<?php echo $row['file'] ?>" target="_blank">view file</a></td>
        </tr>
        <?php
 }
 ?>
    </table>

</div> -->
</body>
</html>
