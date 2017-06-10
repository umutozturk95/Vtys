
BEGIN    
  people_insert('ahmet@gmail.com','0545286305','ahmet58','U','ahmet sahin',to_date('2003/05/03', 'yyyy/mm/dd'));  
   dbms_output.put_line('record inserted successfully'); 
END;
/
BEGIN    
   people_insert('mehmet@gmail.com','0545286334','mehmet58','U','mehmet sahin',to_date('2005/05/03', 'yyyy/mm/dd'));  
   dbms_output.put_line('record inserted successfully');  
END;
/  
BEGIN 
   people_insert('ali@gmail.com','0545276305','ali58','U','ali sahin',to_date('2008/05/03', 'yyyy/mm/dd'));  
   dbms_output.put_line('record inserted successfully'); 
END;
/
BEGIN    
   people_insert('veli@gmail.com','0545486305','veli58','U','veli sahin',to_date('2023/05/03', 'yyyy/mm/dd'));  
   dbms_output.put_line('record inserted successfully');    
END;
/
BEGIN   
   people_insert('zeynep@gmail.com','0545347305','zeynep58','U','zeynep sahin',to_date('2013/05/03', 'yyyy/mm/dd'));  
   dbms_output.put_line('record inserted successfully');  
END;
/
BEGIN   
   people_insert('seyit@gmail.com','0545966305','seyit58','U','seyit orman',to_date('211/05/03', 'yyyy/mm/dd'));  
   dbms_output.put_line('record inserted successfully'); 
END;
/
BEGIN    
   people_insert('elif@gmail.com','0545286125','elif44','U','elif duman',to_date('1993/05/03', 'yyyy/mm/dd'));  
   dbms_output.put_line('record inserted successfully');  
END;
/
BEGIN   
   people_insert('salim@gmail.com','0545286995','12salim','U','salim saygin',to_date('2003/05/03', 'yyyy/mm/dd'));  
   dbms_output.put_line('record inserted successfully');
END;
/
BEGIN     
   people_insert('nusret@gmail.com','0545123405','nusret58','U','nusret dogan',to_date('2005/05/03', 'yyyy/mm/dd'));  
   dbms_output.put_line('record inserted successfully'); 
END;
/
BEGIN    
   people_insert('kazim@gmail.com','0545284405','kazim58','U','kazim kangalli',to_date('2003/08/03', 'yyyy/mm/dd'));  
   dbms_output.put_line('record inserted successfully'); 
END;
/
BEGIN    
   people_insert('admin@gmail.com','0545000305','admin58','A','umut talat',to_date('1992/10/03', 'yyyy/mm/dd'));  
   dbms_output.put_line('record inserted successfully');  
END;

/

BEGIN    
  author_insert(1, 'Yazar Sivasta dogdu. ');  
   dbms_output.put_line('record inserted successfully'); 
END;

/


BEGIN    
  users_insert(2,'ahmet');  
   dbms_output.put_line('record inserted successfully'); 
END;
/

BEGIN    
  users_insert(3,'mehmet');  
   dbms_output.put_line('record inserted successfully'); 
END;
/

BEGIN    
  users_insert(4,'ali');  
   dbms_output.put_line('record inserted successfully'); 
END;
/

BEGIN    
  users_insert(5,'veli');  
   dbms_output.put_line('record inserted successfully'); 
END;
/

BEGIN    
  users_insert(6,'zeynep');  
   dbms_output.put_line('record inserted successfully'); 
END;
/

BEGIN    
  users_insert(7,'elif');  
   dbms_output.put_line('record inserted successfully'); 
END;
/

BEGIN    
  users_insert(8,'salim');  
   dbms_output.put_line('record inserted successfully'); 
END;
/

BEGIN    
  users_insert(9,'nusret');  
   dbms_output.put_line('record inserted successfully'); 
END;
/

BEGIN    
  users_insert(10,'kazim');  
   dbms_output.put_line('record inserted successfully'); 
END;
/

BEGIN    
  users_insert(11,'seyit');  
   dbms_output.put_line('record inserted successfully'); 
