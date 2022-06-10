create table `ilp_admin` (`admin_id` int unsigned not null auto_increment primary key, `admin_username` varchar(32) not null, `admin_password` varchar(64) not null, `admin_created_at` datetime not null, `admin_updated_at` datetime not null);
create table `ilp_websites` (`websites_id` bigint unsigned not null auto_increment primary key, `websites_domain` varchar(32) not null, `websites_name` varchar(32) not null, `websites_title` varchar(32) not null, `websites_description` varchar(2048) not null, `websites_is_default` char(1) not null default 'n', `websites_content` longtext not null, `websites_header_info` longtext not null, `websites_footer_info` longtext not null, `websites_border_color` varchar(10) not null, `websites_border_color_hover` varchar(10) not null, `websites_created_at` datetime not null, `websites_updated_at` datetime not null);
alter table `ilp_websites` add unique `ilp_websites_websites_domain_unique`(`websites_domain`);
create table `ilp_banners` (`banners_id` bigint unsigned not null auto_increment primary key, `banners_title` varchar(32) not null, `banners_description_1` varchar(2048) not null, `banners_description_2` varchar(2048) not null, `banners_image` varchar(256) not null, `banners_url` varchar(256) not null, `banners_website_id` bigint unsigned null, `banners_created_at` datetime not null, `banners_updated_at` datetime not null);
alter table `ilp_banners` add constraint `ilp_banners_banners_website_id_foreign` foreign key (`banners_website_id`) references `ilp_websites` (`websites_id`) on delete cascade;
INSERT INTO `ilp_websites` (`websites_domain`,`websites_name`,`websites_title`,`websites_description`,`websites_is_default`,`websites_header_info`,`websites_footer_info`,`websites_created_at`,`websites_updated_at`)
VALUES ("www.ilp.test","ILP","Inifinite Landing Page","This is the description for the Infinite Landing Page","y","&lt;div class=&quot;container&quot;&gt;
&lt;div class=&quot;d-grid grid-xs-cols-2 grid-cols-1 gap-x-20 gap-y-10&quot;&gt;
&lt;article class=&quot;banner&quot;&gt;
&lt;div class=&quot;banner__image&quot;&gt;&lt;img src=&quot;https://mr0s.com/images/top_banner_left.png&quot;&gt;&lt;/div&gt;
&lt;div class=&quot;banner__overlay flex-column&quot;&gt;&lt;span class=&quot;banner_summary1_0&quot;&gt;나에게 딱 맞는 사이트 추천 문의&lt;/span&gt; &lt;span class=&quot;banner_summary2_0&quot;&gt;텔래그램 : mrzero1&lt;/span&gt;&lt;/div&gt;
&lt;/article&gt;
&lt;article class=&quot;banner&quot;&gt;
&lt;div class=&quot;banner__image&quot;&gt;&lt;img src=&quot;https://mr0s.com/images/top_banner_right.png&quot;&gt;&lt;/div&gt;
&lt;div class=&quot;banner__overlay flex-column&quot;&gt;&lt;span class=&quot;banner_summary1_1&quot;&gt;먹튀제로 사이트 추천은&lt;/span&gt; &lt;span class=&quot;banner_summary2_1&quot;&gt;미스터제로&lt;/span&gt;&lt;/div&gt;
&lt;/article&gt;
&lt;/div&gt;
&lt;/div&gt;","&lt;p&gt;&lt;strong&gt;[미스터제로] - 미스터제로는 먹튀가 절대 발생하지 않는 먹튀제로의 온라인카지노, 토토사이트만을 추천해드리고 있습니다. 안전한 카지노와 토토는 미스터제로와 함께 하십시요.&lt;/strong&gt;&lt;/p&gt;",NOW(), NOW())