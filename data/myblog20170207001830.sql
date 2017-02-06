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
  PRIMARY KEY (`a_id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blog_admin`
--

LOCK TABLES `blog_admin` WRITE;
/*!40000 ALTER TABLE `blog_admin` DISABLE KEYS */;
INSERT INTO `blog_admin` VALUES (9,'稜酆','admin','21232f297a57a5a743894a0e4a801fc3','default_avatar.jpg',1486048969,1486390664,'127.0.0.1',20,1),(27,'张三','zhangsan','312fd2f3cabafc9417c35fd00efdaa5d','default_avatar.jpg',1486290072,0,'',0,1);
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
  PRIMARY KEY (`a_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blog_article`
--

LOCK TABLES `blog_article` WRITE;
/*!40000 ALTER TABLE `blog_article` DISABLE KEYS */;
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
  PRIMARY KEY (`ac_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blog_article_category`
--

LOCK TABLES `blog_article_category` WRITE;
/*!40000 ALTER TABLE `blog_article_category` DISABLE KEYS */;
/*!40000 ALTER TABLE `blog_article_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `blog_comment`
--

DROP TABLE IF EXISTS `blog_comment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blog_comment`
--

LOCK TABLES `blog_comment` WRITE;
/*!40000 ALTER TABLE `blog_comment` DISABLE KEYS */;
/*!40000 ALTER TABLE `blog_comment` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blog_menu`
--

LOCK TABLES `blog_menu` WRITE;
/*!40000 ALTER TABLE `blog_menu` DISABLE KEYS */;
INSERT INTO `blog_menu` VALUES (1,0,'控制面板','admin','index','index','http://localhost/myblog/public/admin/index/index',0,'','fa-cubes',1,500,1,0),(2,0,'操作菜单','','','','http://localhost/myblog/public/',0,'','fa-reorder',1,300,1,0),(3,2,'管理员','admin','admin','index','http://localhost/myblog/public/admin/admin/index',0,'','fa-users',1,280,2,0),(4,2,'菜单管理','admin','menu','index','http://localhost/myblog/public/admin/menu/index',0,'','fa-tasks',1,255,2,0),(5,2,'导航管理','admin','menu','index','http://localhost/myblog/public/admin/menu/index?type=1',0,'type=1','fa-arrows',1,255,2,0),(6,0,'首页','home','index','index','http://localhost/myblog/public/home/index/index',0,'','',1,255,1,1),(7,0,'大生活','home','index','index2','http://localhost/myblog/public/home/index/index2',0,'','',1,255,1,1),(8,13,'文章分类','admin','articleCategory','index','http://localhost/myblog/public/admin/article_category/index',0,'','fa-list-alt',1,260,2,0),(9,13,'文章标签','admin','tag','index','http://localhost/myblog/public/admin/tag/index',0,'','fa-tag',1,255,2,0),(10,13,'文章列表','admin','article','index','http://localhost/myblog/public/admin/article/index',0,'',' fa-list-alt',1,255,2,0),(11,2,'留言管理','admin','message','index','http://localhost/myblog/public/admin/message/index',0,'','fa-paste',1,255,2,0),(12,2,'单页面管理','admin','page','index','http://localhost/myblog/public/admin/page/index',0,'','fa-file',1,255,2,0),(13,0,'文章管理','','','','http://localhost/myblog/public/',0,'','fa-th-list',1,255,1,0);
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
  PRIMARY KEY (`p_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blog_page`
--

LOCK TABLES `blog_page` WRITE;
/*!40000 ALTER TABLE `blog_page` DISABLE KEYS */;
/*!40000 ALTER TABLE `blog_page` ENABLE KEYS */;
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
  PRIMARY KEY (`t_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blog_tag`
--

LOCK TABLES `blog_tag` WRITE;
/*!40000 ALTER TABLE `blog_tag` DISABLE KEYS */;
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

-- Dump completed on 2017-02-07  0:18:31
