<h1>mySQL test</h1>
<br />
<?php require 'MySqlInfo.php' ?>
<?php


//TRY PDO Style (support for older PHP versions.)
echo "<table style='border: solid 1px black;'>";
echo "<tr><th>Author ID</th><th>Author Name</th><th>Book Name</th></tr>";

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
    $stmt = $conn->prepare("SELECT a.id, authorName, bookName FROM authors a join books b on b.authorID = a.id");
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
?>

 <?php require 'footer.php';?>
