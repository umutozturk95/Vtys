<?php

session_start();  
$person_name=$_SESSION["name"];
$person_type=$_SESSION["type"];
$person_id=$_SESSION["person_id"];
$delivDate = date('d-m-Y h:i:s');
 if(isset($_POST['guncelle'])){
	 
	  $title=htmlspecialchars($_POST['baslik']);
	  $icerik=htmlspecialchars($_POST['icerik']);
	  $etiket_id=htmlspecialchars($_POST['etiket_id']);
	 
	  $db2 = "(DESCRIPTION=(ADDRESS=(PROTOCOL=TCP)(HOST= dbs.cs.hacettepe.edu.tr)(PORT=1521))(CONNECT_DATA=(SID=dbs)))";
       if($c2 = OCILogon("C##b21328394", "21328394", $db2))
          {
			
		    $array=oci_parse($c2,"update blog_post  set post_title='$title', post_content ='$icerik' where blog_post_id =".$_GET['blog_post_id']);		
            oci_execute($array);
			$blog_post_id=$_GET['blog_post_id'];
		     $array=oci_parse($c2,"insert into blog_post_to_tag  values('$blog_post_id','$etiket_id')");		
            oci_execute($array);
			
			$array=oci_parse($c2,"insert into logUser values(DEFAULT,'$person_id','Blog yazisi guncelliyor.',to_date('$delivDate','dd-mm-yy hh24:mi:ss'))");		
            oci_execute($array);
			
					
		 }  
	  oci_close($c2);
	  header("Location:blogYazisiGetir.php?blog_post_id=".$_GET['blog_post_id']);
 }
 if(isset($_GET['delete_id']))
{
    $db2 = "(DESCRIPTION=(ADDRESS=(PROTOCOL=TCP)(HOST= dbs.cs.hacettepe.edu.tr)(PORT=1521))(CONNECT_DATA=(SID=dbs)))";
       if($c2 = OCILogon("C##b21328394", "21328394", $db2))
          {
		    $array=oci_parse($c2,"delete from  blog_post_to_tag  where post_id =".$_GET['blog_post_id']." and  blog_tag_id=".$_GET['delete_id']);		
            oci_execute($array);
		    
			$array=oci_parse($c2,"insert into logUser values(DEFAULT,'$person_id','Blog yazisindan etiket siliyor.',to_date('$delivDate','dd-mm-yy hh24:mi:ss'))");		
            oci_execute($array);
		 }  
	  oci_close($c2);
	  header("Location:blogYazisiGuncelle.php?blog_post_id= ".$_GET['blog_post_id']);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
         <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Blog Yaizisi Düzenle</title>
         <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="./resources/css/cssLayout.css" rel="stylesheet" type="text/css" />
        <link href="./resources/css/default.css" rel="stylesheet" type="text/css" />
	    <script type="text/javascript">
	     function delete_id(delete_id,blog_post_id)
           {
		  window.location.href='blogYazisiGuncelle.php?delete_id='+delete_id+'&blog_post_id='+blog_post_id;
        }
		</script>
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
	     <br/>
       <span style="font-weight:bold;">Blog Yazısı Bilgilerini Güncelleyin</span>
        <hr/>
         <br/>
		 <?php
		  
			  $array=oci_parse($c2,"select at.blog_tag_id,at.tag_name from blog_tag at,blog_post_to_tag att where at.blog_tag_id=att.blog_tag_id  and att.post_id =".$_GET['blog_post_id']);
              oci_execute($array);
		    
				
		 ?>
           <table class="bloglar" style="width: 300px !important;">
			  <thead  class="colHead">
                <tr>
				 <td>Etiket Adı</td>
				 <td>Sil</td>
				</tr>
			  </thead>
              <tbody>
			    <?php
				  while($row=oci_fetch_array($array)){
				?>
				<tr>
			       <td><?php echo $row[1];?></td>
				   <td><a href="javascript:delete_id('<?php echo $row[0];?>','<?php echo $_GET["blog_post_id"];?>')">Sil</a></td>
				</tr>
				<?php
				  }
				?>
              </tbody>   			  
           </table>			  
         <br/>	
		 <hr/>
	    
	   <form method="post">
		<table>
		
		 <?php
			 

		        $array=oci_parse($c2,"select blog_tag_id, tag_name from blog_tag ");
                oci_execute($array);
			   
            
			?>
			<tr>
			 <td>Etiket:</td>
			 <td>
			   <select name="etiket_id">
			     <?php
				  while( $row=oci_fetch_array($array)){
				  ?>
				    <option value="<?php echo $row[0];?>"><?php echo $row[1];?></option>
				  <?php
				   }
				  ?>
				 
			   </select>
			 </td>
			</tr>
			
		 <?php
           
		        $array=oci_parse($c2,"select post_title,post_content from blog_post where blog_post_id =".$_GET['blog_post_id']);
                oci_execute($array);
			    $row=oci_fetch_array($array);
		 ?>		 
	      <tr>
		    <td><span style="font-weight:bold;">Blog Yazısı Başlığı:</span></td>
		    <td><input type="text" class="m" name="baslik" value="<?php echo $row[0];?>" /></td>
		  </tr>
		
		    
		 
		  <tr>
		  <td><span style="font-weight:bold;">İçerik:</span></td>
		  <td><textarea class="m" style="height:420px;" name='icerik'><?php echo $row[1]; ?></textarea></td>		  
		  </tr>
	      <tr>
		  <td><button type="submit" name="guncelle"><strong>Güncelle</strong></button></td>
		  <td></td>
		  </tr>
		  <?php
			 oci_close($c2);
			}
		  ?>
	    </table>
	 </form>
	 </div>
	 
 
 
 

</body>
</html>