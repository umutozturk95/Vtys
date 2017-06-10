<?php
   if(isset($_POST['Submit'])&&!empty($_POST['email'])&&!empty($_POST['pwd'])){
      
	  $email=htmlspecialchars($_POST['email']);
	  $password=htmlspecialchars($_POST['pwd']);
	  $encrypted_password = encrypt_decrypt('encrypt', $password);
	  
	  $db = "(DESCRIPTION=(ADDRESS=(PROTOCOL=TCP)(HOST= dbs.cs.hacettepe.edu.tr)(PORT=1521))(CONNECT_DATA=(SID=dbs)))";
       if($c = OCILogon("C##b21328394", "21328394", $db))
       {
		    $array=oci_parse($c,"select * from people where password = '$encrypted_password' and email = '$email' ");
            oci_execute($array);
			if($row=oci_fetch_array($array)){
				
			   $array=oci_parse($c,"select * from blocked where user_id =".$row[0]);
		       oci_execute($array);
			 if($blocked=oci_fetch_array($array)){  
				   
				$message="Engellendiğiniz için giriş yapamazsınız!";
			  }
              else{ 			
				 session_start();
				 $_SESSION["person_id"]=$row[0];
				 $_SESSION["email"]=$row[1];
				 $_SESSION["phone_number"]=$row[2];
				 $_SESSION["password"]=$row[3];
				 $_SESSION["type"]=$row[4];
				 $_SESSION["name"]=$row[5];
				 $_SESSION["birth_date"]=$row[6];
					
				 if($_SESSION["type"]=="A"){
				   	
					 header("Location:yazarMainPage.php");
				 }
				  else{
					
					header("Location:userMainPage.php");
					
				  }
			 
			  }
			
			}
			else{
				
				$message="Geçersiz şifre veya email!";
				 		
			}
		      oci_close($c);
	   }
	   else{
		   
		    $err = OCIError();
		   
	   }
  }
  else{
	   $message="";
	  
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
        <title>Login Page</title>
		 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
         <meta name="viewport" content="width=device-width, initial-scale=1">
         <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
         <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
         <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link href="./resources/css/default.css" rel="stylesheet" type="text/css" />
        <link href="./resources/css/cssLayout.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
	 
         
        <div id="baslik">
           BLOG SİTESİ
        </div>
        <div id="aciklama">
             Sitemize Hoşgeldiniz!
        </div>
        <div id="giris" style="height: 500px !important;">
            <div class="container">
              <form   method="post">
             <div class="form-group">
               <label for="email">Email:</label>
              <input type="email" class="form-control" placeholder="Email Enter" id="email" name="email" required/>
            </div>
          <div class="form-group">
           <label for="pwd">Şifre:</label>
           <input type="password" class="form-control" placeholder="Password Enter"  id="pwd"  name="pwd" required/>
        </div>
          <button type="submit" name="Submit"  class="btn btn-default">Submit</button>
		  <br/>
		 <span style="font-weight: bold; color:red;" ><?php echo $message; ?></span>
  </form>
</div>
        </div>
        <div id="footer"> Copyright @www.blog_site.com</div>
    </body>
</html>