END;
/

 BEGIN    
  blog_insert(1, 'yazilim', 'yazilim hakkinda bilgiler icerir.',to_date('1992/10/03', 'yyyy/mm/dd') );  
   dbms_output.put_line('record inserted successfully'); 
END;
/

 BEGIN    
  blog_topcategory_insert('C',1);  
   dbms_output.put_line('record inserted successfully'); 
END;
/

BEGIN    
  blog_topcategory_insert('C++',2);  
   dbms_output.put_line('record inserted successfully'); 
END;
/

BEGIN    
  blog_topcategory_insert('Java',3);  
   dbms_output.put_line('record inserted successfully'); 
END;
/

BEGIN    
  blog_topcategory_insert('C#',4);  
   dbms_output.put_line('record inserted successfully'); 
END;
/

BEGIN    
  blog_topcategory_insert('Objective C',5);  
   dbms_output.put_line('record inserted successfully'); 
END;
/

BEGIN    
  blog_topcategory_insert('Python',6);  
   dbms_output.put_line('record inserted successfully'); 
END;
/

BEGIN    
  blog_topcategory_insert('Delphi',7);  
   dbms_output.put_line('record inserted successfully'); 
END;
/

BEGIN    
  blog_topcategory_insert('Kotlin',8);  
   dbms_output.put_line('record inserted successfully'); 
END;
/

BEGIN    
  blog_topcategory_insert('PHP',9);  
   dbms_output.put_line('record inserted successfully'); 
END;
/

BEGIN    
  blog_topcategory_insert('HTML',10);  
   dbms_output.put_line('record inserted successfully'); 
END;
/

BEGIN    
  blog_subcategory_insert(1,'C Kosullar', 1);  
   dbms_output.put_line('record inserted successfully'); 
END;
/

BEGIN    
  blog_subcategory_insert(2,'C++ variables', 2);  
   dbms_output.put_line('record inserted successfully'); 
END;
/

BEGIN    
  blog_subcategory_insert(3,'Java kurulumu', 3);  
   dbms_output.put_line('record inserted successfully'); 
END;
/

BEGIN    
  blog_subcategory_insert(4,'C# tarihcesi', 4);  
   dbms_output.put_line('record inserted successfully'); 
END;
/

BEGIN    
  blog_subcategory_insert(5,'Swift Dili', 5);  
   dbms_output.put_line('record inserted successfully'); 
END;
/

BEGIN    
  blog_subcategory_insert(6,'Python Programlama', 6);  
   dbms_output.put_line('record inserted successfully'); 
END;
/

BEGIN    
  blog_subcategory_insert(7,'Delphi Kurulum', 7);  
   dbms_output.put_line('record inserted successfully'); 
END;
/

BEGIN    
  blog_subcategory_insert(8,'Kotlin nedir', 8);  
   dbms_output.put_line('record inserted successfully'); 
END;
/

BEGIN    
  blog_subcategory_insert(9,'PHP Donguler', 9);  
   dbms_output.put_line('record inserted successfully'); 
END;
/

BEGIN    
  blog_subcategory_insert(10,'Html Tags', 10);  
   dbms_output.put_line('record inserted successfully'); 
END;
/


BEGIN    
  blog_post_insert(1,1,'if-else kullanimi','if-else ve elseif kullanimlari detaylari' ,to_date('1992/10/03', 'yyyy/mm/dd'));  
   dbms_output.put_line('record inserted successfully'); 
END;
/


BEGIN    
  blog_post_insert(1,2,'Variables Kullanimi','integer double long gibi tipler vardir.' ,to_date('1992/10/03', 'yyyy/mm/dd'));  
   dbms_output.put_line('record inserted successfully'); 
END;
/

BEGIN    
  blog_post_insert(1,3,'JDK kurulum','Java SE 8 surumunu indirin.' ,to_date('1992/10/03', 'yyyy/mm/dd'));  
   dbms_output.put_line('record inserted successfully'); 
END;
/

BEGIN    
  blog_post_insert(1,4,'C# Yapim Sureci','1992 yilinda yapildi' ,to_date('1992/10/03', 'yyyy/mm/dd'));  
   dbms_output.put_line('record inserted successfully'); 
END;
/

