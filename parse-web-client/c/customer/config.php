<?php
/*
 * Copyright(c) 2009 limitlink,Inc. All Rights Reserved.
 * http://limitlink.jp/
 * 文字コード UTF-8
 */
require_once('../application/loader.php');
$view->script('customer.js');
$view->heading('顧客情報設定');
$liquid = new Liquid;
if ($_GET['folder'] <= 0 || count($hash['item']) > 0 || count($hash['default']) <= 0) {
	$display[1] = ' style="display:none;"';
	$operator = '標準設定';
} else {
	$display[0] = ' style="display:none;"';
	$operator = '項目の変更';
}
if (!is_array($hash['item']) || count($hash['item']) <= 0) {
	for ($i = 0; $i < 5; $i++) {
		$hash['item'][] = array();
	}
}
?>
<h1>顧客情報設定<?=$view->caption($hash['folder'], array(0=>'トップ / 標準設定'))?></h1>
<ul class="operate">
	<li><a href="index.php<?=$view->parameter(array('folder'=>$_GET['folder']))?>">顧客情報一覧に戻る</a></li>
<?php
if ($_GET['folder'] > 0) {
	echo '<li><span class="operator" onclick="Customer.configdefault(this)">'.$operator.'</span></li>';
}
echo '</ul>';
if (strlen($_GET['folder']) > 0) {
	if ($_GET['folder'] > 0) {
?>
<form class="content" method="post" name="configitemdefault" action=""<?=$display[1]?>>
<?php
		if (is_array($hash['default']) && count($hash['default']) > 0) {
?>
	<table class="formlist" cellspacing="0">
		<tr><th>項目名<?=$view->explain('itemcaption')?></th>
		<th>入力フォーム<?=$view->explain('iteminput')?></th>
		<th>必須</th><th>一覧表示</th><th>順序</th></tr>
		<?=$liquid->configitem($hash['default'], 1)?>
	</table>
<?php
		} else {
			echo '<a href="config.php?folder=0">標準の項目</a>は設定されていません。';
		}
?>
	<div class="submit">
		<input type="submit" value="　設定　" />&nbsp;
		<input type="button" value="キャンセル" onclick="location.href='index.php<?=$view->parameter(array('folder'=>$_GET['folder']))?>'" />&nbsp;
	</div>
	<input type="hidden" name="item_default" value="1" />
</form>
<?php
	}
?>
<form class="content" method="post" name="configitem" action=""<?=$display[0]?>>
<?php
	if ($_GET['folder'] <= 0) {
		echo '<div>このカテゴリの設定は標準の項目として設定されます。';
		$view->explain('itemdefault');
		echo '</div>';
	}
?>
	<?=$view->error($hash['error'])?>
	<table class="formlist" id="configitem" cellspacing="0">
		<tr><th>項目名<?=$view->explain('itemcaption')?></th>
		<th>入力フォーム<?=$view->explain('iteminput')?></th>
		<th>必須</th><th>一覧表示</th><th>順序</th></tr>
		<?=$liquid->configitem($hash['item'])?>
	</table>
	<span class="operator" onclick="Customer.increment(10)">追加</span>
	<span class="operator" onclick="Customer.increment('remove')">削除</span>
	<div class="submit">
		<input type="submit" value="　設定　" />&nbsp;
		<input type="button" value="キャンセル" onclick="location.href='index.php<?=$view->parameter(array('folder'=>$_GET['folder']))?>'" />&nbsp;
	</div>
</form>
<?php
} else {
?>
<table class="list" cellspacing="0" style="width:400px;">
	<tr><th>カテゴリ名</th><th>項目数</th></tr>
	<tr><td><a href="config.php?folder=0">トップ / 標準設定</a></td><td><?=$hash['count'][0]?>&nbsp;</td></tr>
<?php
	if (is_array($hash['folder']) && count($hash['folder']) > 0) {
		foreach ($hash['folder'] as $key => $value) {
?>
	<tr><td><a href="config.php?folder=<?=$key?>"><?=$value?></a>&nbsp;</td>
	<td><?=$hash['count'][$key]?>&nbsp;</td></tr>
<?php
		}
	}
	echo '</table>';
}
$view->footing();
?>