$(function($) {
 	var loc = location.href;
 	var n1 = loc.length; //地址的总长度
 	var n2 = loc.indexOf("="); //取得=号的位置
 	var id = decodeURI(loc.substr(n2 + 1, n1 - n2)); //从=号后面的内容


 	$.get(url + 'admin/api/category.php', function(data) {

 		// 渲染分类
 		var html = $('#category_tmpl').render({
 			commens: data.category
 		});
 		$('#category-list').html(html);

 		//  根据要查询的分类id参数传入后端进行返回该分类id的文章
 		$.get(url + 'admin/api/post-category.php', {
 			id: id
 		}, function(res) {
			// 转换时间格式
 			$.views.converters({
 				updateDate: function(val) {
 					return val.substr(0, 10)
 				}
 			})
 			var html = $('#posts_detail_tmpl').render({
 				commens: res
 			});
 			$('#posts_detail').html(html);
 		})
 	});






 })
