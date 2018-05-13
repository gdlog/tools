<?php

/*
外部URLからデータを拾ってきて、自分のサーバーのDBに入れるプログラムサンプル

手順
1:データを拾ってきて、DBに入れやすい形に整える
2:DB接続する
3:DBにインサート
4:DB接続解除

*/

/* 1:データを拾ってきて、DBに入れやすい形に整える
メモ：
データをまとめて処理したいので、SQLの構文に合わせて
カラム名（$col_names）とバリュー($values)を変数にしておきます

サンプル：外部ブログのRSSからデータを引っ張ってきて、自分のサーバーのDBに入れる(easy)
*/
$RSSpath = "URL"; 
$XML = simplexml_load_file ( $RSSpath );
 

$col_names = "title,body,publication_date";
$values = "";

$i = 0;
foreach ( $XML->entry as $entry ) {
	if($i == 0){
		//1個目は , を入れない
		$values .= "('".$entry->body."','".$entry->body."', '".$entry->publication_date."')";
	}else{
		$values .= " , ('".$entry->body."','".$entry->body."', '".$entry->publication_date."')";
	}
	
}



/* 2.DB接続 */
$link = mysql_connect('ip_adress', 'id', 'pass');

if (!$link) {
die('接続失敗です。'.mysql_error());
}

$db_selected = mysql_select_db('table_name', $link);
if (!$db_selected){
die('データベース選択失敗です。'.mysql_error());
}

mysql_set_charset('utf8');




/*  3:DBにインサート
 メモ
Insert文の書き方
INSERT INTO tbl_name (col_name1, col_name2, ...)
  VALUES (value1, value2, ...), (value1, value2, ...), (value1, value2, ...);

たとえば　create table goods(id int, name varchar(10), price int); で作られた
テーブル、goods に複数データを入れる場合は,
INSERT INTO goods (id, name) VALUES (1, '花瓶'), (2, '財布'), (3, '時計');
などと書きます

データをまとめて処理したいので、手順１の部分で
カラム名（$col_names）とバリュー($values)を変数にしておきます
*/

$sql = <<<SQL
insert into テーブル名 ($col_names) values ($values)
SQL;

$result = mysql_query($sql); //Insert実行



/* 4:DB接続解除 */
$close_flag = mysql_close($link);


?>