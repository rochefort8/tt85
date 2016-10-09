<?php
/*
 * Copyright(c) 2009 limitlink,Inc. All Rights Reserved.
 * http://limitlink.jp/
 * 文字コード UTF-8
 */

class Customer extends ApplicationModel {

	var $item;
	
	function Customer() {
	
		$this->schema = array(
		'folder_id'=>array('カテゴリ', 'notnull', 'numeric', 'except'=>array('search')),
		'customer_type'=>array('分類', 'notnull', 'numeric', 'except'=>array('search', 'update')),
		'customer_name'=>array('名前', 'length:100'),
		'customer_ruby'=>array('かな', 'length:100'),
		'customer_juniorhighschool'=>array('会社名', 'length:100'),
		'customer_club'=>array('会社名(かな)', 'length:100'),
		'customer_department'=>array('部署', 'length:1000'),
		'customer_position'=>array('役職', 'length:1000'),
		'customer_postcode'=>array('郵便番号', 'length:8'),
		'customer_address'=>array('住所', 'length:1000'),
		'customer_addressruby'=>array('住所(かな)', 'length:1000'),
		'customer_phone'=>array('電話番号', 'length:20'),
		'customer_graduate'=>array('FAX', 'length:20'),
		'customer_mobile'=>array('携帯電話', 'length:20'),
		'customer_email'=>array('メールアドレス', 'length:1000'),
		'customer_url'=>array('URL', 'length:1000'),
		'customer_comment'=>array('備考', 'length:10000', 'line:100'),
		'customer_parent'=>array('会社情報ID', 'numeric', 'except'=>array('search')));
		for ($i = 0; $i < 10; $i++) {
			$this->schema[sprintf('customer_item%02d', $i)] = array();
		}
		if ($_POST['customer_type'] == 1) {
			$this->schema['customer_juniorhighschool'][] = 'notnull';
		} else {
			$this->schema['customer_name'][] = 'notnull';
		}
		$this->connect();
		$this->item = new Item($this->handler);
	
	}
	
	function index($type = 0) {
		
		$hash = $this->permitCategory('customer', $_GET['folder']);
		$this->where[] = $this->folderWhere($hash['folder']);
		$this->where[] = "(customer_type = ".intval($type).")";
		$hash += $this->findLimit('id', 1);
		if ($_GET['folder'] != 'all') {
			$hash['item'] = $this->item->findItem('customer', $_GET['folder']);
		}
		return $hash;
	
	}

	function view() {
	
		$hash['data'] = $this->findView();
		$hash += $this->permitCategory('customer', $hash['data']['folder_id']);
		$hash['item'] = $this->item->findItem('customer', $hash['data']['folder_id']);
		if ($hash['data']['customer_parent'] > 0) {
			$field = implode(',', $this->schematize());
			$data = $this->fetchOne("SELECT ".$field." FROM ".$this->table." WHERE id = ".intval($hash['data']['customer_parent']));
			if (!$this->permitted($data, 'public')) {
				$hash['data']['customer_parent'] = '';
			}
		}
		$hash += $this->findUser($hash['data']);
		return $hash;

	}
	
