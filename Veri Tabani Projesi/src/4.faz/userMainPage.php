<?php  
session_start();  
$person_name=$_SESSION["name"];
$person_type=$_SESSION["type"];
?>  

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
         <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Ana Sayfa</title>
         <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="./resources/css/default.css" rel="stylesheet" type="text/css" />
        <link href="./resources/css/cssLayout.css" rel="stylesheet" type="text/css" />
    <head>


<body>  
     <div id="baslik">
          <?php
             $db = "(DESCRIPTION=(ADDRESS=(PROTOCOL=TCP)(HOST= dbs.cs.hacettepe.edu.tr)(PORT=1521))(CONNECT_DATA=(SID=dbs)))";
             if($c = OCILogon("C##b21328394", "21328394", $db))
             {
	               
                   $array=oci_parse($c,"select blog_title,blog_summary,image_path from blog where blog_id =1");
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
                    
					<li>
					  <a href="userMainPage.php">Ana sayfa</a>
					</li>
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
				
                </ul>
     </div>
	 <br/>
	 <div id="giris" style="height: 450px !important;">
	   <span style="font-weight: bold;font-size: 15px">İşlem yapmak için yukarıdaki menüleri kullanınız!
	   <br>
	        <span><?php  echo $row[1];?></span>
	   </span>
	   <br/>
	   <br/>
	   <img src="<?php  echo $row[2];?>" alt="pl"  height="300px" width="600px"/>
	 </div>
	 
	 <?php
	   }
	 ?>
	   <div id="footer"> Copyright @www.blog_sitesi.com</div>
</body>  
</html>  