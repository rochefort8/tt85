<?php
/*
 * Copyright(c) 2009 limitlink,Inc. All Rights Reserved.
 * http://limitlink.jp/
 * 文字コード UTF-8
 */
require_once('../application/loader.php');
$view->script('postcode.js');
$view->heading('顧客情報削除');
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
	<li><a href="company.php<?=$view->positive(array('folder'=>$hash['data']['folder_id']))?>">一覧に戻る</a></li>
</ul>
<form class="content" method="post" action="">
	<?=$view->error($hash['error'], '下記の顧客情報を削除します。')?>
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
		<tr><th>カテゴリ</th><td><?=$hash['folder'][$hash['data']['folder_id']]?>&nbsp;</td></tr>
	</table>
	<?=$view->property($hash['data'])?>
	<div class="submit">
		<input type="submit" value="　削除　" />&nbsp;
		<input type="button" value="キャンセル" onclick="location.href='company.php<?=$view->positive(array('folder'=>$hash['data']['folder_id']))?>'" />
	</div>
	<input type="hidden" name="id" value="<?=$hash['data']['id']?>" />
</form>
<?php
$view->footing();
?>
