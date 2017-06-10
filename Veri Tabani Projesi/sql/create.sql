CREATE TABLE people
(person_id number(10) NOT NULL,
 email VARCHAR2(20) NOT NULL,
 phone_number VARCHAR(20),
 password VARCHAR(10),
 type CHAR(1),
 name VARCHAR(20),
 birth_date DATE,
 CONSTRAINT people_pk PRIMARY KEY(person_id),
 CONSTRAINT people_unique UNIQUE (email)
);
/
CREATE TABLE author
(author_id number(10) NOT NULL,
 biography  NVARCHAR2(1000),
 CONSTRAINT author_id_pk PRIMARY KEY(author_id),
 CONSTRAINT fk_peopleAuthor FOREIGN KEY (author_id) REFERENCES people(person_id) ON DELETE CASCADE
);

/

CREATE TABLE users
(user_id number(10) NOT NULL,
 nickname VARCHAR(10) NOT NULL,
 CONSTRAINT user_id_pk PRIMARY KEY(user_id),
 CONSTRAINT fk_peopleUser FOREIGN KEY (user_id) REFERENCES people(person_id) ON DELETE CASCADE,
 CONSTRAINT user_unique UNIQUE (nickname)
);

/

CREATE TABLE blog
(blog_id number(10) NOT NULL,
 author_id number(10) NOT NULL,
 blog_title VARCHAR2(50),
 blog_summary VARCHAR2(50),
 creation_date  DATE,
 CONSTRAINT fk_authorBlog FOREIGN KEY (author_id) REFERENCES author(author_id) ON DELETE CASCADE,
 CONSTRAINT blog_pk PRIMARY KEY(blog_id) 
);

/


CREATE TABLE blog_topcategory
(topcategory_id number(10) NOT NULL,
category_name VARCHAR(20),
category_order number(10),
CONSTRAINT blog_topcategory_pk PRIMARY KEY(topcategory_id)
);

/

CREATE TABLE blog_subcategory
(subcategory_id number(10) NOT NULL,
 topcategory_id number(10) NOT NULL,
 category_name VARCHAR(20),
 category_order number(10),
 CONSTRAINT blog_subcategory_pk PRIMARY KEY(subcategory_id),
 CONSTRAINT fk_blog_topcategory  FOREIGN KEY (topcategory_id) REFERENCES blog_topcategory(topcategory_id) ON DELETE CASCADE
);

/

CREATE TABLE blog_post
(blog_post_id number(10) NOT NULL,
 blog_id number(10) NOT NULL,
 subcategory_id NOT NULL,
 post_title VARCHAR2(50),
 post_content  NVARCHAR2(1000),
 creation_date DATE,
 CONSTRAINT blog_post_pk PRIMARY KEY(blog_post_id),
 CONSTRAINT fk_blog_subcategory  FOREIGN KEY (subcategory_id) REFERENCES blog_subcategory(subcategory_id) ON DELETE CASCADE,
 CONSTRAINT fk_blog  FOREIGN KEY (blog_id) REFERENCES blog(blog_id) ON DELETE CASCADE
);
/

CREATE TABLE blog_tag
( blog_tag_id number(10) NOT NULL,
  tag_name VARCHAR(20),
  CONSTRAINT blog_tag_pk PRIMARY KEY(blog_tag_id)
);

/
CREATE TABLE contact
(author_id number(10) NOT NULL,
 accounts varchar2(50),
 CONSTRAINT author_idContact_pk PRIMARY KEY(author_id),
 CONSTRAINT fk_authorContact  FOREIGN KEY(author_id) REFERENCES author(author_id) ON DELETE CASCADE 
);

/
 CREATE TABLE about
 (author_id number(10) NOT NULL,
  about_content VARCHAR2(200),
  CONSTRAINT author_idAbout_pk PRIMARY KEY(author_id),
  CONSTRAINT fk_authorAbout  FOREIGN KEY(author_id) REFERENCES author(author_id) ON DELETE CASCADE 
 );
 
