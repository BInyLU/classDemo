$(function ($) {
	$(document).ajaxStart(function () {
		NProgress.start();
	}).ajaxStop(function () {
		NProgress.done();
	});

	$.get('/admin/api/category.php', function (data) {

		// 渲染分类
		var html = $('#category_tmpl').render({
			commens: data.category
		});
		$('#category-list').html(html);

		// 渲染热门
		var html = $('#hot_posts_tmpl').render({
			commens: data.hot_post
		});
		$('#hot_posts').html(html);

		$.views.converters({
			updateDate: function (val) {
				return val.substr(0, 10)
			}
		})

		// 渲染文章
		var html = $('#posts_detail_tmpl').render({
			commens: data.posts_detail
		});
		$('#posts_detail').html(html);
		
	});

	$('#goToTop').hide(); //隐藏go to top按钮

	$(window).scroll(function () {
		if ($(this).scrollTop() > 100) {
			$('#goToTop').fadeIn();
		} else {
			$('#goToTop').fadeOut();
		}
	});

	$('#goToTop a').click(function () {
		$('html ,body').animate({
			scrollTop: 0
		}, 300);
		return false;
	});



})