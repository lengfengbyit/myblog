/*
SQLyog Ultimate v11.33 (64 bit)
MySQL - 5.5.53 : Database - myblog
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`myblog` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci */;

USE `myblog`;

/*Table structure for table `blog_admin` */

DROP TABLE IF EXISTS `blog_admin`;

CREATE TABLE `blog_admin` (
  `a_id` int(10) NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `nickname` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '昵称',
  `user_name` varchar(20) COLLATE utf8_unicode_ci NOT NULL COMMENT '登录账号',
  `password` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT '登录密码',
  `avatar` varchar(50) COLLATE utf8_unicode_ci DEFAULT '' COMMENT '头像',
  `register_time` int(10) DEFAULT '0' COMMENT '注册时间',
  `last_login_time` int(10) DEFAULT '0' COMMENT '最后一次登录时间',
  `last_login_ip` varchar(16) COLLATE utf8_unicode_ci DEFAULT '' COMMENT '最有一次登录IP',
  `login_count` int(10) DEFAULT '0' COMMENT '登录次数',
  `status` tinyint(4) DEFAULT '1' COMMENT '状态：0：禁用，1：正常',
  `delete_time` int(10) DEFAULT NULL COMMENT '删除时间',
  PRIMARY KEY (`a_id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `blog_admin` */

insert  into `blog_admin`(`a_id`,`nickname`,`user_name`,`password`,`avatar`,`register_time`,`last_login_time`,`last_login_ip`,`login_count`,`status`,`delete_time`) values (9,'稜酆','admin','21232f297a57a5a743894a0e4a801fc3','default_avatar.jpg',2017,1487595714,'127.0.0.1',40,1,NULL),(27,'张三','zhangsan','312fd2f3cabafc9417c35fd00efdaa5d','default_avatar.jpg',2017,0,'',0,1,NULL),(36,'李四','lisi','b3ddbc502e307665f346cbd6e52cc10d','default_avatar.jpg',2017,0,'',0,1,1486890087);

/*Table structure for table `blog_article` */

DROP TABLE IF EXISTS `blog_article`;

CREATE TABLE `blog_article` (
  `a_id` int(10) NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `ac_id` int(10) NOT NULL COMMENT '所属分类ID',
  `tag_ids` varchar(30) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '所属标签ID,用逗号分隔,格式：,1,2,3,10,',
  `title` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT '标题',
  `summary` varchar(200) COLLATE utf8_unicode_ci NOT NULL COMMENT '摘要',
  `content` text COLLATE utf8_unicode_ci NOT NULL COMMENT '内容',
  `create_time` int(10) DEFAULT '0' COMMENT '创建时间',
  `admin_id` int(10) DEFAULT '0' COMMENT '作者ID',
  `is_show` tinyint(4) DEFAULT '1' COMMENT '是否显示',
  PRIMARY KEY (`a_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `blog_article` */

insert  into `blog_article`(`a_id`,`ac_id`,`tag_ids`,`title`,`summary`,`content`,`create_time`,`admin_id`,`is_show`) values (1,1,'2,3,4','一个简单的前端页面','这是一个有HTML+CSS+JavaScript实现的一个简单的网页。这里是第二段了。','<p><b>这是一个有HTML+CSS+JavaScript 实现的一个简单的网页。</b></p><p><br></p><p><img alt=\"[围观]\" src=\"http://localhost/myblog/public/static/admin/plugins/layui/images/face/64.gif\"></p><p><br></p><p>这里是第二段了。<br></p>',1486570359,9,1);

/*Table structure for table `blog_article_category` */

DROP TABLE IF EXISTS `blog_article_category`;

CREATE TABLE `blog_article_category` (
  `ac_id` int(10) NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `cate_name` varchar(30) COLLATE utf8_unicode_ci NOT NULL COMMENT '分类名称',
  `pid` int(10) NOT NULL DEFAULT '0' COMMENT '父ID',
  `level` tinyint(4) NOT NULL DEFAULT '1' COMMENT '层级',
  `sort` int(10) DEFAULT '255' COMMENT '排序',
  `status` tinyint(4) DEFAULT '1' COMMENT '状态，是否启用：1：启用，0：禁用，默认为1',
  PRIMARY KEY (`ac_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `blog_article_category` */

insert  into `blog_article_category`(`ac_id`,`cate_name`,`pid`,`level`,`sort`,`status`) values (1,'HTML',0,1,255,1),(2,'CSS',0,1,255,1),(3,'javascript',0,1,255,1),(4,'PHP',0,1,255,1),(5,'mysql',0,1,255,1);

/*Table structure for table `blog_auth_group` */

DROP TABLE IF EXISTS `blog_auth_group`;

CREATE TABLE `blog_auth_group` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `title` char(100) NOT NULL DEFAULT '' COMMENT '用户组名称',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态',
  `rules` char(200) NOT NULL DEFAULT '' COMMENT '多个规则id,用,分隔',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `blog_auth_group` */

insert  into `blog_auth_group`(`id`,`title`,`status`,`rules`) values (1,'超级管理员',1,'9,25,26,27,10,4,28,29,30,31,7,32,33,34,35,8,36,37,38,39,40,12,13,14,16,17,19,20,22,23,24'),(2,'文章管理员',1,'12,13,14'),(3,'网站管理员',1,'19,20');

/*Table structure for table `blog_auth_group_access` */

DROP TABLE IF EXISTS `blog_auth_group_access`;

CREATE TABLE `blog_auth_group_access` (
  `uid` mediumint(8) unsigned NOT NULL COMMENT '用户id',
  `group_id` mediumint(8) unsigned NOT NULL COMMENT '用户组id',
  UNIQUE KEY `uid_group_id` (`uid`,`group_id`),
  KEY `uid` (`uid`),
  KEY `group_id` (`group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `blog_auth_group_access` */

insert  into `blog_auth_group_access`(`uid`,`group_id`) values (9,1),(27,2);

/*Table structure for table `blog_auth_rule` */

DROP TABLE IF EXISTS `blog_auth_rule`;

CREATE TABLE `blog_auth_rule` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(80) NOT NULL DEFAULT '' COMMENT '规则唯一标识',
  `title` char(20) NOT NULL DEFAULT '' COMMENT '规则描述',
  `type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '类型：0：代表模块名称，1：代表规则',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态，1为正常，0为禁用',
  `condition` char(100) NOT NULL DEFAULT '' COMMENT '规则表达式，为空表示存在就验证，不为空表示按表达式验证。',
  `pid` int(8) DEFAULT '0' COMMENT '父id',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=41 DEFAULT CHARSET=utf8;

/*Data for the table `blog_auth_rule` */

insert  into `blog_auth_rule`(`id`,`name`,`title`,`type`,`status`,`condition`,`pid`) values (1,'my','我的面板',0,1,'',0),(2,'admin','用户管理',0,1,'',0),(8,'role_index','角色管理',1,1,'role_index',2),(4,'admin_index','管理员列表',1,1,'admin_index',2),(7,'rule_index','规则管理',1,1,'rule_index',2),(9,'log_index_me','日志信息',1,1,'log_index_me',1),(10,'admin_info','个人信息',1,1,'admin_info',1),(11,'article','文章管理',0,1,'',0),(12,'articlecategory_index','文章分类',1,1,'articlecategory_index',11),(13,'article_index','文章列表',1,1,'article_index',11),(14,'tag_index','文章标签',1,1,'tag_index',11),(15,'user','会员管理',0,1,'',0),(16,'user_index','会员列表',1,1,'user_index',15),(17,'message_index','留言管理',1,1,'message_index',15),(18,'website','网站管理',0,1,'',0),(19,'page_index','单页面管理',1,1,'page_index',18),(20,'menu_index_type_1','导航管理',1,1,'menu_index_type_1',18),(21,'system','系统管理',0,1,'',0),(22,'syssetting_index','参数设置',1,1,'syssetting_index',21),(23,'menu_index','菜单管理',1,1,'menu_index',21),(24,'log_index','系统日志',1,1,'log_index',21),(25,'log_clearall_me','清空日志',1,1,'log_clearall_me',9),(26,'log_delselect','删除选中',1,1,'log_delselect',9),(27,'log_del','删除',1,1,'log_del',9),(28,'admin_add','添加管理员',1,1,'admin_add',4),(29,'admin_edit','编辑',1,1,'admin_edit',4),(30,'admin_del','删除',1,1,'admin_del',4),(31,'admin_delselect','删除选中',1,1,'admin_delselect',4),(32,'rule_add','添加规则',1,1,'rule_add',7),(33,'rule_edit','编辑规则',1,1,'rule_edit',7),(34,'rule_del','删除规则',1,1,'rule_del',7),(35,'rule_delete','删除选中',1,1,'rule_delete',7),(36,'role_add','添加角色',1,1,'role_add',8),(37,'role_edit','编辑角色',1,1,'role_edit',8),(38,'role_del','删除角色',1,1,'role_del',8),(39,'role_delselect','删除选中',1,1,'role_delselect',8),(40,'role_editrule','分配权限',1,1,'role_editrule',8);

/*Table structure for table `blog_comment` */

DROP TABLE IF EXISTS `blog_comment`;

CREATE TABLE `blog_comment` (
  `c_id` int(10) NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `p_cid` int(10) NOT NULL DEFAULT '0' COMMENT '父ID,为0代表评论，大于0则代表回复的评论',
  `a_id` int(10) NOT NULL COMMENT '文章ID',
  `user_id` int(10) NOT NULL DEFAULT '0' COMMENT '用户ID,为0代表匿名用户',
  `nick_name` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '用户昵称，匿名用户需填写，登录用户为用户昵称',
  `content` varchar(300) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '评论内容',
  `create_time` int(10) NOT NULL DEFAULT '0' COMMENT '评论时间',
  `ip` varchar(16) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '用户IP',
  PRIMARY KEY (`c_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `blog_comment` */

/*Table structure for table `blog_log` */

DROP TABLE IF EXISTS `blog_log`;

CREATE TABLE `blog_log` (
  `log_id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) COLLATE utf8_unicode_ci DEFAULT '' COMMENT '标题',
  `table` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '操作的controller',
  `action` varchar(20) COLLATE utf8_unicode_ci DEFAULT '' COMMENT '操作的action',
  `create_time` int(10) DEFAULT NULL COMMENT '创建时间',
  `admin_id` int(10) DEFAULT NULL COMMENT '操作者id',
  PRIMARY KEY (`log_id`)
) ENGINE=InnoDB AUTO_INCREMENT=85 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `blog_log` */

insert  into `blog_log`(`log_id`,`title`,`table`,`action`,`create_time`,`admin_id`) values (61,'删除数据，id:58,成功','Log','del',1487464949,9),(62,'删除选中数据，id:60,59,成功','Log','delselect',1487465169,9),(63,'添加数据，id:28,成功','Rule','add',1487465235,9),(64,'添加数据，id:29,成功','Rule','add',1487465269,9),(65,'添加数据，id:30,成功','Rule','add',1487465288,9),(66,'添加数据，id:31,成功','Rule','add',1487465305,9),(67,'添加数据，id:32,成功','Rule','add',1487465334,9),(68,'添加数据，id:33,成功','Rule','add',1487465359,9),(69,'添加数据，id:34,成功','Rule','add',1487465381,9),(70,'添加数据，id:35,成功','Rule','add',1487465401,9),(71,'添加数据，id:36,成功','Rule','add',1487465448,9),(72,'添加数据，id:37,成功','Rule','add',1487465466,9),(73,'添加数据，id:38,成功','Rule','add',1487465480,9),(74,'添加数据，id:39,成功','Rule','add',1487465498,9),(75,'添加数据，id:40,成功','Rule','add',1487465559,9),(76,'编辑数据，id:12,成功','Rule','edit',1487465940,9),(77,'编辑数据，id:23,成功','Rule','edit',1487466241,9),(78,'编辑数据，id:13,成功','Rule','edit',1487466449,9),(79,'添加数据，id:26,成功','Menu','add',1487479823,9),(80,'添加数据，id:27,成功','Menu','add',1487479882,9),(81,'创建菜单成功','Menu','createnav',1487479914,9),(82,'编辑数据，id:7,成功','Menu','edit',1487600148,9),(83,'添加数据，id:28,成功','Menu','add',1487600806,9),(84,'添加数据，id:29,成功','Menu','add',1487600837,9);

/*Table structure for table `blog_menu` */

DROP TABLE IF EXISTS `blog_menu`;

CREATE TABLE `blog_menu` (
  `m_id` int(10) NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `p_mid` int(10) DEFAULT '0' COMMENT '父id',
  `menu_name` varchar(20) COLLATE utf8_unicode_ci NOT NULL COMMENT '菜单名称',
  `module` varchar(20) COLLATE utf8_unicode_ci NOT NULL COMMENT '对应模块',
  `controller` varchar(20) COLLATE utf8_unicode_ci NOT NULL COMMENT '对应控制器',
  `action` varchar(20) COLLATE utf8_unicode_ci NOT NULL COMMENT '对应方法',
  `url` varchar(100) COLLATE utf8_unicode_ci DEFAULT '' COMMENT '路径',
  `url_type` tinyint(4) DEFAULT '0' COMMENT 'URL类型：0，模型控制器，1：直接使用URL，2：外链模式',
  `param` varchar(30) COLLATE utf8_unicode_ci DEFAULT '' COMMENT '参数，字符串格式',
  `icon_class` varchar(30) COLLATE utf8_unicode_ci DEFAULT '' COMMENT '图标',
  `status` tinyint(4) DEFAULT '1' COMMENT '状态，1：可用，0：禁用',
  `sort` int(10) NOT NULL DEFAULT '255' COMMENT '排序 降序',
  `level` tinyint(4) DEFAULT '1' COMMENT '层级',
  `type` tinyint(4) DEFAULT '0' COMMENT '类型：0：后台菜单，1：前端导航',
  PRIMARY KEY (`m_id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `blog_menu` */

insert  into `blog_menu`(`m_id`,`p_mid`,`menu_name`,`module`,`controller`,`action`,`url`,`url_type`,`param`,`icon_class`,`status`,`sort`,`level`,`type`) values (1,0,'后台首页','admin','index','main','http://myblog.com/admin/index/main',0,'','fa-home',1,500,1,0),(2,0,'网站管理','','','','http://myblog.com/',0,'',' fa-sitemap',1,200,1,0),(3,18,'管理员列表','admin','admin','index','http://myblog.com/admin/admin/index',0,'','fa-user',1,280,2,0),(4,23,'菜单管理','admin','menu','index','http://myblog.com/admin/menu/index',0,'','fa-tasks',1,255,2,0),(5,2,'导航管理','admin','menu','index','http://myblog.com/admin/menu/index?type=1',0,'type=1','fa-arrows',1,255,2,0),(6,0,'首页','home','index','index','http://myblog.com/home/index/index',0,'','',1,255,1,1),(7,0,'关于本站','home','index','index2','http://myblog.com/home/index/index2',0,'','',1,255,1,1),(8,13,'文章分类','admin','articleCategory','index','http://myblog.com/admin/article_category/index',0,'','fa-list-alt',1,260,2,0),(9,13,'文章标签','admin','tag','index','http://myblog.com/admin/tag/index',0,'','fa-tag',1,255,2,0),(10,13,'文章列表','admin','article','index','http://myblog.com/admin/article/index',0,'',' fa-list-alt',1,255,2,0),(11,21,'留言管理','admin','message','index','http://myblog.com/admin/message/index',0,'','fa-paste',1,255,2,0),(12,2,'单页面管理','admin','page','index','http://myblog.com/admin/page/index',0,'','fa-file',1,255,2,0),(13,0,'文章管理','','','','http://myblog.com/',0,'','fa-th-list',1,255,1,0),(14,0,'我的面板','admin','admin','info','http://myblog.com/admin/admin/info',0,'','fa-user',1,400,1,0),(15,14,'个人信息','admin','admin','info','http://myblog.com/admin/admin/info',0,'','fa-user-md',1,255,2,0),(17,14,'日志信息','admin','log','index','http://myblog.com/admin/log/index?me',0,'me','fa-edit',1,255,2,0),(18,0,'用户管理','','i','','http://myblog.com/i/',0,'','fa-users',1,350,1,0),(19,18,'角色管理','admin','role','index','http://myblog.com/admin/role/index',0,'','fa-lock',1,255,2,0),(20,18,'规则管理','admin','rule','index','http://myblog.com/admin/rule/index',0,'',' fa-tachometer',1,255,2,0),(21,0,'会员管理','','','','http://myblog.com/',0,'','fa-users',1,255,1,0),(22,21,'会员列表','admin','user','index','http://myblog.com/admin/user/index',0,'','fa-user',1,255,2,0),(23,0,'系统管理','','','','http://myblog.com/',0,'',' fa-th-large',1,100,1,0),(24,23,'参数设置','admin','SysSetting','index','http://myblog.com/admin/sys_setting/index',0,'','fa-file-text-o',1,255,2,0),(25,23,'系统日志','admin','log','index','http://myblog.com/admin/log/index',0,'','fa-edit',1,255,2,0),(26,2,'站点设置','admin','site','setting','http://myblog.com/admin/site/setting',0,'','fa-cogs',1,255,2,0),(27,2,'SEO设置','admin','site','seo','http://myblog.com/admin/site/seo',0,'',' fa-search-plus',1,255,2,0),(28,0,'我的作品','home','index','works','http://myblog.com/home/index/works',0,'','',1,255,1,1),(29,0,'留言墙','home','index','message','http://myblog.com/home/index/message',0,'','',1,255,1,1);

/*Table structure for table `blog_message` */

DROP TABLE IF EXISTS `blog_message`;

CREATE TABLE `blog_message` (
  `m_id` int(10) NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `p_mid` int(10) NOT NULL DEFAULT '0' COMMENT '留言父ID,为0代表留言，大于0则代表回复的留言',
  `user_id` int(10) NOT NULL DEFAULT '0' COMMENT '用户ID,为0代表匿名用户',
  `nick_name` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '留言用户昵称，匿名用户需填写，非匿名用户为用户昵称',
  `title` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT '留言主题',
  `content` varchar(300) COLLATE utf8_unicode_ci NOT NULL COMMENT '留言内容',
  `create_time` int(10) NOT NULL DEFAULT '0' COMMENT '留言时间',
  `ip` varchar(16) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '留言用户IP',
  PRIMARY KEY (`m_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `blog_message` */

/*Table structure for table `blog_page` */

DROP TABLE IF EXISTS `blog_page`;

CREATE TABLE `blog_page` (
  `p_id` int(10) NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `title` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT '标题',
  `content` text COLLATE utf8_unicode_ci COMMENT '内容',
  `create_time` int(10) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(10) DEFAULT '0' COMMENT '更新时间',
  `sort` int(10) DEFAULT '255' COMMENT '排序(降序)',
  `status` tinyint(4) DEFAULT '1' COMMENT '是否显示：1：显示，0：不显示，默认为1',
  PRIMARY KEY (`p_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `blog_page` */

insert  into `blog_page`(`p_id`,`title`,`content`,`create_time`,`update_time`,`sort`,`status`) values (1,'关于我们','这是一个关于我们页面&lt;br&gt;',1486647273,1486647328,255,1);

/*Table structure for table `blog_site` */

DROP TABLE IF EXISTS `blog_site`;

CREATE TABLE `blog_site` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `key` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `value` varchar(500) COLLATE utf8_unicode_ci DEFAULT '',
  `type` varchar(20) COLLATE utf8_unicode_ci DEFAULT '' COMMENT '参数类型',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `blog_site` */

insert  into `blog_site`(`id`,`key`,`value`,`type`) values (1,'site_open','1','site'),(2,'site_name','13','site'),(3,'site_logo','20170220/83c452c0a3f67dc60b4a1a8160941d56.jpeg','site'),(4,'site_coypright','这里是底部版权信息','site'),(5,'visitor_message','1','site'),(14,'seo_title','个人博客','seo'),(15,'seo_key','程序员，PHP，IT，博客','seo'),(16,'seo_desc','一个后端程序员的个人博客','seo'),(17,'site_name','13','site'),(18,'site_coypright','这里是底部版权信息','site');

/*Table structure for table `blog_tag` */

DROP TABLE IF EXISTS `blog_tag`;

CREATE TABLE `blog_tag` (
  `t_id` int(10) NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `tag_name` varchar(30) COLLATE utf8_unicode_ci NOT NULL COMMENT '标签名称',
  `sort` int(10) DEFAULT '255' COMMENT '排序(降序)',
  `status` tinyint(4) DEFAULT '1' COMMENT '是否启用：1：启用，0：禁用，默认1',
  PRIMARY KEY (`t_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `blog_tag` */

insert  into `blog_tag`(`t_id`,`tag_name`,`sort`,`status`) values (2,'html',255,1),(3,'css',255,1),(4,'js',255,1),(5,'vue',255,1),(6,'mysql',255,1);

/*Table structure for table `blog_user` */

DROP TABLE IF EXISTS `blog_user`;

CREATE TABLE `blog_user` (
  `u_id` int(10) NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `user_name` varchar(20) COLLATE utf8_unicode_ci NOT NULL COMMENT '登录账号',
  `password` varchar(30) COLLATE utf8_unicode_ci NOT NULL COMMENT '登录密码',
  `nick_name` varchar(20) COLLATE utf8_unicode_ci NOT NULL COMMENT '昵称',
  `avatar` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '头像',
  `create_time` int(10) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `last_login_time` int(10) NOT NULL DEFAULT '0' COMMENT '最后一次登录时间',
  `last_login_ip` varchar(16) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '最有一次登录IP',
  `login_count` int(10) NOT NULL DEFAULT '0' COMMENT '登录次数',
  PRIMARY KEY (`u_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `blog_user` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