/

CREATE TABLE comments
(comment_id number(10) NOT NULL,
 post_id number(10) NOT NULL,
 person_id number(10) NOT NULL,
 creation_date DATE ,
 comment_title VARCHAR(20),
 comment_content VARCHAR2(100),
 CONSTRAINT comment_id_pk PRIMARY KEY(comment_id),
 CONSTRAINT fk_blog_postComments  FOREIGN KEY(post_id) REFERENCES blog_post(blog_post_id) ON DELETE CASCADE,
 CONSTRAINT fk_peopleComments  FOREIGN KEY(person_id) REFERENCES people(person_id) ON DELETE CASCADE 

);

/

CREATE TABLE blog_post_to_tag 
(post_id number(10) NOT NULL,
 blog_tag_id number(10) NOT NULL, 
 CONSTRAINT blog_post_to_tag_pk PRIMARY KEY (post_id,blog_tag_id),
 CONSTRAINT fk_blog_postBlog_post_to_tag  FOREIGN KEY(post_id) REFERENCES blog_post(blog_post_id) ON DELETE CASCADE,
 CONSTRAINT fk_blog_tagBlog_post_to_tag  FOREIGN KEY(blog_tag_id) REFERENCES blog_tag(blog_tag_id) ON DELETE CASCADE 
);

/


CREATE TABLE blog_post_like
( post_id number(10) NOT NULL,
 likes_number number(10),
 CONSTRAINT blog_post_like_pk PRIMARY KEY (post_id),
 CONSTRAINT fk_blog_postBlog_post_like  FOREIGN KEY(post_id) REFERENCES blog_post(blog_post_id) ON DELETE CASCADE
);

/


CREATE TABLE blog_post_score
(post_id number(10) NOT NULL,
 score  number(10),
 CONSTRAINT blog_post_score_pk PRIMARY KEY (post_id),
 CONSTRAINT fk_blog_postBlog_post_score  FOREIGN KEY(post_id) REFERENCES blog_post(blog_post_id) ON DELETE CASCADE
);

/

CREATE TABLE liked_blog_post
(post_id number(10) NOT NULL,
 person_id number(10) NOT NULL,
 CONSTRAINT liked_blog_post_pk PRIMARY KEY (post_id,person_id),
 CONSTRAINT fk_blog_postLiked_blog_post  FOREIGN KEY(post_id) REFERENCES blog_post(blog_post_id) ON DELETE CASCADE,
 CONSTRAINT fk_peopleLiked_blog_post  FOREIGN KEY(person_id) REFERENCES people(person_id) ON DELETE CASCADE
);


/

CREATE TABLE delete_blog_post 
(post_id number(10) NOT NULL,
 author_id number(10) NOT NULL,
 deletion_date date,
 deletion_cause varchar2(200),
 CONSTRAINT delete_blog_post_pk PRIMARY KEY (post_id),
 CONSTRAINT fk_authorDelete_blog_post FOREIGN KEY (author_id) REFERENCES author(author_id)ON DELETE CASCADE,
 CONSTRAINT fk_blog_postDelete_blog_post  FOREIGN KEY(post_id) REFERENCES blog_post(blog_post_id) ON DELETE CASCADE
);


/

CREATE TABLE blocked
(user_id number(10) NOT NULL,
 author_id number(10) NOT NULL,
 block_cause varchar(200),
 CONSTRAINT blocked_pk PRIMARY KEY (user_id),
 CONSTRAINT fk_authorBlocked FOREIGN KEY (author_id) REFERENCES author(author_id) ON DELETE CASCADE,
 CONSTRAINT fk_usersBlocked FOREIGN KEY (user_id) REFERENCES users(user_id)ON DELETE CASCADE
 
);

/

