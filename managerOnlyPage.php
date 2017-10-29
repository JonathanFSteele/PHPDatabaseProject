<?php
  require 'AuthLibraries.php';
  redirectIfNotInRole("manager");
?>
<html>
<body>
  <h1>This page should only be viewable by a manager</h1>
</body>
</html>
