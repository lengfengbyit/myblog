/**
 * 公用js
 * 
 */

/**
 * [setCookie description]
 * @param {[type]} name   [description]
 * @param {[type]} value  [description]
 * @param {[type]} second [过期时间 秒]
 */
function setCookie(name,value,second)
{
	var exp = new Date();
	exp.setTime(exp.getTime() + second*1);
	document.cookie = name + "="+ escape (value) + ";expires=" + exp.toGMTString();
}

function getCookie(name)
{
	var arr,reg=new RegExp("(^| )"+name+"=([^;]*)(;|$)");
	if(arr=document.cookie.match(reg))
	return unescape(arr[2]);
	else
	return null;
}

function delCookie(name)
{
	var exp = new Date();
	exp.setTime(exp.getTime() - 1);
	var cval=getCookie(name);
	if(cval!=null)
	document.cookie= name + "="+cval+";expires="+exp.toGMTString();
}