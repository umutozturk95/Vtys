<?php  
session_start();  
$person_name=$_SESSION["name"];
$person_type=$_SESSION["type"];
?>  
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
      <head>
         <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Blog Yazıları</title>
         <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="./resources/css/cssLayout.css" rel="stylesheet" type="text/css" />
        <link href="./resources/css/default.css" rel="stylesheet" type="text/css" />
    <head>
<body style="background-color:powderblue; !important;">



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
		      if(isset($_GET['kategori_id'])){
	    
		  
	           
			  $array3=oci_parse($c,"select * from blog_post  where subcategory_id=".$_GET['kategori_id']);
	          oci_execute($array3);
		  
       ?>  
							
             </ul> 
            </div>
              <div id="icerik"style="background-color:powderblue; !important;">
			     <br/>
				  	<ul style="list-style-type:circle !important;">
				  <?php			
					while($row3=oci_fetch_array($array3)){
	          	   ?>		  	   
                     
					<li><a href="blogYazisiGetir.php?blog_post_id=<?php echo $row3[0]; ?>"><?php echo $row3[3]; ?></a></li>
				 
					                          
               <?php       					   
				  }
				   
		        ?>        
		          </ul>
				 
		
			  </div>
			 
   	<?php
		 }
		oci_close($c);
	   }
      ?>

</body>
</html>