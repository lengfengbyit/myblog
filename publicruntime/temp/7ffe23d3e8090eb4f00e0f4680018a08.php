<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:72:"D:\phpStudy2\WWW\myblog\public/../application/admin\view\admin\form.html";i:1486781551;}*/ ?>
<br/>
<form class="layui-form" method="post" action="<?php echo $url; ?>" enctype="multipart/form-data" id="dataForm">
	<div class="layui-form-item">
		<label class="layui-form-label">账号</label>
		<div class="layui-input-block">
			<input type="text" name="user_name" placeholder="请输入账号" autocomplete="off" class="layui-input" lay-verify="required" value="<?php echo $info['user_name']; ?>">
		</div>
	</div>
	<div class="layui-form-item">
		<label class="layui-form-label">密码</label>
		<div class="layui-input-block">
			<input type="text" name="password" placeholder="请输入密码" autocomplete="off" class="layui-input" " value="">
			<samll>(为空则不修改)</samll>
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
<script>
loadFormScript();
</script>