CREATE TABLE announcement
(announcement_id number(10) NOT NULL,
 author_id number(10) NOT NULL,
 announcement_content varchar2(200),
 title varchar(50),
 announcement_date date,
 CONSTRAINT announcement_pk PRIMARY KEY(announcement_id),
 CONSTRAINT fk_authorAnnouncement FOREIGN KEY (author_id) REFERENCES author(author_id)ON DELETE CASCADE

);

/

CREATE TABLE announcement_tag
(announcement_tag_id number(10) NOT NULL,
tag_name varchar(50),
CONSTRAINT announcement_tag_pk PRIMARY KEY(announcement_tag_id)
);

/

CREATE TABLE announcement_to_tag 
(announcement_id number(10) NOT NULL,
 announcement_tag_id number(10) NOT NULL,
 CONSTRAINT announcement_to_tag_pk PRIMARY KEY (announcement_id,announcement_tag_id),
 CONSTRAINT fk_announcement FOREIGN KEY (announcement_id) REFERENCES announcement(announcement_id)ON DELETE CASCADE,
 CONSTRAINT fk_announcement_tag FOREIGN KEY (announcement_tag_id) REFERENCES announcement_tag(announcement_tag_id)ON DELETE CASCADE
);


/
CREATE TABLE edit_comment
(comment_id number(10) NOT NULL,
 person_id number(10) NOT NULL,
 edit_date date,
 CONSTRAINT edit_comment_pk PRIMARY KEY(comment_id,person_id) , 
 CONSTRAINT fk_commentEdit_comment FOREIGN KEY (comment_id) REFERENCES comments(comment_id)ON DELETE CASCADE,
 CONSTRAINT fk_peopleEdit_comment FOREIGN KEY (person_id) REFERENCES people(person_id)ON DELETE CASCADE
);

/

CREATE TABLE comment_like_rating
(comment_id number(10) NOT NULL,
 likes_number number(10),
 CONSTRAINT comment_like_rating_pk PRIMARY KEY(comment_id) ,
 CONSTRAINT fk_commentComment_like_rating FOREIGN KEY (comment_id) REFERENCES comments(comment_id)ON DELETE CASCADE
);

/

CREATE TABLE delete_comment
(comment_id number(10) NOT NULL,
 author_id number(10) NOT NULL,
 deletion_cause varchar2(200),
 deletion_date date,
 CONSTRAINT delete_comment_pk PRIMARY KEY(comment_id),
 CONSTRAINT fk_commentDelete_comment FOREIGN KEY (comment_id) REFERENCES comments(comment_id) ON DELETE CASCADE,
 CONSTRAINT fk_authorDelete_comment FOREIGN KEY (author_id) REFERENCES author(author_id)ON DELETE CASCADE
);

/

create  table logUser
(log_id number(10) not null,
 person_id number(10) not null,
 log_information varchar2(100),
 log_date DATE,
 CONSTRAINT log_id_pk PRIMARY KEY(log_id),
 CONSTRAINT fk_peopleLog FOREIGN KEY (person_id) REFERENCES people(person_id) ON DELETE CASCADE
);

/

CREATE SEQUENCE logUser_seqs
  START WITH    1
  INCREMENT BY   1
  NOCACHE
;
/

create or replace trigger logUser_tr
  before insert on logUser
  for each  row
  
begin
  select  logUser_seqs.nextval
    into  : new.log_id
    from dual;
end;
/



CREATE SEQUENCE people_seqs
  START WITH    1
  INCREMENT BY   1
  NOCACHE
;
/

create or replace trigger people_tr
  before insert on people
  for each  row
  
begin
  select  people_seqs.nextval
    into  : new.person_id
    from dual;
end;
/



CREATE SEQUENCE blog_seqs
  START WITH    1
  INCREMENT BY   1
  NOCACHE
;
/

create or replace trigger blog_tr
 before insert on blog
 for each  row
  
begin
  select blog_seqs.nextval
    into  : new.blog_id
    from dual;
