<?php
$dbms ="mysql";
$host='localhost';
$dbName="lottery";
$user="root";
$pass="";
$dsn="$dbms:host=$host;dbname=$dbName";

$telphone = trim($_REQUEST['telphone']);
$dbh = new PDO($dsn,$user,$pass);

$statement = $dbh->prepare('SELECT name, isset, theindex FROM lottery WHERE `telphone`=?');
$statement->bindvalue(1,$telphone);
$statement->execute();

$result = $statement->fetch();

if (!$result) {
  echo "请输入正确的抽奖号码";
  exit(0);
}
$name=$result['name'];
$isset=$result['isset'];
if($isset) {
  $repeat = true;
} else {
  $repeat = false;
}
$theindex=$result['theindex'];
$flag = rand(1,10)>5? true:false;
switch($theindex){
  case "1":
    $pathindex = $flag? 0:4;
    $range = "一等奖";
    break;
  case "2":
    $pathindex = $flag? 3:7;
    $range = "二等奖";
    break;
  case "3":
    $pathindex = $flag? 2:6;
    $range = "三等奖";
    break;
  case "4":
    $pathindex = $flag? 1:5;
    $range = "参与奖";
    break;
  }

?>
<!DOCTYPE html>
<html lang="zh">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0,shrink-to-fit=no,user-scalable=no">
  <meta name="apple-mobile-web-app-capable" content="yes"/>
  <meta name="apple-mobile-web-app-status-bar-style" content="black"/>
  <meta name="format-detection" content="telephone=no,email=no"/>
  <meta name="screen-orientation" content="portrait">
    <title>2018年宜春市特警支队"欢乐进警营 快乐迎新春"工会抽奖活动</title>
  <link rel="stylesheet" href="./css/style.css">
</head>
<body style="text-align: center;background-color: #f5f5f5">
  <h4>2018年宜春市特警支队</h4><h4>"欢乐进警营 快乐迎新春"</h4><h4>工会抽奖活动</h4>
  <h6>抽奖号码为：<?php echo $telphone; ?></h6>
  <?php 
  if ($repeat) :?>
  <div>
  <h6>恭喜您!您已经完成抽奖。</h6><h6>抽中<?= $range ?></h6>
  </div>

<?php else:?>

<div class="m-ui-dial"  id="dail">
  <div id="js_pointer" class="pointer">
    <a class="btn" id="btn" href="javascript:;" onclick="lottery.draw()"></a>
  </div>
  </div>
  <div id="response">点击按钮开始抽奖</div>
</body>
<script src="./js/dial.js"></script>
<script>
  var lottery = new LotteryDial(document.getElementById('js_pointer'), { // eslint-disable-line
    speed: 30, // 每帧速度
    areaNumber: 8 // 奖区数量
  });
  lottery.on('start', function () {
    lottery.setResult(<?php echo $pathindex?>);
  });
  lottery.on('end', function () {
    document.getElementById('btn').onclick=null;
    var request= new XMLHttpRequest();
    request.onreadystatechange = function(){
      if(request.readyState === 4) {
          var textarea = document.getElementById('response');
        if (request.status === 200) {
          textarea.innerText = "恭喜您!抽中 <?php echo $range?>";
        } else {
          textarea.value = "网络错误";
        }
      }
    }
    request.open('post',"setdown.php",true);
request.setRequestHeader("Content-type","application/x-www-form-urlencoded")
    request.send("telphone=<?php echo $telphone?>");
  })
</script>
</html>
<?php endif ?>
