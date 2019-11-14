var loc = location.href;
var n1 = loc.length; //地址的总长度
var n2 = loc.indexOf("="); //取得=号的位置
var id = decodeURI(loc.substr(n2 + 1, n1 - n2)); //从=号后面的内容


$(function ($) {


	$.get('/admin/api/category.php', function (data) {

		// // 渲染分类
		// var html = $('#category_tmpl').render({
		// 	commens: data.category
		// });
		// $('#category-list').html(html);

		// // 渲染热门
		// var html = $('#hot_posts_tmpl').render({
		// 	commens: data.hot_post
		// });
		// $('#hot_posts').html(html);

		$.views.converters({
			updateDate: function (val) {
				return val.substr(0, 10)
			}
		})

		// 渲染文章
		$.get('/admin/api/post-detail.php', {
			id: id
		}, function (res) {
			var html = $('#posts_detail').render({
				commens: res.post_word
			});
			$('#postdetail').html(html);
			var html = $('#post_comments').render({
				commens: res.post_comments
			});
			$('#post_C').html(html);
		});

	});

	// 写评论 把数据传给后端 后端再返回前端渲染
	$('#submit').on('click', function () {
		var nickname = $('#nickname').val();
		var content = $('#content').val();
		var d = new Date();
		var vYear = d.getFullYear()
		var vMon = d.getMonth() + 1
		var vDay = d.getDate();
		var h = d.getHours();
		var m = d.getMinutes();
		var se = d.getSeconds();
		currenttime = vYear + "-" + (vMon < 10 ? "0" + vMon : vMon) + "-" + (vDay < 10 ? "0" + vDay : vDay) + " " + (h <
			10 ? "0" + h : h) + ":" + (m < 10 ? "0" + m : m) + ":" + (se < 10 ? "0" + se : se);
		if (!nickname) {
			alert('请完整填写内容');
		} else if (!content) {
			alert('请完整填写内容');
		} else {
			// 传给后端保存
			$.post('/admin/api/post-comment.php', {
				id: id,
				nickname: nickname,
				content: content,
				time: currenttime
			}, function (data) {
				if (data > 0) {
					// 返回前端
					$.get('/admin/api/post-detail.php', {
						id: id
					}, function (res) {
						alert('评论成功！等待审核~');
						var html = $('#post_comments').render({
							commens: res.post_comments
						});
						$('#post_C').html(html);
					});
				} else {
					alert('评论失败');
				}
			});
		}
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