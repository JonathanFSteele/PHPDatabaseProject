<nav class="navbar navbar-expand-md navbar-dark" style="background-color: darkorange">
  <!-- Navbar content -->
  <a class="navbar-brand" href="index.php">Elite Basketball Management</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="index.php">Home<span class="sr-only">(current)</span></a>
        </li>
        <?php
        if($_SESSION['Role'] == "Manager")
        {
          echo '<li class="nav-item active"><a class="nav-link" href="playerManagement.php">Management<span class="sr-only">(current)</span></a></li>';
          echo '<li class="nav-item active"><a class="nav-link" href="training.php">Training<span class="sr-only">(current)</span></a></li>';
          echo '<li class="nav-item active"><a class="nav-link" href="assignTraining.php">Assign-Training<span class="sr-only">(current)</span></a></li>';
          echo '<li class="nav-item active"><a class="nav-link" href="games.php">Games<span class="sr-only">(current)</span></a></li>';
          echo '<li class="nav-item active"><a class="nav-link" href="assignGames.php">Assign-Games<span class="sr-only">(current)</span></a></li>';
          echo '<li class="nav-item active"><a class="nav-link" href="certificate.php">Certificate<span class="sr-only">(current)</span></a></li>';
        }
        else  {
          echo '<li class="nav-item active"><a class="nav-link" href="stats.php">Stats<span class="sr-only">(current)</span></a></li>';
        }
        ?>
      </ul>
      <ul class="navbar-nav my-2 my-lg-0">
        <li class="nav-item">
          <a class="nav-link" href="profile.php"><?php echo $_SESSION['LoginID'] ?></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="killsession.php">Logout</a>
        </li>
      </ul>
    </div>
</nav>
<br />