	function add($redirect = 'index.php') {
		
		if ($_SERVER['REQUEST_METHOD'] != 'POST' && $_GET['id'] > 0) {
			$hash['data'] = $this->findView();
			$hash += $this->permitCategory('customer', $hash['data']['folder_id'], 'add');
			$hash['item'] = $this->item->findItem('customer', $hash['data']['folder_id']);
		} else {
			$hash = $this->permitCategory('customer', $_POST['folder_id'], 'add');
			$hash['item'] = $this->item->findItem('customer', $_POST['folder_id']);
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				$this->schema = $this->item->create($this->schema, $hash['item']);
				$this->validateSchema('insert');
				$this->insertPost();
				$this->redirect($redirect.$this->parameter(array('folder'=>$_POST['folder_id'])));
			}
			$hash['data'] = $this->post;
		}
		$hash += $this->findUser($hash['data']);
		return $hash;
	
	}
	
	function edit($redirect = 'index.php') {
	
		$hash['data'] = $this->findView();
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$hash += $this->permitCategory('customer', $_POST['folder_id'], 'add');
			$hash['item'] = $this->item->findItem('customer', $_POST['folder_id']);
			$this->schema = $this->item->create($this->schema, $hash['item']);
			$this->validateSchema('update');
			$this->updatePost();
			if ($this->response) {
				if ($hash['data']['customer_type'] == 1) {
					$string = $this->post['customer_juniorhighschool'];
				} else {
					$string = $this->post['customer_name'];
				}
				$query = sprintf("UPDATE %s SET folder_id = %d, customer_name = '%s' WHERE customer_id = %d", DB_PREFIX.'history', intval($_POST['folder_id']), $this->quote($string), intval($_POST['id']));
				$this->response = $this->query($query);
			}
			$this->redirect($redirect.$this->parameter(array('folder'=>$_POST['folder_id'])));
			$hash['data'] = $this->post;
		} else {
			$hash += $this->permitCategory('customer', $hash['data']['folder_id'], 'add');
			$hash['item'] = $this->item->findItem('customer', $hash['data']['folder_id']);
		}
		$hash += $this->findUser($hash['data']);
		return $hash;
	
	}
	
	function delete($redirect = 'index.php') {
	
		$hash['data'] = $this->findView();
		$hash += $this->permitCategory('customer', $hash['data']['folder_id'], 'add');
		$hash['item'] = $this->item->findItem('customer', $hash['data']['folder_id']);
		$this->deletePost();
		if ($this->response) {
			$this->response = $this->query("DELETE FROM ".DB_PREFIX."history WHERE customer_id = ".intval($_POST['id']));
		}
		$this->redirect($redirect.$this->parameter(array('folder'=>$hash['data']['folder_id'])));
		$hash += $this->findUser($hash['data']);
		return $hash;

	}
	
	function company() {
		
		return $this->index(1);
	
	}

	function companyview() {
	
		return $this->view();

	}
	
	function companyadd() {
		
		return $this->add('company.php');
	
	}

	function companyedit() {
	
		return $this->edit('company.php');
	
	}

	function companydelete() {
	
		return $this->delete('company.php');

	}
	
	function companylist() {
		
		$hash = $this->permitCategory('customer');
		$this->where[] = $this->folderWhere($hash['folder']);
		$this->where[] = "(customer_type = 1)";
		$_REQUEST['limit'] = 50;
		$hash = $this->findLimit('customer_juniorhighschool', 0, array('customer_juniorhighschool'));
		return $hash;
		
	}

	function postcode() {
	
		$postcode = new Postcode;
		$hash['list'] = $postcode->feed();
		$this->error = $postcode->error;
		return $hash;
	
	}
	
	function csv() {
		
		$hash = $this->permitCategory('customer', $_GET['folder']);
		$this->where[] = "(customer_type = ".intval($_GET['type']).")";
		$this->where[] = $this->folderWhere($hash['folder']);
		$data = $this->findAll('id', 1);
		if ($_GET['type'] == 1) {
			$field = array('customer_juniorhighschool'=>'会社名',
			'customer_juniorhighschool'=>'会社名(かな)',
			'customer_department'=>'部署',
			'customer_name'=>'担当者',
			'customer_position'=>'役職',
			'customer_postcode'=>'郵便番号',
			'customer_address'=>'住所',
			'customer_addressruby'=>'住所(かな)',
			'customer_phone'=>'電話番号',
			'customer_graduate'=>'FAX',
			'customer_email'=>'メールアドレス',
			'customer_url'=>'URL');
		} else {
			$field = array('customer_name'=>'名前',
			'customer_ruby'=>'かな',
			'customer_postcode'=>'郵便番号',
			'customer_address'=>'住所',
			'customer_addressruby'=>'住所(かな)',
			'customer_phone'=>'電話番号',
			'customer_graduate'=>'FAX',
			'customer_mobile'=>'携帯電話',
			'customer_email'=>'メールアドレス',
			'customer_juniorhighschool'=>'会社名',
			'customer_juniorhighschool'=>'会社名(かな)',
			'customer_department'=>'部署',
			'customer_position'=>'役職',
			'customer_url'=>'URL');
		}
		if ($_GET['folder'] != 'all') {
			$item = $this->item->findItem('customer', $_GET['folder']);
			if (is_array($item) && count($item) > 0) {
				foreach ($item as $row) {
					$field[$row['item_field']] = $row['item_caption'];
				}
			}
		} else {
			for ($i = 0; $i < 10; $i++) {
				$field[sprintf('customer_item%02d', $i)] = '項目'.($i + 1);
			}
		}
		$field['customer_comment'] = '備考';
		$this->exportcsv($data, $field, 'customer'.date('Ymd').'.csv');
		
	}
	
	function config() {
	
		$hash = $this->item->add('customer', 'index.php'.$this->parameter(array('folder'=>$_GET['folder'])));
		$this->error = $this->item->error;
		return $hash;
	
	}

}

?>
