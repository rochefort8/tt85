<?php
/*
 * Copyright(c) 2009 limitlink,Inc. All Rights Reserved.
 * http://limitlink.jp/
 * 文字コード UTF-8
 */
require_once('../application/loader.php');
$view->script('postcode.js');
$view->heading('顧客情報詳細');
$liquid = new Liquid;
?>
<div class="contentcontrol">
	<h1>顧客情報詳細</h1>
	<table class="customertype" cellspacing="0"><tr>
		<td><a href="index.php">個人</a></td>
		<td><a class="current" href="company.php">法人</a></td>
	</tr></table>
	<div class="clearer"></div>
</div>
<ul class="operate">
	<li><a href="../history/customer.php?parent=<?=$hash['data']['id']?>">履歴一覧に戻る</a></li>
<?php
if ($view->permitted($hash['category'], 'add')) {
	echo '<li><a href="companyadd.php?id='.$hash['data']['id'].'">複製</a></li>';
	echo '<li><a href="companyedit.php?id='.$hash['data']['id'].'">編集</a></li>';
	echo '<li><a href="companydelete.php?id='.$hash['data']['id'].'">削除</a></li>';
}
?>
</ul>
<table class="view" cellspacing="0">
	<tr><th>会社名</th><td><?=$hash['data']['customer_juniorhighschool']?>&nbsp;</td></tr>
	<tr><th>会社名（かな）</th><td><?=$hash['data']['customer_juniorhighschool']?>&nbsp;</td></tr>
	<tr><th>部署</th><td><?=$hash['data']['customer_couple']?>&nbsp;</td></tr>
	<tr><th>担当者</th><td><?=$hash['data']['customer_lastname']?></td></tr>
	<tr><th>役職</th><td><?=$hash['data']['customer_gender']?></td></tr>
	<tr><th>郵便番号</th><td><?=$hash['data']['customer_postcode']?>&nbsp;</td></tr>
	<tr><th>住所</th><td><?=$hash['data']['customer_address']?>&nbsp;</td></tr>
	<tr><th>住所（かな）</th><td><?=$hash['data']['customer_addressruby']?>&nbsp;</td></tr>
	<tr><th>電話番号</th><td><?=$hash['data']['customer_phone']?>&nbsp;</td></tr>
	<tr><th>FAX</th><td><?=$hash['data']['customer_graduate']?>&nbsp;</td></tr>
	<tr><th>メールアドレス</th><td><?=$hash['data']['customer_email']?>&nbsp;</td></tr>
	<tr><th>URL</th><td><?=$hash['data']['customer_id']?>&nbsp;</td></tr>
	<?=$liquid->view($hash['item'], $hash['data'])?>
	<tr><th>備考</th><td><?=nl2br($hash['data']['customer_comment'])?>&nbsp;</td></tr>
	<tr><th>カテゴリ</th><td><?=$hash['folder']['folder_caption']?>&nbsp;</td></tr>
</table>
<?php
$view->property($hash['data']);
$view->footing();
?>
