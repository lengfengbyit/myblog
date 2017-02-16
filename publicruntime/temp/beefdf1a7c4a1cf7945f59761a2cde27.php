<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:74:"D:\phpStudy2\WWW\myblog\public/../application/admin\view\article\form.html";i:1486570180;}*/ ?>
<br/>
<form class="layui-form" method="post" action="<?php echo $url; ?>" id="dataForm">
	<div class="layui-form-item">
		<label class="layui-form-label">所属分类</label>
		<div class="layui-input-block">
			<select name="ac_id" id="">
				<option value="0">--请选择--</option>
				<?php if(is_array($cateList) || $cateList instanceof \think\Collection || $cateList instanceof \think\Paginator): $i = 0; $__LIST__ = $cateList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$cate): $mod = ($i % 2 );++$i;?>
					<option value="<?php echo $cate['ac_id']; ?>" 
						<?php if($info['ac_id'] == $cate['ac_id']): ?>selected<?php endif; ?>
					 ><?php echo $cate['cate_name']; ?></option>
				<?php endforeach; endif; else: echo "" ;endif; ?>
			</select>
		</div>
	</div>
	<div class="layui-form-item">
		<label class="layui-form-label">选择标签</label>
		<div class="layui-input-block">
			<?php if(is_array($tagList) || $tagList instanceof \think\Collection || $tagList instanceof \think\Paginator): $i = 0; $__LIST__ = $tagList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$tag): $mod = ($i % 2 );++$i;?>
				<input type="checkbox" name="tag_ids[<?php echo $tag['t_id']; ?>]" value="<?php echo $tag['t_id']; ?>" title="<?php echo $tag['tag_name']; ?>"
				<?php if(in_array(($tag['t_id']), is_array($info['tag_ids'])?$info['tag_ids']:explode(',',$info['tag_ids']))): ?>checked<?php endif; ?>
				>
			<?php endforeach; endif; else: echo "" ;endif; ?>
		</div>
	</div>
	<div class="layui-form-item">
		<label class="layui-form-label">标题</label>
		<div class="layui-input-block">
			<input type="text" name="title" placeholder="请输入文章标题" autocomplete="off" class="layui-input" lay-verify="required" value="<?php echo $info['title']; ?>">
		</div>
	</div>
	<div class="layui-form-item">
		<label class="layui-form-label">是否显示</label>
		<div class="layui-input-block">
			<input type="checkbox" name="is_show" value="<?php echo $info['is_show']; ?>" lay-skin="switch" <?php if($info['is_show'] == '1'): ?>checked<?php endif; ?> title="是否显示">
		</div>
	</div>
	<div class="layui-form-item">
		<label class="layui-form-label">摘要</label>
		<div class="layui-input-block">
			<textarea name="summary" class="layui-textarea"  placeholder="请输入文章摘要"><?php echo $info['summary']; ?></textarea>
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
			<input type="hidden" name="id" value="<?php echo $info['a_id']; ?>">
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