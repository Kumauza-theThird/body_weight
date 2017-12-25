<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>ダッシュ</title>
  </head>
  <body>
<?php
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
        $sql = "SELECT measure_day,body_weight,height FROM daily_data";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        print "記録一覧<br /><br />";
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
  <table border="1">
  <thead>
       <tr>
           <th>測定日</th>
           <th>体重</th>
           <th>身長</th>
       </tr>
   </thead>
   <tbody>
       <?php
       $rec = $stmt->fetchALL();
       foreach($rec as $key => $value)
      {
        echo '<tr>';
        echo '<td>'.$value['measure_day']. '</td>';
        echo '<td>'.$value['body_weight']. '</td>';
        echo '<td>'.$value['height']. '</td>';
        echo '</tr>';
       }
       ?>
     </tbody>
 </table>
  </body>
</html>
