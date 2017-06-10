<?php  
session_start();  
$person_name=$_SESSION["name"];
$person_type=$_SESSION["type"];
$delivDate = date('d-m-Y h:i:s');
$person_id=$_SESSION["person_id"];
if(isset($_POST['ekle'])){
	 
	  $name=htmlspecialchars($_POST['name']);
	  $phone_number=htmlspecialchars($_POST['phone_number']);
	  $email=htmlspecialchars($_POST['email']);
	  $password=htmlspecialchars($_POST['password']);
	  $encrypted_password = encrypt_decrypt('encrypt', $password);
	  $birth_date=htmlspecialchars($_POST['birth_date']);
	  $nickname=htmlspecialchars($_POST['nickname']);
	  $db2 = "(DESCRIPTION=(ADDRESS=(PROTOCOL=TCP)(HOST= dbs.cs.hacettepe.edu.tr)(PORT=1521))(CONNECT_DATA=(SID=dbs)))";
       if($c2 = OCILogon("C##b21328394", "21328394", $db2))
          {
		    $array2=oci_parse($c2,"insert into people values(DEFAULT,'$email','$phone_number','$encrypted_password','U','$name',to_date('$birth_date','dd-mm-yy hh24:mi:ss'))  RETURNING  person_id INTO  :person_id");
            oci_bind_by_name($array2, ':person_id', $theNewID, 8);           
		   oci_execute($array2);
		   
		    $array=oci_parse($c2,"insert into users  values('$theNewID','$nickname')");
		    oci_execute($array);

			
            $array=oci_parse($c2,"insert into logUser values(DEFAULT,'$person_id','Kullanici ekliyor.',to_date('$delivDate','dd-mm-yy hh24:mi:ss'))");		
            oci_execute($array); 
										
		 }
		oci_close($c2);
	   
	   header("Location:tumKisiler.php");
	   
	   
	   
	   
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
			  
			<?php
			 }
             ?>			
			  
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
	 
	  
     
     <div id="giris"style="height: 520px; !important;">
               <br/>
		<span style="font-weight:bold;">Kişi Bilgilerini Giriniz:</span>
		<hr/>
		<br/>
	    <form method="post">
		  <table style="width: 600px ;">
	        <tr>
		       <td><span style="font-weight:bold;">İsim:</span></td>
		       <td><input type="text" class="m" name="name" value="" /></td>
		    </tr>
		    <tr>
		       <td><span style="font-weight:bold;">Tel no:</span></td>
		        <td><input type="text" class="m" name="phone_number" value=""/></td>	  
		    </tr>
			 <tr>
		       <td><span style="font-weight:bold;">Email:</span></td>
		        <td><input type="text" class="m" name="email" value=""/></td>	  
		    </tr>
			 <tr>
		       <td><span style="font-weight:bold;">Şifre:</span></td>
		        <td><input type="text" class="m" name="password" value=""/></td>	  
		    </tr>
			<tr>
		       <td><span style="font-weight:bold;">Doğum Tarihi:</span></td>
		        <td><input type="text" class="m" name="birth_date" value=""  placeholder="../../.."/></td>	  
		    </tr>
			<tr>
		       <td><span style="font-weight:bold;">Takma isim</span></td>
		        <td><input type="text" class="m" name="nickname" value=""/></td>	  
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