<?php
function display_graduate_list($selected_graduate) {
	 print '<select name="customer_graduate">' ;

	 $year = 1950;
	 $graduate = $year - 1902 ;
	 $gengo = $year - 1925 ;

	 for (;$year < 1989;$year++,$graduate++,$gengo++) {
	     	 $selected="" ;
	     	 if ( $graduate == $selected_graduate ) {
		    $selected = "selected" ;
		 } 
	  	 echo "<option value=\"${graduate}\" ${selected}>${graduate}期(${year}年/昭和${gengo}年卒業)</option>";
	 }
	 $year = 1989 ;
	 $gengo = $year - 1988 ;

	 for (;$year < 2018;$year++,$graduate++,$gengo++) {
	     	 $selected="" ;
	     	 if ( $graduate == $selected_graduate ) {
		    $selected = "selected" ;
		 } 
	  	 echo "<option value=\"${graduate}\" ${selected}>${graduate}期(${year}年/ 平成${gengo}年卒業)</option>";
	 }
	 print '</select>';
}

function display_club_list($selected_item) {
	 $club_array = array(
	 	 "ESS","お茶","カメラ","ギター","コーラス","サッカー","ソフトテニス","テニス",
		  "バスケットボール","バトミントン","バレーボール","フォーク同好会","ブラスバンド",
		  "ボート","ラグビー","ラジオ","映画研究会","演劇","演劇","応援","音楽","化学",
		  "華道","弓道","軽音楽","剣道","硬式テニス","合唱","山岳","写真","社会","柔道",
		  "書道","食物","新聞","図書","吹奏楽","水泳","生徒会","生物","相撲","体操","卓球",
		  "地学","茶道","軟式テニス","美術","文芸","弁論","放送","野球","理化部化学班",
		  "理化部地学班","陸上","その他"
		  );
	 print '<select name="customer_club">' ;

	 print_r('Ogihara') ;
	 for ($n = 0;$n < count($club_array);$n++) {
	 	 $selected="" ;
	 	 if ( $club_array[$n] == $selected_item ) {
		    $selected = "selected" ;
		 } 
		 echo "<option value=\"${club_array[$n]}\" ${selected}>${club_array[$n]}</option>";
	 } 
	 print '</select>';
}

function display_juniorhighschool_list($selected_item) {
	 $school_array = array(
	      "芦屋中","鞍手南中","鞍手北中","引野中","永犬丸中","遠賀中","遠賀南中","岡垣中",
	      "岡垣東中","沖田中","花尾中","宮竹中","弓削中","響南中","熊西中","穴生中","剣中",
	      "古月中","向洋中","香月中","高見中","高須中","高塔中","黒崎中","桜蔭中","思永中",
	      "枝光台中","枝光中","枝光北中","若宮中","若松中","小倉日新館中","小竹中","上津役中",
	      "城山中","植木中","陣山中","水巻中","水巻南中","星陵中","西川中","西南学院中",
	      "西南女学院中","石峯中","折尾高女中","折尾中","千代中","浅川中","則松中","大蔵中",
	      "大之浦中","中央中","中間中","中間東中","中間南中","直方一中","直方三中","直方二中",
	      "槻田中","東筑中","洞北中","二島中","日新館中","博多女子中","八児中","板櫃中",
	      "尾倉中","福教大付属小倉中","福教大付属中","本城中","明治学園中","木屋瀬中","その他") ;
	 print '<select name="customer_juniorhighschool">' ;
	 for ($n = 0;$n < count($school_array);$n++) {
	  	 $selected="" ;
	 	 if ( $school_array[$n] == $selected_item ) {
		    $selected = "selected" ;
		 } 
		 echo "<option value=\"${school_array[$n]}\" ${selected}>${school_array[$n]}</option>";
	 } 
	 print '</select>';
}
?>
