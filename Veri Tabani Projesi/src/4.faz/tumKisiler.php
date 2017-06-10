<?php  
session_start();  
$person_name=$_SESSION["name"];
$person_type=$_SESSION["type"];
$delivDate = date('d-m-Y h:i:s');
$person_id=$_SESSION["person_id"];
if(isset($_GET['delete_id'])){
	
	  $db2 = "(DESCRIPTION=(ADDRESS=(PROTOCOL=TCP)(HOST= dbs.cs.hacettepe.edu.tr)(PORT=1521))(CONNECT_DATA=(SID=dbs)))";
       if($c2 = OCILogon("C##b21328394", "21328394", $db2))
          {
		    $array=oci_parse($c2,"delete from people where person_id = ".$_GET['delete_id']);		
            oci_execute($array);
		    
		
			$array=oci_parse($c2,"insert into logUser values(DEFAULT,'$person_id','Kisi siliyor.',to_date('$delivDate','dd-mm-yy hh24:mi:ss'))");		
            oci_execute($array); 
		 }  
	  oci_close($c2);
	  header("Location:tumKisiler.php");
}

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
		 function yeniKullaniciOlustur(){
			 window.location.href="kisiEkle.php";
		 }
		function delete_id(person_id){
			
			  window.location.href="tumKisiler.php?delete_id="+person_id;
		}
		function engelle_id(person_id){
			  window.location.href="engelleKisiyi.php?blocked_id="+person_id;
			
		}
		function engellenenler(){
			
			 window.location.href="engellenenler.php";
		}
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
				 
       <?php			
          			
				
		         $array=oci_parse($c,"select person_id,name,email,phone_number,birth_date,type from people");
                 oci_execute($array);
			     
					 
       ?>  			     
            <div id="icerik"style="background-color:powderblue; !important;">
               <br/>
			    <table class="bloglar" style="width: 800px !important;">
			      <thead  class="colHead">
				   <tr>
				     <th>İsim</th>
					 <th>Email</th>
				     <th>Tel No</th>
					 <th>Doğum Tarihi</th>
					 <th>Tip</th>
					 <?php
					    if($person_type=="A"){
					  ?>
					  <th>Güncelleme</th>
					  <th>Silme</th>
					  <th>Engelleme</th>
					  <th>Görüntüleme</th> 
					  <?php
					  }
					  else{
					  ?>
					   <th>Görüntüleme</th>
					 <?php
					  }
					 ?>
				   </tr>
				  </thead>
			     <tbody>
				    <?php
					   while($row=oci_fetch_array($array)){
					?>
				     <tr>
				  
					   <td><?php echo $row[1]; ?></td>
                       <td><?php echo $row[2];?></td>
                       <td><?php echo $row[3]; ?></td>
					   <td><?php echo $row[4];?></td>
                       <td><?php echo $row[5];?></td>
                       
					  <?php 
					   if($person_type=="A"){					 
					     
						 if($row[5]=="A"){
						?>
						<td><a href="yazarGuncelle.php?person_id=<?php echo $row[0];?>">Güncelle</a></td>
					    <td></td>
						<td></td>
                        <td><a href="yazarGoruntule.php?person_id=<?php echo $row[0]; ?>">Görüntüle</a></td>	
						<?php
                         }
						 else{
                         ?>		
						 <td><a href="kisiGuncelle.php?person_id=<?php echo $row[0];?>">Güncelle</a></td>
                          <td><a href="javascript:delete_id('<?php echo $row[0]; ?>')">Sil</a></td>
						 <td><a href="javascript:engelle_id('<?php echo $row[0]; ?>')">Engelle</a></td>
                         <td><a href="kisiGoruntule.php?person_id=<?php echo $row[0]; ?>">Görüntüle</a></td>	
                        <?php
                         }
                        ?>						
					   
					  <?php
					   }
					    else{
						  if($row[5]=="A"){
					  ?>
					     <td><a href="yazarGoruntule.php?person_id=<?php echo $row[0]; ?>">Görüntüle</a></td>
					    <?php
					      }
						   else{
					     ?>
						   <td><a href="kisiGoruntule.php?person_id=<?php echo $row[0]; ?>">Görüntüle</a></td>
						 <?php
						   }
					    }
					   ?>
					  
                     </tr>				  
 				  <?php
					 }
				  ?>
				
				 </tbody>
			   
			   </table>
		     	   
			   <br/>
			   <hr/>
			   <?php
			     if($person_type=="A"){
			   ?>
			   <button name="yeniKullaniciOlustur" onclick="yeniKullaniciOlustur()">Yeni Kullanıcı</button>
			    &nbsp;
			    <button name="engellenenler" onclick="engellenenler()">Engellenenler</button>
               	<?php
				 }
				?>
            </div>
			
			
			<?php
			    
			    oci_close($c);
			 }
			?>
	
   </body>
</html>