BEGIN    
  blog_post_insert(1,5,'Swift Nedir','Apple firmasi gelistirdi' ,to_date('1992/10/03', 'yyyy/mm/dd'));  
   dbms_output.put_line('record inserted successfully'); 
END;
/

BEGIN    
  blog_post_insert(1,6,'Python giris dersi','python esnek bir dildir' ,to_date('1992/10/03', 'yyyy/mm/dd'));  
   dbms_output.put_line('record inserted successfully'); 
END;
/

BEGIN    
  blog_post_insert(1,7,'Delphi Hazirlanmasi','delphi 3 surumunu kurunuz' ,to_date('1992/10/03', 'yyyy/mm/dd'));  
   dbms_output.put_line('record inserted successfully'); 
END;
/

BEGIN    
  blog_post_insert(1,8,'Kotlin Hakkinda','Kotlin bir Android bilesenidir.' ,to_date('1992/10/03', 'yyyy/mm/dd'));  
   dbms_output.put_line('record inserted successfully'); 
END;
/

BEGIN    
  blog_post_insert(1,9,'Php While','while dongusu onemlidir' ,to_date('1992/10/03', 'yyyy/mm/dd'));  
   dbms_output.put_line('record inserted successfully'); 
END;
/

BEGIN    
  blog_post_insert(1,10,'Br tag','satir basini dondurur' ,to_date('1992/10/03', 'yyyy/mm/dd'));  
   dbms_output.put_line('record inserted successfully'); 
END;
/


BEGIN    
  blog_tag_insert('#java');  
   dbms_output.put_line('record inserted successfully'); 
END;
/


BEGIN    
  blog_tag_insert('#c++');  
   dbms_output.put_line('record inserted successfully'); 
END;
/

BEGIN    
  blog_tag_insert('#c');  
   dbms_output.put_line('record inserted successfully'); 
END;
/

BEGIN    
  blog_tag_insert('#c#');  
   dbms_output.put_line('record inserted successfully'); 
END;
/

BEGIN    
  blog_tag_insert('#swift');  
   dbms_output.put_line('record inserted successfully'); 
END;
/

BEGIN    
  blog_tag_insert('#delphi');  
   dbms_output.put_line('record inserted successfully'); 
END;
/

BEGIN    
  blog_tag_insert('#kotlin');  
   dbms_output.put_line('record inserted successfully'); 
END;
/

BEGIN    
  blog_tag_insert('#html');  
   dbms_output.put_line('record inserted successfully'); 
END;
/

BEGIN    
  blog_tag_insert('#network');  
   dbms_output.put_line('record inserted successfully'); 
END;
/

BEGIN    
  blog_tag_insert('#yazilim');  
   dbms_output.put_line('record inserted successfully'); 
END;
/



BEGIN    
  contact_create(1, 'facebook: @umut_talat, twitter: @umut_talat');  
   dbms_output.put_line('record inserted successfully'); 
END;
/


BEGIN    
  about_create(1, '1992 yilinda ankarada dogdu. yazilim gelistiriyor.');  
   dbms_output.put_line('record inserted successfully'); 
END;
/


BEGIN    
  comments_insert(1, 1,to_date('1992/10/03', 'yyyy/mm/dd'), 'yazý hakkinda', 'iyi anlatilmis' );  
   dbms_output.put_line('record inserted successfully'); 
END;
/

BEGIN    
  comments_insert(2, 2,to_date('1992/10/03', 'yyyy/mm/dd'), 'yazi kotu', 'ozensiz anlatilmis' );  
   dbms_output.put_line('record inserted successfully'); 
END;
/

BEGIN    
  comments_insert(3, 5,to_date('1992/10/03', 'yyyy/mm/dd'), 'yazar hakkinda', 'yazar cok donanimli' );  
   dbms_output.put_line('record inserted successfully'); 
END;
/

BEGIN    
  comments_insert(4, 1,to_date('1992/10/03', 'yyyy/mm/dd'), 'java', 'cok kral bir dil' );  
   dbms_output.put_line('record inserted successfully'); 
END;
/

BEGIN    
  comments_insert(5, 2,to_date('1992/10/03', 'yyyy/mm/dd'), 'c++', 'zor bir dil' );  
   dbms_output.put_line('record inserted successfully'); 
