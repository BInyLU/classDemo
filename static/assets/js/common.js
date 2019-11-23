// 创建请求入口
var url = 'https://ebuxsf.coding.io/' 

// 创建加载窗
var AjaxMaskSuccess =
	'<div><div class="AjaxMask" style="position: fixed;top: 0;width: 100%;height: 100vh;background: rgba(255,255,255,.9);z-index: 990;"></div><div class="AjaxMaskBox" style="position: fixed; top: 50%;left: 50%;transform: translate(-50%, -50%);width: 250px;height: 50px;z-index: 999;color:#000;font-size:24px;"><div class="loader"><div class="loader-inner"><div class="loader-line-wrap"><div class="loader-line"></div></div><div class="loader-line-wrap"><div class="loader-line"></div></div><div class="loader-line-wrap"><div class="loader-line"></div></div><div class="loader-line-wrap"><div class="loader-line"></div></div><div class="loader-line-wrap"><div class="loader-line"></div></div></div></div></div></div>'

var AjaxMaskError =
	'<div><div class="AjaxMask" style="position: fixed;top: 0;width: 100%;height: 100vh;background: rgba(0,0,0,1);z-index: 990;"></div><div class="AjaxMaskBox" style="position: fixed; top: 50%;left: 50%;transform: translate(-50%, -50%);width: 250px;height: 50px;z-index: 999;color:#fff;font-size:24px;"><div class="loader"><div class="loader-inner"><div class="loader-line-wrap"><div class="loader-line"></div></div><div class="loader-line-wrap"><div class="loader-line"></div></div><div class="loader-line-wrap"><div class="loader-line"></div></div><div class="loader-line-wrap"><div class="loader-line"></div></div><div class="loader-line-wrap"><div class="loader-line"></div></div></div></div></div></div>'


// Ajax请求出错时
$(document).ajaxError(function(e, xhr, opt) {
	$('.body').append(AjaxMaskError)
	setTimeout(function() {
		window.location.href = '/' + fileNames;
	}, 3000)
});


// Ajax请求前打开loading
$(document).ajaxSend(function(e, xhr, opt) {
	$('.body').append(AjaxMaskSuccess)
});


// Ajax请求完关闭loading
$(document).ajaxSuccess(function(e, xhr, opt) {
	$('.AjaxMask').hide()
	$('.AjaxMaskBox').hide()
});


// 返回顶部
$(window).scroll(function() {
	if ($(this).scrollTop() > 100) {
		$('#goToTop').fadeIn();
	} else {
		$('#goToTop').fadeOut();
	}
});

$('#goToTop').click(function() {
	$('html ,body').animate({
		scrollTop: 0
	}, 300);
});
