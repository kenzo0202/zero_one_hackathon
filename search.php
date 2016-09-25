<?php
//$budget_high = $POST["budget_high"];
//$budget_low = $POST["budget_low"];
//$area = $POST["area"];


//1.  DB接続します
try {
  $pdo = new PDO('mysql:dbname=catcheee_db;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
  exit('データベースに接続できませんでした。'.$e->getMessage());
}

//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM restaurant_table, mid_table, tag_table WHERE area = '$area' AND between '$budget_low' and '$budget_high' AND 1 = mid_table.tag_id AND mid_table.res_id = restaurant_table.id ORDER BY id DESC");
$status = $stmt->execute();

// //２．データ登録SQL作成
// $stmt1 = $pdo1->prepare("SELECT * FROM tag_table where name = 'shibuya'");
// $status1 = $stmt1->execute();


//３データ表示
$view="";
if($status==false){
  //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("ErrorQuery:".$error[2]);
}else{
  //Selectデータの数だけ自動でループしてくれる
  while( $result = $stmt->fetch(PDO::FETCH_ASSOC) ){
    //管理FLGで表示を切り分けたりしてみましょう！！！（追加してください！）
    $view .= '<tr><td>'.$result["id"].'</td><td>'.$result["name"]."</td><td>".$result["area"]."</td><td>".$result["comment"]."</td><td>".$result["chara"]."</td><td>".$result["budget"].'</td></tr>';
  }
 }

 // $view1="";
 // if($status1==false){
 //   //execute（SQL実行時にエラーがある場合）
 //   $error = $stmt1->errorInfo();
 //   exit("ErrorQuery:".$error[2]);
 // }else{
 //   //Selectデータの数だけ自動でループしてくれる
 //   while( $result1 = $stmt1->fetch(PDO::FETCH_ASSOC) ){
 //     //管理FLGで表示を切り分けたりしてみましょう！！！（追加してください！）
 //     $view1 .= '<tr><td>'.$result1["id"].'</td><td>'.$result1["name"]."</td><td>".$result1["area"]."</td><td>".$result1["comment"]."</td><td>".$result1["chara"]."</td><td>".$result1["budget"].'</td></tr>';
 //   }
 //  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Document</title>
</head>
<body>
<table>
 <?=$view?>
</table>
</body>
</html>
