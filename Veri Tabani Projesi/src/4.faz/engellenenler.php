<?php  
session_start();  
$person_name=$_SESSION["name"];
$person_type=$_SESSION["type"];
$delivDate = date('d-m-Y h:i:s');
$person_id=$_SESSION["person_id"];
$output='';
if(isset($_GET['engellenen_id'])){
	
	  $db2 = "(DESCRIPTION=(ADDRESS=(PROTOCOL=TCP)(HOST= dbs.cs.hacettepe.edu.tr)(PORT=1521))(CONNECT_DATA=(SID=dbs)))";
       if($c2 = OCILogon("C##b21328394", "21328394", $db2))
          {
		    $array=oci_parse($c2,"delete from blocked where user_id = ".$_GET['engellenen_id']);		
            oci_execute($array);
			
			
            $array=oci_parse($c2,"insert into logUser values(DEFAULT,'$person_id','Kullanici engelini kaldiriyor.',to_date('$delivDate','dd-mm-yy hh24:mi:ss'))");		
            oci_execute($array); 
				
		 }  
	  oci_close($c2);
	  header("Location:engellenenler.php");
	
}


function fetch_data()  
 {  
      
	    $output = '';  
	  
	   $db2 = "(DESCRIPTION=(ADDRESS=(PROTOCOL=TCP)(HOST= dbs.cs.hacettepe.edu.tr)(PORT=1521))(CONNECT_DATA=(SID=dbs)))";
       if($c2 = OCILogon("C##b21328394", "21328394", $db2))
          {
		  $array=oci_parse($c2,"select p.name,p.email,p.phone_number,p.birth_date,p.type,b.block_cause from people p,blocked b where p.person_id=b.user_id");
          oci_execute($array);
			
		 } 
		 
      while($row =oci_fetch_array($array))  
      {       
      $output .= '<tr>  
                          <td>'.$row[0].'</td>  
                          <td>'.$row[1].'</td>  
                          <td>'.$row[2].'</td>  
                          <td>'.$row[3].'</td>  
                          <td>'.$row[4].'</td>  
                          <td>'.$row[5].'</td>  
                     </tr>  
                          ';  
      }  

        oci_close($c2);
      return $output;  
 }  
 if(isset($_POST["create_pdf"]))  
 {  
      require_once('tcpdf/tcpdf.php');  
      $obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);  
      $obj_pdf->SetCreator(PDF_CREATOR);  
      $obj_pdf->SetTitle("Engellenenler");  
      $obj_pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);  
      $obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));  
      $obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));  
      $obj_pdf->SetDefaultMonospacedFont('helvetica');  
      $obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);  
      $obj_pdf->SetMargins(PDF_MARGIN_LEFT, '5', PDF_MARGIN_RIGHT);  
      $obj_pdf->setPrintHeader(false);  
      $obj_pdf->setPrintFooter(false);  
      $obj_pdf->SetAutoPageBreak(TRUE, 10);  
      $obj_pdf->SetFont('helvetica', '', 12); 
	  
      $obj_pdf->AddPage();  
      $content = '';  
      $content .= '  
      <h3 align="center">Engellenenler</h3><br /><br />  
      <table border="1" cellspacing="0" cellpadding="6">  
           <tr>  
                <th>Ad</th>  
                <th>Email</th>  
                <th>Tel No</th>  
                <th>Dogum Tarihi</th>  
                <th>Tip</th>
                <th>Engellenme Nedeni</th>  				
           </tr>  
      ';  
      $content .= fetch_data();  
      $content .= '</table>';  
      $obj_pdf->writeHTML($content);  
      $obj_pdf->Output('sample.pdf', 'I');  
 }  

 if(isset($_POST["create_html"]))  
 {  
   $output='';
	  $db2 = "(DESCRIPTION=(ADDRESS=(PROTOCOL=TCP)(HOST= dbs.cs.hacettepe.edu.tr)(PORT=1521))(CONNECT_DATA=(SID=dbs)))";
       if($c2 = OCILogon("C##b21328394", "21328394", $db2))
          {
		  $array=oci_parse($c2,"select p.name,p.email,p.phone_number,p.birth_date,p.type,b.block_cause from people p,blocked b where p.person_id=b.user_id");
          oci_execute($array);
			
		  $number=2;
	$output.="<h2>Engellenenler</h2><hr/>"	;
	$output.="<html><body><table border=\'".$number."\'>"	;
	
	 while($row=oci_fetch_array($array))  
      {       
      $output .="<tr><td>".$row[0]."-".$row[1]."-".$row[2]."-".$row[3]."-".$row[4]."-".$row[5]."</tr></td>";
	   
      }
      $output.="</table></body></html>";
   } 		 
	 oci_close($c2);	
   
 }
