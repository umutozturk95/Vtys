<?php

session_start();  
$person_name=$_SESSION["name"];
$person_type=$_SESSION["type"];
$delivDate = date('d-m-Y h:i:s');
$person_id=$_SESSION["person_id"];
 if(isset($_POST['ekle'])){
	 
	  $title=htmlspecialchars($_POST['baslik']);
	  $icerik=htmlspecialchars($_POST['icerik']);
	  $altKategori_id=htmlspecialchars($_POST['altKategori_id']);
	  $etiketId=htmlspecialchars($_POST['etiket_id']);
	  $db2 = "(DESCRIPTION=(ADDRESS=(PROTOCOL=TCP)(HOST= dbs.cs.hacettepe.edu.tr)(PORT=1521))(CONNECT_DATA=(SID=dbs)))";
       if($c2 = OCILogon("C##b21328394", "21328394", $db2))
          {
			
		    $array=oci_parse($c2,"insert into blog_post values(DEFAULT,1,'$altKategori_id','$title',to_date('$delivDate','dd-mm-yy hh24:mi:ss'),'$icerik')  RETURNING  blog_post_id INTO  :blog_post_id");
            
			oci_bind_by_name($array, ':blog_post_id', $theNewID, 8);
			oci_execute($array);
		  
		    $array=oci_parse($c2,"insert into blog_post_to_tag  values('$theNewID','$etiketId')");
		    oci_execute($array);	

	
           
			$array=oci_parse($c2,"insert into logUser values(DEFAULT,'$person_id','Blog yazisi olusturuyor.',to_date('$delivDate','dd-mm-yy hh24:mi:ss'))");		
            oci_execute($array); 
						
		 } 
	  oci_close($c2);
	  header("Location:tumBlogyazilari.php");
 }
 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
         <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Yorum Düzenle</title>
         <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="./resources/css/cssLayout.css" rel="stylesheet" type="text/css" />
        <link href="./resources/css/default.css" rel="stylesheet" type="text/css" />
			
	<style>
      .m{
         width: 650px;
         box-sizing: border-box;

      }
   </style>
    <head>

<body>

 <div id="baslik">
           <?php
             $db = "(DESCRIPTION=(ADDRESS=(PROTOCOL=TCP)(HOST= dbs.cs.hacettepe.edu.tr)(PORT=1521))(CONNECT_DATA=(SID=dbs)))";
             if($c2 = OCILogon("C##b21328394", "21328394", $db))
             {
	               
                   $array=oci_parse($c2,"select blog_title from blog where blog_id =1");
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
	 
	 <div id="giris">
	   <form method="post">
		<table>
	      <tr>
		    <td><span style="font-weight:bold;">Blog Yazısı Başlığı:</span></td>
		    <td><input type="text" class="m" name="baslik" value="" /></td>
		  </tr>
		  <tr>
		    <?php
			 
			 
			
		        $array=oci_parse($c2,"select subcategory_id,category_name from blog_subcategory");
                oci_execute($array);
			
            
			?>
		       
		      <td><span style="font-weight:bold;">Alt Kategori:</span></td>
			   <td>
			     <select name="altKategori_id">
				   <?php
				    while($row=oci_fetch_array($array)){
				    
					?>
					<option value="<?php echo $row[0];?>"><?php echo $row[1];?></option>
					 
				   <?php
				    }
				   ?>
				 </select>
			  </td>
			 
			  
		  </tr>
		  <tr>
		     <td><span style="font-weight:bold;">Etiket:</span></td>
		      <td>
			    <select name="etiket_id">
				  <?php
				    $array=oci_parse($c2,"select blog_tag_id, tag_name from blog_tag");
                    oci_execute($array);
                   while($etiketler=oci_fetch_array($array)){ 
                  ?>				  
				     <option value="<?php echo $etiketler[0];?>"><?php echo $etiketler[1];?></option>
				  <?php
				    }
				   ?>
				</select>
		
			  </td>
		  </tr>
		   <?php
			     }
		       oci_close($c2);
		    ?>
		  <tr>
		  <td><span style="font-weight:bold;">İçerik:</span></td>
		  <td><textarea class="m" style="height:420px;" name='icerik' wrap="virtual"></textarea></td>		  
		  </tr>
	      <tr>
		  <td><button type="submit" name="ekle"><strong>Ekle</strong></button></td>
		  <td></td>
		  </tr>
		  
	    </table>
	 </form>
	 </div>
	 
 
 
 

</body>
</html>