end;
/

CREATE SEQUENCE blog_post_seqs
  START WITH    1
  INCREMENT BY   1
  NOCACHE

;
/

create or replace trigger blog_post_tr
  before insert on blog_post
  for each  row
  
begin
  select  blog_post_seqs.nextval
    into  : new.blog_post_id
    from dual;
end;
/

CREATE SEQUENCE announcement_seqs
  START WITH    1
  INCREMENT BY   1
  NOCACHE
  
;
/

create or replace trigger announcement_tr
 before insert on announcement
 for each  row
  
begin
  select  announcement_seqs.nextval
    into  : new.announcement_id
    from dual;
END;
/

CREATE SEQUENCE blog_subcategory_seqs
  START WITH    1
  INCREMENT BY   1
  NOCACHE
;
/

create or replace trigger blog_subcategory_tr
 before insert on blog_subcategory
 for each  row
  
begin
  select  blog_subcategory_seqs.nextval
    into  : new.subcategory_id
    from dual;
end;
/

CREATE SEQUENCE comments_seqs
  START WITH    1
  INCREMENT BY   1
  NOCACHE
;
/

create or replace trigger comments_tr
  before insert on comments
  for each  row
  
begin
  select  comments_seqs.nextval
    into  : new.comment_id
    from dual;
end;
/

CREATE SEQUENCE announcement_tag_seqs
  START WITH    1
  INCREMENT BY   1
  NOCACHE
;
/

create or replace trigger  announcement_tag_tr
 before insert on announcement_tag
 for each  row
  
begin
  select  announcement_tag_seqs.nextval
    into  : new.announcement_tag_id
    from dual;
end;
/

CREATE SEQUENCE blog_topcategory_seqs
  START WITH    1
  INCREMENT BY   1
  NOCACHE
;
/

create or replace trigger blog_topcategory_tr
 before insert on blog_topcategory
 for each  row
  
begin
  select  blog_topcategory_seqs.nextval
    into  : new.topcategory_id
    from dual;
end;
/

CREATE SEQUENCE blog_tag_seqs
  START WITH    1
  INCREMENT BY   1
  NOCACHE
;
/

create or replace trigger blog_tag_tr
  before insert on  blog_tag
  for each  row
  
begin
  select  blog_tag_seqs.nextval
    into  : new.blog_tag_id
    from dual;
end;
/

create or replace procedure people_insert
(email IN VARCHAR,
phone_number IN VARCHAR,
password IN VARCHAR,
type IN CHAR,
name IN VARCHAR,
birth_date IN DATE)
is    
begin    
insert into people(email,phone_number,password,type,name,birth_date) values(email,phone_number,password,type,name,birth_date);    
end;

/

create or replace procedure author_insert
  (author_id IN number,
  biography IN NVARCHAR2
    )
  is
  begin
  insert into author(author_id , biography) values(author_id, biography);
 end;
/

create or replace procedure users_insert
  (
    user_id IN number,
    nickname IN VARCHAR
    )
  is
  begin
  insert into users(user_id,nickname) values(user_id,nickname);
    end;

/

create or replace procedure blog_insert
  (author_id IN number,
    blog_title IN VARCHAR2,
    blog_summary IN VARCHAR2,
    creation_date IN DATE
    )
  is
  begin
  insert into blog(author_id, blog_title, blog_summary, creation_date) values(author_id ,blog_title, blog_summary, creation_date);
    end;

 /
 
 create or replace procedure blog_topcategory_insert
  ( category_name IN VARCHAR,
    category_order IN number
  )
  is
  begin
  insert into blog_topcategory(category_name, category_order) values(category_name, category_order);
    end;

 /
 

 create or replace procedure blog_subcategory_insert
 (topcategory_id IN number,
  category_name IN VARCHAR,
  category_order IN number
  )
  is 
  begin
  insert into blog_subcategory(topcategory_id, category_name, category_order) values(topcategory_id, category_name, category_order);
  end;

