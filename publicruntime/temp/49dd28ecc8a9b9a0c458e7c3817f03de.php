<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:73:"D:\phpStudy2\WWW\myblog\public/../application/admin\view\admin\index.html";i:1486295506;}*/ ?>
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
	</head>
	<body>
		<div class="admin-main">
			<blockquote class="layui-elem-quote">
				<a href="javascript:;" class="layui-btn layui-btn-small form" data-url="<?php echo url('add'); ?>" data-title="添加管理员" id="add">
					<i class="layui-icon">&#xe608;</i> 添加管理员
				</a>
				<a href="javascript:;" class="layui-btn layui-btn-small" id="delSelect">
					<i class="layui-icon">&#xe640;</i> 删除选中
				</a>
			</blockquote>
			<fieldset class="layui-elem-field">
				<legend>管理员列表</legend>
				<div class="layui-field-box">
					<form action="<?php echo url('delSelect'); ?>" method="post" id="delSelectForm">
						<table class="site-table table-hover">
							<thead>
								<tr>
									<th><input type="checkbox" id="selected-all"></th>
									<th>用户名</th>
									<th>昵称</th>
									<th>头像</th>
									<th>注册时间</th>
									<th>最后登录时间</th>
									<th>最后登录IP</th>
									<th>登录次数</th>
									<th>状态</th>
									<th>操作</th>
								</tr>
							</thead>
							<tbody>
								<?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$admin): $mod = ($i % 2 );++$i;?>
								<tr>
									<td><input type="checkbox" value="<?php echo $admin['a_id']; ?>" name="id[]"></td>
									<td><?php echo $admin['user_name']; ?></td>
									<td><?php echo $admin['nickname']; ?></td>
									<td>
										<?php if(!(empty($admin['avatar']) || (($admin['avatar'] instanceof \think\Collection || $admin['avatar'] instanceof \think\Paginator ) && $admin['avatar']->isEmpty()))): ?>
											<img src="<?php echo UPLOAD_PATH; ?><?php echo $admin['avatar']; ?>" alt="头像">
										<?php else: ?>
											无
										<?php endif; ?>
									</td>
									<td><?php echo time_formate($admin['register_time']); ?></td>
									<td><?php echo time_formate($admin['last_login_time']); ?></td>
									<td><?php echo $admin['last_login_ip']; ?></td>
									<td><?php echo $admin['login_count']; ?></td>
									<td><?php echo status_icon($admin['status'] ); ?></td>
									<td>
										<a href="javascript:;" data-url="<?php echo url('edit',array('id'=>$admin['a_id'])); ?>" data-title="编辑管理员" class="layui-btn layui-btn-mini form">编辑</a>
										<a href="javascript:;" data-url="<?php echo url('del',array('id'=>$admin['a_id'],'page'=>\think\Request::instance()->get('page'))); ?>"  class="layui-btn layui-btn-danger layui-btn-mini del">删除</a>
									</td>
								</tr>
								<?php endforeach; endif; else: echo "" ;endif; ?>
							</tbody>
						</table>
					</form>
				</div>
			</fieldset>
			<div class="admin-table-page">
				<div class="pagination"><?php echo $page; ?></div>
			</div>
		</div>
		
		<script type="text/javascript" src="<?php echo ADMIN_STATIC_URL; ?>plugins/layui/layui.js"></script>
		<script type="text/javascript" src="<?php echo ADMIN_STATIC_URL; ?>js/page.common.js"></script>
		
	</body>

</html>