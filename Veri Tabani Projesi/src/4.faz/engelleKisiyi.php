<?php  
session_start();  
$person_name=$_SESSION["name"];
$person_type=$_SESSION["type"];
$delivDate = date('d-m-Y h:i:s');
$person_id=$_SESSION["person_id"];
if(isset($_POST['engelle'])){
	 
	  $blocked_cause=htmlspecialchars($_POST['blocked_cause']);
	  $blockedId=$_GET['blocked_id']  ;
	  $db2 = "(DESCRIPTION=(ADDRESS=(PROTOCOL=TCP)(HOST= dbs.cs.hacettepe.edu.tr)(PORT=1521))(CONNECT_DATA=(SID=dbs)))";
       
	   if($c2 = OCILogon("C##b21328394", "21328394", $db2))
          {
		
		    $array2=oci_parse($c2,"insert into blocked values('$blockedId',1,'$blocked_cause')");
            oci_execute($array2);
			
			
            $array=oci_parse($c2,"insert into logUser values(DEFAULT,'$person_id','Kullanici Engelliyor.',to_date('$delivDate','dd-mm-yy hh24:mi:ss'))");		
            oci_execute($array); 
            			
		 }
		oci_close($c2);
	   
	   header("Location:engellenenler.php");
 }
?>  
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
         <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Kişi Ekle</title>
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
			   <span style="font-weight:bold;">Engellenecek Kişinin Bilgisi:</span>
			   <hr/>
		<?php			
          			
					
		
		         $array=oci_parse($c,"select name,email,phone_number,birth_date,type from people where person_id=".$_GET['blocked_id']);
                 oci_execute($array);
			     $row=oci_fetch_array($array);
					 
       ?>  		   
			    <table class="bloglar" style="width: 800px !important;">
			      <thead  class="colHead">
				   <tr>
				     <th>İsim</th>
					 <th>Email</th>
				     <th>Tel No</th>
					 <th>Doğum Tarihi</th>
					 <th>Tip</th>
				   </tr>
                 </thead>
                <tbody>
				  <tr>
				     
					  <td><?php echo $row[0]; ?></td>
                       <td><?php echo $row[1];?></td>
                       <td><?php echo $row[2]; ?></td>
					   <td><?php echo $row[3];?></td>
                       <td><?php echo $row[4];?></td>
				  </tr>
				</tbody>
			</table>	
   			<hr/>	 
			<br/>
			
			
			   
	<?php
          oci_close($c);
	   }
     ?>	
	    <form method="post">
		  <table>
	       
			<tr>
		       <td><span style="font-weight:bold;">Engelleme Nedeni:</span></td>
		        <td><textarea class="m"  name="blocked_cause"></textarea></td>	  
		    </tr>
			
	        <tr>
		      <td><button type="submit" name="engelle"><strong>Engelle</strong></button></td>
		      <td></td>
		    </tr>
		  
	       </table>
	  </form>            
    </div>
			

   </body>
</html>