<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:71:"D:\phpStudy2\WWW\myblog\public/../application/admin\view\role\form.html";i:1487251634;}*/ ?>
<br/>
<form class="layui-form" method="post" action="<?php echo $url; ?>" enctype="multipart/form-data" id="dataForm">
	<div class="layui-form-item">
		<label class="layui-form-label">名称</label>
		<div class="layui-input-block">
			<input type="text" name="title" placeholder="请输入角色名称" autocomplete="off" class="layui-input" lay-verify="required" value="<?php echo $info['title']; ?>">
		</div>
	</div>
	<div class="layui-form-item">
		<label class="layui-form-label">状态</label>
		<div class="layui-input-block">
			<input type="checkbox" name="status" value="<?php echo $info['status']; ?>" lay-skin="switch" <?php if($info['status'] == '1'): ?>checked<?php endif; ?> title="状态">
		</div>
	</div>
	<div class="layui-form-item">
		<div class="layui-input-block">
			<input type="hidden" name="id" value="<?php echo $info['id']; ?>">
			<button class="layui-btn" lay-submit lay-filter="*">立即提交</button>
			<button type="reset" class="layui-btn layui-btn-primary">重置</button>
		</div>
	</div>
</form>
<script>
loadFormScript();
</script>