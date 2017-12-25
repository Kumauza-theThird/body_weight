<?php

$body_weight = $_POST['body_weight'];
$height = $_POST['height'];


try {
    /* リクエストから得たスーパーグローバル変数をチェックするなどの処理 */
    // データベースに接続
    $pdo = new PDO(
        'mysql:dbname=fat;host=localhost;charset=utf8mb4',
        'root',
        '',
        [
          //例外をスローしてくれるらしい
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
          //カラム名をキーとする連想配列で取得するらしい
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]
    );
  /* データベースから値を取ってきたり， データを挿入したりする処理 */
$sql = "INSERT INTO daily_data (measure_day,body_weight,height) VALUES (now(),:body_weight,:height)";
  $stmt = $pdo->prepare($sql);
  $params = array(':body_weight' => $body_weight,':height' => $height);
$stmt->execute($params);
echo '登録完了しました';
} catch (PDOException $e) {
    // エラーが発生した場合は「500 Internal Server Error」でテキストとして表示して終了する
    // - もし手抜きしたくない場合は普通にHTMLの表示を継続する
    // - ここではエラー内容を表示しているが， 実際の商用環境ではログファイルに記録して， Webブラウザには出さないほうが望ましい
    header('Content-Type: text/plain; charset=UTF-8', true, 500);
    exit($e->getMessage());
}
// Webブラウザにこれから表示するものがUTF-8で書かれたHTMLであることを伝える
// (これか <meta charset="utf-8"> の最低限どちらか1つがあればいい． 両方あっても良い．)
header('Content-Type: text/html; charset=utf-8');
?>
<a href="javascript:void(0);" onclick="window.history.back();">戻る</a>
</body>
</html>
