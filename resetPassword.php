<head>
  <title>Reset Password</title>
  <?php require "master_head.php"  ?>
</head>
<body style="margin-top: 150px;">
  <h1 style="text-align: center;">Elite Basketball Management</h1>
  <br />
  <br />
  <br />
  <div style="margin-left: 35%; margin-right: 35%;">
    <form>
      <h2 style="text-align: center;">Reset Password</h2>
      <br />
      <label class="sr-only">New Password</label>
      <input class="form-control" placeholder="New Password" required autofocus autocomplete="off" />
      <br />
      <label class="sr-only">Verify Password</label>
      <input class="form-control" placeholder="Verify Password" required autofocus autocomplete="off" />
      <br />
      <button class="btn btn-lg btn-primary btn-block" type="submit">Submit</button>
      <br />
    </form>
  </div>
  <footer class="footer" style="background-color: #e9ecef; margin-top: 200px;">
    <div class="container">
      <?php include 'footer.php';?>
      <?php include 'master_foot.php' ?>
    </div>
  </footer>
</body>
