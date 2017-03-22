-- MySQL dump 10.13  Distrib 5.5.53, for Win32 (AMD64)
--
-- Host: localhost    Database: myblog
-- ------------------------------------------------------
-- Server version	5.5.53

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `blog_admin`
--

DROP TABLE IF EXISTS `blog_admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blog_admin`
--

LOCK TABLES `blog_admin` WRITE;
/*!40000 ALTER TABLE `blog_admin` DISABLE KEYS */;
INSERT INTO `blog_admin` VALUES (9,'稜酆11','admin','21232f297a57a5a743894a0e4a801fc3','default_avatar.jpg',2017,1490160927,'127.0.0.1',51,1,NULL),(27,'张三','zhangsan','312fd2f3cabafc9417c35fd00efdaa5d','default_avatar.jpg',2017,0,'',0,1,NULL),(36,'李四','lisi','b3ddbc502e307665f346cbd6e52cc10d','default_avatar.jpg',2017,0,'',0,1,1486890087);
/*!40000 ALTER TABLE `blog_admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `blog_article`
--

DROP TABLE IF EXISTS `blog_article`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
  `view_num` int(10) DEFAULT '0' COMMENT '浏览次数',
  PRIMARY KEY (`a_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blog_article`
--

LOCK TABLES `blog_article` WRITE;
/*!40000 ALTER TABLE `blog_article` DISABLE KEYS */;
INSERT INTO `blog_article` VALUES (1,1,',2,3,4,','一个简单的前端页面','这是一个有HTML+CSS+JavaScript实现的一个简单的网页。这里是第二段了。','<p><b>这是一个有HTML+CSS+JavaScript 实现的一个简单的网页。</b></p><p><br></p><p><img alt=\"[围观]\" src=\"http://localhost/myblog/public/static/admin/plugins/layui/images/face/64.gif\"></p><p><br></p><p>这里是第二段了。<br></p>',1486570359,9,1,53),(2,3,',2,3,4,','测试页面','测试页面测试页面测试页面','<p>测试页面测试页面测试页面测试页面测试页面</p>',1488956503,9,1,669);
/*!40000 ALTER TABLE `blog_article` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `blog_article_category`
--

DROP TABLE IF EXISTS `blog_article_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `blog_article_category` (
  `ac_id` int(10) NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `cate_name` varchar(30) COLLATE utf8_unicode_ci NOT NULL COMMENT '分类名称',
  `pid` int(10) NOT NULL DEFAULT '0' COMMENT '父ID',
  `level` tinyint(4) NOT NULL DEFAULT '1' COMMENT '层级',
  `sort` int(10) DEFAULT '255' COMMENT '排序',
  `status` tinyint(4) DEFAULT '1' COMMENT '状态，是否启用：1：启用，0：禁用，默认为1',
  PRIMARY KEY (`ac_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blog_article_category`
--

LOCK TABLES `blog_article_category` WRITE;
/*!40000 ALTER TABLE `blog_article_category` DISABLE KEYS */;
INSERT INTO `blog_article_category` VALUES (1,'HTML',0,1,255,1),(2,'CSS',0,1,255,1),(3,'javascript',0,1,255,1),(4,'PHP',0,1,255,1),(5,'mysql',0,1,255,1);
/*!40000 ALTER TABLE `blog_article_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `blog_auth_group`
--

DROP TABLE IF EXISTS `blog_auth_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `blog_auth_group` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `title` char(100) NOT NULL DEFAULT '' COMMENT '用户组名称',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态',
  `rules` char(200) NOT NULL DEFAULT '' COMMENT '多个规则id,用,分隔',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blog_auth_group`
--

LOCK TABLES `blog_auth_group` WRITE;
/*!40000 ALTER TABLE `blog_auth_group` DISABLE KEYS */;
INSERT INTO `blog_auth_group` VALUES (1,'超级管理员',1,'9,25,26,27,10,4,28,29,30,31,7,32,33,34,35,8,36,37,38,39,40,12,13,14,16,17,19,20,22,23,24'),(2,'文章管理员',1,'12,13,14'),(3,'网站管理员',1,'19,20');
/*!40000 ALTER TABLE `blog_auth_group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `blog_auth_group_access`
--

DROP TABLE IF EXISTS `blog_auth_group_access`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `blog_auth_group_access` (
  `uid` mediumint(8) unsigned NOT NULL COMMENT '用户id',
  `group_id` mediumint(8) unsigned NOT NULL COMMENT '用户组id',
  UNIQUE KEY `uid_group_id` (`uid`,`group_id`),
  KEY `uid` (`uid`),
  KEY `group_id` (`group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blog_auth_group_access`
--

LOCK TABLES `blog_auth_group_access` WRITE;
/*!40000 ALTER TABLE `blog_auth_group_access` DISABLE KEYS */;
INSERT INTO `blog_auth_group_access` VALUES (9,1),(27,2);
/*!40000 ALTER TABLE `blog_auth_group_access` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `blog_auth_rule`
--

DROP TABLE IF EXISTS `blog_auth_rule`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blog_auth_rule`
--

LOCK TABLES `blog_auth_rule` WRITE;
/*!40000 ALTER TABLE `blog_auth_rule` DISABLE KEYS */;
INSERT INTO `blog_auth_rule` VALUES (1,'my','我的面板',0,1,'',0),(2,'admin','用户管理',0,1,'',0),(8,'role_index','角色管理',1,1,'role_index',2),(4,'admin_index','管理员列表',1,1,'admin_index',2),(7,'rule_index','规则管理',1,1,'rule_index',2),(9,'log_index_me','日志信息',1,1,'log_index_me',1),(10,'admin_info','个人信息',1,1,'admin_info',1),(11,'article','文章管理',0,1,'',0),(12,'articlecategory_index','文章分类',1,1,'articlecategory_index',11),(13,'article_index','文章列表',1,1,'article_index',11),(14,'tag_index','文章标签',1,1,'tag_index',11),(15,'user','会员管理',0,1,'',0),(16,'user_index','会员列表',1,1,'user_index',15),(17,'message_index','留言管理',1,1,'message_index',15),(18,'website','网站管理',0,1,'',0),(19,'page_index','单页面管理',1,1,'page_index',18),(20,'menu_index_type_1','导航管理',1,1,'menu_index_type_1',18),(21,'system','系统管理',0,1,'',0),(22,'syssetting_index','参数设置',1,1,'syssetting_index',21),(23,'menu_index','菜单管理',1,1,'menu_index',21),(24,'log_index','系统日志',1,1,'log_index',21),(25,'log_clearall_me','清空日志',1,1,'log_clearall_me',9),(26,'log_delselect','删除选中',1,1,'log_delselect',9),(27,'log_del','删除',1,1,'log_del',9),(28,'admin_add','添加管理员',1,1,'admin_add',4),(29,'admin_edit','编辑',1,1,'admin_edit',4),(30,'admin_del','删除',1,1,'admin_del',4),(31,'admin_delselect','删除选中',1,1,'admin_delselect',4),(32,'rule_add','添加规则',1,1,'rule_add',7),(33,'rule_edit','编辑规则',1,1,'rule_edit',7),(34,'rule_del','删除规则',1,1,'rule_del',7),(35,'rule_delete','删除选中',1,1,'rule_delete',7),(36,'role_add','添加角色',1,1,'role_add',8),(37,'role_edit','编辑角色',1,1,'role_edit',8),(38,'role_del','删除角色',1,1,'role_del',8),(39,'role_delselect','删除选中',1,1,'role_delselect',8),(40,'role_editrule','分配权限',1,1,'role_editrule',8);
/*!40000 ALTER TABLE `blog_auth_rule` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `blog_comment`
--

DROP TABLE IF EXISTS `blog_comment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `blog_comment` (
  `c_id` int(10) NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `rev_cid` int(10) NOT NULL DEFAULT '0' COMMENT '回复留言id,为0代表评论，大于0则代表回复的评论',
  `a_id` int(10) NOT NULL COMMENT '文章ID',
  `user_id` int(10) NOT NULL DEFAULT '0' COMMENT '用户ID,为0代表匿名用户',
  `nick_name` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '用户昵称，匿名用户需填写，登录用户为用户昵称',
  `content` varchar(300) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '评论内容',
  `create_time` int(10) NOT NULL DEFAULT '0' COMMENT '评论时间',
  `ip` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '用户IP',
  PRIMARY KEY (`c_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blog_comment`
--

LOCK TABLES `blog_comment` WRITE;
/*!40000 ALTER TABLE `blog_comment` DISABLE KEYS */;
INSERT INTO `blog_comment` VALUES (3,0,2,0,'张三','这是一个刘安拉来的数据库发多少法拉盛看见对方',1489132778,'127.0.0.1'),(4,3,2,0,'李四','上面这位仁兄所得非常在理',1489133163,'127.0.0.1'),(5,0,1,0,'李四','之类又是拉开的是你发爱的是浪费',1489134379,'127.0.0.1');
/*!40000 ALTER TABLE `blog_comment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `blog_log`
--

DROP TABLE IF EXISTS `blog_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `blog_log` (
  `log_id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) COLLATE utf8_unicode_ci DEFAULT '' COMMENT '标题',
  `table` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '操作的controller',
  `action` varchar(20) COLLATE utf8_unicode_ci DEFAULT '' COMMENT '操作的action',
  `create_time` int(10) DEFAULT NULL COMMENT '创建时间',
  `admin_id` int(10) DEFAULT NULL COMMENT '操作者id',
  PRIMARY KEY (`log_id`)
) ENGINE=InnoDB AUTO_INCREMENT=154 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blog_log`
--

LOCK TABLES `blog_log` WRITE;
/*!40000 ALTER TABLE `blog_log` DISABLE KEYS */;
INSERT INTO `blog_log` VALUES (132,'编辑数据，id:9,失败','Admin','edit',1490148799,9),(133,'编辑数据，id:9,失败','Admin','edit',1490148808,9),(134,'编辑数据，id:9,失败','Admin','edit',1490148818,9),(135,'编辑数据，id:9,失败','Admin','edit',1490148821,9),(136,'编辑数据，id:9,失败','Admin','edit',1490148829,9),(137,'编辑数据，id:9,成功','Admin','edit',1490148834,9),(138,'编辑数据，id:9,失败','Admin','edit',1490148839,9),(139,'编辑数据，id:9,成功','Admin','edit',1490148842,9),(140,'编辑数据，id:9,成功','Admin','edit',1490148892,9),(141,'编辑数据，id:9,成功','Admin','edit',1490161036,9),(142,'编辑数据，id:9,失败','Admin','edit',1490161081,9),(143,'编辑数据，id:9,失败','Admin','edit',1490161083,9),(144,'编辑数据，id:9,失败','Admin','edit',1490161253,9),(145,'编辑数据，id:9,失败','Admin','edit',1490161379,9),(146,'编辑数据，id:9,失败','Admin','edit',1490161618,9),(147,'编辑数据，id:9,失败','Admin','edit',1490161624,9),(148,'编辑数据，id:9,成功','Admin','edit',1490163628,9),(149,'编辑数据，id:9,成功','Admin','edit',1490163735,9),(150,'编辑数据，id:9,失败','Admin','edit',1490163778,9),(151,'编辑数据，id:9,失败','Admin','edit',1490163784,9),(152,'编辑数据，id:9,成功','Admin','edit',1490163786,9),(153,'编辑成功','Menu','edit',1490169381,9);
/*!40000 ALTER TABLE `blog_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `blog_menu`
--

DROP TABLE IF EXISTS `blog_menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blog_menu`
--

LOCK TABLES `blog_menu` WRITE;
/*!40000 ALTER TABLE `blog_menu` DISABLE KEYS */;
INSERT INTO `blog_menu` VALUES (1,0,'后台首页','admin','index','main','/admin/index/main.html',0,'','fa-home',1,500,1,0),(2,0,'网站管理','','','','/',0,'',' fa-sitemap',1,200,1,0),(3,18,'管理员列表','admin','admin','index','/admin/admin/index.html',0,'','fa-user',1,280,2,0),(4,23,'菜单管理','admin','menu','index','/admin/menu/index.html',0,'','fa-tasks',1,255,2,0),(5,2,'导航管理','admin','menu','index','/admin/menu/index.html?type=1',0,'type=1','fa-arrows',1,255,2,0),(6,0,'首页','home','index','index','/home/index/index.html',0,'','',1,255,1,1),(7,0,'关于本站','home','index','about','/home/index/about.html',0,'','',1,255,1,1),(8,13,'文章分类','admin','articleCategory','index','/admin/article_category/index.html',0,'','fa-list-alt',1,260,2,0),(9,13,'文章标签','admin','tag','index','/admin/tag/index.html',0,'','fa-tag',1,255,2,0),(10,13,'文章列表','admin','article','index','/admin/article/index.html',0,'',' fa-list-alt',1,255,2,0),(11,21,'留言管理','admin','comment','index','/admin/comment/index.html',0,'','fa-paste',1,255,2,0),(12,2,'单页面管理','admin','page','index','/admin/page/index.html',0,'','fa-file',1,255,2,0),(13,0,'文章管理','','','','/',0,'','fa-th-list',1,255,1,0),(14,0,'我的面板','admin','admin','info','/admin/admin/info.html',0,'','fa-user',1,400,1,0),(15,14,'个人信息','admin','admin','info','/admin/admin/info.html',0,'','fa-user-md',1,255,2,0),(17,14,'日志信息','admin','log','index','/admin/log/index.html?me',0,'me','fa-edit',1,255,2,0),(18,0,'用户管理','','','','/',0,'','fa-users',1,350,1,0),(19,18,'角色管理','admin','role','index','/admin/role/index.html',0,'','fa-lock',1,255,2,0),(20,18,'规则管理','admin','rule','index','/admin/rule/index.html',0,'',' fa-tachometer',1,255,2,0),(21,0,'会员管理','','','','/',0,'','fa-users',1,255,1,0),(22,21,'会员列表','admin','user','index','http://myblog.com/admin/user/index',0,'','fa-user',0,255,2,0),(23,0,'系统管理','','','','/',0,'',' fa-th-large',1,100,1,0),(24,23,'参数设置','admin','SysSetting','index','/admin/sys_setting/index.html',0,'','fa-file-text-o',1,255,2,0),(25,23,'系统日志','admin','log','index','/admin/log/index.html',0,'','fa-edit',1,255,2,0),(26,2,'站点设置','admin','site','setting','/admin/site/setting.html',0,'','fa-cogs',1,255,2,0),(27,2,'SEO设置','admin','site','seo','/admin/site/seo.html',0,'',' fa-search-plus',1,255,2,0),(28,0,'我的作品','home','index','works','/home/index/works.html',0,'','',0,255,1,1),(29,0,'留言墙','home','index','comment','/home/index/comment.html',0,'','',1,255,1,1);
/*!40000 ALTER TABLE `blog_menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `blog_message`
--

DROP TABLE IF EXISTS `blog_message`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blog_message`
--

LOCK TABLES `blog_message` WRITE;
/*!40000 ALTER TABLE `blog_message` DISABLE KEYS */;
/*!40000 ALTER TABLE `blog_message` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `blog_page`
--

DROP TABLE IF EXISTS `blog_page`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `blog_page` (
  `p_id` int(10) NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `title` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT '标题',
  `content` text COLLATE utf8_unicode_ci COMMENT '内容',
  `create_time` int(10) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(10) DEFAULT '0' COMMENT '更新时间',
  `sort` int(10) DEFAULT '255' COMMENT '排序(降序)',
  `status` tinyint(4) DEFAULT '1' COMMENT '是否显示：1：显示，0：不显示，默认为1',
  `alias` varchar(30) COLLATE utf8_unicode_ci DEFAULT '' COMMENT '别名，根据这个来调数据',
  PRIMARY KEY (`p_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blog_page`
--

LOCK TABLES `blog_page` WRITE;
/*!40000 ALTER TABLE `blog_page` DISABLE KEYS */;
INSERT INTO `blog_page` VALUES (1,'关于我们','这是一个关于我们页面&lt;br&gt;',1486647273,1490001830,255,1,'about');
/*!40000 ALTER TABLE `blog_page` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `blog_site`
--

DROP TABLE IF EXISTS `blog_site`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `blog_site` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `key` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `value` varchar(500) COLLATE utf8_unicode_ci DEFAULT '',
  `type` varchar(20) COLLATE utf8_unicode_ci DEFAULT '' COMMENT '参数类型',
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique` (`key`,`type`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blog_site`
--

LOCK TABLES `blog_site` WRITE;
/*!40000 ALTER TABLE `blog_site` DISABLE KEYS */;
INSERT INTO `blog_site` VALUES (1,'site_open','1','site'),(2,'site_name','个人博客','site'),(3,'site_logo','20170220/83c452c0a3f67dc60b4a1a8160941d56.jpeg','site'),(4,'site_coypright','这里是底部版权信息','site'),(5,'visitor_message','1','site'),(14,'seo_title','个人博客','seo'),(15,'seo_key','程序员，PHP，IT，博客','seo'),(16,'seo_desc','一个后端程序员的个人博客','seo');
/*!40000 ALTER TABLE `blog_site` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `blog_tag`
--

DROP TABLE IF EXISTS `blog_tag`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `blog_tag` (
  `t_id` int(10) NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `tag_name` varchar(30) COLLATE utf8_unicode_ci NOT NULL COMMENT '标签名称',
  `sort` int(10) DEFAULT '255' COMMENT '排序(降序)',
  `status` tinyint(4) DEFAULT '1' COMMENT '是否启用：1：启用，0：禁用，默认1',
  PRIMARY KEY (`t_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blog_tag`
--

LOCK TABLES `blog_tag` WRITE;
/*!40000 ALTER TABLE `blog_tag` DISABLE KEYS */;
INSERT INTO `blog_tag` VALUES (2,'html',255,1),(3,'css',255,1),(4,'js',255,1),(5,'vue',255,1),(6,'mysql',255,1);
/*!40000 ALTER TABLE `blog_tag` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `blog_user`
--

DROP TABLE IF EXISTS `blog_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blog_user`
--

LOCK TABLES `blog_user` WRITE;
/*!40000 ALTER TABLE `blog_user` DISABLE KEYS */;
/*!40000 ALTER TABLE `blog_user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-03-22 15:56:54
