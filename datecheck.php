<?php
require_once("datecheck.php");

// 日付計算関数を使わずに、日付（西暦）の妥当性チェックをする
// check_date関数
//↓以下使用禁止
//https://www.php.net/manual/ja/book.datetime.php
//正規表現

//＊＊日付のチェック内容＊＊
//①数字のみ8桁、もしくは、ハイフンまたはスラッシュ区切り（年-月-日）
//②半角のみ
//③日付として正しいこと
//※

//＊＊サンプルテストケース＊＊
//最低限以下のケースは仕様通りに動作すること。ケースが足りないと思ったら足してもらってOK

$tests = array(
	'2021-05-01'
	,'2021/05/01'
	,'2021-5-1'
	,'2021/5/1'
	,'2021/05/1'
	,'20210501'
	,'20211010'
	,'1/05/01'
	,'1/5/1'
	,'2021/05/31'
	,'2021/10/01'
	,'2021/10/10'
	,'1-1-1'
	,'1-99-1'
	,'2021-04-30'
	,'2021-04-31'
	,'20210431'
	,'2021-12-31'
	,'2021-12-32'
	,'2021@05@01'
	,'２０２１／０５／０１'
	,'0000/00/00'
	,'2021/05/99'
	,'2021/99/99'
	,'2021/05'
	,'2020-02-29'
	,'2021-02-29'
	,'2021/02/29'
	,'2021/09/31'
	,'00000000'
	,'99999999'
	,'00001210'
	);


foreach($tests as $test) { 
	$res = date_parse($test);
	echo $test ."--------->>>>check_date =". check_date($test) . ":: date_parse=".  ((count($res['warnings']) == 0 && $res['error_count']==0) ? "OK" : "NG") . "</br>\n";
}



function check_date($trDate){
	// ここにチェックを実装
	//引数 $trDate：チェックする文字列
	//戻り値 エラーがない場合は"OK" それ以外の場合は"OK"以外

	//var_dump($trDate);
	$len = mb_strlen($trDate, "UTF-8");
    $wdt = mb_strwidth($trDate, "UTF-8");

	if ($len != $wdt) return '半角で入力してください';

	$test_month = array('01', '02', '03', '04', '05', '06', '07', '08', '09', '1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12');
	$test_day = array('01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23', '24', '25', '26', '27', '28', '29', '30', '31', '1', '2', '3', '4', '5', '6', '7', '8', '9');
	
	if (ctype_digit($trDate) && mb_strlen($trDate) == 8) {
		if(mb_substr($trDate, -2) == '00') {
			return 'error';
		} 
		if ((mb_substr($trDate, 4, 2) == '02'
		|| mb_substr($trDate, 4, 2) == '04'
		|| mb_substr($trDate, 4, 2) == '06'
		|| mb_substr($trDate, 4, 2) == '09'
		|| mb_substr($trDate, 4, 2) == '11')
		&& mb_substr($trDate, -2) == '31') {
			return '不正な日付です';	
		} elseif ((mb_substr($trDate, 0, 4) % 4 != 0)
		&& (mb_substr($trDate, 4, 2) == '02' )
		&& (mb_substr($trDate, -2) == '29' || mb_substr($trDate, -2) == '30' || mb_substr($trDate, -2) == '31')) {
			return '不正な日付です';
		} elseif ((mb_substr($trDate, 0, 4) % 4 == 0)
		&& (mb_substr($trDate, 4, 2) == '02')
		&& (mb_substr($trDate, -2) == '30' || mb_substr($trDate, -2) == '31')) {
			return '不正な日付です';
		} else {
			return 'OK';
		}
	}

	$hyphen = str_contains($trDate, '-');
	$slash = str_contains($trDate, '/');

	$explode_hyphen = explode("-", $trDate);
	$explode_slash = explode("/", $trDate);
	

	
	if ($hyphen || $slash) {
		if (mb_strlen($trDate) <= 10 && mb_strlen($trDate) >= 5 && $slash == 2) {
			//var_dump($explode_slash);
			if (isset($explode_slash[1]) && (in_array($explode_slash[1], $test_month))) {
				if (isset($explode_slash[2]) && (in_array($explode_slash[2], $test_day))) {
					if (($explode_slash[1] == '02' || $explode_slash[1] == '2'
					|| $explode_slash[1] == '04' || $explode_slash[1] == '4'
					|| $explode_slash[1] == '06' || $explode_slash[1] == '6'
					|| $explode_slash[1] == '09' || $explode_slash[1] == '9'
					|| $explode_slash[1] == '11')
					&& $explode_slash[2] == '31') {
						return '不正な日付です';	
					} elseif (($explode_slash[0] % 4 != 0)
					&& ($explode_slash[1] == '02' || $explode_slash[1] == '2')
					&& ($explode_slash[2] == '29' || $explode_slash[2] == '30' || $explode_slash[2] == '31')) {
						return '不正な日付です';
					} elseif (($explode_slash[0] % 4 == 0)
					&& ($explode_slash[1] == '02' || $explode_slash[1] == '2')
					&& ($explode_slash[2] == '30' || $explode_slash[2] == '31')) {
						return '不正な日付です';
					}
					else {
						return 'OK';
					}	
				} else {
					return '日にちが不適切な値です';
				}
			} else {
				return '月が不適切な値です';
			}
		} elseif ( mb_strlen($trDate) <= 10 && mb_strlen($trDate) >= 5 && $hyphen == 2 ) {
			if (isset($explode_hyphen[1]) && (in_array($explode_hyphen[1], $test_month))) {
				if (isset($explode_hyphen[2]) &&(in_array($explode_hyphen[2], $test_day))) {
					if (($explode_hyphen[1] == '02' || $explode_hyphen[1] == '2'
					|| $explode_hyphen[1] == '04' || $explode_hyphen[1] == '4'
					|| $explode_hyphen[1] == '06' || $explode_hyphen[1] == '6'
					|| $explode_hyphen[1] == '09' || $explode_hyphen[1] == '9'
					|| $explode_hyphen[1] == '11')
					&& $explode_hyphen[2] == '31') {
						return '不正な日付です';	
					} elseif (($explode_hyphen[0] % 4 != 0)
					&& ($explode_hyphen[1] == '02' || $explode_hyphen[1] == '2')
					&& ($explode_hyphen[2] == '29' || $explode_hyphen[2] == '30' || $explode_hyphen[2] == '31')) {
						return '不正な日付です';
					} elseif (($explode_hyphen[0] % 4 == 0)
					&& ($explode_hyphen[1] == '02' || $explode_hyphen[1] == '2')
					&& ($explode_hyphen[2] == '30' || $explode_hyphen[2] == '31')) {
						return '不正な日付です';
					}
					else return 'OK';
				} else {
					return '日にちが不適切な値です';
				}
			} else {
				return '月が不適切な値です';
			}
			
		}
	}
	
	$testarr = array('-', '/');
	$arr = str_split($trDate);
	for ($i=0; $i < $trDate; $i++) { 
		if (in_array($arr[$i], $testarr)) {
			continue;
		} else {
			return 'エラー';
		}
	}

	
}
