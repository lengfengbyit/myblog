<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:83:"D:\phpStudy2\WWW\myblog\public/../application/admin\view\article_category\form.html";i:1486480693;}*/ ?>
<br/>
<form class="layui-form" method="post" action="<?php echo $url; ?>" enctype="multipart/form-data" id="dataForm">
	<div class="layui-form-item">
		<label class="layui-form-label">所属分类<?php echo $info['pid']; ?></label>
		<div class="layui-input-block">
			<select name="pid" id="">
				<option value="0">--请选择--</option>
				<?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?>
					<option value="<?php echo $item['ac_id']; ?>" 
						<?php if($info['pid'] == $item['ac_id']): ?>selected<?php endif; ?>
					 ><?php echo $item['cate_name']; ?></option>
				<?php endforeach; endif; else: echo "" ;endif; ?>
			</select>
		</div>
	</div>
	<div class="layui-form-item">
		<label class="layui-form-label">分类名称</label>
		<div class="layui-input-block">
			<input type="text" name="cate_name" placeholder="请输入分类名称" autocomplete="off" class="layui-input" lay-verify="required" value="<?php echo $info['cate_name']; ?>">
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
			<input type="hidden" name="id" value="<?php echo $info['ac_id']; ?>">
			<button class="layui-btn" lay-submit lay-filter="*">立即提交</button>
			<button type="reset" class="layui-btn layui-btn-primary" id="reset">重置</button>
		</div>
	</div>
</form>
<script>
loadFormScript();
</script>