/

create or replace procedure blog_post_insert
( blog_id IN number,
  subcategory_id IN number,
  post_title IN VARCHAR2,
  post_content IN NVARCHAR2,
  creation_date IN DATE
 )  
 is
 begin
 insert into blog_post(blog_id, subcategory_id, post_title, post_content, creation_date) values(blog_id, subcategory_id, post_title, post_content, creation_date);
end;



/

create or replace procedure blog_tag_insert
(tag_name IN VARCHAR
)
is
begin
insert into blog_tag(tag_name) values(tag_name);
  end;
/


create or replace procedure contact_create
 (author_id IN number,
  accounts IN VARCHAR
 )  
 is
 begin
 insert into contact(author_id ,accounts) values(author_id, accounts);
  end;
/

create or replace procedure about_create
 (author_id IN number,
  about_content IN VARCHAR2
 )  
 is
 begin
 insert into about(author_id, about_content) values(author_id,about_content);
end;
/


create or replace procedure comments_insert
(post_id IN number,
  person_id IN number,
  creation_date IN DATE,
  comment_title IN VARCHAR,
  comment_content IN VARCHAR2
)  
 is
 begin
 insert into comments(post_id, person_id, creation_date,comment_title, comment_content) values(post_id, person_id, creation_date,comment_title, comment_content);
 end;
/

create or replace procedure blog_post_to_tag_insert
  (post_id IN number,
    blog_tag_id IN number
    )
  is
  begin
  insert into blog_post_to_tag(post_id, blog_tag_id) values(post_id, blog_tag_id);
    end;
/

create or replace procedure blog_post_like_insert
  (post_id IN number,
    likes_number IN number
    )
  is
  begin
  insert into blog_post_like(post_id ,likes_number) values(post_id ,likes_number);
    end;


 /
 

 create or replace procedure blog_post_score_insert
 (post_id IN number,
  score IN number
  )   
 is
 begin
 insert into blog_post_score(post_id, score) values(post_id,score);
  end;



 /
 
 create or replace procedure liked_blog_post_insert
 (post_id IN number,
  person_id IN number
  ) 
 is
 begin
 insert into liked_blog_post(post_id, person_id) values(post_id, person_id);
  end;


/

create or replace procedure delete_blog_post_insert
  (post_id IN number,
    author_id IN number,
    deletion_date IN DATE,
    deletion_cause IN VARCHAR2
    )
  is
  begin
  insert into delete_blog_post(post_id, author_id, deletion_date, deletion_cause) values(post_id,author_id, deletion_date, deletion_cause);
    end;


 /   



create or replace procedure blocked_insert
(user_id IN number,
  author_id IN number,
  block_cause IN VARCHAR
)  
is
begin
insert into blocked( user_id, author_id, block_cause) values(user_id, author_id,block_cause);
  end;



/

create or replace procedure announcement_insert
(author_id IN number,
  announcement_content IN VARCHAR2,
  title IN VARCHAR,
  announcement_date IN DATE
)  
is
begin
insert into announcement(author_id, announcement_content, title, announcement_date) values(author_id,announcement_content,title, announcement_date);
  end;

/


create or replace procedure announcement_tag_insert
(tag_name IN VARCHAR
)  
is
begin
insert into announcement_tag(tag_name) values(tag_name);
  end;




/


create or replace procedure announcement_to_tag_insert
(announcement_id IN number,
  announcement_tag_id IN number
)  
is
begin
insert into announcement_to_tag(announcement_id, announcement_tag_id) values(announcement_id, announcement_tag_id);
  end;



/

create or replace procedure edit_comment_insert
  (comment_id IN number,
    person_id IN number,
    edit_date IN DATE
    )
  is
  begin
  insert into edit_comment(comment_id, person_id, edit_date) values(comment_id,person_id,edit_date);
    end;



/