END;
/

BEGIN    
  comments_insert(5, 6,to_date('1992/10/03', 'yyyy/mm/dd'), 'anlatim tarzi', 'anlatim tarzi cok guzel' );  
   dbms_output.put_line('record inserted successfully'); 
END;
/

BEGIN    
  comments_insert(6, 1,to_date('1992/10/03', 'yyyy/mm/dd'), 'yazim tarzi', 'imla hatalari var' );  
   dbms_output.put_line('record inserted successfully'); 
END;
/

BEGIN    
  comments_insert(7, 8,to_date('1992/10/03', 'yyyy/mm/dd'), 'uzun yazi', 'yazi cok uzun' );  
   dbms_output.put_line('record inserted successfully'); 
END;
/

BEGIN    
  comments_insert(7, 7,to_date('1992/10/03', 'yyyy/mm/dd'), 'kisa yazi', 'yazi cok kisa' );  
   dbms_output.put_line('record inserted successfully'); 
END;
/

BEGIN    
  comments_insert(7, 9,to_date('1992/10/03', 'yyyy/mm/dd'), 'paylasma', 'yaziyi kendi sitemde yayinlamak isterim' );  
   dbms_output.put_line('record inserted successfully'); 
END;
/



BEGIN    
  blog_post_to_tag_insert(1,1);  
   dbms_output.put_line('record inserted successfully'); 
END;
/


BEGIN    
  blog_post_to_tag_insert(1, 2);  
   dbms_output.put_line('record inserted successfully'); 
END;
/

BEGIN    
  blog_post_to_tag_insert(1, 3);  
   dbms_output.put_line('record inserted successfully'); 
END;
/

BEGIN    
  blog_post_to_tag_insert(2, 4);  
   dbms_output.put_line('record inserted successfully'); 
END;
/

BEGIN    
  blog_post_to_tag_insert(2,5);  
   dbms_output.put_line('record inserted successfully'); 
END;
/

BEGIN    
  blog_post_to_tag_insert(1, 5);  
   dbms_output.put_line('record inserted successfully'); 
END;
/

BEGIN    
  blog_post_to_tag_insert(8,6);  
   dbms_output.put_line('record inserted successfully'); 
END;
/

BEGIN    
  blog_post_to_tag_insert(5,8);  
   dbms_output.put_line('record inserted successfully'); 
END;
/

BEGIN    
  blog_post_to_tag_insert(1,9);  
   dbms_output.put_line('record inserted successfully'); 
END;
/

BEGIN    
  blog_post_to_tag_insert(5,3);  
   dbms_output.put_line('record inserted successfully'); 
END;
/



 
 BEGIN    
  blog_post_like_insert(1,23);  
   dbms_output.put_line('record inserted successfully'); 
END;
/

 BEGIN    
  blog_post_like_insert(2,234);  
   dbms_output.put_line('record inserted successfully'); 
END;
/

 BEGIN    
  blog_post_like_insert(3,223);  
   dbms_output.put_line('record inserted successfully'); 
END;
/

 BEGIN    
  blog_post_like_insert(4,253);  
   dbms_output.put_line('record inserted successfully'); 
END;
/

 BEGIN    
  blog_post_like_insert(5,236);  
   dbms_output.put_line('record inserted successfully'); 
END;
/

 BEGIN    
  blog_post_like_insert(6,243);  
   dbms_output.put_line('record inserted successfully'); 
END;
/

 BEGIN    
  blog_post_like_insert(7,26);  
   dbms_output.put_line('record inserted successfully'); 
END;
/

 BEGIN    
  blog_post_like_insert(8,93);  
   dbms_output.put_line('record inserted successfully'); 
END;
/

 BEGIN    
  blog_post_like_insert(9,83);  
   dbms_output.put_line('record inserted successfully'); 
END;
/

 BEGIN    
  blog_post_like_insert(10,63);  
   dbms_output.put_line('record inserted successfully'); 
END;
/


  BEGIN    
  blog_post_score_insert(1,123);  
   dbms_output.put_line('record inserted successfully'); 
