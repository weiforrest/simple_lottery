<?php
//header('Content-type:text/html;charset=utf-8');
$dbms ="mysql";
$host='localhost';
$dbName="lottery";
$user="root";
$pass="";
$dsn="$dbms:host=$host;dbname=$dbName";

$telphone = trim($_REQUEST['telphone']);
$dbh = new PDO($dsn,$user,$pass,
array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));

$statement = $dbh->prepare('SELECT name FROM lottery WHERE telphone=:telphone');
$statement->execute(["telphone"=>$telphone]);

$result = $statement->fetch();

if ($result["name"]) {
	$date["name"] = $result["name"];
	$date["status"] = "OK";
    echo json_encode($date);
}else{
    echo 1;
}
