create view people_view as 
 select * from people order by name ASC;
 /
 
 select *from people_view;
/

create view user_counts as
select count(*) as count_user from users;
/

select *from user_counts;
/

create view blog_post_counts as
select  count(*) as count_blog_post from blog_post;

/

select *from  blog_post_counts;
/

create view blocked_counts as
select count(*) as blocked_count from blocked;
/


select *from blocked_counts;
/

create  view  blog_post_like_max(post_id,max_likes_number) as
select post_id,max(likes_number) from blog_post_like group by post_id;

/
select *from blog_post_like_max;
/


create view blog_post_score_max(post_id,max_score) as
select post_id,max(score) from blog_post_score group by post_id;
/
select *from blog_post_score_max;
/