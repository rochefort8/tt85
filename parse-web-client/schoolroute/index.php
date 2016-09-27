<head>

<meta charset = "UTF-8">
<title>通学路</title>
<link rel="stylesheet" href="./contact.css" type="text/css" />
</head>

<body>
<div class="main">
<div id="contactInfo">

     <form name="form1" action="./confirm.php" method="post" enctype="multipart/form-data">
	  
     <p>通学路 投稿フォーム</p>
	  
     <table class="contact_tbl">

       <tr>
         <th>タイトル</th>
         <td>
         <input type="text" id="text_param1" name="text_param1" size=30
  	   	  value="<?php echo htmlspecialchars($text_param1, ENT_QUOTES, "UTF-8");?>">
         </td>
       </tr>

         <th>説明</th>
         <td>
         <input type="text" id="text_param2" name="text_param2" size=30
  	   	  value="<?php echo htmlspecialchars($text_param2, ENT_QUOTES, "UTF-8");?>">
         </td>
       </tr>

       <tr>
         <th>Youtube Video ID</th>
         <td>
         <input type="text" id="text_paramd32" name="text_param3" size=30
  	   	  value="<?php echo htmlspecialchars($text_param3, ENT_QUOTES, "UTF-8");?>">
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