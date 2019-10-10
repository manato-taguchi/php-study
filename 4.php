<?php
// 2019/9/2（月）～9/3（火）
$now = new DateTime();
$now->add(DateInterval::createFromDateString('1 month'));
$year = $now->format('Y');
$month = $now->format('m');

// echo $year;
// echo "\n";
// echo $month;
// echo PHP_EOL;

$week = 1;
$weekday = 1;  // 月曜日
$monday_1st = "";

$ret_monday = getNthWeekday($year, $month, $week, $weekday);
if ($ret_monday !== FALSE) {
  $monday_1st = $year . "/" . $month . "/" . $ret_monday . '（月）';
} else {
  echo '該当する日付は存在しません';
}

$weekday = 2;  // 火曜日
$tuesday_1st = "";
$ret_tuesday = getNthWeekday($year, $month, $week, $weekday);
if ($ret_tuesday !== FALSE) {
  $tuesday_1st = $year . "/" . $month . "/" . $ret_tuesday . '（火）';
} else {
  echo '該当する日付は存在しません';
}
// echo PHP_EOL;


/*
<select name="schedule" id="schedule">
    <option value="2019/9/2（月）～9/3（火）" >2019/9/2（月）～9/3（火）</option>
</select>
*/
$html = <<< EOL
<select name="schedule" id="schedule">
    <option value="{$monday_1st}～{$tuesday_1st}" >{$monday_1st}～{$tuesday_1st}</option>
</select>
EOL;
echo $html;
echo "\n\n\n";


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
