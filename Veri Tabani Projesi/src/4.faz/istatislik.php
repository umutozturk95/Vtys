<?php  
session_start();  
$person_name=$_SESSION["name"];
$person_type=$_SESSION["type"];
$person_id=$_SESSION["person_id"];
?>  
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
         <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Kişiler</title>
         <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="./resources/css/cssLayout.css" rel="stylesheet" type="text/css" />
        <link href="./resources/css/default.css" rel="stylesheet" type="text/css" />
		<script type="text/javascript">
		
		</script>
    <head>


   <body  style="background-color:powderblue; !important;">  
   
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
	 
	   <div id="sol"style="height: 500px !important;">              
                Kişi Kategorisi
                <hr/>
                <br/>					  			
				<ul style="list-style-type:circle !important;">		  	                    
				   <li><a href="yazarGetirKategoriIle.php">Yazar</a></li>
				   <br/>
				   <li><a href="kullaniciGetirKategoriIle.php">Kullanıcılar</a></li>                      
		        </ul>
       </div>           
				 
    

	
            <div id="icerik"style="background-color:powderblue; !important;">
               <br/>
			     <table class="bloglar" style="width: 400px !important;">
			       <thead  class="colHead">
				     <tr>
					  <th></th>
					  <th></th>
				     </tr>
				   </thead>
				  <tbody>
				<?php
				   $array=oci_parse($c,"select * from blog_post");
			       oci_execute($array);
				   $row=oci_fetch_all($array, $res);
				  
				?>
				
                 <tr>
                  <td><span style="font-weight:bold;">Blog Yazı Sayısı:</span></td>
				   <td><span><?php echo $row;?></span></td>
				 </tr>
				 <?php
				   $array=oci_parse($c,"select * from people");
			       oci_execute($array);
				   $row=oci_fetch_all($array, $res);
				 ?>
				 <tr>
				   <td><span style="font-weight:bold;">Toplam Kişi Sayısı:</span></td>
				   <td><span><?php echo $row;?></span></td>
				 
				 </tr>
				  <?php
				   $array=oci_parse($c,"select * from  author");
			       oci_execute($array);
				   $row=oci_fetch_all($array, $res);
				 ?>
				  <tr>
				   <td><span style="font-weight:bold;">Toplam Yazar Sayısı:</span></td>
				   <td><span><?php echo $row;?></span></td>			 
				 </tr>
				  <?php
				   $array=oci_parse($c,"select * from  users");
			       oci_execute($array);
				   $row=oci_fetch_all($array, $res);
				 ?>
				   <tr>
				   <td><span style="font-weight:bold;">Toplam Kullanıcı Sayısı:</span></td>
				   <td><span><?php echo $row;?></span></td>			 
				 </tr>
				  <?php
				   $array=oci_parse($c,"select * from  announcement");
			       oci_execute($array);
				   $row=oci_fetch_all($array, $res);
				 ?>
				   <tr>
				   <td><span style="font-weight:bold;">Duyuru Sayısı:</span></td>
				   <td><span><?php echo $row;?></span></td>		 
				  </tr>
				  <?php
				   $array=oci_parse($c,"select * from  blocked");
			       oci_execute($array);
				   $row=oci_fetch_all($array, $res);
				 ?>
				  <tr>
				   <td><span style="font-weight:bold;">Engellenen Kullanıcı Sayısı:</span></td>
				   <td><span><?php echo $row;?></span></td>		 
				 </tr>
				 
				 
				  <?php
				   $array=oci_parse($c,"select * from  comments");
			       oci_execute($array);
				   $row=oci_fetch_all($array, $res);
				 ?>
				  <tr>
				   <td><span style="font-weight:bold;">Yorum Sayısı:</span></td>
				   <td><span><?php echo $row;?></span></td>		 
				 </tr>
				 
			 
				  </tbody>
				</table>
				
				<br/>
				<hr/>
				<span style="font-weight:bold;">En çok beğenilen blog yazısı:</span>
				<br/>
				<?php 
				 
				 
				   $array=oci_parse($c,"select blog_post_id,post_title,creation_date from blog_post where blog_post_id =(select post_id from (select post_id,max(likes_number) as total_like  from blog_post_like  group by post_id  order by total_like desc )  where rownum <=1)");
			       oci_execute($array);
				   $row=oci_fetch_array($array);
				 
				?>
				<br/>
				 <table class="bloglar" style="width: 600px !important;">
			      <thead  class="colHead">
				    <tr>
				      <th>Başlık</th>
					  <th>Yaratılma Tarihi</th>
					  <th>Görüntüleme</th>
				    </tr>
				   </thead>
				   <tbody>
				 
				      <tr>
					    <td><?php echo $row[1];?></td>
						<td><?php echo $row[2];?></td>
						<td><a href="blogYazisiGetir.php?blog_post_id=<?php echo $row[0]; ?>">Görüntüle</a></td>
					  </tr>
					 
				   </tbody>
				  </table> 
				
				
				<br/>
				<br/>
				<span style="font-weight:bold;">En çok beğenilen yorum:</span>
				<hr/>
				<?php                                                                                                                             
				     $array=oci_parse($c,"select comment_id,comment_title,creation_date,comment_content from comments where  comment_id = (select comment_id from (select comment_id,max(likes_number) as total_like  from comment_like_rating  group by comment_id order by total_like desc) where rownum <= 1)");
			         oci_execute($array);
					 $row=oci_fetch_array($array);
				?>
				<table class="bloglar" style="width: 600px !important;">
			      <thead  class="colHead">
				    <tr>
				      <th>Başlık</th>
					  <th>Yaratılma Tarihi</th>
					  <th>İçerik</th>
				    </tr>
				   </thead>
				   <tbody>
					      <tr>
						    <td><?php echo $row[1];?></td>
  							<td><?php echo $row[2];?></td>
							<td><?php echo $row[3];?></td>
						  </tr>
					
				   </tbody>
				   
				 </table>
				 
				 <br/>
				 <br/>
				 <span style="font-weight:bold;">En çok blog yazısı beğenen kişi</span>
				 <hr/>
				 <?php
				 
				     $array=oci_parse($c,"select name,email,phone_number,type,birth_date from people where  person_id =(select person_id from (select person_id from liked_blog_post  group by person_id order by count(*) desc) where rownum <= 1)");
			         oci_execute($array);
					 $row=oci_fetch_array($array);
				 ?>
				 <table class="bloglar" style="width: 600px !important;">
			      <thead  class="colHead">
				    <tr>
				      <th>İsim</th>
					  <th>Email</th>
					  <th>Tel No</th>
					  <th>Tip</th>
					  <th>Doğum Tarihi</th>
					  
				    </tr>
				   </thead>
				   <tbody>
				  
					  <tr>
					     <td><?php echo $row[0];?></td>
						 <td><?php echo $row[1];?></td>
						 <td><?php echo $row[2];?></td>
						 <td><?php echo $row[3];?></td>
						 <td><?php echo $row[4];?></td>
					 </tr>
				       
				   </tbody>
				 </table>  
				  <br/>
				  <hr>
				  <br/>
				  <br/>
				  <span style="font-weight:bold;">En çok düzenlenen yorum</span>
				  <br/>
				   <?php
				 
				     $array=oci_parse($c,"select comment_title,comment_content,creation_date  from comments where  comment_id =(select comment_id from (select comment_id from  edit_comment  group by comment_id order by count(*) desc) where rownum <= 1)");
			         oci_execute($array);
					 $row=oci_fetch_array($array);
				 ?>
				  
				<table class="bloglar" style="width: 600px !important;">
			      <thead  class="colHead">
				    <tr>
				      <th>Yorum Başlığı</th>
					  <th>İçerik</th>
					  <th>Yazılma Tarihi</th>
				    </tr>
				   </thead>
				   <tbody>
				  
					  <tr>
					     <td><?php echo $row[0];?></td>
						 <td><?php echo $row[1];?></td>
						 <td><?php echo $row[2];?></td>
						
					 </tr>
				       
				   </tbody>
				 </table>  
				  
			      <br/>
				  <hr/>
            </div>
			<?php
			    
			    oci_close($c);
			 }
			?>
	
   </body>
</html>