<?php


// 必要な定数を設定
define('GMAIL_HOST','imap.googlemail.com');
define('GMAIL_PORT',993);
define('GMAIL_ACCOUNT','tt85.20151107@gmail.com');
define('GMAIL_PASSWORD','tochikun');
define('SERVER','{'.GMAIL_HOST.':'.GMAIL_PORT.'/novalidate-cert/imap/ssl}');



// メールボックスへの IMAP ストリームをオープン
if (($mbox = @imap_open(SERVER."INBOX", GMAIL_ACCOUNT, GMAIL_PASSWORD)) == false) {

}

echo 'Hello';

// メールボックスの情報を取得
$mboxes=imap_mailboxmsginfo($mbox);

echo 'Hello';



// メッセージ数の有無
if( $mboxes->Nmsgs != 0 ) {
	// 情報を格納する変数を初期化
	$mail=null;
	for( $mailno=1; $mailno<=$mboxes->Nmsgs; $mailno++ ) {
		// ヘッダー情報の取得
		$head=imap_header($mbox, $mailno);
		// アドレスの取得
		$mail[$mailno]['address']=$head->from[0]->mailbox.'@'.$head->from[0]->host;
		// タイトルの有無
		if( !empty($head->subject) ) {
			// タイトルをデコード
			$mhead=imap_mime_header_decode($head->subject);
			foreach( $mhead as $key=>$value) {
				if( $value->charset != 'default' ) {
					$mail[$mailno]['subject']=mb_convert_encoding($value->text,'UTF-8',$value->charset);
				}else{
					$mail[$mailno]['subject']=$value->text;
				}
			}
		}else{
			// タイトルがない場合の処理を記述...
		}
		// 格納用変数の初期化
		$charset=null;
		$encoding=null;
		$attached_data=null;
		$parameters=null;
		// メール構造を取得
		$info=imap_fetchstructure($mbox, $mailno);
		if( !empty($info->parts) ) {
			// 
			$parts_cnt=count($info->parts);
			for( $p=0; $p<$parts_cnt; $p++ ) {
				// タイプにより処理を分ける
				// [参考] http://www.php.net/manual/ja/function.imap-fetchstructure.php
				if( $info->parts[$p]->type == 0 ) {
					if( empty( $charset ) ) {
						$charset=$info->parts[$p]->parameters[0]->value;
					}
					if( empty( $encoding ) ) {
						$encoding=$info->parts[$p]->encoding;
					}
				}elseif(!empty($info->parts[$p]->parts) && $info->parts[$p]->parts[$p]->type == 0){
					$parameters=$info->parts[$p]->parameters[0]->value;
					if( empty( $charset ) ) {
						$charset=$info->parts[$p]->parts[$p]->parameters[0]->value;
					}
					if( empty( $encoding ) ) {
						$encoding=$info->parts[$p]->parts[$p]->encoding;
					}
				}elseif($info->parts[$p]->type == 5){
					$files=imap_mime_header_decode($info->parts[$p]->dparameters[0]->value);
					if(!empty($files) && is_array($files) ) {
						$attached_data[$p]['file_name']=null;
						foreach($files as $key => $file) {
							if( $file->charset != 'default') {
								$attached_data[$p]['file_name'].=mb_convert_encoding($file->text, 'UTF-8', $file->charset);
							}else{
								$attached_data[$p]['file_name'].=$file->text;
							}
						}
					}
					$attached_data[$p]['content_type'] = $info->parts[$p]->subtype;
				}
			}
		}else{
			$charset=$info->parameters[0]->value;
			$encoding=$info->encoding;
		}
		if( empty($charset) ) {
			// エラー処理を記述...
		}
		// 本文を取得
		$body=imap_fetchbody($mbox, $mailno, 1, FT_INTERNAL);
		$body=trim($body);
		if( !empty($body) ) {
			// タイプによってエンコード変更
			switch( $encoding ) {
				case 0 :
					$mail[$mailno]['body']=mb_convert_encoding($body, "UTF-8", $charset);
				break;
				case 1 :
					$encode_body=imap_8bit($body);
					$encode_body=imap_qprint($encode_body);
					$mail[$mailno]['body']=mb_convert_encoding($encode_body, "UTF-8", $charset);
				break;
				case 3 :
					$encode_body=imap_base64($body);
					$mail[$mailno]['body']=mb_convert_encoding($encode_body, "UTF-8", $charset);
				break;
				case 4 :
					$encode_body=imap_qprint($body);
					$mail[$mailno]['body']=mb_convert_encoding($encode_body, 'UTF-8', $charset);
				break;
				case 2 :
				case 5 :
				default:
					// エラー処理を記述...
				break;
			}
		}else{
			// エラー処理を記述...
		}
		
		// 添付を取得
		if( !empty($attached_data) ) {
			foreach( $attached_data as $key => $value) {
				$attached=imap_fetchbody($mbox, $mailno, $key+1, FT_INTERNAL);
				if(empty($attached)) break;
				// ファイル名を一意の名前にする(同じファイルが存在しないように)
				list($name, $ex)=explode('.', $value['file_name']);
				$mail[$mailno]['attached_file'][$key]['file_name']=$name.'_'.time().'_'.$key.'.'.$ex;
				$mail[$mailno]['attached_file'][$key]['image']=imap_base64($attached);
				$mail[$mailno]['attached_file'][$key]['content_type']='Content-type: image/'.strtolower($value['content_type']);
			}
		}

		// メールの削除
//		imap_delete($mbox, $mailno);
	}
	// 削除用にマークされたすべてのメッセージを削除
//	imap_expunge($mbox);

	// $mailを確認
	var_dump( $mail );
}