END;
/
 
  BEGIN    
  blog_post_score_insert(2,13);  
   dbms_output.put_line('record inserted successfully'); 
END;
/

  BEGIN    
  blog_post_score_insert(3,14);  
   dbms_output.put_line('record inserted successfully'); 
END;
/

  BEGIN    
  blog_post_score_insert(4,623);  
   dbms_output.put_line('record inserted successfully'); 
END;
/

  BEGIN    
  blog_post_score_insert(5,323);  
   dbms_output.put_line('record inserted successfully'); 
END;
/

  BEGIN    
  blog_post_score_insert(6,143);  
   dbms_output.put_line('record inserted successfully'); 
END;
/

  BEGIN    
  blog_post_score_insert(7,193);  
   dbms_output.put_line('record inserted successfully'); 
END;
/

  BEGIN    
  blog_post_score_insert(8,183);  
   dbms_output.put_line('record inserted successfully'); 
END;
/

  BEGIN    
  blog_post_score_insert(9,453);  
   dbms_output.put_line('record inserted successfully'); 
END;
/

  BEGIN    
  blog_post_score_insert(10,463);  
   dbms_output.put_line('record inserted successfully'); 
END;
/


  BEGIN    
  liked_blog_post_insert(1,1);  
   dbms_output.put_line('record inserted successfully'); 
END;
/

BEGIN    
  liked_blog_post_insert(1,2);  
   dbms_output.put_line('record inserted successfully'); 
END;
/
BEGIN    
  liked_blog_post_insert(1,3);  
   dbms_output.put_line('record inserted successfully'); 
END;
/

BEGIN    
  liked_blog_post_insert(2,2);  
   dbms_output.put_line('record inserted successfully'); 
END;
/
BEGIN    
  liked_blog_post_insert(3,1);  
   dbms_output.put_line('record inserted successfully'); 
END;
/

BEGIN    
  liked_blog_post_insert(4,2);  
   dbms_output.put_line('record inserted successfully'); 
END;
/
BEGIN    
  liked_blog_post_insert(5,1);  
   dbms_output.put_line('record inserted successfully'); 
END;
/

BEGIN    
  liked_blog_post_insert(6,2);  
   dbms_output.put_line('record inserted successfully'); 
END;
/
BEGIN    
  liked_blog_post_insert(7,1);  
   dbms_output.put_line('record inserted successfully'); 
END;
/

BEGIN    
  liked_blog_post_insert(8,2);  
   dbms_output.put_line('record inserted successfully'); 
END;
/



  BEGIN    
  delete_blog_post_insert(1,1, to_date('2023/10/03', 'yyyy/mm/dd'), 'eski yazi');  
   dbms_output.put_line('record inserted successfully'); 
END;
/


 BEGIN    
  delete_blog_post_insert(2,1, to_date('2020/10/03', 'yyyy/mm/dd'), 'guncel degil');  
   dbms_output.put_line('record inserted successfully'); 
END;
/

 BEGIN    
  delete_blog_post_insert(3,1, to_date('2011/10/03', 'yyyy/mm/dd'), 'faydasiz');  
   dbms_output.put_line('record inserted successfully'); 
END;
/

 BEGIN    
  delete_blog_post_insert(4,1, to_date('2011/10/03', 'yyyy/mm/dd'), 'eski  yazi');  
   dbms_output.put_line('record inserted successfully'); 
END;
/

 BEGIN    
  delete_blog_post_insert(5,1, to_date('2034/10/03', 'yyyy/mm/dd'), 'dil kullanilmiyor');  
   dbms_output.put_line('record inserted successfully'); 
END;
/

 BEGIN    
  delete_blog_post_insert(6,1, to_date('2012/10/03', 'yyyy/mm/dd'), 'eski yazi');  
   dbms_output.put_line('record inserted successfully'); 
END;
/

 BEGIN    
  delete_blog_post_insert(7,1, to_date('2045/10/03', 'yyyy/mm/dd'), 'cok sikayet alindi');  
   dbms_output.put_line('record inserted successfully'); 
