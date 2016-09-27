<head>

<meta charset = "UTF-8">
<title>画用紙リレー</title>
<link rel="stylesheet" href="./contact.css" type="text/css" />
</head>

<body>
<div class="main">
<div id="contactInfo">

     <form name="form1" action="./confirm.php" method="post" enctype="multipart/form-data">

     <p>とーち君クイズ 入力フォーム</p>	  
	  
     <table class="contact_tbl">

       <tr>
         <th><span class="f_red"></span>画像1</th>
         <td>
           <input type="file" id="file_param1" name="file_param1" size="30" /><br />
         </td>
       </tr>
       <th><span class="f_red"></span>画像2</th>
         <td>
           <input type="file" id="file_param2" name="file_param2" size="30" /><br />
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