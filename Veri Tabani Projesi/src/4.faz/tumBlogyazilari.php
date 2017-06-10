<?php  
session_start();  
$person_name=$_SESSION["name"];
$person_type=$_SESSION["type"];
$delivDate = date('d-m-Y h:i:s');
$person_id=$_SESSION["person_id"];
$output='';
if(isset($_GET['delete_id'])){
	
	  $db2 = "(DESCRIPTION=(ADDRESS=(PROTOCOL=TCP)(HOST= dbs.cs.hacettepe.edu.tr)(PORT=1521))(CONNECT_DATA=(SID=dbs)))";
       if($c2 = OCILogon("C##b21328394", "21328394", $db2))
          {
			
		    $array=oci_parse($c2,"delete from blog_post where blog_post_id = ".$_GET['delete_id']);		
            oci_execute($array);
		    
		
			$array=oci_parse($c2,"insert into logUser values(DEFAULT,'$person_id','Blog yazisi siliyor.',to_date('$delivDate','dd-mm-yy hh24:mi:ss'))");		
            oci_execute($array); 
			
		 }  
	  oci_close($c2);
	  header("Location:tumBlogyazilari.php");
	
}

 function fetch_data()  
 {  
      
	    $output = '';  
	  
	   $db2 = "(DESCRIPTION=(ADDRESS=(PROTOCOL=TCP)(HOST= dbs.cs.hacettepe.edu.tr)(PORT=1521))(CONNECT_DATA=(SID=dbs)))";
       if($c2 = OCILogon("C##b21328394", "21328394", $db2))
          {
		    
			 $array=oci_parse($c2,"select post_title,creation_date,category_name from blog_subcategory sb, blog_post p where p.subcategory_id=sb.subcategory_id");
	         oci_execute($array);
			
		 } 
		 
      while($row =$row=oci_fetch_array($array))  
      {       
      $output .= '<tr>  
                          <td>'.$row[0].'</td>  
                          <td>'.$row[1].'</td>  
                          <td>'.$row[2].'</td>  
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
      $obj_pdf->SetTitle("Tum Blog Yazilari");  
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
      <h3 align="center">Tum Blog Yazilari</h3><br /><br />  
      <table border="1" cellspacing="0" cellpadding="3">  
           <tr>  
                <th>Baslik</th>  
                <th>Olusturulma Tarihi</th>  
                <th>Kategori Ad</th>   
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
		   $array=oci_parse($c2,"select post_title,creation_date,category_name from blog_subcategory sb, blog_post p where p.subcategory_id=sb.subcategory_id");
	       oci_execute($array);
			
    $number=2;
	$output.="<h2>Blog Yazilari</h2><hr/>"	;
	$output.="<html><body><table border=\'".$number."\'>"	;
	
	 while($row=oci_fetch_array($array))  
      {       
      $output .="<tr><td>".$row[0]."-".$row[1]."-".$row[2]."</tr></td>";
	   
      }
      $output.="</table></body></html>";
   } 		 
	 oci_close($c2);	
   
 }
if(isset($_POST["create_txt"])){
	
  $output = 'Blog Yazilari:\r\n';  	  
	   $db2 = "(DESCRIPTION=(ADDRESS=(PROTOCOL=TCP)(HOST= dbs.cs.hacettepe.edu.tr)(PORT=1521))(CONNECT_DATA=(SID=dbs)))";
       if($c2 = OCILogon("C##b21328394", "21328394", $db2))
          {
		   $array=oci_parse($c2,"select post_title,creation_date,category_name from blog_subcategory sb, blog_post p where p.subcategory_id=sb.subcategory_id");
	       oci_execute($array);
		 	
	    while($row=oci_fetch_array($array))  
          {       
             $output .=$row[0]."-".$row[1]."-".$row[2].'\r\n';
	   
         }
     
	     
       } 		 
	 oci_close($c2);	 
	
	
}


?>  
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
         <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Blog Yazıları</title>
         <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="./resources/css/cssLayout.css" rel="stylesheet" type="text/css" />
        <link href="./resources/css/default.css" rel="stylesheet" type="text/css" />
		<script type="text/javascript">
		 function yeniBlogYazisiOlustur(){
			 window.location.href="yeniBlogYazisiOlustur.php";
		 }
		function delete_id(blog_post_id){
			
			  window.location.href="tumBlogyazilari.php?delete_id="+blog_post_id;
		}
		function ustKategoriler(){
			window.location.href="ustKategoriler.php";
			
		}
		function altKategoriler(){
			
			window.location.href="altKategoriler.php";
		}
		function blogEtiketler(){
			window.location.href="blogEtiketler.php";
			
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
		    $array3=oci_parse($c,"select blog_post_id,post_title,creation_date,category_name from blog_subcategory sb, blog_post p where p.subcategory_id=sb.subcategory_id");
	         oci_execute($array3);
			 
       ?>  
							
             </ul> 
            </div>

            <div id="icerik"style="background-color:powderblue; !important;">
               <br/>
			    <table class="bloglar" style="width: 600px !important;">
			      <thead  class="colHead">
				   <tr>
				     <th>Blog Başlığı </th>
					 <th>Yazıldğı Tarih</th>
				     <th>Alt Kategorisi</th>
					 <?php
					    if($person_type=="A"){
					  ?>
					  <th>Güncelleme</th>
					  <th>Silme</th>
					  <th>Görüntüleme</th> 
					  <?php
					  }
					  else{
					  ?>
					   <th>Görüntüleme</th>
					 <?php
					  }
					 ?>
				   </tr>
				  </thead>
			     <tbody>
				   <?php
					  while($row3=oci_fetch_array($array3)){
					
					?>	
				     <tr>
				  
					   <td><?php echo $row3[1]; ?></td>
                       <td><?php echo $row3[2];?></td>
                       <td><?php echo $row3[3]; ?></td>
					  <?php 
					   if($person_type=="A"){
					  ?>
                       
					   <td><a href="blogYazisiGuncelle?blog_post_id=<?php echo $row3[0];?>">Güncelle</a></td>
                       <td><a href="javascript:delete_id('<?php echo $row3[0]; ?>')">Sil</a></td>	
					   <td><a href="blogYazisiGetir.php?blog_post_id=<?php echo $row3[0]; ?>">Görüntüle</a></td>	
					  <?php
					   }
					    else{
					  ?>
					   <td><a href="blogYazisiGetir.php?blog_post_id=<?php echo $row3[0]; ?>">Görüntüle</a></td>
					   <?php
					    }
					   ?>
					  
                     </tr>				  
 				  <?php		
					}
					?>
				
				 </tbody>
			   
			   </table>
		     	   
			   <br/>
			   <hr/>
			   <?php
			     if($person_type=="A"){
			   ?>
			   
			   <button name="yeniBlogYazisiOlustur" onclick="yeniBlogYazisiOlustur()">Yeni Blog Yazısı</button>
			    &nbsp;
				&nbsp;
			   <button onclick="ustKategoriler()">Üst Kategoriler</button>
			   &nbsp;
			   &nbsp;
			   <button onclick="altKategoriler()">Alt Kategoriler</button>
			    &nbsp;
			    &nbsp;
			   <button onclick="blogEtiketler()">Etiketler</button>
			   
               	<?php
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
			
			
			<?php
			    oci_close($c);
			 }
			?>
	
   </body>
</html>