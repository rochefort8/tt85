<?php
/*
 * Copyright(c) 2009 limitlink,Inc. All Rights Reserved.
 * http://limitlink.jp/
 * 文字コード UTF-8
 */
require_once('../application/json.php');
if (is_array($hash['list']) && count($hash['list']) > 0) {
?>
<table class="list" cellspacing="0">
<tr><th>会社名</th><th>郵便番号</th><th>住所</th><th>電話番号</th><th>部署</th></tr>
<?php
	foreach ($hash['list'] as $row) {
?>
	<tr><td>
		<span class="operator" onclick="Customer.set('<?=$row['id']?>', '<?=$row['customer_company']?>', '<?=$row['customer_companyruby']?>', '<?=$row['customer_department']?>', '<?=$row['customer_url']?>')">
		<?=$row['customer_company']?></span>&nbsp;
	</td>
	<td><?=$row['customer_postcode']?>&nbsp;</td>
	<td><?=$row['customer_address']?>&nbsp;</td>
	<td><?=$row['customer_phone']?>&nbsp;</td>
	<td><?=$row['customer_department']?>&nbsp;</td></tr>
<?php
	}
	echo '</table>';
	if ($hash['count'] <= 50) {
		echo '検索結果 '.$hash['count'].' 件';
	} else {
		echo '50件以上のデータが見つかりました。<br />検索条件を絞り込んでください。';
	}
} else {
	echo '検索条件に一致するデータは見つかりませんでした。';
}
?>