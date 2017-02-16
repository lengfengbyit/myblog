<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:70:"D:\phpStudy2\WWW\myblog\public/../application/admin\view\tag\form.html";i:1486480750;}*/ ?>
<br/>
<form class="layui-form" method="post" action="<?php echo $url; ?>" enctype="multipart/form-data" id="dataForm">
	<div class="layui-form-item">
		<label class="layui-form-label">标签名称</label>
		<div class="layui-input-block">
			<input type="text" name="tag_name" placeholder="请输入标签名称" autocomplete="off" class="layui-input" lay-verify="required" value="<?php echo $info['tag_name']; ?>">
		</div>
	</div>
	<div class="layui-form-item">
		<label class="layui-form-label">排序</label>
		<div class="layui-input-block">
			<input type="text" name="sort" placeholder="请输入一个数字" autocomplete="off" class="layui-input"  value="<?php echo $info['sort']; ?>">
			<small class="form-tips">(降序)</small>
		</div>
	</div>
	<div class="layui-form-item">
		<label class="layui-form-label">是否可用</label>
		<div class="layui-input-block">
			<input type="checkbox" name="status" value="<?php echo $info['status']; ?>" lay-skin="switch" <?php if($info['status'] == '1'): ?>checked<?php endif; ?> title="是否可用">
		</div>
	</div>
	<div class="layui-form-item">
		<div class="layui-input-block">
			<input type="hidden" name="id" value="<?php echo $info['t_id']; ?>">
			<button class="layui-btn" lay-submit lay-filter="*">立即提交</button>
			<button type="reset" class="layui-btn layui-btn-primary" id="reset">重置</button>
		</div>
	</div>
</form>
<script>
loadFormScript();
</script>