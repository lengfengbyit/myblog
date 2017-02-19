layui.config({
	base: ADMIN_STATIC_URL + 'plugins/layui/modules/'
}).use(['icheck', 'laypage','layer'], function() {
	
	var $ = layui.jquery,
		laypage = layui.laypage,
		layer = parent.layer === undefined ? layui.layer : parent.layer;
	/*$('input').iCheck({
		checkboxClass: 'icheckbox_flat-green'
	});*/

	//加载表单页面
	$('.form').on('click', function() {
		var url = this.dataset.url;
		var title = this.dataset.title;
		$.get(url, null, function(form) {
			layer.open({
				type: 1,
				title: title,
				content: form,
				// btn: ['保存', '取消'],
				area: ['600px', '400px'],
				maxmin: true,
				full: function(elem) { //最大化
					var win = window.top === window.self ? window : parent.window;
					$(win).on('resize', function() {
						var $this = $(this);
						elem.width($this.width()).height($this.height()).css({
							top: 0,
							left: 0
						});
						elem.children('div.layui-layer-content').height($this.height() - 95);
					});
				}
			});
		});
	});


	//删除数据
	$('.del').on('click',function(){

		var url = this.dataset.url;
		layer.confirm('是否确定删除？', {
		  btn: ['确定', '取消'],
		}, function(index, layero){ //确定
			
			layer.close(index);

			$.get(url, function(data) {
				
				if(typeof data == 'string'){
					data = JSON.parse(data);
				}
				layer.msg(data.msg);

				//删除成功，刷新页面
				if(data.error == 0){

					location.reload(true);
				}
			});
		}, function(index){ //取消
		  	
		  	layer.close(index);
		});
	})

	//删除选中数据
	$('#delSelect').on('click',function(){
		$('#delSelectForm').submit();
	})

	$('.site-table tbody tr').on('click', function(event) {
		var $this = $(this);
		var $input = $this.children('td').eq(0).find('input');
		$input.on('ifChecked', function(e) {
			$this.css('background-color', '#EEEEEE');
		});
		$input.on('ifUnchecked', function(e) {
			$this.removeAttr('style');
		});
		$input.iCheck('toggle');
	}).find('input').each(function() {
		var $this = $(this);
		$this.on('ifChecked', function(e) {
			$this.parents('tr').css('background-color', '#EEEEEE');
		});
		$this.on('ifUnchecked', function(e) {
			$this.parents('tr').removeAttr('style');
		});
	});
	$('#selected-all').on('ifChanged', function(event) {
		var $input = $('.site-table tbody tr td').find('input');
		$input.iCheck(event.currentTarget.checked ? 'check' : 'uncheck');
	});


});

/**
 * 加载 form.js 兼容不在iframe中打开页面
 * @return {[type]} [description]
 */
function loadFormScript(){
		
	if(document.getElementById('formScript')){

		var el = document.getElementById('formScript');
		el.parentNode.removeChild(el);
	}
	var eleScript = document.createElement('script');
	eleScript.type = 'text/javascript';
	eleScript.src = ADMIN_STATIC_URL +  "js/form.js";
	eleScript.id = 'formScript';

	var head = document.getElementsByTagName('head')[0];
	if(head){
		head.appendChild(eleScript);
	}else{

		document.getElementsByTagName('form')[0].appendChild(eleScript);
	}
}