if(isset($_POST["create_txt"])){
	
  $output = 'Engellenenler:\r\n';  	  
	   $db2 = "(DESCRIPTION=(ADDRESS=(PROTOCOL=TCP)(HOST= dbs.cs.hacettepe.edu.tr)(PORT=1521))(CONNECT_DATA=(SID=dbs)))";
       if($c2 = OCILogon("C##b21328394", "21328394", $db2))
          {
		  $array=oci_parse($c2,"select p.name,p.email,p.phone_number,p.birth_date,p.type,b.block_cause from people p,blocked b where p.person_id=b.user_id");
          oci_execute($array);
			
			
	    while($row=oci_fetch_array($array))  
          {       
             $output .=$row[0]."-".$row[1]."-".$row[2]."-".$row[3]."-".$row[4]."-".$row[5].'\r\n';
	   
         }
     
	     
       } 		 
	 oci_close($c2);	 
	
	
}

?>  
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
         <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Engellenenler</title>
         <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="./resources/css/cssLayout.css" rel="stylesheet" type="text/css" />
        <link href="./resources/css/default.css" rel="stylesheet" type="text/css" />
		<script type="text/javascript">
	    function engellemeKaldir(engellenen_id){
			
			window.location.href='engellenenler.php?engellenen_id='+engellenen_id;		
		}
		
		function downloadHtml(text) {
         var element = document.createElement('a');
          element.setAttribute('href', 'data:text/html;charset=utf-8,' + encodeURIComponent(text));
          element.setAttribute('download',"reportHtml.html");
          document.body.appendChild(element);

          element.click();

          document.body.removeChild(element); 
      }
		function downloadText(text) {
         var element = document.createElement('a');
          element.setAttribute('href', 'data:text/text ;charset=utf-8,' + encodeURIComponent(text));
          element.setAttribute('download',"reportTxt.txt");
          document.body.appendChild(element);

          element.click();

          document.body.removeChild(element); 
      }
		
		</script>
		

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
			   <span style="font-weight:bold;">Engellenenler:</span>
			   <hr/>
		<?php			
          	
		         $array=oci_parse($c,"select p.person_id,p.name,p.email,p.phone_number,p.birth_date,p.type,b.block_cause from people p,blocked b where p.person_id=b.user_id");
                 oci_execute($array);
			     
					 
       ?>  		   
			    <table class="bloglar" style="width: 800px !important;">
			      <thead  class="colHead">
				   <tr>
				     <th>İsim</th>
					 <th>Email</th>
				     <th>Tel No</th>
					 <th>Doğum Tarihi</th>
					 <th>Tip</th>
					 <th>Engellenme Nedeni</th>
					 <th>Görüntüleme</th>
					 <th>Engellemeyi Kaldır</th>
				   </tr>
                 </thead>
                <tbody>
				
				 <?php
				  while($row=oci_fetch_array($array)){
				 ?>
				  <tr>	  
                       <td><?php echo $row[1];?></td>
                       <td><?php echo $row[2]; ?></td>
					   <td><?php echo $row[3];?></td>
                       <td><?php echo $row[4];?></td>
					   <td><?php echo $row[5];?></td>
					   <td><?php echo $row[6] ?></td>
					   <td><a href="kisiGoruntule.php?person_id=<?php echo $row[0];?>">Görüntüle</a></td>
					   <td><a href="javascript:engellemeKaldir('<?php echo $row[0];?>')">Engellemeyi Kaldır</a></td>
						 
				  </tr>
				  
				  <?php
				   }
				   ?>
				</tbody>
			</table>	
   			<hr/>	 
			<br/>
			   
	<?php
          oci_close($c);
	   }
     ?>	
	   
	   <br/>
	   <br/>
	   <span style="font-weight:bold;">Raporlama Tipleri</span>
	   <hr/>
	   <table>
	       <form method="post">  
             <tr>
			  <td><input type="submit" name="create_pdf" value="PDF"/></td>  
			
			  <td><input type="submit" name="create_txt" value="TXT"/></td>  
           
			  <td><input type="submit" name="create_html" value="HTML"/></td>  
			</tr>
		  </form>  
		   <tr>
		   <td></td>
           <td><button name="download" onclick="downloadText('<?php echo $output;?>')"><strong>TXT İndir</strong></button></td>			
	       
		  <td><button name="download" onclick="downloadHtml('<?php echo $output;?>')"><strong>HTML İndir</strong></button></td>		
	      </tr>
		</table>
		 <hr/>
    </div>
			

   </body>
</html>