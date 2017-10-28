<h1>mySQL test</h1>
<br />
<?php require 'MySqlInfo.php' ?>
<?php

//TRY MySQLi Style (Supported in 5.3.0+ . Currently we are on 5.6+)

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully via MySQLi<br />";

//Select Statement:
$sql = "SELECT * FROM authors a join books b on b.authorID = a.id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table><tr><th>author ID</th><th>Author Name</th><th>Book Name</th></tr>";
    // output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row["id"]."</td><td>".$row["authorName"]."</td><td>".$row["bookName"]."</td></tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}

$conn->close();

?>

 <?php require 'footer.php';?>
