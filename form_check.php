<?php
$body_weight = $_POST['body_weight'];
$height = $_POST['height'];

//$body_weight = "a";
//$height = "155";
echo '<form method="post" action="fat.php">';
if (!ctype_digit($body_weight)) {
  echo "数字を入れてください";
}
else {
  echo '<input type="hidden" name="body_weight" value="'.$body_weight.'">';
}

if (!ctype_digit($height)) {
  echo "数字を入れてください";
}
else {
  echo '<input type="hidden" name="body_weight" value="'.$height.'">';
}

echo '<input type="submit" value="OK"><br />';
 ?>
