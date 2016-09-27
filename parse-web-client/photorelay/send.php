<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>sample</title>
</head>
<body>

<?php

// POSTされたデータを取得します。
$text_param1 = isset($_POST["text_param1"])? $_POST["text_param1"] : "";
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

function upload_to_parse( $name, $image, $description, $archive )
{
    $obj = ParseObject::create("Photo");

   try {
     $file_image       = ParseFile::createFromFile( $image ,basename($image)) ;
     $obj->set( "image" , $file_image ) ;
     $obj->set( "caption" , $name ) ;
     $obj->save() ;
   } catch (\Parse\ParseException $e) {
      print $e ;
   }
}

upload_to_parse( $text_param1, $file_param1_uploaded_path,"", "" ) ;

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
