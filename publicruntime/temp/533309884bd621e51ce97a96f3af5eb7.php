<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:71:"D:\phpStudy2\WWW\myblog\public/../application/admin\view\page\form.html";i:1486646906;}*/ ?>
<br/>
<form class="layui-form" method="post" action="<?php echo $url; ?>" id="dataForm">
	<div class="layui-form-item">
		<label class="layui-form-label">标题</label>
		<div class="layui-input-block">
			<input type="text" name="title" placeholder="请输入文章标题" autocomplete="off" class="layui-input" lay-verify="required" value="<?php echo $info['title']; ?>">
		</div>
	</div>
	<div class="layui-form-item">
		<label class="layui-form-label">是否显示</label>
		<div class="layui-input-block">
			<input type="checkbox" name="status" value="<?php echo $info['status']; ?>" lay-skin="switch" <?php if($info['status'] == '1'): ?>checked<?php endif; ?> title="是否显示">
		</div>
	</div>
	<div class="layui-form-item">
		<label class="layui-form-label">排序</label>
		<div class="layui-input-block">
			<input type="text" name="sort" value="<?php echo $info['sort']; ?>" placeholder="请输入一个数字" autocomplete="off" class="layui-input" value="<?php echo $info['sort']; ?>">
		</div>
	</div>
	<div class="layui-form-item">
		<label class="layui-form-label">内容</label>
		<div class="layui-input-block">
			<textarea class="layui-textarea layui-hide" name="content" lay-verify="content" id="LAY_demo_editor"><?php echo $info['content']; ?></textarea>
		</div>
	</div>
	<div class="layui-form-item">
		<div class="layui-input-block">
			<input type="hidden" name="id" value="<?php echo $info['p_id']; ?>">
			<button class="layui-btn" lay-submit lay-filter="*">立即提交</button>
			<button type="reset" class="layui-btn layui-btn-primary" id="reset">重置</button>
		</div>
	</div>
</form>
<script>

loadFormScript();
</script>
<script>
	layui.use(['form', 'layedit', 'laydate'], function() {
		var form = layui.form(),
			layer = layui.layer,
			layedit = layui.layedit,
			laydate = layui.laydate;

		//创建一个编辑器
		var editIndex = layedit.build('LAY_demo_editor');
		//自定义验证规则
		form.verify({
			title: function(value) {
				if(value.length < 5) {
					return '标题至少得5个字符啊';
				}
			},
			content: function(value) {
				layedit.sync(editIndex);
			}
		});
		
	});
</script>