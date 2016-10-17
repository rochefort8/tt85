<?php
/*
 * Copyright(c) 2009 limitlink,Inc. All Rights Reserved.
 * http://limitlink.jp/
 * 文字コード UTF-8
 */
require_once('../application/loader.php');
$view->heading('履歴');
$pagination = new Pagination(array('type'=>$_GET['type'], 'folder'=>$_GET['folder']));
$current[intval($_GET['type'])] = ' class="current"';
if ($_GET['type'] == 1) {
	$caption = '会社名';
} else {
	$caption = '名前';
}
if (count($hash['list']) <= 0) {
	$attribute = ' onclick="alert(\'出力するデータがありません。\');return false;"';
}
$liquid = new Liquid;
?>
<div class="contentcontrol">
	<h1>履歴<?=$view->caption($hash['folder'])?></h1>
	<table class="customertype" cellspacing="0"><tr>
		<td><a<?=$current[0]?> href="index.php">個人</a></td>
		<td><a<?=$current[1]?> href="index.php?type=1">法人</a></td>
	</tr></table>
	<div class="clearer"></div>
</div>
<ul class="operate">
	<li><a href="csv.php<?=$view->parameter(array('sort'=>$_GET['sort'], 'desc'=>$_GET['desc'], 'search'=>$_GET['search'], 'type'=>$_GET['type'], 'folder'=>$_GET['folder']))?>"<?=$attribute?>>CSV出力</a></li>
<?php
if ($view->authorize('administrator', 'manager')) {
	echo '<li><a href="config.php?folder='.intval($_GET['folder']).'">履歴設定</a></li>';
}
?>
</ul>
<?=$view->searchform(array('type'=>$_GET['type'], 'folder'=>$_GET['folder']))?>
<table class="content" cellspacing="0"><tr><td class="contentfolder">
	<div class="folder">
		<div class="foldercaption">カテゴリ</div>
		<ul class="folderlist">
<?php
$currentfolder[intval($_GET['folder'])] = ' class="current"';
echo '<li'.$currentfolder[0].'><a href="index.php'.$view->parameter(array('type'=>$_GET['type'])).'">トップ</a></li>';
if (is_array($hash['folder']) && count($hash['folder']) > 0) {
	foreach ($hash['folder'] as $key => $value) {
		echo '<li'.$currentfolder[$key].'><a href="index.php'.$view->parameter(array('type'=>$_GET['type'], 'folder'=>$key)).'">'.$value.'</a></li>';
	}
}
echo '</ul>';
if ($view->authorize('administrator', 'manager', 'editor')) {
	echo '<div class="folderoperate"><a href="../category/?type=customer">編集</a></div>';
}
?>
	</div>
</td><td>
	<table class="list" cellspacing="0">
		<tr><th><?=$pagination->sortby('customer_lastname', $caption)?></th>
		<?=$liquid->listheader($hash['item'], $pagination)?>
		<th class="listlink">&nbsp;</th></tr>
<?php
if (is_array($hash['list']) && count($hash['list']) > 0) {
	foreach ($hash['list'] as $row) {
?>
		<tr><td><a href="customer.php?parent=<?=$row['customer_id']?>"><?=$row['customer_lastname']?></a>&nbsp;</td>
		<?=$liquid->listcontent($hash['item'], $row)?>
		<td><a href="view.php?id=<?=$row['id']?>">詳細</a></td></tr>
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
