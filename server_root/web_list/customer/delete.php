<?php
/*
 * Copyright(c) 2009 limitlink,Inc. All Rights Reserved.
 * http://limitlink.jp/
 * 文字コード UTF-8
 */
require_once('../application/loader.php');
$view->script('postcode.js');
$view->heading('顧客情報削除');
if ($hash['data']['customer_role'] > 0) {
	$hash['data']['customer_juniorhighschool'] = sprintf('<a href="companyview.php?id=%d">%s</a>', $hash['data']['customer_role'], $hash['data']['customer_juniorhighschool']);
}
$liquid = new Liquid;
?>
<div class="contentcontrol">
	<h1>顧客情報削除</h1>
	<table class="customertype" cellspacing="0"><tr>
		<td><a class="current" href="index.php">個人</a></td>
		<td><a href="company.php">法人</a></td>
	</tr></table>
	<div class="clearer"></div>
</div>
<ul class="operate">
	<li><a href="index.php<?=$view->positive(array('folder'=>$hash['data']['folder_id']))?>">一覧に戻る</a></li>
</ul>
<form class="content" method="post" action="">
	<?=$view->error($hash['error'], '下記の顧客情報を削除します。')?>
	<table class="view" cellspacing="0">
		<tr><th>ID</th><td><?=$hash['data']['customer_id']?>&nbsp;</td></tr>
		<tr><th>名前</th><td><?=$hash['data']['customer_lastname']?>&nbsp;</td></tr>
		<tr><th>かな</th><td><?=$hash['data']['customer_lastname_ruby']?>&nbsp;</td></tr>
		<tr><th>性別</th><td><?=$hash['data']['customer_gender']?>&nbsp;</td></tr>
		<tr><th>郵便番号</th><td><?=$hash['data']['customer_postcode']?>&nbsp;</td></tr>
		<tr><th>住所</th><td><?=$hash['data']['customer_address']?>&nbsp;</td></tr>
		<tr><th>住所（かな）</th><td><?=$hash['data']['customer_addressruby']?>&nbsp;</td></tr>
		<tr><th>電話番号</th><td><?=$hash['data']['customer_phone']?>&nbsp;</td></tr>
		<tr><th>FAX</th><td><?=$hash['data']['customer_graduate']?>&nbsp;</td></tr>
		<tr><th>携帯電話番号</th><td><?=$hash['data']['customer_mobile']?>&nbsp;</td></tr>
		<tr><th>メールアドレス</th><td><?=$hash['data']['customer_email']?>&nbsp;</td></tr>
		<tr><th>会社名</th><td><?=$hash['data']['customer_juniorhighschool']?><?=$hash['data']['customer_juniorhighschoolview']?>&nbsp;</td></tr>
		<tr><th>会社名（かな）</th><td><?=$hash['data']['customer_club']?>&nbsp;</td></tr>
		<tr><th>部署</th><td><?=$hash['data']['customer_couple']?>&nbsp;</td></tr>
		<tr><th>役割</th><td><?=$hash['data']['customer_role']?>&nbsp;</td></tr>
		<tr><th>夫婦</th><td><?=$hash['data']['customer_couple']?>&nbsp;</td></tr>
		<?=$liquid->view($hash['item'], $hash['data'])?>
		<tr><th>備考</th><td><?=nl2br($hash['data']['customer_comment'])?>&nbsp;</td></tr>
		<tr><th>カテゴリ</th><td><?=$hash['folder'][$hash['data']['folder_id']]?>&nbsp;</td></tr>
	</table>
	<?=$view->property($hash['data'])?>
	<div class="submit">
		<input type="submit" value="　削除　" />&nbsp;
		<input type="button" value="キャンセル" onclick="location.href='index.php<?=$view->positive(array('folder'=>$hash['data']['folder_id']))?>'" />
	</div>
	<input type="hidden" name="id" value="<?=$hash['data']['id']?>" />
</form>
<?php
$view->footing();
?>
