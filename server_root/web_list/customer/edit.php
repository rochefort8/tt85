<?php
/*
 * Copyright(c) 2009 limitlink,Inc. All Rights Reserved.
 * http://limitlink.jp/
 * 文字コード UTF-8
 */
require_once('../application/loader.php');
require_once('./common_view.php');

$view->script('postcode.js');
$view->heading('顧客情報編集');
$hash['folder'] = array('&nbsp;') + $hash['folder'];
if (intval($hash['data']['customer_role']) > 0) {
	$belong = $helper->checkbox('customer_role', intval($hash['data']['customer_role']), intval($hash['data']['customer_role']), 'customer_role', 'リンク');
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
		<tr><th>ID</th><td><?=$hash['data']['customer_id']?></td></tr>

		<tr><th>姓<span class="necessary">(必須)</span></th><td><input type="text" name="customer_lastname" class="inputvalue" value="<?=$hash['data']['customer_lastname']?>" /></td></tr>
		<tr><th>名<span class="necessary">(必須)</span></th><td><input type="text" name="customer_firstname" class="inputvalue" value="<?=$hash['data']['customer_firstname']?>" /></td></tr>
		<tr><th>かな</th><td><input type="text" name="customer_lastname_ruby" class="inputvalue" value="<?=$hash['data']['customer_lastname_ruby']?>" /></td></tr>
		<tr><th>かな</th><td><input type="text" name="customer_firstname_ruby" class="inputvalue" value="<?=$hash['data']['customer_firstname_ruby']?>" /></td></tr>

		<tr><th>性別</th><td><?php echo display_gender_list($hash['data']['customer_gender']); ?></td></tr>

		<tr><th>卒業期</th><td><?php echo display_graduate_list($hash['data']['customer_graduate']); ?></td></tr>

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

		<tr><th>役割</th><td><?php echo display_role($hash['data']['customer_role']); ?></td></tr>
		<tr><th>夫婦</th><td><input type="text" name="customer_couple" class="inputvalue" value="<?=$hash['data']['customer_couple']?>" /></td></tr>
		<tr><th>年会費</th><td><input type="text" name="customer_annualfee" class="inputvalue" value="<?=$hash['data']['customer_annualfee']?>" /></td></tr>
		<tr><th>懇親会</th><td><input type="text" name="customer_party" class="inputvalue" value="<?=$hash['data']['customer_party']?>" /></td></tr>
		<tr><th>備考</th><td><textarea name="customer_comment" class="inputcomment" rows="5"><?=$hash['data']['customer_comment']?></textarea></td></tr>
		<tr><th>カテゴリ</th><td><?=$helper->selector('folder_id', $hash['folder'], $hash['data']['folder_id'])?></td></tr>
		<tr><th>ID</th><td><input type="text" name="customer_id" class="inputvalue" value="<?=$hash['data']['customer_id']?>" /></td></tr>	

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

