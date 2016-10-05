<?php
/*
 * Copyright(c) 2009 limitlink,Inc. All Rights Reserved.
 * http://limitlink.jp/
 * 文字コード UTF-8
 */
require_once('../application/loader.php');
$view->heading('履歴削除');
$current[intval($hash['parent']['customer_type'])] = ' class="current"';
$liquid = new Liquid;
?>
<div class="contentcontrol">
	<h1>履歴削除</h1>
	<table class="customertype" cellspacing="0"><tr>
		<td><a<?=$current[0]?> href="index.php">個人</a></td>
		<td><a<?=$current[1]?> href="index.php?type=1">法人</a></td>
	</tr></table>
	<div class="clearer"></div>
</div>
<ul class="operate">
	<li><a href="customer.php<?=$view->parameter(array('parent'=>$hash['parent']['id']))?>">履歴一覧に戻る</a></li>
</ul>
<form class="content" method="post" action="">
	<?=$view->error($hash['error'], '下記の履歴を削除します。')?>
	<table class="view" cellspacing="0">
		<?=$liquid->view($hash['item'], $hash['data'])?>
	</table>
	<?=$view->property($hash['data'])?>
	<div class="submit">
		<input type="submit" value="　削除　" />&nbsp;
		<input type="button" value="キャンセル" onclick="location.href='customer.php<?=$view->positive(array('parent'=>$hash['parent']['id']))?>'" />
	</div>
	<input type="hidden" name="id" value="<?=$hash['data']['id']?>" />
</form>
<?php
$view->footing();
?>