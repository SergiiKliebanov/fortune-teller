<?php
require __DIR__ . '/vendor/autoload.php';
/*
use Cowsayphp\Farm;

header('Content-Type: text/plain');

$text = "Version 2: Set a message by adding ?message=<message here> to the URL";
if(isset($_GET['message']) && $_GET['message'] != '') {
	$text = htmlspecialchars($_GET['message']);
}

$cow = Farm::create(\Cowsayphp\Farm\Cow::class);
echo $cow->say($text);
*/

echo
'
<button name="Donate" onClick="redirect()">
<script type="text/javascript">
	function redirect()
	{
		var url = "https://send.monobank.ua/jar/4bVDCTouxY?&t=custom_data";
		window.location(url);
	}
</script>';

echo "<table style='border: solid 1px black;'>";
echo "<tr><th>donator</th><th>amount</th><th>curse_id</th><th>curse_text</th></tr>";

class TableRows extends RecursiveIteratorIterator {
  function __construct($it) {
    parent::__construct($it, self::LEAVES_ONLY);
  }

  function current() {
    return "<td style='width:150px;border:1px solid black;'>" . parent::current(). "</td>";
  }

  function beginChildren() {
    echo "<tr>";
  }

  function endChildren() {
    echo "</tr>" . "\n";
  }
}


$options = [
	\PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT => 'false' 
];

try {
  // $conn = new PDO($_ENV['DATABASE_URL'], $_ENV['DATABASE_USERNAME'], $_ENV['DATABASE_PASSWORD'],$options);
  $conn = new PDO("mysql:host=" . $_ENV['DATABASE_HOSTNAME'] . 
		  ";dbname=" . $_ENV['DATABASE_DATABASE'] .
		  ";port=" . $_ENV['DATABASE_PORT'], 
		  $_ENV['DATABASE_USERNAME'], 
		  $_ENV['DATABASE_PASSWORD'],
		  $options);
	
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $stmt = $conn->prepare("SELECT d.donator, d.amount, d.curse_id, c.text as curse_text FROM donations d join curses c on c.id = d.curse_id");
  $stmt->execute();
  $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
  foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
    echo $v;
  }
} catch(PDOException $e) {
  echo "Error: " . $e->getMessage();
}
$conn = null;
echo "</table>";
