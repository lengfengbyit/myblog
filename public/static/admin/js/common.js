/** common.js By Beginner Emain:zheng_jinfan@126.com HomePage:http://www.zhengjinfan.cn */
layui.define(['layer'], function(exports) {
	"use strict";

	var $ = layui.jquery,
		layer = layui.layer;

	var common = {
		/**
		 * 抛出一个异常错误信息
		 * @param {String} msg
		 */
		throwError: function(msg) {
			throw new Error(msg);
			return;
		},
		/**
		 * 弹出一个错误提示
		 * @param {String} msg
		 */
		msgError: function(msg) {
			layer.msg(msg, {
				icon: 5
			});
			return;
		}
	};

	exports('common', common);
});

//加载form.js
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