<?php  
session_start();  
$person_name=$_SESSION["name"];
$person_type=$_SESSION["type"];
if(isset($_POST['guncelle'])){
	 
	  $name=$_POST['name'];
	  $phone_number=$_POST['phone_number'];
	  $email=$_POST['email'];
	  $password=$_POST['password'];
	  $encrypt_password=encrypt_decrypt('encrypt',$password);
	  $hakkinda=$_POST['hakkinda'];
	  $accounts=$_POST['accounts'];
	  $delivDate = date('d-m-Y h:i:s');
      $person_id=$_SESSION["person_id"];
	  $db2 = "(DESCRIPTION=(ADDRESS=(PROTOCOL=TCP)(HOST= dbs.cs.hacettepe.edu.tr)(PORT=1521))(CONNECT_DATA=(SID=dbs)))";
       if($c2 = OCILogon("C##b21328394", "21328394", $db2))
          {
		    $array2=oci_parse($c2,"update people set name='$name' ,phone_number='$phone_number',email='$email',password ='$encrypt_password' where person_id=".$_GET['person_id']);
            oci_execute($array2);
			
			$array3=oci_parse($c2,"update contact set accounts='$accounts'  where author_id=".$_GET['person_id']);
			oci_execute($array3);
			
			$array3=oci_parse($c2,"update author set biography='$hakkinda'  where author_id=".$_GET['person_id']);
			oci_execute($array3);
           	
		
			$array=oci_parse($c2,"insert into logUser values(DEFAULT,'$person_id','Yazar bilgisi guncelliyor.',to_date('$delivDate','dd-mm-yy hh24:mi:ss'))");		
            oci_execute($array); 
			
		 }
		oci_close($c2);
	   
	   header("Location:yazarGoruntule.php?person_id=".$_GET['person_id']);
 }
 
 
 function encrypt_decrypt($action, $string) {
    $output = false;

    $encrypt_method = "AES-256-CBC";
    $secret_key = 'This is my secret key';
    $secret_iv = 'This is my secret iv';

    // hash
    $key = hash('sha256', $secret_key);
    
    // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
    $iv = substr(hash('sha256', $secret_iv), 0, 16);

    if( $action == 'encrypt' ) {
        $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
        $output = base64_encode($output);
    }
    else if( $action == 'decrypt' ){
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
    }

    return $output;
}
 
?>  
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
         <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Kişi Güncelle</title>
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
           if(isset($_GET['person_id'])){
			
		         $array=oci_parse($c,"select p.name ,p.phone_number, p.email, p.password,a.biography,c.accounts from people p,contact c,author a where p.person_id=a.author_id and a.author_id=c.author_id  and p.person_id =".$_GET['person_id']);
                 oci_execute($array);
			     $row=oci_fetch_array($array);
      ?>	  
     <div id="giris" style="height: 520px; !important;">
               <br/>
	    <form method="post">
		  <table style="width: 600px ;">
	        <tr>
		       <td><span style="font-weight:bold;">İsim:</span></td>
		       <td><input type="text" class="m" name="name" value="<?php echo $row[0];?>" /></td>
		    </tr>
		    <tr>
		       <td><span style="font-weight:bold;">Tel no:</span></td>
		        <td><input type="text" class="m" name="phone_number" value="<?php echo $row[1];?>"/></td>	  
		    </tr>
			 <tr>
		       <td><span style="font-weight:bold;">Email:</span></td>
		        <td><input type="text" class="m" name="email" value="<?php echo $row[2];?>"/></td>	  
		    </tr>
			 <tr>
		       <td><span style="font-weight:bold;">Şifre:</span></td>
		        <td><input type="text" class="m" name="password" value="<?php echo encrypt_decrypt('decrypt',$row[3]);?>"/></td>	  
		    </tr>	
			
			 <tr>
		       <td><span style="font-weight:bold;">Hakkında:</span></td>
		        <td><textarea class="m" name="hakkinda"><?php echo $row[4];?></textarea></td>	  
		    </tr>
			 <tr>
		       <td><span style="font-weight:bold;">Sosyal Medya Hesapları:</span></td>
		        <td><input type="text" class="m" name="accounts" value="<?php echo $row[5];?>"/></td>	  
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