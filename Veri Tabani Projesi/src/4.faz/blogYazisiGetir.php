<?php
header('Content-type: text/html; charset=iso-8859-9');
header('Content-type: text/html; charset=UTF-8');  
session_start();  
$person_name=$_SESSION["name"];
$person_type=$_SESSION["type"];
$person_id=$_SESSION["person_id"];
$delivDate = date('d-m-Y h:i:s');
 if(isset($_GET['delete_id'])){
	  
	   $db = "(DESCRIPTION=(ADDRESS=(PROTOCOL=TCP)(HOST= dbs.cs.hacettepe.edu.tr)(PORT=1521))(CONNECT_DATA=(SID=dbs)))";
       if($c = OCILogon("C##b21328394", "21328394", $db))
         {
		      $array=oci_parse($c,"delete from  comments where comment_id=".$_GET['delete_id']);
              oci_execute($array);
			  
			  $array=oci_parse($c,"insert into logUser values(DEFAULT,'$person_id','Yorum siliyor.',to_date('$delivDate','dd-mm-yy hh24:mi:ss'))");		
              oci_execute($array);
			  
          	  oci_close($c);
	      }
	header("Location:blogYazisiGetir.php?blog_post_id=".$_GET['blog_post_id']);
}            
 if(isset($_GET['yorumBegen_id'])){
	  $db = "(DESCRIPTION=(ADDRESS=(PROTOCOL=TCP)(HOST= dbs.cs.hacettepe.edu.tr)(PORT=1521))(CONNECT_DATA=(SID=dbs)))";
       if($c = OCILogon("C##b21328394", "21328394", $db))
         {
		      $array=oci_parse($c,"select likes_number from  comment_like_rating where comment_id=".$_GET['begen_id']);
              oci_execute($array);
			  
			  if($row=oci_fetch_array($array)){
				    $row[0]=$row[0]+1;
					$setLikeRating=oci_parse($c,"update  comment_like_rating set likes_number='$row[0]' where comment_id=".$_GET['begen_id']);
				    oci_execute($setLikeRating);
			  }
			  
			  else{
				  $yorum_id=$_GET['begen_id'];
				  $insertRating=oci_parse($c,"insert into  comment_like_rating values('$yorum_id',1)");
				  oci_execute($insertRating);
			  }
			  
			  $array=oci_parse($c,"insert into logUser values(DEFAULT,'$person_id','Yorum begeniyor.',to_date('$delivDate','dd-mm-yy hh24:mi:ss'))");		
              oci_execute($array);
          	  oci_close($c);
	      }
		  
	 header("Location:blogYazisiGetir.php?blog_post_id=".$_GET['blog_post_id']);
 }
 if(isset($_GET['blogBegen_id'])){
	  
	   $db = "(DESCRIPTION=(ADDRESS=(PROTOCOL=TCP)(HOST= dbs.cs.hacettepe.edu.tr)(PORT=1521))(CONNECT_DATA=(SID=dbs)))";
       if($c = OCILogon("C##b21328394", "21328394", $db))
         {
		      $array=oci_parse($c,"select likes_number from  blog_post_like where post_id=".$_GET['blogBegen_id']);
              oci_execute($array);
			   $blogPost_id=$_GET['blogBegen_id'];
			  if($row=oci_fetch_array($array)){
				    $row[0]=$row[0]+1;
					$setLikeRating=oci_parse($c,"update  blog_post_like set likes_number='$row[0]' where post_id=".$_GET['blogBegen_id']);
				    oci_execute($setLikeRating);
			  }
			  
			  else{
				 
				  $insertRating=oci_parse($c,"insert into   blog_post_like  values('$blogPost_id',1)");
				  oci_execute($insertRating);
			  }
			  $likedPost=oci_parse($c,"insert into liked_blog_post values('$blogPost_id','$person_id')");
			  oci_execute($likedPost);
			  
			  $array=oci_parse($c,"insert into logUser values(DEFAULT,'$person_id','Blog yazisi begeniyor.',to_date('$delivDate','dd-mm-yy hh24:mi:ss'))");		
              oci_execute($array);
			  
          	  oci_close($c);
	      }
		  
	 header("Location:blogYazisiGetir.php?blog_post_id=".$_GET['blogBegen_id']);
	 
 }
 
 
