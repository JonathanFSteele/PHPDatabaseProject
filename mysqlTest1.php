<head>
  <?php require "master_head.php"  ?>
  <?php require 'MySqlInfo.php' ?>
</head>
<body>
  <div class="container">
    <h1>mySQLTables</h1>
    <br />


    <?php
    //TRY PDO Style (support for older PHP versions.)
    //************************************************************
    // Assign Training Table
    //************************************************************
    echo "<h2>AssignTraining Table</h2></h2>";
    echo "<table class='table table-striped'>";
    echo "<tr><th>PlayerID</th><th>ManagerID</th><th>TrainingName</th></tr>";

    class TableRows extends RecursiveIteratorIterator
    {
        public function __construct($it)
        {
            parent::__construct($it, self::LEAVES_ONLY);
        }

        public function current()
        {
            return "<td style='width:150px;border:1px solid black;'>" . parent::current(). "</td>";
        }

        public function beginChildren()
        {
            echo "<tr>";
        }

        public function endChildren()
        {
            echo "</tr>" . "\n";
        }
    }

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare("SELECT * FROM AssignTraining");
        $stmt->execute();

        // set the resulting array to associative
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        foreach (new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
            echo $v;
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    $conn = null;
    echo "</table>";

    //************************************************************
    // Game Table
    //************************************************************
    echo "<h2>Game Table</h2></h2>";
    echo "<table class='table table-striped'>";
    echo "<tr><th>GameID</th><th>Date</th><th>Result</th><th>PlayingVenue</th><th>OpponentTeam</th></tr>";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare("SELECT * FROM Game");
        $stmt->execute();

        // set the resulting array to associative
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        foreach (new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
            echo $v;
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    $conn = null;
    echo "</table>";

    //************************************************************
    // Manager Table
    //************************************************************
    echo "<h2>Manager Table</h2></h2>";
    echo "<table class='table table-striped'>";
    echo "<tr><th>ID</th><th>LoginID</th><th>Name</th><th>Password</th><th>Birthday</th><th>Address</th><th>Email</th><th>PhoneNumber</th></tr>";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare("SELECT * FROM Manager");
        $stmt->execute();

        // set the resulting array to associative
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        foreach (new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
            echo $v;
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    $conn = null;
    echo "</table>";

    //************************************************************
    // Manager Certificate Table
    //************************************************************
    echo "<h2>Manager Certificate Table</h2></h2>";
    echo "<table class='table table-striped'>";
    echo "<tr><th>ManagerID</th><th>CertificateID</th><th>Certificate</th></tr>";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare("SELECT * FROM ManagerCertificate");
        $stmt->execute();

        // set the resulting array to associative
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        foreach (new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
            echo $v;
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    $conn = null;
    echo "</table>";

    //************************************************************
    // Play Table
    //************************************************************
    echo "<h2>Play Table</h2></h2>";
    echo "<table class='table table-striped'>";
    echo "<tr><th>PlayerID</th><th>GameID</th></tr>";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare("SELECT * FROM Play");
        $stmt->execute();

        // set the resulting array to associative
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        foreach (new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
            echo $v;
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    $conn = null;
    echo "</table>";

    //************************************************************
    // Player Table
    //************************************************************
    echo "<h2>Player Table</h2></h2>";
    echo "<table class='table table-striped'>";
    echo "<tr><th>ID</th><th>LoginID</th><th>Name</th><th>Password</th><th>Birthday</th><th>Address</th><th>Email</th><th>PhoneNumber</th><th>PlayPos</th></tr>";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare("SELECT * FROM Player");
        $stmt->execute();

        // set the resulting array to associative
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        foreach (new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
            echo $v;
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    $conn = null;
    echo "</table>";

    //************************************************************
    // Staff Table
    //************************************************************
    echo "<h2>Staff Table</h2></h2>";
    echo "<table class='table table-striped'>";
    echo "<tr><th>ID</th><th>Name</th><th>Birthday</th><th>Address</th><th>Email</th><th>PhoneNumber</th><th>Title</th></tr>";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare("SELECT * FROM Staff");
        $stmt->execute();

        // set the resulting array to associative
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        foreach (new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
            echo $v;
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    $conn = null;
    echo "</table>";

    //************************************************************
    // Stats Table
    //************************************************************
    echo "<h2>Stats Table</h2></h2>";
    echo "<table class='table table-striped'>";
    echo "<tr><th>PlayerID</th><th>Year</th><th>TotalPoints</th><th>ASPG</th></tr>";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare("SELECT * FROM Stats");
        $stmt->execute();

        // set the resulting array to associative
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        foreach (new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
            echo $v;
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    $conn = null;
    echo "</table>";

    //************************************************************
    // Training Table
    //************************************************************
    echo "<h2>Training Table</h2></h2>";
    echo "<table class='table table-striped'>";
    echo "<tr><th>TrainingName</th><th>Instruction</th><th>TimePeriodInHour</th></tr>";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare("SELECT * FROM Training");
        $stmt->execute();

        // set the resulting array to associative
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        foreach (new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
            echo $v;
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    $conn = null;
    echo "</table>";

    //************************************************************
    // GameView View
    //************************************************************
    echo "<h2>GameView View</h2></h2>";
    echo "<table class='table table-striped'>";
    echo "<tr><th>Date</th><th>PlayingVenue</th><th>OpponentTeam</th><th>Result</th></tr>";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare("SELECT * FROM GameView");
        $stmt->execute();

        // set the resulting array to associative
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        foreach (new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
            echo $v;
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    $conn = null;
    echo "</table>";

    //************************************************************
    // ManagerView View
    //************************************************************
    echo "<h2>ManagerView View</h2></h2>";
    echo "<table class='table table-striped'>";
    echo "<tr><th>ID</th><th>LoginID</th><th>Name</th><th>Password</th><th>Birthday</th><th>Address</th><th>Email</th><th>PhoneNumber</th><th>ManagerID</th><th>CertificateID</th><th>Certificate</th></tr>";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare("SELECT * FROM ManagerView");
        $stmt->execute();

        // set the resulting array to associative
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        foreach (new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
            echo $v;
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    $conn = null;
    echo "</table>";

    //************************************************************
    // PlayerData View
    //************************************************************
    echo "<h2>PlayerData View</h2></h2>";
    echo "<table class='table table-striped'>";
    echo "<tr><th>LoginID</th><th>Name</th><th>Birthday</th><th>Email</th><th>YearForStats</th><th>TotalPoints</th><th>ASPG</th><th>ManagerName</th><th>TrainingName</th></tr>";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare("SELECT * FROM PlayerData");
        $stmt->execute();

        // set the resulting array to associative
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        foreach (new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
            echo $v;
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    $conn = null;
    echo "</table>";

    //************************************************************
    // TrainingView View
    //************************************************************
    echo "<h2>TrainingView View</h2></h2>";
    echo "<table class='table table-striped'>";
    echo "<tr><th>PlayerName</th><th>TrainingName</th><th>ManagerName</th></tr>";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare("SELECT * FROM TrainingView");
        $stmt->execute();

        // set the resulting array to associative
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        foreach (new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
            echo $v;
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    $conn = null;
    echo "</table>";

    //END PHP *****************************************************
    ?>

    <?php require 'footer.php';?>
    <?php require 'master_foot.php';?>
  </div>
</body>