create or replace procedure comment_like_rating_insert
  (comment_id IN number,
    likes_number IN number
    )
  is
  begin
  insert into comment_like_rating(comment_id, likes_number) values(comment_id, likes_number);
    end;



 /

 create or replace procedure delete_comment_insert
  (comment_id IN number,
    author_id IN number,
    deletion_cause IN VARCHAR2,
    deletion_date IN DATE
    )
  is
  begin
  insert into delete_comment(comment_id, author_id, deletion_cause,deletion_date) values(comment_id,author_id, deletion_cause, deletion_date);
    end;

/


CREATE OR REPLACE PROCEDURE people_delete
(p_id IN NUMBER)
IS
BEGIN

  DELETE from people where person_id = p_id;

END;
/



CREATE OR REPLACE PROCEDURE author_delete
(a_id IN NUMBER)
IS
BEGIN

  DELETE from people  where person_id = a_id;

END;
/

CREATE OR REPLACE PROCEDURE users_delete
(user_id IN NUMBER)
IS
BEGIN

  DELETE from people where person_id = user_id;

END;
/

CREATE OR REPLACE PROCEDURE blog_delete
(blogs_id IN NUMBER)
IS
BEGIN

  DELETE from blog where blog_id =blogs_id;

END;
/



CREATE OR REPLACE PROCEDURE blog_topcategory_delete
(t_id IN NUMBER)
IS
BEGIN

  DELETE from blog_topcategory where topcategory_id =t_id;

END;
/

CREATE OR REPLACE PROCEDURE blog_subcategory_delete
(s_id IN NUMBER)
IS
BEGIN

  DELETE from blog_subcategory where subcategory_id =s_id;

END;
/

CREATE OR REPLACE PROCEDURE blog_post_delete
(p_id IN NUMBER)
IS
BEGIN

  DELETE from blog_subcategory where subcategory_id=p_id;

END;
/

CREATE OR REPLACE PROCEDURE blog_tag_delete
(t_id IN NUMBER)
IS
BEGIN

  DELETE from blog_tag where blog_tag_id =t_id;

END;
/

CREATE OR REPLACE PROCEDURE  contact_delete
(c_id IN NUMBER)
IS
BEGIN

  DELETE from  contact where author_id =c_id;

END;
/

CREATE OR REPLACE PROCEDURE  about_delete
(a_id IN NUMBER)
IS
BEGIN

  DELETE from  about where author_id =a_id;

END;
/


CREATE OR REPLACE PROCEDURE  comments_delete
(c_id IN NUMBER)
IS
BEGIN

  DELETE from  comments where comment_id =c_id;

END;
/

CREATE OR REPLACE PROCEDURE  blog_post_to_tag_delete
(p_id IN NUMBER,
 t_id IN  NUMBER
)
IS
BEGIN

  DELETE from   blog_post_to_tag where post_id =p_id  and blog_tag_id=t_id;

END;
/

CREATE OR REPLACE PROCEDURE  blog_post_like_delete
(p_id IN NUMBER)
IS
BEGIN

  DELETE from   blog_post_like where post_id =p_id;

END;
/

CREATE OR REPLACE PROCEDURE  blog_post_score_delete
(p_id IN NUMBER)
IS
BEGIN

  DELETE from   blog_post_score where post_id =p_id;

END;
/


CREATE OR REPLACE PROCEDURE  liked_blog_post_delete
(pt_id IN NUMBER,
pr_id IN NUMBER)
IS
BEGIN

  DELETE from  liked_blog_post  where post_id =pt_id and person_id=pr_id;

END;
/

CREATE OR REPLACE PROCEDURE delete_comment_delete
(del_com_id IN number)
IS
BEGIN
DELETE from delete_comment where comment_id=del_com_id;
END;



/


CREATE OR REPLACE PROCEDURE comment_like_rating_delete
(del_com_id IN number)
IS
BEGIN
DELETE from comment_like_rating where comment_id=del_com_id;
END;


