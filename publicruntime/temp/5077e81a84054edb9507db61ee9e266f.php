<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:71:"D:\phpStudy2\WWW\myblog\public/../application/admin\view\rule\form.html";i:1487169413;}*/ ?>
<br/>
<form class="layui-form" method="post" action="<?php echo $url; ?>" enctype="multipart/form-data" id="dataForm">
	<div class="layui-form-item">
		<label class="layui-form-label">所属模块</label>
		<div class="layui-input-block">
			<select name="pid" id="">
				<option value="0">--请选择--</option>
				<?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?>
					<option value="<?php echo $item['id']; ?>" 
						<?php if($info['pid'] == $item['id']): ?>selected<?php endif; ?>
					 ><?php echo $item['title']; ?></option>
				<?php endforeach; endif; else: echo "" ;endif; ?>
			</select>
		</div>
	</div>
	<div class="layui-form-item">
		<label class="layui-form-label">规则名称</label>
		<div class="layui-input-block">
			<input type="text" name="title" placeholder="请输入规则名称" autocomplete="off" class="layui-input" lay-verify="required" value="<?php echo $info['title']; ?>">
		</div>
	</div>
	<div class="layui-form-item">
		<label class="layui-form-label">唯一标识</label>
		<div class="layui-input-block">
			<input type="text" name="name" placeholder="请输入规则唯一标识" autocomplete="off" class="layui-input" value="<?php echo $info['name']; ?>">
		</div>
	</div>
	<div class="layui-form-item">
		<label class="layui-form-label">规则表达式</label>
		<div class="layui-input-block">
			<input type="text" name="condition" placeholder="请输入规则表达式" autocomplete="off" class="layui-input" value="<?php echo $info['condition']; ?>">
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
			<button type="reset" class="layui-btn layui-btn-primary" id="reset">重置</button>
		</div>
	</div>
</form>
<script>

loadFormScript();
</script>