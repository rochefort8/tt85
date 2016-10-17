<?php
/*
 * Copyright(c) 2009 limitlink,Inc. All Rights Reserved.
 * http://limitlink.jp/
 * 文字コード UTF-8
 */

class View {
	
	var $javascript = '';
	
	function heading($caption = '', $directory = '', $onload = '') {
	
		if ($directory == '') {
			$directory = basename(dirname($_SERVER['SCRIPT_NAME']));
		}
		$current[$directory] = ' class="current"';
		if (!file_exists('application')) {
			$root = '../';
		}
		if (file_exists($root.'js/'.$directory.'.js')) {
			$javascript = '<script type="text/javascript" src="'.$root.'js/'.$directory.'.js"></script>';
		}
		if ($caption) {
			$caption = APP_TYPE.' '.$caption;
		} else {
			$caption = APP_TYPE;
		}
		$javascript .= $this->javascript;
		require_once(DIR_VIEW.'header.php');
		require_once(DIR_VIEW.'control.php');
		
	}
	
	function script() {
		
		$argument = func_get_args();
		if (is_array($argument) && count($argument) > 0) {
			if (!file_exists('application')) {
				$root = '../';
			}
			foreach ($argument as $value) {
				$this->javascript .= '<script type="text/javascript" src="'.$root.'js/'.$value.'"></script>';
			}
		}
	
	}
	
	function footing() {
		
		require_once(DIR_VIEW.'footer.php');
	
	}
	
	function error($array, $string = '') {
		
		if (is_array($array) && count($array) > 0) {
			return '<div class="error">'.implode('<br />', $array).'</div>';
		} elseif (strlen($string) > 0) {
			return '<div class="error">'.$string.'</div>';
		}
		return $error;
	
	}
	
	function pagination($pagination, $count) {
		
		if (isset($_GET['sort']) && strlen($_GET['sort']) > 0) {
			$sort = $this->escape($_GET['sort']);
		}
		if (isset($_GET['desc']) && strlen($_GET['desc']) > 0) {
			$desc = intval($_GET['desc']);
		}
		if (is_array($pagination->parameter) && count($pagination->parameter) > 0) {
			foreach ($pagination->parameter as $key => $value) {
				$array[] = $key.'='.$value;

			}
			/* */
			if ($_REQUEST['customer_graduate']) {
	$array[] = 'customer_graduate='.htmlspecialchars($_REQUEST['customer_graduate'], ENT_QUOTES, 'UTF-8');
			}
			if ($_REQUEST['customer_club']) {
	$array[] = 'customer_club='.htmlspecialchars($_REQUEST['customer_club'], ENT_QUOTES, 'UTF-8');
			}
			if ($_REQUEST['customer_juniorhighschool']) {
	$array[] = 'customer_juniorhighschool='.htmlspecialchars($_REQUEST['customer_juniorhighschool'], ENT_QUOTES, 'UTF-8');
			}
			if ($_REQUEST['customer_name']) {
	$array[] = 'customer_name='.htmlspecialchars($_REQUEST['customer_name'], ENT_QUOTES, 'UTF-8');
			}


			$onchange = sprintf(' onchange="App.limit(\'%s\',\'%s\',\'%s\')"', $sort, $desc, implode('&', $array));
		} else {
			$onchange = sprintf(' onchange="App.limit(\'%s\',\'%s\')"', $sort, $desc);
		}
		echo '<div class="pagination">'.$pagination->create($count).'&nbsp;';
		echo '表示件数:'.$pagination->limit($onchange).'</div>';
	
	}
	
	function initialize($string, $value) {
		
		if ($_SERVER['REQUEST_METHOD'] != 'POST' && strlen($string) <= 0) {
			$string = $value;
		}
		return $string;
	
	}
	
	function parameter($array) {
		
		if (is_array($array) && count($array) > 0) {
			foreach ($array as $key => $value) {
				if (strlen($value) > 0) {
					$result[] = $key.'='.$this->escape($value);
				}
			}
			if (is_array($result) && count($result) > 0) {
				return '?'.implode('&', $result);
			}
		}
	
	}
	
	function positive($array) {
		
		if (is_array($array) && count($array) > 0) {
			foreach ($array as $key => $value) {
				if ($value > 0) {
					$result[] = $key.'='.intval($value);
				}
			}
			if (is_array($result) && count($result) > 0) {
				return '?'.implode('&', $result);
			}
		}
	
	}
	
	function escape($string) {
		
		return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
	
	}
	
	function style($value, $string, $display = 'block') {
	
		if ($value == $string) {
			$style = ' style="display:'.$display.';"';
		} else {
			$style = ' style="display:none;"';
		}
		return $style;
	
	}
	
	function uploadfile($string = '') {
		
		$result = sprintf('<input type="hidden" name="MAX_FILE_SIZE" value="%s" />', APP_FILESIZE);
		if (strlen($string) > 0) {
			$array = explode(',', $string);
			if (is_array($array) && count($array) > 0) {
				$element = '<div><input type="checkbox" name="uploadedfile[]" id="uploadedfile%s" value="%s" checked="checked" /><label for="uploadedfile%s">%s</label></div>';
				foreach ($array as $key => $value) {
					if (strlen($value) > 0) {
						$value = $this->escape($value);
						$result .= sprintf($element, $key, $value, $key, $value);
					}
				}
			}
		}
		$result .= '<div><span class="operator" onclick="App.uploadfile(this)">ファイルを添付</span></div>';
		return $result;
	
	}
	
	function attachment($id, $directory, $prefix, $filelist) {
		
		if (strlen($filelist) > 0) {
			$array = explode(',', $filelist);
			if (is_array($array) && count($array) > 0) {
				$helper = new Helper;
				$result = array('', '');
				$image = '<li><a href="download.php?id=%s&file=%s" target="_blank"><img src="download.php?id=%s&file=%s"%s /><br />%s</a></li>';
				$element = '<li><a href="download.php?id=%s&file=%s"><img src="../images/file.gif" />&nbsp;%s</a></li>';
				foreach ($array as $value) {
					if (strlen($value) > 0) {
						$value = $this->escape($value);
						if (preg_match('/.+\.(jpeg|jpg|gif|png)$/', $value)) {
							$file = $this->uploadencode(DIR_UPLOAD.$directory.'/'.$prefix.'_'.$value);
							$tag = $helper->resizeImage($file, 100, 100);
							$result[0] .= sprintf($image, $id, urlencode($value), $id, urlencode($value), $tag, $value);
						} else {
							$result[1] .= sprintf($element, $id, urlencode($value), $value);
						}
					}
				}
				if (strlen($result[0]) > 0) {
					$result[0] = '<ul class="attachment">'.$result[0].'</ul><div class="clearer"></div>';
				}
				if (strlen($result[1]) > 0) {
					$result[1] = '<ul class="attachment">'.$result[1].'</ul><div class="clearer"></div>';
				}
				return $result[0].$result[1];
			}
		}
	
	}
	
	function uploadencode($string) {
		
		if (stristr(PHP_OS, 'win')) {
			$string = mb_convert_encoding($string, 'SJIS', 'SJIS, EUC-JP, UTF-8');
		}
		return $string;
		
	}

}

?>