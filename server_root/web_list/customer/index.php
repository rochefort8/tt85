<?php
/*
 * Copyright(c) 2009 limitlink,Inc. All Rights Reserved.
 * http://limitlink.jp/
 * 文字コード UTF-8
 */
require_once('../application/loader.php');
$view->script('postcode.js');
$view->heading('メンバ');
$pagination = new Pagination(array('folder'=>$_GET['folder']));
$liquid = new Liquid;
?>
<div class="contentcontrol">
	<h1>名簿操作<?=$view->caption($hash['folder'], array('all'=>'すべて表示'))?></h1>
	<table class="customertype" cellspacing="0"><tr>
		<td><a class="current" href="index.php">個人</a></td>
	</tr></table>
	<div class="clearer"></div>
</div>
<ul class="operate">
<?php
if ($view->permitted($hash['category'], 'add')) {
	echo '<li><a href="add.php'.$view->parameter(array('folder'=>$_GET['folder'])).'">新規登録</a></li>';
}
if (count($hash['list']) <= 0) {
	$attribute = ' onclick="alert(\'出力するデータがありません。\');return false;"';
}
?>
	<li><a href="csv.php<?=$view->parameter(array('sort'=>$_GET['sort'], 'desc'=>$_GET['desc'], 'search'=>$_GET['search'], 'folder'=>$_GET['folder'], 'type'=>0))?>"<?=$attribute?>>CSV出力</a></li>
<?php
if ($view->authorize('administrator', 'manager')) {
	echo '<li><a href="config.php?folder='.intval($_GET['folder']).'">顧客設定</a></li>';
}
?>
</ul>

<?=$view->searchform(array('folder'=>$_GET['folder']))?>

<table class="content" cellspacing="0"><tr><td class="contentfolderr">
<!--
	<?=$view->category($hash['folder'], 'customer')?>
-->
</td><td>
	<table class="list" cellspacing="0">
		<tr>
		<th><?=$pagination->sortby('customer_id', 'ID')?></th>
		<th><?=$pagination->sortby('customer_graduate', '卒業期')?></th>
		<th><?=$pagination->sortby('customer_name', '名前')?></th>
		<th><?=$pagination->sortby('customer_ruby', 'かな')?></th>
		<th><?=$pagination->sortby('customer_gender', '性別')?></th>
		<th><?=$pagination->sortby('customer_email', 'メールアドレス')?></th>
		<th><?=$pagination->sortby('customer_postcode', '郵便番号')?></th>
		<th><?=$pagination->sortby('customer_address', '住所')?></th>
		<th><?=$pagination->sortby('customer_phone', '電話番号')?></th>
		<th><?=$pagination->sortby('customer_juniorhighschool', '出身中学')?></th>
		<th><?=$pagination->sortby('customer_club', '部活動')?></th>
		<th><?=$pagination->sortby('customer_role', '役割')?></th>
		<th><?=$pagination->sortby('customer_couple', '夫婦')?></th>
		<th><?=$pagination->sortby('customer_annualfee', '年会費')?></th>
		<th><?=$pagination->sortby('customer_party', '懇親会')?></th>
		<?=$liquid->listheader($hash['item'], $pagination)?></tr>
<?php
if (is_array($hash['list']) && count($hash['list']) > 0) {
	foreach ($hash['list'] as $row) {
?>
		<tr>
		<td><?=$row['customer_id']?>&nbsp;</td>
		<td><?=$row['customer_graduate']?>&nbsp;</td>
		<td><a href="./view.php?id=<?=$row['id']?>"><?=$row['customer_name']?></a>&nbsp;</td>
		<td><?=$row['customer_ruby']?>&nbsp;</td>
		<td><?=$row['customer_gender']?>&nbsp;</td>
		<td><?=$row['customer_email']?>&nbsp;</td>
		<td><?=$row['customer_postcode']?>&nbsp;</td>
		<td><?=$row['customer_address']?>&nbsp;</td>
		<td><?=$row['customer_phone']?>&nbsp;</td>
		<td><?=$row['customer_juniorhighschool']?>&nbsp;</td>
		<td><?=$row['customer_club']?>&nbsp;</td>
		<td><?=$row['customer_role']?>&nbsp;</td>
		<td><?=$row['customer_couple']?>&nbsp;</td>
		<td><?=$row['customer_annualfee']?>&nbsp;</td>
		<td><?=$row['customer_party']?>&nbsp;</td>
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