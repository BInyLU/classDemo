$(function ($) {
	
	$.get( url + 'admin/api/category.php', function (data) {
		
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
		
		// 转换时间格式
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





})