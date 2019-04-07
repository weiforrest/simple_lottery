<?php
header('Content-type:text/json;charset=utf-8');
$dbms ="mysql";
$host='localhost';
$dbName="lottery";
$user="root";
$pass="";
$dsn="$dbms:host=$host;dbname=$dbName";

$telphone = trim($_REQUEST['telphone']);
$dbh = new PDO($dsn,$user,$pass);

$statement = $dbh->prepare('UPDATE `lottery` set `isset`=1 WHERE `telphone`=:telphone');
$statement->execute(["telphone" => $telphone]);
$result = $statement->rowCount();


if($result){
    echo json_encode(["ok"=> "200"]);
} else{
    echo json_encode(["error" => "404"]);
}
