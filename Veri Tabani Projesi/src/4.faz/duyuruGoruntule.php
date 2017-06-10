<?php  
session_start();  
$person_name=$_SESSION["name"];
$person_type=$_SESSION["type"];
?>  
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
         <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Duyurular</title>
         <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="./resources/css/cssLayout.css" rel="stylesheet" type="text/css" />
        <link href="./resources/css/default.css" rel="stylesheet" type="text/css" />
		<script type="text/javascript">
	
		</script>
		
		<style>
      .m{
         width: 500px;
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
	 
	 
	   <?php			
          			
					
			
		         $array=oci_parse($c2,"select announcement_tag_id,tag_name from announcement_tag");
                 oci_execute($array);
			     
					 
       ?>  			  
	   <div id="sol">              
                Duyurular Etiketleri
                <hr/>
                <br/>					  			
				<ul style="list-style-type:circle !important;">
                  
                 <?php
                    while($row=oci_fetch_array($array)){
                  ?>				 
				   <li><a href="duyuruGetirKategoriIle.php?announcement_tag_id=<?php echo $row[0];?>"><?php echo $row[1];?></a></li>
				   <br/>
				  <?php
                    }
				   ?>				  
		        </ul>
       </div>     
	 
	 
	 
	  <?php
	  
		      $array=oci_parse($c2,"select title,announcement_content,announcement_date from announcement where announcement_id =".$_GET['announcement_id']);
              oci_execute($array);
			  $row=oci_fetch_array($array);
	  ?>
			
	 <div id="icerik">
		<br/>
		<br/>
		<span style="font-weight:bold;"><?php echo $row[0];?></span>
		<hr/>
		<span style="font-style: italic"><?php echo $row[1];?></span>
		<hr/>
		<br/>
		<span style="font-weight:bold;">Oluşturulma Tarihi:</span>
		&nbsp;&nbsp;
		<span><?php echo $row[2];?></span>
        <br/>
        <span style="font-weight:bold;">Etiketler:</span>&nbsp;
		<?php
         $array=oci_parse($c2,"select at.tag_name from announcement_tag at,announcement_to_tag att where at.announcement_tag_id=att.announcement_tag_id  and att.announcement_id=".$_GET['announcement_id']);
         oci_execute($array);
		    while($row=oci_fetch_array($array)){		
         ?>
	         <span><?php echo $row[0];?>&nbsp;</span>
	     <?php
		    }
		 ?>
		 <hr/>
	 </div>
	 <?php
	   }
	    
		oci_close($c2);
	 ?>
   </body>
</html>