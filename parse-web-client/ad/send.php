<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>送信</title>
</head>
<body>

<?php

// POSTされたデータを取得します。
$text_param1 = isset($_POST["text_param1"])? $_POST["text_param1"] : "";
$text_param2 = isset($_POST["text_param2"])? $_POST["text_param2"] : "";
$text_param3 = isset($_POST["text_param3"])? $_POST["text_param3"] : "";
$text_param4 = isset($_POST["text_param4"])? $_POST["text_param4"] : "";
$text_param5 = isset($_POST["text_param5"])? $_POST["text_param5"] : "";

$file_param1 = isset($_POST["file_param1"])? $_POST["file_param1"] : "";

$file_param1_uploaded_path = isset($_POST["file_param1_uploaded_path"])? $_POST["file_param1_uploaded_path"] : "";

require '../vendor/autoload.php';

date_default_timezone_set('Asia/Tokyo');

use Parse\ParseClient;
use Parse\ParseObject;
use Parse\ParseFile;

ParseClient::initialize(
	'rLfiUPlbIE5orN0Al07gpotnvIpqwTUpoQlkhjO0',
	'LnIgqdYSz8krs6iKBdH5XtGqglkyjzuSEHTnNbEC', 
	'jtNDkVGTpaVeregAuvlTYOUCErbKnSMgE7F6x9Fo'
	);


    $obj = ParseObject::create("Ad");

    $obj->set( "title" , $text_param1 ) ;
    $obj->set( "caption" , $text_param2 ) ;
    $obj->set( "link" , $text_param3 ) ;
    $obj->set( "owner" , $text_param4 ) ;
    $obj->set( "graduate" , $text_param5 ) ;


    $file1 = ParseFile::createFromFile( $file_param1_uploaded_path ,basename($file_param1_uploaded_path )) ;
    $obj->set( "image" , $file1 ) ;
    $obj->save() ;

$upload_success = true ;

require_once("header.php");
?>

<body>
<div class="main">
<div id="contactInfo">

<?php if($upload_success){ ?>
	<h1>投稿完了</h1>
	<div id="thanks">
		<p>
			情報を送信しました。<br>
		</p>
	</div>
<?php } ?>

<?php if(!$upload_success){ ?>
	<h1>投稿失敗）</h1>
	<p>
		<span class="error">情報送信に失敗しました。</span>
	</p>
<?php } ?>
	  <div id="btn_area">
		  <input type="button" name="back_btn" value="戻る"
		         onclick="location.href='./index.php'"" class="btn">

	  </div>

	<p>
	  <li><a href="http://www.parse.com/apps/liketochiku/collections">Parse.com</a></li>
	</p>

</div><!--/contactInfo-->
</div><!--/main-->

</body>
</html>
