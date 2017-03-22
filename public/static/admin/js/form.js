layui.use(['jquery','form'], function(){

	var $ = layui.jquery,
	layer = layui.layer,
	form = layui.form(),
	formSubmitFlag = false;
	form.render();//手动渲染

	//监听提交
	form.on('submit(*)', function(data){

		if(formSubmitFlag){
			return false;
		}
		formSubmitFlag = true;
		    
		var url = $('#dataForm').attr('action');

		$.post(url, data.field, function(data, textStatus, xhr) {
			formSubmitFlag = false;
			if(typeof data == 'string'){

				data = JSON.parse(data);
			}

			layer.msg(data.msg);

			if(!data.error){

				layer.closeAll('page');
				
				//刷新iframe
				if($('iframe')[0]){

					$('#refreshPage').trigger('click');
				}else{

					window.location.reload();
				}
				
			}
		});

		return false;
	});
	
	

	if(typeof lay_other_func == 'function'){

		lay_other_func($,layer,form);
	}

	$('input[type=file]').on('change',function(){

		//检查浏览器是否支持fileReader对象
		if(typeof FileReader == 'undefined'){

			layer.msg('浏览器版本太低不能上传图片'); return;
		}
		
		var _self = this;
		var reader = new FileReader();
		reader.readAsDataURL(this.files[0]);
		reader.onload = function(e){
			
			$(_self).next().val(e.target.result);
		}
	})
	

});
