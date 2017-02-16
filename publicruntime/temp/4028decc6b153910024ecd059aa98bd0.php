<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:84:"D:\phpStudy2\WWW\myblog\public/../application/admin\view\article_category\index.html";i:1486480601;s:39:"../application/common/layout/index.html";i:1486397553;s:38:"../application/common/view/header.html";i:1486476081;}*/ ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>管理员列表页</title>
		<link rel="stylesheet" href="<?php echo ADMIN_STATIC_URL; ?>plugins/layui/css/layui.css" media="all" />
		<link rel="stylesheet" href="<?php echo ADMIN_STATIC_URL; ?>css/global.css" media="all">
		<link rel="stylesheet" type="text/css" href="<?php echo ADMIN_STATIC_URL; ?>css/font-awesome.4.6.0.css">
		<link rel="stylesheet" href="<?php echo ADMIN_STATIC_URL; ?>css/table.css" />
		<script type="text/javascript">
			var ADMIN_STATIC_URL = "<?php echo ADMIN_STATIC_URL; ?>";
		</script>
		<script type="text/javascript" src="<?php echo ADMIN_STATIC_URL; ?>plugins/layui/layui.js"></script>
		<script type="text/javascript" src="<?php echo ADMIN_STATIC_URL; ?>js/page.common.js"></script>
	</head>
	<body>


<div class="item-main">
	<blockquote class="layui-elem-quote">
		<a href="javascript:;" class="layui-btn layui-btn-small form" data-url="<?php echo url('add'); ?>" data-title="添加分类" id="add">
			<i class="layui-icon">&#xe608;</i> 添加分类
		</a>
		<a href="javascript:;" class="layui-btn layui-btn-small" id="delSelect">
			<i class="layui-icon">&#xe640;</i> 删除选中
		</a>
	</blockquote>
	<fieldset class="layui-elem-field">
		<legend>文章分类列表</legend>
		<div class="layui-field-box">
			<form action="<?php echo url('delSelect'); ?>" method="post" id="delSelectForm">
				<table class="site-table table-hover">
					<thead>
						<tr>
							<th><input type="checkbox" id="selected-all"></th>
							<th>ID</th>
							<th>分类名称</th>
							<th>状态</th>
							<th>排序</th>
							<th>操作</th>
						</tr>
					</thead>
					<tbody>
						<?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?>
						<tr>
							<td><input type="checkbox" value="<?php echo $item['ac_id']; ?>" name="id[]"></td>
							<td><?php echo $item['ac_id']; ?></td>
							<td style="text-align: left"><?php echo $item['cate_name']; ?></td>
							<td><?php echo status_icon($item['status'] ); ?></td>
							<td><?php echo $item['sort']; ?></td>
							<td>
								<a href="javascript:;" data-url="<?php echo url('edit',array('id'=>$item['ac_id'])); ?>" data-title="编辑管理员" class="layui-btn layui-btn-mini form">编辑</a>
								<a href="javascript:;" data-url="<?php echo url('del',array('id'=>$item['ac_id'],'page'=>\think\Request::instance()->get('page'))); ?>"  class="layui-btn layui-btn-danger layui-btn-mini del">删除</a>
							</td>
						</tr>
							<?php if(is_array($item['children']) || $item['children'] instanceof \think\Collection || $item['children'] instanceof \think\Paginator): $i = 0; $__LIST__ = $item['children'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$child): $mod = ($i % 2 );++$i;?>
								<tr>
									<td><input type="checkbox" value="<?php echo $child['ac_id']; ?>" name="id[]"></td>
									<td><?php echo $child['ac_id']; ?></td>
									<td style="text-align: left">&nbsp;&nbsp;|_&nbsp;<?php echo $child['cate_name']; ?></td>
									<td><?php echo status_icon($child['status'] ); ?></td>
									<td><?php echo $child['sort']; ?></td>
									<td>
										<a href="javascript:;" data-url="<?php echo url('edit',array('id'=>$child['ac_id'])); ?>" data-title="编辑管理员" class="layui-btn layui-btn-mini form">编辑</a>
										<a href="javascript:;" data-url="<?php echo url('del',array('id'=>$child['ac_id'],'page'=>\think\Request::instance()->get('page'))); ?>"  class="layui-btn layui-btn-danger layui-btn-mini del">删除</a>
									</td>
								</tr>
							<?php endforeach; endif; else: echo "" ;endif; endforeach; endif; else: echo "" ;endif; ?>
					</tbody>
				</table>
			</form>
		</div>
	</fieldset>
</div>
		

<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>管理员列表页</title>
		<link rel="stylesheet" href="<?php echo ADMIN_STATIC_URL; ?>plugins/layui/css/layui.css" media="all" />
		<link rel="stylesheet" href="<?php echo ADMIN_STATIC_URL; ?>css/global.css" media="all">
		<link rel="stylesheet" type="text/css" href="<?php echo ADMIN_STATIC_URL; ?>css/font-awesome.4.6.0.css">
		<link rel="stylesheet" href="<?php echo ADMIN_STATIC_URL; ?>css/table.css" />
		<script type="text/javascript">
			var ADMIN_STATIC_URL = "<?php echo ADMIN_STATIC_URL; ?>";
		</script>
		<script type="text/javascript" src="<?php echo ADMIN_STATIC_URL; ?>plugins/layui/layui.js"></script>
		<script type="text/javascript" src="<?php echo ADMIN_STATIC_URL; ?>js/page.common.js"></script>
	</head>
	<body>