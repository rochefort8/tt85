<?php
/*
 * Copyright(c) 2009 limitlink,Inc. All Rights Reserved.
 * http://limitlink.jp/
 * 文字コード UTF-8
 */
require_once('../application/loader.php');
require_once('./graduate_list.php');

$view->script('postcode.js');
$view->heading('顧客情報編集');
$hash['folder'] = array('&nbsp;') + $hash['folder'];
if (intval($hash['data']['customer_parent']) > 0) {
	$belong = $helper->checkbox('customer_parent', intval($hash['data']['customer_parent']), intval($hash['data']['customer_parent']), 'customer_parent', 'リンク');
}
$liquid = new Liquid;
?>
<div class="contentcontrol">
	<h1>顧客情報編集</h1>
	<table class="customertype" cellspacing="0"><tr>
		<td><a class="current" href="index.php">個人</a></td>
		<td><a href="company.php">法人</a></td>
	</tr></table>
	<div class="clearer"></div>
</div>
<ul class="operate">
	<li><a href="index.php<?=$view->positive(array('folder'=>$hash['data']['folder_id']))?>">一覧に戻る</a></li>
	<li><a href="add.php?id=<?=$hash['data']['id']?>">複製</a></li>
	<li><a href="delete.php?id=<?=$hash['data']['id']?>">削除</a></li>
</ul>
<form class="content" method="post" name="customer" action="">
	<?=$view->error($hash['error'])?>
	<table class="form" cellspacing="0">
		<tr><th>名前<span class="necessary">(必須)</span></th><td><input type="text" name="customer_name" class="inputvalue" value="<?=$hash['data']['customer_name']?>" /></td></tr>
		<tr><th>かな</th><td><input type="text" name="customer_ruby" class="inputvalue" value="<?=$hash['data']['customer_ruby']?>" /></td></tr>
		<tr><th>卒業期</th><td><?php echo display_graduate_list($hash['data']['customer_graduate']); ?></td></tr>
<!---
		<tr><th>卒業期</th><td><input type="text" name="customer_graduate" class="inputalpha" value="<?=$hash['data']['customer_graduate']?>" /></td></tr>
--->
		<tr><th>メールアドレス</th><td><input type="text" name="customer_email" class="inputvalue" value="<?=$hash['data']['customer_email']?>" /></td></tr>		<tr><th>郵便番号</th><td>
			<input type="text" name="customer_postcode" id="postcode" class="inputalpha" value="<?=$hash['data']['customer_postcode']?>" />&nbsp;
			<input type="button" value="検索" onclick="Postcode.feed(this)" />
		</td></tr>
		<tr><th>住所</th><td>
			<input type="text" name="customer_address" id="address" class="inputtitle" value="<?=$hash['data']['customer_address']?>" />&nbsp;
			<input type="button" value="検索" onclick="Postcode.feed(this, 'address')" />
		</td></tr>
		<tr><th>住所（かな）</th><td><input type="text" name="customer_addressruby" id="addressruby" class="inputtitle" value="<?=$hash['data']['customer_addressruby']?>" /></td></tr>
		<tr><th>電話番号</th><td><input type="text" name="customer_phone" class="inputalpha" value="<?=$hash['data']['customer_phone']?>" /></td></tr>

		<tr><th>携帯電話番号</th><td><input type="text" name="customer_mobile" class="inputalpha" value="<?=$hash['data']['customer_mobile']?>" /></td></tr>

		<tr><th>出身中学</th><td><?php echo display_juniorhighschool_list($hash['data']['customer_juniorhighschool']) ; ?></td></tr>
		<tr><th>部活動</th><td><?php echo display_club_list($hash['data']['customer_club']) ; ?></td></tr>
		<tr><th>備考</th><td><textarea name="customer_comment" class="inputcomment" rows="5"><?=$hash['data']['customer_comment']?></textarea></td></tr>
		<tr><th>カテゴリ</th><td><?=$helper->selector('folder_id', $hash['folder'], $hash['data']['folder_id'])?></td></tr>
	</table>
	<div class="submit">
		<input type="submit" value="　編集　" />&nbsp;
		<input type="button" value="キャンセル" onclick="location.href='index.php<?=$view->positive(array('folder'=>$hash['data']['folder_id']))?>'" />
	</div>
	<input type="hidden" name="id" value="<?=$hash['data']['id']?>" />
	<input type="hidden" name="customer_type" value="0" />
</form>
<?php
$view->footing();
?>