?>  
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
      <head>
         <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Blog Yazıları</title>
         <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="./resources/css/cssLayout.css" rel="stylesheet" type="text/css" />
        <link href="./resources/css/default.css" rel="stylesheet" type="text/css" />
		
     <script type="text/javascript">
      function yorumDuzenle(yorum_id) {
          window.location.href="yorumDuzenle.php?yorum_id="+yorum_id+"&blog_post_id="+<?php echo $_GET['blog_post_id'];?>;
      }
	  function yorumYap(){
		  window.location.href="yorumYap.php?blog_post_id="+<?php echo $_GET['blog_post_id'];?>;
		  
	  }
	  function yorumSil(yorum_id){
		  
		  window.location.href="blogYazisiGetir.php?delete_id="+yorum_id+"&blog_post_id="+<?php echo $_GET['blog_post_id'];?>;
	  }
	  
	  function yorumBegen(yorum_id){
		   window.location.href="blogYazisiGetir.php?yorumBegen_id="+yorum_id+"&blog_post_id="+<?php echo $_GET['blog_post_id'];?>;
	  }
	  function blogYazıbegen(){
		   window.location.href="blogYazisiGetir.php?blogBegen_id="+<?php echo $_GET['blog_post_id'];?>;
		  
	  }
	  function begenenleriGetir(){
		  
		  window.location.href="blogYazisiBegenenler.php?blog_post_id="+<?php echo $_GET['blog_post_id'];?>;
		  
	  }
    </script>
		
		
    <head>