END;
/

 BEGIN    
  delete_blog_post_insert(8,1, to_date('2022/10/03', 'yyyy/mm/dd'), 'yanlis yazilmis');  
   dbms_output.put_line('record inserted successfully'); 
END;
/

 BEGIN    
  delete_blog_post_insert(9,1, to_date('2045/10/03', 'yyyy/mm/dd'), 'guncel degil');  
   dbms_output.put_line('record inserted successfully'); 
END;
/

 BEGIN    
   delete_blog_post_insert(10,1, to_date('2023/10/03', 'yyyy/mm/dd'), 'eski yazi');  
   dbms_output.put_line('record inserted successfully'); 
END;
/


 BEGIN    
  blocked_insert(2,1,'kufur');  
   dbms_output.put_line('record inserted successfully'); 
END;
/


 BEGIN    
  blocked_insert(3,1,'kufur');  
   dbms_output.put_line('record inserted successfully'); 
END;
/

 BEGIN    
  blocked_insert(4,1,'kufur');  
   dbms_output.put_line('record inserted successfully'); 
END;
/

 BEGIN    
  blocked_insert(5,1,'kufur');  
   dbms_output.put_line('record inserted successfully'); 
END;
/

 BEGIN    
  blocked_insert(6,1,'hakaret');  
   dbms_output.put_line('record inserted successfully'); 
END;
/

 BEGIN    
  blocked_insert(7,1,'kufur');  
   dbms_output.put_line('record inserted successfully'); 
END;
/

 BEGIN    
  blocked_insert(8,1,'hakaret');  
   dbms_output.put_line('record inserted successfully'); 
END;
/

 BEGIN    
  blocked_insert(9,1,'kufur');  
   dbms_output.put_line('record inserted successfully'); 
END;
/

 BEGIN    
  blocked_insert(10,1,'hakaret');  
   dbms_output.put_line('record inserted successfully'); 
END;
/

 BEGIN    
  blocked_insert(11,1,'kufur');  
   dbms_output.put_line('record inserted successfully'); 
END;
/



BEGIN    
  announcement_insert(1, 'c dersleri yayinlandi', 'c dersleri',to_date('2045/10/03', 'yyyy/mm/dd') );  
   dbms_output.put_line('record inserted successfully'); 
END;
/

 BEGIN    
  announcement_insert(1, 'Java dersleri yayinlandi', 'Java dersleri',to_date('2045/10/03', 'yyyy/mm/dd') );  
   dbms_output.put_line('record inserted successfully'); 
END;
/

 BEGIN    
  announcement_insert(1, 'c# dersleri yayinlandi', 'c# dersleri',to_date('2045/10/03', 'yyyy/mm/dd') );  
   dbms_output.put_line('record inserted successfully'); 
END;
/

 BEGIN    
  announcement_insert(1, 'c++ dersleri yayinlandi', 'c++ dersleri',to_date('2045/10/03', 'yyyy/mm/dd') );  
   dbms_output.put_line('record inserted successfully'); 
END;
/


 BEGIN    
  announcement_insert(1, 'objective c dersleri yayinlandi', 'objective c dersleri',to_date('2045/10/03', 'yyyy/mm/dd') );  
   dbms_output.put_line('record inserted successfully'); 
END;
/

 BEGIN    
  announcement_insert(1, 'Python dersleri yayinlandi', 'Python dersleri',to_date('2045/10/03', 'yyyy/mm/dd') );  
   dbms_output.put_line('record inserted successfully'); 
END;
/

 BEGIN    
  announcement_insert(1, 'Delphi dersleri yayinlandi', 'Delphi dersleri',to_date('2045/10/03', 'yyyy/mm/dd') );  
   dbms_output.put_line('record inserted successfully'); 
END;
/

 BEGIN    
  announcement_insert(1, 'ruby dersleri yayinlandi', 'ruby dersleri',to_date('2045/10/03', 'yyyy/mm/dd') );  
   dbms_output.put_line('record inserted successfully'); 
END;
/

 BEGIN    
  announcement_insert(1, 'cisco dersleri yayinlandi', 'cisco dersleri',to_date('2045/10/03', 'yyyy/mm/dd') );  
   dbms_output.put_line('record inserted successfully'); 
