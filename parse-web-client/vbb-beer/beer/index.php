<head>

<meta charset = "UTF-8">
<title>ニュース</title>
<link rel="stylesheet" href="./contact.css" type="text/css" />
</head>

<body>
<div class="main">
<div id="contactInfo">

     <form name="form1" action="./confirm.php" method="post" enctype="multipart/form-data">
	  
     <p>ニュース 投稿フォーム</p>
	  
     <table class="contact_tbl">

       <tr>
         <th>Name</th>
         <td>
         <input type="text" id="text_param1" name="text_param1" size=30
  	   	  value="<?php echo htmlspecialchars($beerName_JP, ENT_QUOTES, "UTF-8");?>">
         </td>
       </tr>
       <tr>
         <th>名称(日本語）</th>
         <td>
         <input type="text" id="text_paramd2" name="text_param2" size=30
  	   	  value="<?php echo htmlspecialchars($beerName_JP, ENT_QUOTES, "UTF-8");?>">
         </td>
       </tr>

         <th>説明</th>
         <td>
         <textarea id="text_param3" name="text_param3" cols=40 rows=4
  	   	  value="<?php echo htmlspecialchars($beerName_JP, ENT_QUOTES, "UTF-8");?>"></textarea>
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