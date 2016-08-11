<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require 'vendor/autoload.php';

$servername = "192.168.99.100:32785";
$username = "root";
$password = "password";
$dbname = "slides";

$sql_create = "createdatabase.sql";

$app = new \Slim\App;

/**
 * Accepts a $name which it uses to select from the mysql database and return the data
 **/
$app->get('/slide/{name}', function (Request $request, Response $response) {
	global $servername, $dbname, $username, $password;
    $name = $request->getAttribute('name');
	
	$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
	// set the PDO error mode to exception
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	try{
		$row = "";
		$sql = "SELECT data FROM slidedata WHERE name = '{$name}'";
		$stmt = $conn->prepare($sql); 
		$stmt->execute();
		
		$data = "";
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 

		$data = array('data' => $stmt->fetchAll()[0]['data']);
	}
	catch(PDOException $e) {
		$data = array('error' => $e->getMessage());
	}
	
	$unwrapped = json_decode($data['data']);
    
	$response = $response->withJson($unwrapped, 201);

    return $response;
});

/**
 * The content body is placed into the data field. A name is generated and returned on successful inserstion
 **/
$app->put('/createslide/', function (Request $request, Response $response, $args) {
	global $servername, $dbname, $username, $password;
    $body = $request->getBody()->getContents();
	$name = bin2hex(openssl_random_pseudo_bytes(8));
    
    $data = array('name' => $name, 'data' => $body);
	try {
		$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
		// set the PDO error mode to exception
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "INSERT INTO slidedata (name, data) VALUES ('{$name}', '{$body}')";
		// use exec() because no results are returned
		$conn->exec($sql);
		$response = $response->withJson($data, 201);
		}
	catch(PDOException $e)
		{
		$response->withJson(array('error' => $e->getMessage()));
		}
	
	
    return $response;
});

/**
 * Creates the DB
 **/
$app->get('/createdb/', function (Request $request, Response $response) {
	global $servername, $dbname, $username, $password;
    try {
	    $conn = new PDO("mysql:host=$servername", $username, $password);
	    // set the PDO error mode to exception
	    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	    // sql to create table
	    $conn->exec("CREATE DATABASE `{$dbname}`;");

	    echo "Table Database Created Successfully";
	    }
	catch(PDOException $e)
	    {
	    	echo "<br>" . $e->getMessage();
	    }
	$conn = null;
});

/**
 * Creates the tables
 **/
$app->get('/createtables/', function (Request $request, Response $response) {
	global $servername, $dbname, $username, $password, $sql_create;
    try {
	    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
	    // set the PDO error mode to exception
	    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	    // sql to create table
	    $sql = file_get_contents($sql_create);

	    // use exec() because no results are returned
	    $conn->exec($sql);
	    echo "Table Slides Created Successfully";
	    }
	catch(PDOException $e)
	    {
	    	echo "<br>" . $e->getMessage();
	    }
	$conn = null;
});

$app->run();
