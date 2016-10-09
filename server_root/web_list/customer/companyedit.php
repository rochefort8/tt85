<?php
/*
 * Copyright(c) 2009 limitlink,Inc. All Rights Reserved.
 * http://limitlink.jp/
 * 文字コード UTF-8
 */
require_once('../application/loader.php');
$view->script('postcode.js');
$view->heading('顧客情報編集');
$hash['folder'] = array('&nbsp;') + $hash['folder'];
$liquid = new Liquid;
?>
<div class="contentcontrol">
	<h1>顧客情報編集</h1>
	<table class="customertype" cellspacing="0"><tr>
		<td><a href="index.php">個人</a></td>
		<td><a class="current" href="company.php">法人</a></td>
	</tr></table>
	<div class="clearer"></div>
</div>
<ul class="operate">
	<li><a href="company.php<?=$view->positive(array('folder'=>$hash['data']['folder_id']))?>">一覧に戻る</a></li>
	<li><a href="companyadd.php?id=<?=$hash['data']['id']?>">複製</a></li>
	<li><a href="companydelete.php?id=<?=$hash['data']['id']?>">削除</a></li>
</ul>
<form class="content" method="post" name="customer" action="">
	<?=$view->error($hash['error'])?>
	<table class="form" cellspacing="0">
		<tr><th>会社名<span class="necessary">(必須)</span></th><td><input type="text" name="customer_juniorhighschool" class="inputvalue" value="<?=$hash['data']['customer_juniorhighschool']?>" /></td></tr>
		<tr><th>会社名（かな）</th><td><input type="text" name="customer_juniorhighschool" class="inputvalue" value="<?=$hash['data']['customer_juniorhighschool']?>" /></td></tr>
		<tr><th>部署</th><td><input type="text" name="customer_department" class="inputvalue" value="<?=$hash['data']['customer_department']?>" /></td></tr>
		<tr><th>担当者</th><td><input type="text" name="customer_name" class="inputvalue" value="<?=$hash['data']['customer_name']?>" /></td></tr>
		<tr><th>役職</th><td><input type="text" name="customer_position" class="inputvalue" value="<?=$hash['data']['customer_position']?>" /></td></tr>
		<tr><th>郵便番号</th><td>
			<input type="text" name="customer_postcode" id="postcode" class="inputalpha" value="<?=$hash['data']['customer_postcode']?>" />&nbsp;
			<input type="button" value="検索" onclick="Postcode.feed(this)" />
		</td></tr>
		<tr><th>住所</th><td>
			<input type="text" name="customer_address" id="address" class="inputtitle" value="<?=$hash['data']['customer_address']?>" />&nbsp;
			<input type="button" value="検索" onclick="Postcode.feed(this, 'address')" />
		</td></tr>
		<tr><th>住所（かな）</th><td><input type="text" name="customer_addressruby" id="addressruby" class="inputtitle" value="<?=$hash['data']['customer_addressruby']?>" /></td></tr>
		<tr><th>電話番号</th><td><input type="text" name="customer_phone" class="inputalpha" value="<?=$hash['data']['customer_phone']?>" /></td></tr>
		<tr><th>FAX</th><td><input type="text" name="customer_graduate" class="inputalpha" value="<?=$hash['data']['customer_graduate']?>" /></td></tr>
		<tr><th>メールアドレス</th><td><input type="text" name="customer_email" class="inputvalue" value="<?=$hash['data']['customer_email']?>" /></td></tr>
		<tr><th>URL</th><td><input type="text" name="customer_url" class="inputvalue" value="<?=$hash['data']['customer_url']?>" /></td></tr>
		<?=$liquid->form($hash['item'], $hash['data'])?>
		<tr><th>備考</th><td><textarea name="customer_comment" class="inputcomment" rows="5"><?=$hash['data']['customer_comment']?></textarea></td></tr>
		<tr><th>カテゴリ</th><td><?=$helper->selector('folder_id', $hash['folder'], $hash['data']['folder_id'])?></td></tr>
	</table>
	<div class="submit">
		<input type="submit" value="　編集　" />&nbsp;
		<input type="button" value="キャンセル" onclick="location.href='company.php<?=$view->positive(array('folder'=>$hash['data']['folder_id']))?>'" />
	</div>
	<input type="hidden" name="id" value="<?=$hash['data']['id']?>" />
	<input type="hidden" name="customer_type" value="1" />
</form>
<?php
$view->footing();
?>
