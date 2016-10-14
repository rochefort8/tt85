<?php
/*
 * Copyright(c) 2009 limitlink,Inc. All Rights Reserved.
 * http://limitlink.jp/
 * 文字コード UTF-8
 */
require_once('../application/loader.php');
$view->heading('履歴');
$pagination = new Pagination(array('parent'=>$_GET['parent']));
$current[intval($hash['parent']['customer_type'])] = ' class="current"';
if ($hash['parent']['customer_type'] == 1) {
	$location = array('company.php', 'companyview.php');
} else {
	$location = array('index.php', 'view.php');
}
$liquid = new Liquid;
?>
<div class="contentcontrol">
	<h1>履歴</h1>
	<table class="customertype" cellspacing="0"><tr>
		<td><a<?=$current[0]?> href="index.php">個人</a></td>
	</tr></table>
	<div class="clearer"></div>
</div>
<ul class="operate">
	<li><a href="../customer/<?=$location[0]?><?=$view->positive(array('folder'=>$hash['parent']['folder_id']))?>">一覧に戻る</a></li>
	<li><a href="../customer/<?=$location[1]?>?id=<?=intval($_GET['parent'])?>">顧客詳細</a></li>
</ul>
<table class="view" cellspacing="0" style="margin-bottom:20px;">
<?php
if ($hash['parent']['customer_type'] == 1) {
?>
	<tr><th>会社名</th><td><?=$hash['parent']['customer_juniorhighschool']?>&nbsp;</td></tr>
	<tr><th>部署</th><td><?=$hash['parent']['customer_couple']?>&nbsp;</td></tr>
	<tr><th>担当者</th><td><?=$hash['parent']['customer_name']?>&nbsp;</td></tr>
<?php
} else {
?>
	<tr><th>名前</th><td><?=$hash['parent']['customer_name']?>&nbsp;</td></tr>
<?php
}
?>
	<tr><th>郵便番号</th><td><?=$hash['parent']['customer_postcode']?>&nbsp;</td></tr>
	<tr><th>住所</th><td><?=$hash['parent']['customer_address']?>&nbsp;</td></tr>
	<tr><th>電話番号</th><td><?=$hash['parent']['customer_phone']?>&nbsp;</td></tr>
	<tr><th>メールアドレス</th><td><?=$hash['parent']['customer_email']?>&nbsp;</td></tr>
</table>

<?php
if (is_array($hash['item']) && count($hash['item']) > 0) {
	echo '<ul class="operate">';
	if ($view->permitted($hash['category'], 'add')) {
		echo '<li><a href="add.php'.$view->parameter(array('parent'=>$_GET['parent'])).'">履歴追加</a></li>';
	}
	if (count($hash['list']) <= 0) {
		$attribute = ' onclick="alert(\'出力するデータがありません。\');return false;"';
	}
?>
	<li><a href="csv.php<?=$view->parameter(array('sort'=>$_GET['sort'], 'desc'=>$_GET['desc'], 'search'=>$_GET['search'], 'parent'=>$_GET['parent']))?>"<?=$attribute?>>CSV出力</a></li>
<?php
if ($view->authorize('administrator', 'manager')) {
	echo '<li><a href="config.php?folder='.intval($hash['parent']['folder_id']).'">履歴設定</a></li>';
}
?>
</ul>
<?=$view->searchform(array('parent'=>$_GET['parent']))?>
<table class="list" cellspacing="0">
	<tr><?=$liquid->listheader($hash['item'], $pagination)?>
	<th class="listlink">&nbsp;</th></tr>
<?php
	if (is_array($hash['list']) && count($hash['list']) > 0) {
		foreach ($hash['list'] as $row) {
			echo '<tr>'.$liquid->listcontent($hash['item'], $row).'<td><a href="view.php?id='.$row['id'].'">詳細</a></td></tr>';
		}
	}
	echo '</table>';
	echo $view->pagination($pagination, $hash['count']);
} else {
?>
<ul class="operate">
<?php
if ($view->authorize('administrator', 'manager')) {
	echo '<li><a href="config.php?folder='.intval($hash['parent']['folder_id']).'">履歴設定</a></li>';
}
?>
</ul>
<div class="content">履歴の項目が設定されていません。</div>
<?php
}
$view->footing();
?>
