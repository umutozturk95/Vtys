<?php  
session_start();  
$person_name=$_SESSION["name"];
$person_type=$_SESSION["type"];
$delivDate = date('d-m-Y h:i:s');
$person_id=$_SESSION["person_id"];
if(isset($_POST['ekle'])){
	  $etiket_ad=htmlspecialchars($_POST['etiket_name']);
	  $db2 = "(DESCRIPTION=(ADDRESS=(PROTOCOL=TCP)(HOST= dbs.cs.hacettepe.edu.tr)(PORT=1521))(CONNECT_DATA=(SID=dbs)))";
       if($c2 = OCILogon("C##b21328394", "21328394", $db2))
          {
		    $array=oci_parse($c2,"insert into announcement_tag values(DEFAULT,'$etiket_ad')");		
            oci_execute($array);
			
		
            $array=oci_parse($c2,"insert into logUser values(DEFAULT,'$person_id','Duyuru etiketi ekle.',to_date('$delivDate','dd-mm-yy hh24:mi:ss'))");		
            oci_execute($array); 
		 }  
	  oci_close($c2);
	  header("Location:tumDuyurular.php");
}

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
		  function yeniDuyuruOlustur(){
			 window.location.href="duyuruEkle.php";
		 }
	     function etiketEkle(){
			 window.location.href="etiketEkle.php";
			
		}
		</script>
		<style>
      .m{
         width: 650px;
         box-sizing: border-box;

      }
   </style>
		
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
	 <?php			
          			
		         $array=oci_parse($c,"select announcement_tag_id,tag_name from announcement_tag");
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
			
            <div id="icerik"style="background-color:powderblue; !important;">
               <br/> 
			    <span style="font-weight:bold;">Etiket Bilgisi Giriniz</span>
			    <hr/>
			     <form method="post">
                       <table>
					    <tr>
						 <td><span style="font-weight:bold;">Etiket Adı:</span></td>
						 <td><textarea class="m"  name='etiket_name'></textarea></td>
						</tr>
						<tr>
						  <td><button type="submit" name="ekle"><strong>Ekle</strong></button></td>
						  <td></td>
						</tr>
					   </table>
					   
				 </form>
				 <br/>
				 <br/>
				 <hr/>
			   <?php
			     if($person_type=="A"){
			   ?>
			    <button name="yeniDuyuruOlustur" onclick="yeniDuyuruOlustur()">Yeni Duyuru</button>
			       &nbsp;
			    <button name="etiketEkle" onclick="etiketEkle()">Etiket Ekle</button>
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