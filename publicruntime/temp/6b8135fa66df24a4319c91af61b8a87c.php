<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:71:"D:\phpStudy2\WWW\myblog\public/../application/admin\view\menu\form.html";i:1486297322;}*/ ?>
<br/>
<form class="layui-form" method="post" action="<?php echo $url; ?>" enctype="multipart/form-data" id="dataForm">
	<div class="layui-form-item">
		<label class="layui-form-label">所属菜单<?php echo $info['p_mid']; ?></label>
		<div class="layui-input-block">
			<select name="p_mid" id="">
				<option value="0">--请选择--</option>
				<?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$menu): $mod = ($i % 2 );++$i;?>
					<option value="<?php echo $menu['m_id']; ?>" 
						<?php if($info['p_mid'] == $menu['m_id']): ?>selected<?php endif; ?>
					 ><?php echo $menu['menu_name']; ?></option>
				<?php endforeach; endif; else: echo "" ;endif; ?>
			</select>
		</div>
	</div>
	<div class="layui-form-item">
		<label class="layui-form-label">菜单名称</label>
		<div class="layui-input-block">
			<input type="text" name="menu_name" placeholder="请输入菜单名称" autocomplete="off" class="layui-input" lay-verify="required" value="<?php echo $info['menu_name']; ?>">
		</div>
	</div>
	<div class="layui-form-item">
		<label class="layui-form-label">图标class</label>
		<div class="layui-input-block">
			<input type="text" name="icon_class" placeholder="请输入图标class" autocomplete="off" class="layui-input"  value="<?php echo $info['icon_class']; ?>">
			
			<small ><a class="form-tips" href="http://www.yeahzan.com/fa/facss.html" target="_blank">(font-awesome图标库)</a></small>
		</div>
	</div>
	<div class="layui-form-item">
		<label class="layui-form-label">URL类型</label>
		<div class="layui-input-block">
			<input type="radio" name="url_type" value="0" title="控制器模式" lay-filter="url_type"
				<?php if(empty($info['url_type']) || (($info['url_type'] instanceof \think\Collection || $info['url_type'] instanceof \think\Paginator ) && $info['url_type']->isEmpty())): ?>checked<?php endif; ?> >
			<input type="radio" name="url_type" value="1" title="路径模式" lay-filter="url_type"
				<?php if($info['url_type'] == '1'): ?>checked<?php endif; ?> >
			<input type="radio" name="url_type" value="2" title="外链模式" lay-filter="url_type"
				<?php if($info['url_type'] == '2'): ?>checked<?php endif; ?> >
		</div>
	</div>
	<group class="url-type url-type-0">
	<div class="layui-form-item">
		<label class="layui-form-label">模块</label>
		<div class="layui-input-block">
			<input type="text" name="module" placeholder="请输入模块" autocomplete="off" class="layui-input" value="<?php echo $info['module']; ?>">
		</div>
	</div>
	<div class="layui-form-item">
		<label class="layui-form-label">控制器</label>
		<div class="layui-input-block">
			<input type="text" name="controller" placeholder="请输入控制器" autocomplete="off" class="layui-input" value="<?php echo $info['controller']; ?>">
		</div>
	</div>
	<div class="layui-form-item">
		<label class="layui-form-label">动作</label>
		<div class="layui-input-block">
			<input type="text" name="action" placeholder="请输入动作" autocomplete="off" class="layui-input"  value="<?php echo $info['action']; ?>">
		</div>
	</div>
	</group>
	<group class="url-type url-type-1 url-type-2">
	<div class="layui-form-item">
		<label class="layui-form-label">URL路径</label>
		<div class="layui-input-block">
			<input type="text" name="url" placeholder="请输入URL路径" autocomplete="off" class="layui-input"  value="<?php echo $info['url']; ?>">
			<small class="form-tips">(站内路径不需要带域名，外链则需要)</small>
		</div>
	</div>
	</group>
	<div class="layui-form-item">
		<label class="layui-form-label">参数</label>
		<div class="layui-input-block">
			<input type="text" name="param" placeholder="请输入参数" autocomplete="off" class="layui-input"  value="<?php echo $info['param']; ?>">
			<small class="form-tips">(字符串格式)</small>
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
			<input type="hidden" name="id" value="<?php echo $info['m_id']; ?>">
			<input type="hidden" name="type" value="<?php echo $type; ?>">
			<button class="layui-btn" lay-submit lay-filter="*">立即提交</button>
			<button type="reset" class="layui-btn layui-btn-primary" id="reset">重置</button>
		</div>
	</div>
</form>
<script>

//依赖于lay 的其他操作
function lay_other_func($,layer,form){

	$('input[name=url_type]').click('showUrlTypeGroup');
		
	form.on('radio(url_type)',function(data){

		$('.url-type').hide();
		$('.url-type-' + data.value).show();
	})

	function showUrlTypeGroup(){

		var url_type = $('input[name=url_type]').val();
		$('.url-type').hide();
		$('.url-type-' + url_type).show();
	}

	showUrlTypeGroup();
}
loadFormScript();
</script>