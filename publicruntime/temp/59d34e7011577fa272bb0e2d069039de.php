<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:75:"D:\phpStudy2\WWW\myblog\public/../application/admin\view\role\editrule.html";i:1487258089;s:39:"../application/common/layout/index.html";i:1486784064;s:38:"../application/common/view/header.html";i:1486778746;s:38:"../application/common/view/footer.html";i:1486476083;}*/ ?>
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
	.rule-box{
		display: block;
		width: 130px;
		float: left;
		line-height: 25px;
		border: 1px solid #ccc;
		position: relative;
		padding: 10px;
		margin: 10px;
	}
	.rule-box .title{
		text-align: left;
		position: absolute;
		top: -15px;
		background: white;
		width: 80px;
		left: 5px;
		padding-left: 5px;	
	}
	.rule-box .title input[type=checkbox]{
		position: relative;
		top: 2px;
	}
	.clear{
		clear: both;
	}
</style>
<div class="item-main">
	<fieldset class="layui-elem-field">
		<legend>
			<input type="checkbox"  id="all">
			全部选择
		</legend>
		<form action="<?php echo url('editrule'); ?>" method="post" id="dataForm">
		<div class="layui-field-box">
			<?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?>
				<ul class="rule-box">
					<li class="title">
						<input type="checkbox" class="rule-group" title="<?php echo $item['title']; ?>">
						<?php echo $item['title']; ?>
					</li>
					<?php if(is_array($item['children']) || $item['children'] instanceof \think\Collection || $item['children'] instanceof \think\Paginator): $i = 0; $__LIST__ = $item['children'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$rule): $mod = ($i % 2 );++$i;?>
						<li>
							<input type="checkbox" name="rules[<?php echo $rule['id']; ?>]" title="<?php echo $rule['title']; ?>">
							<?php echo $rule['title']; ?>
						</li>
					<?php endforeach; endif; else: echo "" ;endif; ?>
				</ul>
			<?php endforeach; endif; else: echo "" ;endif; ?>
			<div class="clear"></div>
		</div>
		<div class="layui-form-item">
			<div class="layui-input-block">
				<input type="hidden" name="id" value="<?php echo $id; ?>">
				<button class="layui-btn" lay-submit lay-filter="*">立即提交</button>
				<button type="reset" class="layui-btn layui-btn-primary">重置</button>
			</div>
		</div>
		</form>
	</fieldset>
</div>
<script>
	layui.config({
		dir: ADMIN_STATIC_URL + 'plugins/layui/'
	}).use(['jquery'],function(){

		var $ = layui.jquery;

		// 分组全选
		$('.rule-group').click(function(event) {
			var _self = this;
			$(this).parents('ul').find('input[type=checkbox]').each(function(){

				this.checked = _self.checked;
			})

			allIsChecked(); 
		});

		//选中所有
		$('#all').click(function(event) {
			
			var _self = this;
			$('.layui-field-box').find('input[type=checkbox]').each(function(){

				this.checked = _self.checked;
			})	
		});

		$('.layui-field-box input[type=checkbox]').not('.rule-group').click(function(event) {
			
			var flag = true;//标识分组是否全选

			if($(this).parents('ul').find('input[type=checkbox]').not('.rule-group').not('input:checked').size() > 0){

				flag = false;
			}
			//分组选中
			$(this).parents('ul').find('.rule-group').get(0).checked = flag;

			allIsChecked();
		});

		// 判断是否选中全选按钮
		function allIsChecked(){

			if($('.layui-elem-field li input[type=checkbox]').not('.rule-group').not('input:checked').size() == 0){
				
				$('#all').get(0).checked = true;
			}else{

				$('#all').get(0).checked = false;
			}
		}
	});
loadFormScript();
</script>

		
		
	</body>

</html>