<html>
<body>

<form action="testform.php" method="post">
Name: <input type="text" name="name"><br>
E-mail: <input type="text" name="email"><br>
<input type="submit">
</form>
<br />
Results:<br />
<?php
echo "Name: ", $_POST['name'], "<br />";
echo "email: ", $_POST['email'], "<br />";

?>

 <?php require 'footer.php';?>
</body>
</html>
