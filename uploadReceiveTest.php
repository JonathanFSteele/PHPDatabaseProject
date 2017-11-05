<?php
if(isset($_POST['btn-upload']))
{
        echo "<br />Starting receive...";
        $fileObject = rand(1000,100000)."-".$_FILES['fileObject']['name'];
        $fileObject_loc = $_FILES['fileObject']['tmp_name'];
        $folder="uploads/";
        echo "<br />fileObject: ".$fileObject;
        echo "<br />fileObject_loc: ".$fileObject_loc;
        echo "<br />folder: ".$folder;
        if(move_uploaded_file($fileObject_loc,$folder.$fileObject))
        {
            echo "<br />success.";
        }
        else
        {
            echo "<br />fail";
}
}
?>
