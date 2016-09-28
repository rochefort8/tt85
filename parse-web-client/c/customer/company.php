<?php
/*
 * Copyright(c) 2009 limitlink,Inc. All Rights Reserved.
 * http://limitlink.jp/
 * 文字コード UTF-8
 */
require_once('../application/loader.php');
$view->script('postcode.js');
$view->heading('顧客情報');
$pagination = new Pagination(array('folder'=>$_GET['folder']));
$liquid = new Liquid;
?>
<div class="contentcontrol">
	<h1>顧客情報<?=$view->caption($hash['folder'], array('all'=>'すべて表示'))?></h1>
	<table class="customertype" cellspacing="0"><tr>
		<td><a href="index.php">個人</a></td>
		<td><a class="current" href="company.php">法人</a></td>
	</tr></table>
	<div class="clearer"></div>
</div>
<ul class="operate">
<?php
if ($view->permitted($hash['category'], 'add')) {
	echo '<li><a href="companyadd.php'.$view->parameter(array('folder'=>$_GET['folder'])).'">顧客追加</a></li>';
}
if (count($hash['list']) <= 0) {
	$attribute = ' onclick="alert(\'出力するデータがありません。\');return false;"';
}
?>
	<li><a href="csv.php<?=$view->parameter(array('sort'=>$_GET['sort'], 'desc'=>$_GET['desc'], 'search'=>$_GET['search'], 'folder'=>$_GET['folder'], 'type'=>1))?>"<?=$attribute?>>CSV出力</a></li>
<?php
if ($view->authorize('administrator', 'manager')) {
	echo '<li><a href="config.php?folder='.intval($_GET['folder']).'">顧客設定</a></li>';
}
?>
</ul>
<?=$view->searchform(array('folder'=>$_GET['folder']))?>
<table class="content" cellspacing="0"><tr><td class="contentfolder">
	<?=$view->category($hash['folder'], 'customer', 'company.php')?>
</td><td>
	<table class="list" cellspacing="0">
		<tr><th><?=$pagination->sortby('customer_company', '会社名')?></th>
		<th><?=$pagination->sortby('customer_postcode', '郵便番号')?></th>
		<th><?=$pagination->sortby('customer_address', '住所')?></th>
		<th><?=$pagination->sortby('customer_phone', '電話番号')?></th>
		<?=$liquid->listheader($hash['item'], $pagination)?></tr>
<?php
if (is_array($hash['list']) && count($hash['list']) > 0) {
	foreach ($hash['list'] as $row) {
?>
		<tr><td><a href="../history/customer.php?parent=<?=$row['id']?>"><?=$row['customer_company']?></a>&nbsp;</td>
		<td><?=$row['customer_postcode']?>&nbsp;</td>
		<td><?=$row['customer_address']?>&nbsp;</td>
		<td><?=$row['customer_phone']?>&nbsp;</td>
		<?=$liquid->listcontent($hash['item'], $row)?></tr>
<?php
	}
}
?>
	</table>
	<?=$view->pagination($pagination, $hash['count'])?>
</td></tr></table>
<?php
$view->footing();
?>