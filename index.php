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

$conn = new mysqli($_ENV['DATABASE_URL'], $_ENV['DATABASE_USERNAME'], $_ENV['DATABASE_PASSWORD']);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";
