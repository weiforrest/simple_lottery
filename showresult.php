<!doctype html>
<html lang="zh">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>2018年宜春市特警支队"欢乐进警营 快乐迎新春"工会抽奖活动</title>

    <!-- Bootstrap core CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">


    <style>
      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
      html,
body {
  height: 100%;
}

body {
  align-items: center;
  padding-bottom: 40px;
  background-color: #f5f5f5;
}
.result-table{
  width: 100%;
  max-width: 330px;
  padding: 15px;
  margin: auto;
}
    </style>
  </head>
  <body class="text-center">
  <h5>2018年宜春市特警支队</h5><h5>"欢乐进警营 快乐迎新春"</h5><h5>工会抽奖活动公示</h5>
<?php
$dbms ="mysql";
$host='localhost';
$dbName="lottery";
$user="root";
$pass="";
$dsn="$dbms:host=$host;dbname=$dbName";

$dbh = new PDO($dsn,$user,$pass,
array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));

$statement = $dbh->query('SELECT name, theindex FROM lottery WHERE isset=1 AND theindex<4 order by theindex');
?>
<table class="table result-table">
<thead>
    <tr>
        <th scope="col">姓名</th>
        <th scope="col">奖项</th>
    </tr>
</thead>
<tbody>
<?php
while($row = $statement->fetch()){
    switch($row['theindex']){
        case "1":
            $range = "一等奖";
            break;
        case "2":
            $range = "二等奖";
            break;
        case "3":
            $range = "三等奖";
            break;
  }
  echo "<tr><td>".$row['name']."</td><td>".$range."</td></tr>";
}
?>
</tbody>
</table>
</body>
