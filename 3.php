<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>第1月曜日を求めたい</title>
</head>
<body>
<?php
echo '<p>2009年8月の第1月曜日を計算する</p>';

$year = 2019;
$month = 8;
$week = 1;
$weekday = 1;  // 月曜日

echo '<ul>';
echo '<li>年： ' . $year . '</li>';
echo '<li>月： ' . $month . '</li>';
echo '<li>週番号： ' . $week . '</li>';
echo '<li>曜日、0（日曜）から6（土曜）： ' . $weekday . '</li>';
echo '</ul>';

echo '<p>計算結果： ';
$ret = getNthWeekday($year, $month, $week, $weekday);
if ($ret !== FALSE) {
  echo $ret . '日';
} else {
  echo '該当する日付は存在しません';
}
echo '</p>';
echo '<p>2009年8月の第1月曜日を計算する</p>';

$year = 2019;
$month = 8;
$week = 3;
$weekday = 3;  // 月曜日

echo '<ul>';
echo '<li>年： ' . $year . '</li>';
echo '<li>月： ' . $month . '</li>';
echo '<li>週番号： ' . $week . '</li>';
echo '<li>曜日、0（日曜）から6（土曜）： ' . $weekday . '</li>';
echo '</ul>';

echo '<p>計算結果： ';
$ret = getNthWeekday($year, $month, $week, $weekday);
if ($ret !== FALSE) {
  echo $ret . '日';
} else {
  echo '該当する日付は存在しません';
}
echo '</p>';
# getNthWeekday()関数
# 指定年月の第○番目の○曜日の日付を返します。該当する日付が存在しない場合は
# FALSEを返します。
# 第1引数には年を指定します。
# 第2引数には月を指定します。
# 第3引数には週番号（第○週目）を指定します。
# 第4引数には曜日を0（日曜）から6（土曜）の数値で指定します。
function getNthWeekday($year, $month, $week, $weekday) {
  // 週の指定が正しいか判定
  if ($week < 1 || $week > 5) {
    return FALSE;
  }
  // 曜日の指定が正しいか判定
  if ($weekday < 0 || $weekday > 6) {
    return FALSE;
  }

# 指定した年月の月初日（1日）の曜日を取得します。
  $weekdayOfFirst =  (int) date('w', mktime(0, 0, 0, $month, 1, $year));

# 月初日の曜日を元にして第1○曜日の日付を求めます。
  $firstDay = $weekday - $weekdayOfFirst + 1;
  if ($firstDay <= 0) {
    $firstDay += 7;
  }

# 第1○曜日に7の倍数を加算して、第○週の○曜日の日付を求めます。
  $resultDay = $firstDay + 7 * ($week - 1);

# 最後に計算結果が妥当な日付かどうかチェックします。
  if (!checkdate($month, $resultDay, $year)) {
    return FALSE;
  }

  return $resultDay;
}
?>
</body>
</html>