/


CREATE OR REPLACE PROCEDURE edit_comment_delete
(del_com_id IN number,
 del_person_id IN number)
IS
BEGIN
DELETE from edit_comment where comment_id=del_com_id and person_id=del_person_id;
END;

/


CREATE OR REPLACE PROCEDURE announcement_to_tag_delete
(del_anno_id IN number,
 del_anno_tag_id IN number
)
IS
BEGIN
DELETE from announcement_to_tag where announcement_id=del_anno_id and announcement_tag_id=del_anno_tag_id;
END;

/

CREATE OR REPLACE PROCEDURE announcement_tag_delete
(del_anno_tag_id IN number)
IS
BEGIN
DELETE from announcement_tag where announcement_tag_id=del_anno_tag_id;
END;


/

 CREATE OR REPLACE PROCEDURE announcement_delete
 (del_anno_id IN number)
 IS
 BEGIN
 DELETE from announcement where announcement_id=del_anno_id;
 END;

 /

 CREATE OR REPLACE PROCEDURE blocked_delete
 (del_user_id IN number)
 IS
 BEGIN
 DELETE from blocked where user_id=del_user_id;
 END;

 /

 CREATE OR REPLACE PROCEDURE delete_blog_post_delete
 (del_post_id IN number)
 IS
 BEGIN
 DELETE from delete_blog_post where post_id=del_post_id;
 END;
/

CREATE OR REPLACE PROCEDURE people_update
(person_idU IN number,
	phone_numberU IN VARCHAR2
)
IS
BEGIN
UPDATE people SET phone_number= phone_numberU  WHERE  person_id = person_idU ;

COMMIT;
END;
/

CREATE OR REPLACE PROCEDURE author_update
(author_idU IN number,
	biographyU IN NVARCHAR2
)
IS
BEGIN
UPDATE author SET biography=biographyU  WHERE author_id = author_idU;
COMMIT;
END;

/

CREATE OR REPLACE PROCEDURE blog_update
(blog_idU IN number,
 blog_summaryU IN VARCHAR2
)
IS
BEGIN
UPDATE blog SET blog_summary=blog_summaryU  WHERE blog_id=blog_idU ;
COMMIT;
END;

/

CREATE OR REPLACE PROCEDURE blog_topcategory_update
(topcategory_idU IN number,
	category_nameU IN VARCHAR
)
IS
BEGIN
UPDATE blog_topcategory SET category_name=category_nameU  WHERE topcategory_id=topcategory_idU;
COMMIT;
END;

/


CREATE OR REPLACE PROCEDURE blog_subcategory_update
(subcategory_idU IN number,
	category_nameU IN VARCHAR
)
IS
BEGIN
UPDATE blog_subcategory SET category_name=category_nameU  WHERE subcategory_id=subcategory_idU ;
COMMIT;
END;


/


CREATE OR REPLACE PROCEDURE blog_post_update
(blog_post_idU IN number,
	post_contentU IN NVARCHAR2
)
IS
BEGIN
UPDATE blog_post SET post_content=post_contentU WHERE  blog_post_id=blog_post_idU;
COMMIT;
END;


/

CREATE OR REPLACE PROCEDURE blog_tag_update
(blog_tag_idU IN number,
	tag_nameU IN VARCHAR
)
IS
BEGIN
UPDATE blog_tag SET tag_name=tag_nameU WHERE blog_tag_id=blog_tag_idU;
COMMIT;
END;


/

CREATE OR REPLACE PROCEDURE contact_update
(author_idU IN number,
	accountsU IN VARCHAR2
)
IS
BEGIN
UPDATE contact SET  accounts=accountsU  WHERE  author_id=author_idU ;
COMMIT;
END;

/


