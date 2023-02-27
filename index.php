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
  echo "Connected successfully";
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}
