<?php
    require 'MySqlInfo.php';
    require 'authLibraries.php';
    redirectIfNotLoggedIn();

?>
<head>
  <title>Profile</title>
  <?php require "master_head.php"  ?>
</head>
<body>
  <?php require "master_navbar.php" ?>
  <div class="jumbotron">
    <div class="container">
      <h1 class="display-3">Profile</h1>
    </div>
  </div>
  <div class="container">
    <form>
      <div class="form-group">
        <label for="exampleInputEmail1">Login ID</label>
        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="<?php echo $_SESSION['LoginID'] ?>">
        <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
      </div>
      <div class="form-group">
        <label for="exampleInputEmail1">Name</label>
        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="<?php echo $_SESSION['LoginName'] ?>">
        <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
      </div>
      <div class="form-group">
        <label for="exampleInputEmail1">Email address</label>
        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="<?php echo $_SESSION['Email'] ?>">
        <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
      </div>
      <div class="form-group">
        <label for="exampleInputEmail1">Birthday</label>
        <input type="date" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="<?php echo $_SESSION['Birthday'] ?>">
        <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
      </div>
      <div class="form-group">
        <label for="exampleInputEmail1">Address</label>
        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="<?php echo $_SESSION['Address'] ?>">
        <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
      </div>
      <div class="form-group">
        <label for="exampleInputEmail1">Phone Number</label>
        <input type="text" name="phone" class="form-control" aria-describedby="emailHelp" placeholder="<?php echo $_SESSION['PhoneNumber'] ?>">
        <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
      </div>
      <div class="form-group">
        <label for="exampleInputEmail1">Play Pos</label>
        <select class="form-control" id="sel1" value="<?php echo $_SESSION['PlayPos'] ?>">
          <option>None</option>
          <option>point guard</option>
          <option>shooting guard</option>
          <option>small forward</option>
          <option>power forward</option>
          <option>center</option>
        </select>
        <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
      </div>
      <button type="submit" class="btn btn-primary">Change Stats</button>
    </form>
    <form>
      <div class="form-group">
        <label for="exampleInputPassword1">Password</label>
        <input type="password" class="form-control" id="exampleInputPassword1" value="<?php echo $_SESSION['Password'] ?>">
      </div>
      <button type="submit" class="btn btn-primary">Update Password</button>
    </form>
  </div>
  <footer class="footer" style="background-color: #e9ecef;">
    <div class="container">
      <?php include 'footer.php';?>
      <?php include 'master_foot.php' ?>
    </div>
  </footer>
</body>