CREATE OR REPLACE PROCEDURE about_update
(author_idU IN number,
	about_contentU IN VARCHAR2
)
IS
BEGIN
UPDATE about SET about_content=about_contentU WHERE   author_id=author_idU;
COMMIT;
END;


/

CREATE OR REPLACE PROCEDURE comments_update
(comment_idU IN number,
	comment_contentU IN VARCHAR
)
IS
BEGIN
UPDATE comments SET comment_content=comment_contentU WHERE comment_id=comment_idU;
COMMIT;
END;

/


CREATE OR REPLACE PROCEDURE blog_post_to_tag_update
(post_idU IN number,
	blog_tag_idU IN number
)
IS
BEGIN
UPDATE blog_post_to_tag SET post_id=post_id WHERE blog_tag_id=blog_tag_idU;
COMMIT;
END;


/

CREATE OR REPLACE PROCEDURE blog_post_like_update
(post_idU IN number,
	likes_numberU IN number
)
IS
BEGIN
UPDATE blog_post_like SET likes_number=likes_numberU  WHERE post_id=post_idU;
COMMIT;
END;


/

CREATE OR REPLACE PROCEDURE blog_post_score_update
(post_idU IN number,
	scoreU IN number
)
IS
BEGIN
UPDATE blog_post_score SET score=scoreU WHERE post_id=post_idU;
COMMIT;
END;


/


CREATE OR REPLACE PROCEDURE liked_blog_post_update
(post_idU IN number,
	person_idU IN number
)
IS
BEGIN
UPDATE liked_blog_post SET person_id=person_idU  WHERE post_id=post_idU;
COMMIT;
END;

/

CREATE OR REPLACE PROCEDURE delete_blog_post_update
(post_idU IN number,
	deletion_causeU IN VARCHAR2
)
IS
BEGIN
UPDATE delete_blog_post SET deletion_cause=deletion_causeU  WHERE post_id=post_idU ;
COMMIT;
END;

/

CREATE OR REPLACE PROCEDURE blocked_update
(user_idU IN number,
	block_causeU IN VARCHAR
)
IS
BEGIN
UPDATE blocked SET block_cause=block_causeU  WHERE user_id=user_idU ;
COMMIT;
END;

/

CREATE OR REPLACE PROCEDURE announcement_update
(announcement_idU IN number,
	contentU IN VARCHAR

)
IS
BEGIN
UPDATE announcement SET announcement_content=contentU WHERE announcement_id=announcement_idU;
COMMIT;
END;

/


CREATE OR REPLACE PROCEDURE announcement_tag_update
(announcement_idU IN number,
	tag_nameU IN number
)
IS
BEGIN
UPDATE announcement_tag SET tag_name=tag_nameU  WHERE announcement_tag_id=announcement_idU ;
COMMIT;
END;

/


CREATE OR REPLACE PROCEDURE announcement_to_tag_update
(announcement_idU IN number,
	announcement_tag_idU IN number
)
IS
BEGIN
UPDATE announcement_to_tag SET announcement_id=announcement_idU WHERE announcement_tag_id=announcement_tag_idU;
COMMIT;
END;


/

CREATE OR REPLACE PROCEDURE edit_comment_update
(comment_idU IN number,
	edit_dateU IN DATE
)
IS
BEGIN
UPDATE edit_comment SET edit_date=edit_dateU WHERE comment_id=comment_idU;
COMMIT;
END;


/

CREATE OR REPLACE PROCEDURE comment_like_rating_update
(comment_idU IN number,
	likes_numberU IN number
)
IS
BEGIN
UPDATE comment_like_rating SET likes_number=likes_numberU  WHERE comment_id=comment_idU;
COMMIT;
END;

/


CREATE OR REPLACE PROCEDURE delete_comment_update
(comment_idU IN number,
	deletion_causeU IN VARCHAR2
)
IS
BEGIN
UPDATE delete_comment SET  deletion_cause=deletion_causeU   WHERE comment_id=comment_idU;
COMMIT;
END;

/
