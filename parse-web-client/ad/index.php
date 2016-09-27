<head>

<meta charset = "UTF-8">
<title>広告</title>
<link rel="stylesheet" href="./contact.css" type="text/css" />
</head>

<body>
<div class="main">
<div id="contactInfo">

     <form name="form1" action="./confirm.php" method="post" enctype="multipart/form-data">
	  
     <p>広告 投稿フォーム</p>
	  
     <table class="contact_tbl">

       <tr>
         <th>タイトル</th>
         <td>
         <input type="text" id="text_param1" name="text_param1" size=30
  	   	  value="<?php echo htmlspecialchars($beerName_JP, ENT_QUOTES, "UTF-8");?>">
         </td>
       </tr>

       <tr>
         <th>代表者名</th>
         <td>
         <input type="text" id="text_param4" name="text_param4" size=30
  	   	  value="<?php echo htmlspecialchars($beerName_JP, ENT_QUOTES, "UTF-8");?>">
         </td>
       </tr>

       <tr>
         <th>期</th>
         <td>
         <input type="text" id="text_param5" name="text_param5" size=30
  	   	  value="<?php echo htmlspecialchars($beerName_JP, ENT_QUOTES, "UTF-8");?>">
         </td>
       </tr>

       <tr>
         <th>記事</th>
         <td>
         <textarea id="text_param2" name="text_param2" cols=40 rows=4
  	   	  value="<?php echo htmlspecialchars($beerName_JP, ENT_QUOTES, "UTF-8");?>"></textarea>
         </td>
       </tr>

       <tr>
         <th>リンク</th>
         <td>
         <input type="text" id="text_paramd32" name="text_param3" size=30
  	   	  value="<?php echo htmlspecialchars($beerName_JP, ENT_QUOTES, "UTF-8");?>">
         </td>
       </tr>

       <tr>
         <th><span class="f_red"></span>画像</th>
         <td>
           <input type="file" id="file_param1" name="file_param1" size="30" /><br />
         </td>
       </tr>
     </table>

   <div id="btn_area">
  	<input type="submit" name="next_btn" value="次へ" class="btn">
   </div>
   </form>
	  
</div><!--/contactInfo-->
</div><!--/main-->
</body>
</html>