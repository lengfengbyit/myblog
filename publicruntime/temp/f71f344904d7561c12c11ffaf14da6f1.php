<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:72:"D:\phpStudy2\WWW\myblog\public/../application/admin\view\admin\info.html";i:1486809355;s:39:"../application/common/layout/index.html";i:1486784064;s:38:"../application/common/view/header.html";i:1486778746;s:38:"../application/common/view/footer.html";i:1486476083;}*/ ?>
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


<style type="text/css">
	.layui-input{
		max-width: 300px;
	}
</style>
<div class="admin-main">
	<fieldset class="layui-elem-field">
		<legend>个人信息</legend>
		<div class="layui-field-box">
			<form class="layui-form" method="post" action="<?php echo url('edit'); ?>" enctype="multipart/form-data" id="dataForm">
				<div class="layui-form-item">
					<label class="layui-form-label">账号</label>
					<div class="layui-input-block">
						<input type="text" name="user_name" placeholder="请输入账号" autocomplete="off" class="layui-input" lay-verify="required" value="<?php echo $info['user_name']; ?>">
					</div>
				</div>
				<div class="layui-form-item">
					<label class="layui-form-label">密码</label>
					<div class="layui-input-block">
						<input type="text" name="password" placeholder="请输入密码" autocomplete="off" class="layui-input"  value="">
						<small>(为空则不修改)</small>
					</div>
				</div>
				<div class="layui-form-item">
					<label class="layui-form-label">昵称</label>
					<div class="layui-input-block">
						<input type="text" name="nickname" placeholder="请输入昵称" autocomplete="off" class="layui-input" lay-verify="required" value="<?php echo $info['nickname']; ?>">
					</div>
				</div>
				<div class="layui-form-item">
					<label class="layui-form-label">是否可用</label>
					<div class="layui-input-block">
						<input type="checkbox" name="status" value="<?php echo $info['status']; ?>" lay-skin="switch" <?php if($info['status'] == '1'): ?>checked<?php endif; ?> title="是否可用">
					</div>
				</div>
				<div class="layui-form-item">
					<label class="layui-form-label">头像</label>
					<div class="layui-input-block">
					<?php if(!(empty($info['avatar']) || (($info['avatar'] instanceof \think\Collection || $info['avatar'] instanceof \think\Paginator ) && $info['avatar']->isEmpty()))): ?>
						<img src="<?php echo UPLOAD_URL; ?>avatar/<?php echo $info['avatar']; ?>"  alt="" style="max-width:50px;max-height:50px;">
					<?php endif; ?>
					<input type="file"  placeholder="请选择头像上传" class="upload_img">
					<input type="hidden" name="avatar">
					</div>
				</div>
				<div class="layui-form-item">
					<div class="layui-input-block">
						<input type="hidden" name="id" value="<?php echo $info['a_id']; ?>">
						<button class="layui-btn" lay-submit lay-filter="*">立即提交</button>
						<button type="reset" class="layui-btn layui-btn-primary">重置</button>
					</div>
				</div>
			</form>
		</div>
	</fieldset>
</div>
<script>
loadFormScript();
</script>

		
		
	</body>

</html>