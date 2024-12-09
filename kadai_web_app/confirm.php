<?php
// セッションを開始
session_start();

// POSTリクエストから入力データを取得
$name = $_POST['employee_name'];
$age = $_POST['employee_age'];
$department = $_POST['department'];

 // エラーメッセージを格納する配列
 $errors = []; // 最初はエラーなし

 // お名前のバリデーション
 if (empty($name) ) {
     $errors[] = 'お名前を入力してください。';
 }

 // メールアドレスのバリデーション
 if (empty($age) ) {
     $errors[] = 'ご年齢を入力してください。';
 } 

//  // お問い合わせ内容のバリデーション
//  if (empty($message) ) {
//      $errors[] = 'お問い合わせ内容を入力してください。';
//  } elseif (mb_strlen($message) > 100) {
//      $errors[] = 'お問い合わせ内容が100文字を超えています。';

     // 入力項目に問題なければセッション・クッキーを保存
 if (empty($errors)) {
    // セッション変数を保存
    $_SESSION['name'] = $name;
    $_SESSION['age'] = $age;
    $_SESSION['department'] = $department;

    // クッキーを登録（有効期限は1時間）
    setcookie('name', $name, time() + 3600 );
    setcookie('age', $age, time() + 3600 );
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>社員情報入力フォームを作成しよう</title>
</head>

<body>
    <h2>入力内容をご確認ください。</h2>
    <p>問題なければ「確定」、修正する場合は「キャンセル」をクリックしてください。</p>

    <table border="1">
        <tr>
            <th>項目</th>
            <th>入力内容</th>
        </tr>
        <tr>
            <td>社員名</td>
            <td><?php echo $name; ?></td>
        </tr>
        <tr>
            <td>年齢</td>
            <td><?php echo $age; ?></td>
        </tr>
        <tr>
            <td>所属部署</td>
            <td><?php echo $department; ?></td>
        </tr>
    </table>

    <p>
        <button id="confirm-btn" onclick="location.href='complete.php';">確定</button>
        <button id="cancel-btn" onclick="history.back();">キャンセル</button>
    </p>
     <?php
     // 入力項目にエラーがある場合の処理
     if (!empty($errors)) {
         // 配列内のエラーメッセージを順番に出力
         foreach ($errors as $error) {
             echo '<font color="red">' . $error . '</font>' . '<br>';
         }
 
         // 確定ボタンを無効化するJavaScriptコードをブラウザ側に送信
         echo '<script> document.getElementById("confirm-btn").disabled = true; </script>';
     }
     ?>
</body>

</html>