END;
/

 BEGIN    
  announcement_insert(1, 'graph dersleri yayinlandi', 'graph dersleri',to_date('2045/10/03', 'yyyy/mm/dd') );  
   dbms_output.put_line('record inserted successfully'); 
END;
/

 BEGIN    
  announcement_tag_insert('#pointer');  
   dbms_output.put_line('record inserted successfully'); 
END;
/


 BEGIN    
  announcement_tag_insert('#array');  
   dbms_output.put_line('record inserted successfully'); 
END;
/

 BEGIN    
  announcement_tag_insert('#dfs');  
   dbms_output.put_line('record inserted successfully'); 
END;
/

 BEGIN    
  announcement_tag_insert('#encap');  
   dbms_output.put_line('record inserted successfully'); 
END;
/

 BEGIN    
  announcement_tag_insert('#router');  
   dbms_output.put_line('record inserted successfully'); 
END;
/

 BEGIN    
  announcement_tag_insert('#ruby');  
   dbms_output.put_line('record inserted successfully'); 
END;
/

 BEGIN    
  announcement_tag_insert('#kruskal');  
   dbms_output.put_line('record inserted successfully'); 
END;
/

 BEGIN    
  announcement_tag_insert('#stack');  
   dbms_output.put_line('record inserted successfully'); 
END;
/

 BEGIN    
  announcement_tag_insert('#queue');  
   dbms_output.put_line('record inserted successfully'); 
END;
/

 BEGIN    
  announcement_tag_insert('#euler');  
   dbms_output.put_line('record inserted successfully'); 
END;
/




 BEGIN    
  announcement_to_tag_insert(1,1);  
   dbms_output.put_line('record inserted successfully'); 
END;
/



 BEGIN    
  announcement_to_tag_insert(2,2);  
   dbms_output.put_line('record inserted successfully'); 
END;
/


 BEGIN    
  announcement_to_tag_insert(3,3);  
   dbms_output.put_line('record inserted successfully'); 
END;
/


 BEGIN    
  announcement_to_tag_insert(4,4);  
   dbms_output.put_line('record inserted successfully'); 
END;
/


 BEGIN    
  announcement_to_tag_insert(5,5);  
   dbms_output.put_line('record inserted successfully'); 
END;
/


 BEGIN    
  announcement_to_tag_insert(6,6);  
   dbms_output.put_line('record inserted successfully'); 
END;
/


 BEGIN    
  announcement_to_tag_insert(7,7);  
   dbms_output.put_line('record inserted successfully'); 
END;
/


 BEGIN    
  announcement_to_tag_insert(8,8);  
   dbms_output.put_line('record inserted successfully'); 
END;
/


 BEGIN    
  announcement_to_tag_insert(9,9);  
   dbms_output.put_line('record inserted successfully'); 
END;
/


 BEGIN    
  announcement_to_tag_insert(10,10);  
   dbms_output.put_line('record inserted successfully'); 
END;
/



 BEGIN    
  edit_comment_insert(1,1,to_date('2045/10/03', 'yyyy/mm/dd'));  
   dbms_output.put_line('record inserted successfully'); 
END;
/



 BEGIN    
  edit_comment_insert(2,1,to_date('2045/10/03', 'yyyy/mm/dd'));  
   dbms_output.put_line('record inserted successfully'); 
END;
/


 BEGIN    
  edit_comment_insert(3,1,to_date('2045/10/03', 'yyyy/mm/dd'));  
   dbms_output.put_line('record inserted successfully'); 
END;
/


 BEGIN    
  edit_comment_insert(4,1,to_date('2045/10/03', 'yyyy/mm/dd'));  
   dbms_output.put_line('record inserted successfully'); 
END;
/


 BEGIN    
  edit_comment_insert(5,2,to_date('2045/10/03', 'yyyy/mm/dd'));  
   dbms_output.put_line('record inserted successfully'); 
END;
/


 BEGIN    
  edit_comment_insert(6,1,to_date('2045/10/03', 'yyyy/mm/dd'));  
   dbms_output.put_line('record inserted successfully'); 
END;
/


 BEGIN    
  edit_comment_insert(7,1,to_date('2045/10/03', 'yyyy/mm/dd'));  
   dbms_output.put_line('record inserted successfully'); 
