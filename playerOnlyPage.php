<?php
  require 'authLibraries.php';
  redirectIfNotLoggedIn();
?>
<html>
<body>
  <h1>This page should only be viewable by someone logged in. Doesnt check the role</h1>
</body>
</html>
