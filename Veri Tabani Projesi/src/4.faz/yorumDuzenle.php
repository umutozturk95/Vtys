<?php

session_start();  
$person_name=$_SESSION["name"];
$person_type=$_SESSION["type"];
$delivDate = date('d-m-Y h:i:s');
$person_id=$_SESSION["person_id"];
 if(isset($_POST['guncelle'])){
	 
	  $title=htmlspecialchars($_POST['baslik']);
	  $icerik=htmlspecialchars($_POST['icerik']);
	  $db2 = "(DESCRIPTION=(ADDRESS=(PROTOCOL=TCP)(HOST= dbs.cs.hacettepe.edu.tr)(PORT=1521))(CONNECT_DATA=(SID=dbs)))";
       if($c2 = OCILogon("C##b21328394", "21328394", $db2))
          {
		    $array2=oci_parse($c2,"update comments set comment_title='$title' ,comment_content='$icerik'  where comment_id=".$_GET['yorum_id']);
            oci_execute($array2);
			
			$yorum_id=$_GET['yorum_id'];  
			$array2=oci_parse($c2,"insert into edit_comment values('$yorum_id','$person_id',to_date('$delivDate','dd-mm-yy hh24:mi:ss'))");
            oci_execute($array2);
			
			
			$array=oci_parse($c2,"insert into logUser values(DEFAULT,'$person_id','Yorum duzenliyor.',to_date('$delivDate','dd-mm-yy hh24:mi:ss'))");		
            oci_execute($array); 
            			
		 }
		oci_close($c2);
	   
	   header("Location:blogYazisiGetir.php?blog_post_id=".$_GET['blog_post_id']);
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
         width: 500px;
         box-sizing: border-box;

      }
   </style>
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
	 <?php 
	       if(isset($_GET['yorum_id'])){
		         $array=oci_parse($c,"select comment_title,comment_content from comments where comment_id=".$_GET['yorum_id']);
                 oci_execute($array);
			     $row=oci_fetch_array($array);
	
	 ?>
	 <div id="giris">
	   <form method="post">
		<table>
	      <tr>
		    <td><span style="font-weight:bold;">Yorum Başlığı:</span></td>
		    <td><input type="text" class="m" name="baslik" value="<?php echo $row[0];?>" /></td>
		  </tr>
		  <tr>
		  <td><span style="font-weight:bold;">İçerik:</span></td>
		  <td><textarea class="m" style="height:420px;" name='icerik'><?php echo $row[1];?></textarea></td>		  
		  </tr>
	      <tr>
		  <td><button type="submit" name="guncelle"><strong>Güncelle</strong></button></td>
		  <td></td>
		  </tr>
		  
	    </table>
	 </form>
	 </div>
	 
  <?php
		}
    	oci_close($c);
	}
  ?>

</body>
</html>