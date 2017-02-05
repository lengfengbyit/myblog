<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:72:"D:\phpStudy2\WWW\myblog\public/../application/admin\view\menu\index.html";i:1486297220;}*/ ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>菜单管理列表页</title>
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
				<a href="javascript:;" class="layui-btn layui-btn-small form" data-url="<?php echo url('add',array('type'=>$type)); ?>" data-title="添加菜单">
					<i class="layui-icon">&#xe608;</i> 添加菜单
				</a>
				<a href="javascript:;" class="layui-btn layui-btn-small" id="delSelect">
					<i class="layui-icon">&#xe640;</i> 删除选中
				</a>
				<?php if($type == '0'): ?>
				<a href="javascript:;" class="layui-btn layui-btn-small" id="createNav" data-url="<?php echo url('createNav'); ?>">
					<i class="layui-icon">&#x1002;</i> 创建菜单
				</a>
				<?php endif; ?>
			</blockquote>
			<fieldset class="layui-elem-field">
				<legend>菜单列表</legend>
				<div class="layui-field-box">
					<form action="<?php echo url('delSelect'); ?>" method="post" id="delSelectForm">
						<table class="site-table table-hover">
							<thead>
								<tr>
									<th><input type="checkbox" id="selected-all"></th>
									<th>菜单名称</th>
									<th>链接URL</th>
									<th>状态</th>
									<th>排序(降序)</th>
									<th>操作</th>
								</tr>
							</thead>
							<tbody>
								<?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$menu): $mod = ($i % 2 );++$i;?>
								<tr>
									<td><input type="checkbox" value="<?php echo $menu['m_id']; ?>" name="id[]"></td>
									<td style="text-align:left"><?php echo $menu['menu_name']; ?></td>
									<td><?php echo $menu['url']; ?></td>
									<td><?php echo status_icon($menu['status'] ); ?></td>
									<td><?php echo $menu['sort']; ?></td>
									<td>
										<a href="javascript:;" data-url="<?php echo url('edit',array('id'=>$menu['m_id'])); ?>" class="layui-btn layui-btn-mini form">编辑</a>
										<a href="javascript:;" data-url="<?php echo url('del',array('id'=>$menu['m_id'],'page'=>\think\Request::instance()->get('page'))); ?>"  class="layui-btn layui-btn-danger layui-btn-mini del">删除</a>
									</td>
								</tr>
								<?php if(is_array($menu['children']) || $menu['children'] instanceof \think\Collection || $menu['children'] instanceof \think\Paginator): $i = 0; $__LIST__ = $menu['children'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?>
									<tr>
										<td><input type="checkbox" value="<?php echo $item['m_id']; ?>" name="id[]"></td>
										<td style="text-align:left">&nbsp;&nbsp;|_&nbsp;<?php echo $item['menu_name']; ?></td>
										<td><?php echo $item['url']; ?></td>
										<td><?php echo status_icon($item['status'] ); ?></td>
										<td><?php echo $item['sort']; ?></td>
										<td>
											<a href="javascript:;" data-url="<?php echo url('edit',array('id'=>$item['m_id'])); ?>" class="layui-btn layui-btn-mini form">编辑</a>
											<a href="javascript:;" data-url="<?php echo url('del',array('id'=>$item['m_id'],'page'=>\think\Request::instance()->get('page'))); ?>"  class="layui-btn layui-btn-danger layui-btn-mini del">删除</a>
										</td>
									</tr>
								<?php endforeach; endif; else: echo "" ;endif; endforeach; endif; else: echo "" ;endif; ?>
							</tbody>
						</table>
					</form>
				</div>
			</fieldset>
		</div>
		<script type="text/javascript" src="<?php echo ADMIN_STATIC_URL; ?>plugins/layui/layui.js"></script>
		<script type="text/javascript" src="<?php echo ADMIN_STATIC_URL; ?>js/page.common.js"></script>
		<script>
			layui.use(['layer'], function() {
				var $ = layui.jquery,
					layer = parent.layer === undefined ? layui.layer : parent.layer;

				//创建导航菜单
				$('#createNav').on('click',function(){

					$.get(this.dataset.url, function(data) {
						
						if(typeof data == 'string'){

							data = JSON.parse(data);
						}

						layer.msg(data.msg);

						if(data.error == 0){

							parent.location.reload(true);
						}
					});
				})
			});
		</script>
	</body>

</html>