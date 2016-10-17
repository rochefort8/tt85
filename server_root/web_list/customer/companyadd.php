<?php
/*
 * Copyright(c) 2009 limitlink,Inc. All Rights Reserved.
 * http://limitlink.jp/
 * 文字コード UTF-8
 */
require_once('../application/loader.php');
$view->script('postcode.js');
$view->heading('顧客追加');
$hash['data']['folder_id'] = $view->initialize($hash['data']['folder_id'], intval($_GET['folder']));
$hash['folder'] = array('&nbsp;') + $hash['folder'];
$liquid = new Liquid;
?>
<div class="contentcontrol">
	<h1>顧客追加</h1>
	<table class="customertype" cellspacing="0"><tr>
		<td><a href="index.php">個人</a></td>
		<td><a class="current" href="company.php">法人</a></td>
	</tr></table>
	<div class="clearer"></div>
</div>
<ul class="operate">
	<li><a href="company.php<?=$view->parameter(array('folder'=>$_GET['folder']))?>">一覧に戻る</a></li>
</ul>
<form class="content" method="post" name="customer" action="">
	<?=$view->error($hash['error'])?>
	<table class="form" cellspacing="0">
		<tr><th>会社名<span class="necessary">(必須)</span></th><td><input type="text" name="customer_juniorhighschool" class="inputvalue" value="<?=$hash['data']['customer_juniorhighschool']?>" /></td></tr>
		<tr><th>会社名（かな）</th><td><input type="text" name="customer_juniorhighschool" class="inputvalue" value="<?=$hash['data']['customer_juniorhighschool']?>" /></td></tr>
		<tr><th>部署</th><td><input type="text" name="customer_couple" class="inputvalue" value="<?=$hash['data']['customer_couple']?>" /></td></tr>
		<tr><th>担当者</th><td><input type="text" name="customer_lastname" class="inputvalue" value="<?=$hash['data']['customer_lastname']?>" /></td></tr>
		<tr><th>役職</th><td><input type="text" name="customer_gender" class="inputvalue" value="<?=$hash['data']['customer_gender']?>" /></td></tr>
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
		<tr><th>URL</th><td><input type="text" name="customer_id" class="inputvalue" value="<?=$hash['data']['customer_id']?>" /></td></tr>
		<?=$liquid->form($hash['item'], $hash['data'])?>
		<tr><th>備考</th><td><textarea name="customer_comment" class="inputcomment" rows="5"><?=$hash['data']['customer_comment']?></textarea></td></tr>
		<tr><th>カテゴリ</th><td><?=$helper->selector('folder_id', $hash['folder'], $hash['data']['folder_id'])?></td></tr>
	</table>
	<div class="submit">
		<input type="submit" value="　追加　" />&nbsp;
		<input type="button" value="キャンセル" onclick="location.href='company.php<?=$view->parameter(array('folder'=>$_GET['folder']))?>'" />
	</div>
	<input type="hidden" name="customer_type" value="1" />
</form>
<?php
$view->footing();
?>