<body>



 <div id="baslik">
            <?php
             $db = "(DESCRIPTION=(ADDRESS=(PROTOCOL=TCP)(HOST= dbs.cs.hacettepe.edu.tr)(PORT=1521))(CONNECT_DATA=(SID=dbs)))";
             if($c = OCILogon("C##b21328394", "21328394", $db))
             {
	               
                   $array=oci_parse($c,"select blog_title from blog where blog_id =1");
                   oci_execute($array);
				   $row=oci_fetch_array($array);
				   
		      ?>  
			  <span><?php  echo $row[0];?></span>
     </div>
     <div id="aciklama">
               Hoşgeldin '<?php echo $person_name; ?>', Çıkış için
                <a href="logout.php" style="color: white">basınız</a>
     </div>
    <div id="menu">
                <ul id="nav">
				
				    <?php
					if($person_type=="A"){
					?>
					<li>
					  <a href="yazarMainPage.php">Ana sayfa</a>
					</li>
					<?php
					 }
					 else{
					?>
					 <li>
					  <a href="userMainPage.php">Ana sayfa</a>
					</li>
					<?php
					 }
					?>
                    <li><a href="tumKisiler.php">Kullanıcılar</a></li>
                    <li>
                       <a href="tumBlogyazilari.php">Blog Yazıları</a>
                    </li>
                    <li>
                      <a href="tumDuyurular.php">Duyurular</a>
                    </li>
                   <li>
                       <a href="takip.php">Kullanıcı Takip</a>
                    </li>
				   <?php
					if($person_type=="A"){
					?>
                    
				     <li>
                       <a href="istatislik.php">İstatislik</a>
                    </li>
					
					<li>
                       <a href="blogBilgisiGuncelle.php">Blog Ayarları</a>
                    </li>
                   <?php
				     }
				   ?>
				
                   
                </ul>
     </div>
	 
	   <div id="sol">              
                Kategoriler
                <hr/>
                <br/>
				<ul>
	    <?php
           
		         $array=oci_parse($c,"select * from blog_topcategory");
                 oci_execute($array);
			     while($row=oci_fetch_array($array)){
			        $array2=oci_parse($c,"select * from blog_subcategory where topcategory_id='$row[0]'");
                    oci_execute($array2);    	
		?>		    
					
					<li style="color: black !important;"><?php echo $row[1];?>
					<ul style="list-style-type:circle !important;">
		<?php			
					while($row2=oci_fetch_array($array2)){
		?>		  	   
                     
					<li><a href="blogGetirKategoriIle.php?kategori_id=<?php echo $row2[0]; ?>"><?php echo $row2[2]; ?></a></li>
				 
					                          
        <?php       					   
				  }
				   
		?>        
		          </ul>
                  </li>
				  <br/>
       <?php			
          			
					
			 }
		      if(isset($_GET['blog_post_id'])){
	    
		  
	           
			  $array3=oci_parse($c,"select post_title, post_content from blog_post  where blog_post_id=".$_GET['blog_post_id']);
	          oci_execute($array3);
		  
       ?>  
							
             </ul> 
            </div>
              <div id="icerik">
			     <hr/>
	
				  <?php			
					if($row3=oci_fetch_array($array3)){
	          	   ?>		  	   
                    <p style="font-weight: bold ;font-size: 30px"><?php  echo $row3[0];?></p>  
					<hr/>
				    <span charset="UTF-8"><?php echo $row3[1];?></span> 					
					 <hr/>
				     <br/>
					 <span style="font-weight: bold;" >Etiket:&nbsp;</span>
					 
               <?php       					   
				  }
				  
				  $array4= oci_parse($c,"select tag_name from blog_tag t,blog_post_to_tag pt where t.blog_tag_id=pt.blog_tag_id and pt.post_id=".$_GET['blog_post_id']);
				  oci_execute($array4); 
				  
				  while($row4=oci_fetch_array($array4)){
					
				?>	  
					  
				 <span><?php echo $row4[0];?>&nbsp;</span>

                <?php 					
				  
				  }
				   
				 $array5= oci_parse($c,"select comment_id,name,comment_title,comment_content,creation_date from people p,comments c where p.person_id=c.person_id and c.post_id=".$_GET['blog_post_id']);
				 oci_execute($array5);
				
				 ?>
				 <br/>
				  <span style="font-weight: bold; font-size: 15px">Yorumlar</span>
				  <hr/> 	
				 
				 <?php				 
				 while($row5=oci_fetch_array($array5)){
		        ?> 
		          <span style="font-weight: bold ;"><?php  echo $row5[2];?></span><br/>
				  <span  style="font-style: italic"><?php echo $row5[3]; ?></span><br/>
				  <span style="font-weight: bold ;">Gönderen:</span>
		          <span><?php echo $row5[1];?> &nbsp;| &nbsp;</span>
				  <span style="font-weight: bold">Tarih:</span>
				  <span><?php echo $row5[4];?></span>&nbsp;
				    <?php
					 if($person_type=="A"){
				     ?>
					<button name="yorumDuzenle"  onclick="yorumDuzenle('<?php echo $row5[0];?>')">Yorum Düzenle</button>
				    &nbsp;
				    <button name="yorumSil" onclick="yorumSil('<?php echo $row5[0];?>')">Yorumlu Sil</button>
				    &nbsp;
					<?php
					 }
					 ?> 
				    <button name="yorumBegen" onclick="yorumBegen('<?php echo $row5[0];?>')">Yorumu Beğen</button>
				 
					<hr/>
				 
   	<?php
			}
			
			?>
			
		   
   <?php		
		 }
		oci_close($c);
	   }
      ?>
	       <br/>
		   <br/>
	      <button name="yorumYap" onclick="yorumYap()">Yorum Yap</button>
		  &nbsp;
		  <button name="blokYazisiBegen" onclick="blogYazıbegen()">Blog Yazısını Beğen</button>
		  &nbsp;
		  <button name="begenenleriGetir" onclick="begenenleriGetir()">Blog Yazısını Beğenenler</button>
	   
	  </div>		
	 

</body>
</html>