<?php


// �K�v�Ȓ萔��ݒ�
define('GMAIL_HOST','imap.googlemail.com');
define('GMAIL_PORT',993);
define('GMAIL_ACCOUNT','tt85.20151107@gmail.com');
define('GMAIL_PASSWORD','tochikun');
define('SERVER','{'.GMAIL_HOST.':'.GMAIL_PORT.'/novalidate-cert/imap/ssl}');



// ���[���{�b�N�X�ւ� IMAP �X�g���[�����I�[�v��
if (($mbox = @imap_open(SERVER."INBOX", GMAIL_ACCOUNT, GMAIL_PASSWORD)) == false) {

}

echo 'Hello';

// ���[���{�b�N�X�̏����擾
$mboxes=imap_mailboxmsginfo($mbox);

echo 'Hello';



// ���b�Z�[�W���̗L��
if( $mboxes->Nmsgs != 0 ) {
	// �����i�[����ϐ���������
	$mail=null;
	for( $mailno=1; $mailno<=$mboxes->Nmsgs; $mailno++ ) {
		// �w�b�_�[���̎擾
		$head=imap_header($mbox, $mailno);
		// �A�h���X�̎擾
		$mail[$mailno]['address']=$head->from[0]->mailbox.'@'.$head->from[0]->host;
		// �^�C�g���̗L��
		if( !empty($head->subject) ) {
			// �^�C�g�����f�R�[�h
			$mhead=imap_mime_header_decode($head->subject);
			foreach( $mhead as $key=>$value) {
				if( $value->charset != 'default' ) {
					$mail[$mailno]['subject']=mb_convert_encoding($value->text,'UTF-8',$value->charset);
				}else{
					$mail[$mailno]['subject']=$value->text;
				}
			}
		}else{
			// �^�C�g�����Ȃ��ꍇ�̏������L�q...
		}
		// �i�[�p�ϐ��̏�����
		$charset=null;
		$encoding=null;
		$attached_data=null;
		$parameters=null;
		// ���[���\�����擾
		$info=imap_fetchstructure($mbox, $mailno);
		if( !empty($info->parts) ) {
			// 
			$parts_cnt=count($info->parts);
			for( $p=0; $p<$parts_cnt; $p++ ) {
				// �^�C�v�ɂ�菈���𕪂���
				// [�Q�l] http://www.php.net/manual/ja/function.imap-fetchstructure.php
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
			// �G���[�������L�q...
		}
		// �{�����擾
		$body=imap_fetchbody($mbox, $mailno, 1, FT_INTERNAL);
		$body=trim($body);
		if( !empty($body) ) {
			// �^�C�v�ɂ���ăG���R�[�h�ύX
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
					// �G���[�������L�q...
				break;
			}
		}else{
			// �G���[�������L�q...
		}
		
		// �Y�t���擾
		if( !empty($attached_data) ) {
			foreach( $attached_data as $key => $value) {
				$attached=imap_fetchbody($mbox, $mailno, $key+1, FT_INTERNAL);
				if(empty($attached)) break;
				// �t�@�C��������ӂ̖��O�ɂ���(�����t�@�C�������݂��Ȃ��悤��)
				list($name, $ex)=explode('.', $value['file_name']);
				$mail[$mailno]['attached_file'][$key]['file_name']=$name.'_'.time().'_'.$key.'.'.$ex;
				$mail[$mailno]['attached_file'][$key]['image']=imap_base64($attached);
				$mail[$mailno]['attached_file'][$key]['content_type']='Content-type: image/'.strtolower($value['content_type']);
			}
		}

		// ���[���̍폜
//		imap_delete($mbox, $mailno);
	}
	// �폜�p�Ƀ}�[�N���ꂽ���ׂẴ��b�Z�[�W���폜
//	imap_expunge($mbox);

	// $mail���m�F
	var_dump( $mail );
}