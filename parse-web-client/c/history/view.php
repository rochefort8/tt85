<?php
/*
 * Copyright(c) 2009 limitlink,Inc. All Rights Reserved.
 * http://limitlink.jp/
 * 文字コード UTF-8
 */
require_once('../application/loader.php');
$view->heading('履歴詳細');
$current[intval($hash['parent']['customer_type'])] = ' class="current"';
$liquid = new Liquid;
?>
<div class="contentcontrol">
	<h1>履歴詳細</h1>
	<table class="customertype" cellspacing="0"><tr>
		<td><a<?=$current[0]?> href="index.php">個人</a></td>
		<td><a<?=$current[1]?> href="index.php?type=1">法人</a></td>
	</tr></table>
	<div class="clearer"></div>
</div>
<ul class="operate">
	<li><a href="customer.php<?=$view->parameter(array('parent'=>$hash['parent']['id']))?>">履歴一覧に戻る</a></li>
<?php
if ($view->permitted($hash['category'], 'add')) {
	echo '<li><a href="edit.php?id='.$hash['data']['id'].'">編集</a></li>';
	echo '<li><a href="delete.php?id='.$hash['data']['id'].'">削除</a></li>';
}
?>
</ul>
<table class="view" cellspacing="0">
	<?=$liquid->view($hash['item'], $hash['data'])?>
</table>
<?php
$view->property($hash['data']);
$view->footing();
?>