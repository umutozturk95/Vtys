<?php  
session_start();  
$person_name=$_SESSION["name"];
$person_type=$_SESSION["type"];
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
	 
	   <div id="sol" style="height: 500px !important;">              
                Kişi Kategorisi
                <hr/>
                <br/>					  			
				<ul style="list-style-type:circle !important;">		  	                    
				   <li><a href="yazarGetirKategoriIle.php">Yazar</a></li>
				   <br/>
				   <li><a href="kullaniciGetirKategoriIle.php">Kullanıcılar</a></li>                      
		        </ul>
				
       </div>           
				 
       <?php			
          			
		         $array=oci_parse($c,"select p.name,p.email,p.phone_number,p.birth_date,p.type,u.nickname from people p,users u where p.person_id=u.user_id and p.person_id =".$_GET['person_id']);
                 oci_execute($array);
			     $row=oci_fetch_array($array);
					 
       ?>  			     
            <div id="icerik"style="background-color:powderblue; !important;">
               <br/>
			   <span style="font-weight:bold;">Kişi Bilgisi</span><br/>
			    <table class="bloglar" style="width: 800px !important;">
			      <thead  class="colHead">
				   <tr>
				     <th>İsim</th>
					 <th>Email</th>
				     <th>Tel No</th>
					 <th>Doğum Tarihi</th>
					 <th>Tip</th>
					 <th>Takma İsim</th>
					 
				   </tr>
				  </thead>
			     <tbody>
				 
				     <tr>
				  
					   <td><?php echo $row[0]; ?></td>
                       <td><?php echo $row[1];?></td>
                       <td><?php echo $row[2]; ?></td>
					   <td><?php echo $row[3];?></td>
                       <td><?php echo $row[4];?></td>
                       <td><?php echo $row[5];?></td> 
					 </tr>
				 </tbody>
			   
			   </table>
		     	   
			   <br/>
			   <hr/>
			   <br/>
			   <span style="font-weight:bold;">Beğendiği Blog Yazıları</span>
			   <br/>
			   <?php
			     $array=oci_parse($c,"select p.blog_post_id,p.post_title,p.creation_date from blog_post p,liked_blog_post lp where p.blog_post_id=lp.post_id and  lp.person_id =".$_GET['person_id']);
                 oci_execute($array);
			      
				
			   ?>
			     <table class="bloglar" style="width: 800px !important;">
			      <thead  class="colHead">
				   <tr>
				     <th>Başlık</th>
					 <th>Oluşturulma Tarihi</th>
					 <th>Görüntüleme</th>
					 
				   </tr>
				  </thead>
			     <tbody>
				   <?php
				       while($row=oci_fetch_array($array)){
				   ?>
				     <tr>
				  
					   <td><?php echo $row[1]; ?></td>
                       <td><?php echo $row[2];?></td>
                       <td><a href="blogYazisiGetir.php?blog_post_id=<?php echo $row[0];?>">Görüntüle</a></td>
					   
					 </tr>
					 
					 <?php
					   }
					 ?>
				 </tbody>
			   
			   </table>
			   
			   
			   
            </div>
			
			
			<?php
			    
			    oci_close($c);
			 }
			?>
	
   </body>
</html>