<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:73:"D:\phpStudy2\WWW\myblog\public/../application/admin\view\index\login.html";i:1487250793;}*/ ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
		<title>登录</title>
		<link rel="stylesheet" href="<?php echo ADMIN_STATIC_URL; ?>plugins/layui/css/layui.css" media="all" />
		<link rel="stylesheet" href="<?php echo ADMIN_STATIC_URL; ?>css/login.css" />
	</head>
	<body class="beg-login-bg">
		<div class="beg-login-box">
			<header>
				<h1>后台登录</h1>
			</header>
			<div class="beg-login-main">
				<form action="login" class="layui-form" method="post">
					<div class="layui-form-item">
						<label class="beg-login-icon">
                        <i class="layui-icon">&#xe612;</i>
                    </label>
						<input type="text" name="username" lay-verify="required" autocomplete="off" placeholder="这里输入登录名" class="layui-input">
					</div>
					<div class="layui-form-item">
						<label class="beg-login-icon">
                        <i class="layui-icon">&#xe642;</i>
                    </label>
						<input type="password" name="password" lay-verify="required" autocomplete="off" placeholder="这里输入密码" class="layui-input">
					</div>
					<div class="layui-form-item">
						<div class="beg-pull-left beg-login-remember">
							<label>记住帐号？</label>
							<input type="checkbox" name="rememberMe" value="true" lay-skin="switch" checked title="记住帐号">
						</div>
						<div class="beg-pull-right">
							<button class="layui-btn layui-btn-primary" lay-submit lay-filter="login">
                            <i class="layui-icon">&#xe650;</i> 登录
                        </button>
						</div>
						<div class="beg-clear"></div>
					</div>
				</form>
			</div>
			<footer>
				<p>lengfeng © </p>
			</footer>
		</div>
		<script type="text/javascript" src="<?php echo ADMIN_STATIC_URL; ?>plugins/layui/layui.js"></script>
		<script type="text/javascript" src="<?php echo COMMON_STATIC_URL; ?>js/common.js"></script>
		<script>
			layui.use(['layer', 'form'], function() {
				var layer = layui.layer,
					$ = layui.jquery,
					form = layui.form();
					delCookie('admin_info');debugger
					var admin_info = getCookie('admin_info');

					if(admin_info){

						admin_info = JSON.parse(admin_info);

						$('input[name=username]').val(admin_info.username);
						$('input[name=password]').val(admin_info.password);

						$('.layui-form').submit();
					}
				
				form.on('submit(login)',function(data){
					
					var field = data.field;
					if(field.rememberMe == 'true'){
						
						var admin_info = {'username':field.username,'password':field.password};
						setCookie('admin_info',JSON.stringify(admin_info),3600*24*7);//七天 
					}else{
						delCookie('admin_info');
					}
					return true;
				});
			});
		</script>
	</body>

</html>