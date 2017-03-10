<?php if (!defined('THINK_PATH')) exit(); /*a:5:{s:72:"D:\phpStudy2\WWW\myblog\public/../application/home\view\index_index.html";i:1489136586;s:38:"../application/home/layout/layout.html";i:1487733496;s:43:"../application/home/view/public_header.html";i:1487733496;s:44:"../application/home/view/public_navmenu.html";i:1489050187;s:43:"../application/home/view/public_footer.html";i:1489137212;}*/ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="zh-CN" lang="zh-CN">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta http-equiv="Content-Language" content="zh-CN" />
	<meta name="keywords" content="你我网,圈圈说,汉中,汉中圈圈,你我,如是观,心理,感情,youmew" />
	<meta name="description" content="你我网，缘自圈圈说，记载着圈圈的生活过往，只为留住那份曾经的感动；圈圈，又名小尤，前半生执著于感情，命途多舛，故孑然一身。" />
	<title>你我网</title>
	<link rel="stylesheet" rev="stylesheet" href="<?php echo HOME_STATIC_URL; ?>css/style.css" type="text/css" media="screen" />
    <link rel="shortcut icon" href="<?php echo HOME_STATIC_URL; ?>/favicon.ico" />
	<script src="<?php echo HOME_STATIC_URL; ?>js/common.js" type="text/javascript"></script>
	<script src="<?php echo HOME_STATIC_URL; ?>js/c_html_js_add.js" type="text/javascript"></script>
	<script src="<?php echo HOME_STATIC_URL; ?>js/custom.js" type="text/javascript"></script>
	<link rel="alternate" type="application/rss+xml" href="<?php echo HOME_STATIC_URL; ?>css/feed.css" title="你我网 " />
</head>


<body class="multi default">
<div id="divAll">
	<div id="divPage">
	<div id="divMiddle">
		
		<!-- 导航菜单 -->
		<div id="divTop">
    <h1 id="BlogTitle">
        <a href="#">
            <img src="/static/home/images/LOGO.gif" alt="你我网" onMouseover="shake(this,'onmouseout')" />
        </a>
    </h1>
    <h3 id="BlogSubTitle">www.myblog.com</h3>
</div>
<div id="divNavBar">
    <ul>
    	<?php if(is_array($navMenu) || $navMenu instanceof \think\Collection || $navMenu instanceof \think\Paginator): $i = 0; $__LIST__ = $navMenu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?>
        <li><a href="<?php echo $item['url']; ?>"><?php echo $item['menu_name']; ?></a></li>
        <?php endforeach; endif; else: echo "" ;endif; ?>
    </ul>
</div>


		<div id="divMain">
			<?php if(is_array($articleList) || $articleList instanceof \think\Collection || $articleList instanceof \think\Paginator): $i = 0; $__LIST__ = $articleList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$art): $mod = ($i % 2 );++$i;?>
			<div class="post multi-post cate4 auth1">
				<h4 class="post-date"><?php echo $art['create_time']; ?></h4>
				<h2 class="post-title"><a href="<?php echo url('index/article',array('id'=>$art['a_id'])); ?>"><?php echo $art['title']; ?></a></h2>
				<div class="post-body"><p><?php echo $art['summary']; ?></p></div>
				<h5 class="post-tags">Tags: 
					<span class="tags">
						<?php if(is_array($art['tags']) || $art['tags'] instanceof \think\Collection || $art['tags'] instanceof \think\Paginator): $tid = 0; $__LIST__ = $art['tags'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$tag): $mod = ($tid % 2 );++$tid;?>
						<a href="<?php echo url('index/index',array('t_id'=>$tid)); ?>"><?php echo strtoupper($tag); ?></a>&nbsp;&nbsp;
						<?php endforeach; endif; else: echo "" ;endif; ?>
					</span>
				</h5>
				<h6 class="post-footer">
					分类:<?php echo $art['cate_name']; ?> | 评论:<?php echo $art->comments()->count(); ?> | 
					浏览:<span id="spn77"><?php echo $art['view_num']; ?></span>
					| <a href="<?php echo url('index/article',array('id'=>$art['a_id'])); ?>">阅读全文 > </a>
				</h6>
			</div> 
			<?php endforeach; endif; else: echo "" ;endif; ?>

		<div class="pagination"><?php echo $page; ?></div>
		</div>
		<div id="divSidebar">
			<dl class="function" id="divSearchPanel">
				<dt class="function_t">搜索</dt>
				<dd class="function_c">
					<div>
					    <div style="padding:0.5em 0 0.5em 1em;">
					        <form method="post" action="<?php echo url('index/index'); ?>">
		                        <input type="text" name="keyword" value="<?php echo (isset($keyword) && ($keyword !== '')?$keyword:''); ?>" id="edtSearch" size="12"> 
		                        <input type="submit" value="提交" name="btnPost" id="btnPost">
		                    </form>
					    </div>
					</div>
				</dd>
			</dl>
			<dl class="function" id="divTags">
				<dt class="function_t">按标签浏览</dt>
				<dd class="function_c">
					<ul>
						<?php if(is_array($tagList) || $tagList instanceof \think\Collection || $tagList instanceof \think\Paginator): $i = 0; $__LIST__ = $tagList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$tag): $mod = ($i % 2 );++$i;?>
							<li class="tag-name tag-name-size-2">
								<a href="<?php echo url('index/index',array('t_id'=>$tag['t_id'])); ?>"><?php echo strtoupper($tag['tag_name']); ?>
								<span class="tag-count"> (<?php echo $tag->art_count; ?>)</span></a>
							</li>
						<?php endforeach; endif; else: echo "" ;endif; ?>
					</ul>
				</dd>
			</dl>

			<!-- 最新留言 -->
       		<?php echo widget('Comment/lastCommentList'); ?>

			<dl class="function" id="divLinkage">
				<dt class="function_t">友情链接</dt>
				<dd class="function_c">
					<ul>
						<li>
							<a href="http://www.nszbk.com" target="_blank">逆时针博客</a>　
							<a href="http://www.mybiketimes.com/" target="_blank">单车岁月</a>　
							<a href="http://www.lopwon.com/" target="_blank">立云图志</a>
						</li>
					</ul>
				</dd>
			</dl>
		</div>
		
		

<div id="divBottom">
          <h3 id="BlogCopyRight"><?php echo $siteInfo['site_coypright']; ?></h3>
            <h4 id="BlogPowerBy">Powered By 
                <a href="javascript:void(0)" title="<?php echo $siteInfo['site_name']; ?>" target="_blank"><?php echo $siteInfo['site_name']; ?></a>　
                本站遵循<a rel="license" target="_blank" title="署名-非商业性使用-禁止演绎 3.0 中国大陆许可协议" href="http://creativecommons.org/licenses/by-nc-nd/3.0/cn/"> CC BY-NC-ND 3.0 CN协议 </a>。</h4>
        </div><div class="clear"></div>
        </div>
        <div class="clear"></div>
    </div>
    <div class="clear"></div>
</div>
</body>
</html>