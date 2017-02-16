<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:72:"D:\phpStudy2\WWW\myblog\public/../application/admin\view\rule\index.html";i:1487170223;s:39:"../application/common/layout/index.html";i:1486784064;s:38:"../application/common/view/header.html";i:1486778746;s:38:"../application/common/view/footer.html";i:1486476083;}*/ ?>
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
		<a href="javascript:;" class="layui-btn layui-btn-small form" data-url="<?php echo url('add'); ?>" data-title="添加规则" id="add">
			<i class="layui-icon">&#xe608;</i> 添加规则
		</a>
		<a href="javascript:;" class="layui-btn layui-btn-small" id="delSelect">
			<i class="layui-icon">&#xe640;</i> 删除选中
		</a>
	</blockquote>
	<fieldset class="layui-elem-field">
		<legend>规则列表</legend>
		<div class="layui-field-box">
			<form action="<?php echo url('delSelect'); ?>" method="post" id="delSelectForm">
				<table class="site-table table-hover">
					<thead>
						<tr>
							<th><input type="checkbox" id="selected-all"></th>
							<th>规则名称</th>
							<th>规则唯一标识</th>
							<th>表达式</th>
							<th>类型</th>
							<th>状态</th>
							<th>操作</th>
						</tr>
					</thead>
					<tbody>
						<?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?>
						<tr>
							<td><input type="checkbox" value="<?php echo $item['id']; ?>" name="id[]"></td>
							<td style="text-align: left;"><?php echo $item['title']; ?></td>
							<td><?php echo $item['name']; ?></td>
							<td><?php echo $item['condition']; ?></td>
							<td><?php echo rule_type($item['type'] ); ?></td>
							<td><?php echo status_icon($item['status'] ); ?></td>
							<td>
								<a href="javascript:;" data-url="<?php echo url('edit',array('id'=>$item['id'])); ?>" data-title="编辑规则" class="layui-btn layui-btn-mini form">编辑</a>
								<a href="javascript:;" data-url="<?php echo url('del',array('id'=>$item['id'],'page'=>\think\Request::instance()->get('page'))); ?>"  class="layui-btn layui-btn-danger layui-btn-mini del">删除</a>
							</td>
						</tr>
						<?php if(is_array($item['children']) || $item['children'] instanceof \think\Collection || $item['children'] instanceof \think\Paginator): $i = 0; $__LIST__ = $item['children'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$child): $mod = ($i % 2 );++$i;?>
							<tr>
								<td><input type="checkbox" value="<?php echo $child['id']; ?>" name="id[]"></td>
								<td style="text-align: left;">&nbsp;|_<?php echo $child['title']; ?></td>
								<td><?php echo $child['name']; ?></td>
								<td><?php echo $child['condition']; ?></td>
								<td><?php echo rule_type($child['type'] ); ?></td>
								<td><?php echo status_icon($child['status'] ); ?></td>
								<td>
									<a href="javascript:;" data-url="<?php echo url('edit',array('id'=>$child['id'])); ?>" data-title="编辑规则" class="layui-btn layui-btn-mini form">编辑</a>
									<a href="javascript:;" data-url="<?php echo url('del',array('id'=>$child['id'],'page'=>\think\Request::instance()->get('page'))); ?>"  class="layui-btn layui-btn-danger layui-btn-mini del">删除</a>
								</td>
							</tr>
						<?php endforeach; endif; else: echo "" ;endif; endforeach; endif; else: echo "" ;endif; ?>
					</tbody>
				</table>
			</form>
		</div>
	</fieldset>
</div>
		

		
		
	</body>

</html>