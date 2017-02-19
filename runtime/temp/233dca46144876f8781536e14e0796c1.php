<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:74:"D:\phpStudy2\WWW\myblog\public/../application/admin\view\site\setting.html";i:1487509017;s:39:"../application/common/layout/index.html";i:1486784064;s:38:"../application/common/view/header.html";i:1486778746;s:38:"../application/common/view/footer.html";i:1486476083;}*/ ?>
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
			<form class="layui-form" method="post" action="<?php echo url('setting'); ?>" enctype="multipart/form-data" id="dataForm">
				<div class="layui-form-item">
					<label class="layui-form-label">站点名称</label>
					<div class="layui-input-block">
						<input type="text" name="user_name" placeholder="请输入账号" autocomplete="off" class="layui-input"  value="">
					</div>
				</div>
				<div class="layui-form-item">
					<label class="layui-form-label">网站logo</label>
					<div class="layui-input-block">
						<input type="file"  placeholder="请选择头像上传" class="upload_img">
						<input type="hidden" name="site_logo">
					</div>
				</div>
				<div class="layui-form-item">
					<label class="layui-form-label">底部版权信息</label>
					<div class="layui-input-block">
						<textarea name="site_coypright"  placeholder="请输入底部版权信息" class="layui-textarea"></textarea>
					</div>
				</div>
				<div class="layui-form-item">
					<label for="" class="layui-form-label">游客留言</label>
					<div class="layui-input-block">
						<input type="checkbox" lay-skin="switch" value="1" checked name="visitor_message">
					</div>
				</div>
				<div class="layui-form-item">
					<label for="" class="layui-form-label">网站是否开启</label>
					<div class="layui-input-block">
						<input type="checkbox" lay-skin="switch" value="1" checked name="site_open" id="">
					</div>
				</div>
				<div class="layui-form-item">
					<div class="layui-input-block">
						<input type="hidden" name="id" value="">
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