END;
/


 BEGIN    
  edit_comment_insert(8,2,to_date('2045/10/03', 'yyyy/mm/dd'));  
   dbms_output.put_line('record inserted successfully'); 
END;
/


 BEGIN    
  edit_comment_insert(9,1,to_date('2045/10/03', 'yyyy/mm/dd'));  
   dbms_output.put_line('record inserted successfully'); 
END;
/


 BEGIN    
  edit_comment_insert(10,2,to_date('2045/10/03', 'yyyy/mm/dd'));  
   dbms_output.put_line('record inserted successfully'); 
END;
/



  BEGIN    
  comment_like_rating_insert(1,34);  
   dbms_output.put_line('record inserted successfully'); 
END;
/

  BEGIN    
  comment_like_rating_insert(2,46);  
   dbms_output.put_line('record inserted successfully'); 
END;
/

  BEGIN    
  comment_like_rating_insert(3,43);  
   dbms_output.put_line('record inserted successfully'); 
END;
/

  BEGIN    
  comment_like_rating_insert(4,345);  
   dbms_output.put_line('record inserted successfully'); 
END;
/

  BEGIN    
  comment_like_rating_insert(5,876);  
   dbms_output.put_line('record inserted successfully'); 
END;
/

  BEGIN    
  comment_like_rating_insert(6,45);  
   dbms_output.put_line('record inserted successfully'); 
END;
/

  BEGIN    
  comment_like_rating_insert(7,678);  
   dbms_output.put_line('record inserted successfully'); 
END;
/

  BEGIN    
  comment_like_rating_insert(8,23);  
   dbms_output.put_line('record inserted successfully'); 
END;
/

  BEGIN    
  comment_like_rating_insert(9,789);  
   dbms_output.put_line('record inserted successfully'); 
END;
/

  BEGIN    
  comment_like_rating_insert(10,67);  
   dbms_output.put_line('record inserted successfully'); 
END;
/



BEGIN    
  delete_comment_insert(1,1,'uygunsuz',to_date('2000/10/03', 'yyyy/mm/dd'));  
   dbms_output.put_line('record inserted successfully'); 
END;
/  



BEGIN    
  delete_comment_insert(2,1,'uygunsuz',to_date('2000/10/03', 'yyyy/mm/dd'));  
   dbms_output.put_line('record inserted successfully'); 
END;
/ 


BEGIN    
  delete_comment_insert(3,1,'alakasiz',to_date('2000/10/03', 'yyyy/mm/dd'));  
   dbms_output.put_line('record inserted successfully'); 
END;
/ 


BEGIN    
  delete_comment_insert(4,1,'uygunsuz',to_date('2000/10/03', 'yyyy/mm/dd'));  
   dbms_output.put_line('record inserted successfully'); 
END;
/ 


BEGIN    
  delete_comment_insert(5,1,'alakasiz',to_date('2000/10/03', 'yyyy/mm/dd'));  
   dbms_output.put_line('record inserted successfully'); 
END;
/ 


BEGIN    
  delete_comment_insert(6,1,'uygunsuz',to_date('2000/10/03', 'yyyy/mm/dd'));  
   dbms_output.put_line('record inserted successfully'); 
END;
/ 


BEGIN    
  delete_comment_insert(7,1,'alakasiz',to_date('2000/10/03', 'yyyy/mm/dd'));  
   dbms_output.put_line('record inserted successfully'); 
END;
/ 


BEGIN    
  delete_comment_insert(8,1,'uygunsuz',to_date('2000/10/03', 'yyyy/mm/dd'));  
   dbms_output.put_line('record inserted successfully'); 
END;
/ 


BEGIN    
  delete_comment_insert(9,1,'alakasiz',to_date('2000/10/03', 'yyyy/mm/dd'));  
   dbms_output.put_line('record inserted successfully'); 
END;
/ 


BEGIN    
  delete_comment_insert(10,1,'uygunsuz',to_date('2000/10/03', 'yyyy/mm/dd'));  
   dbms_output.put_line('record inserted successfully'); 
END;
/ 
