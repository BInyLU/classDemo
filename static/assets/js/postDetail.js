// 得到 id
var loc = location.href;
var n1 = loc.length; //地址的总长度
var n2 = loc.indexOf("="); //取得=号的位置
var id = decodeURI(loc.substr(n2 + 1, n1 - n2)); //从=号后面的内容


$(function($) {

	// 传递 id , 得到数据后 , 渲染指定文章
	$.get(url + 'admin/api/post-detail.php', {
		id: id
	}, function(res) {

		// 转换时间格式
		$.views.converters({
			updateDate: function(val) {
				return val.substr(0, 10)
			}
		})

		// 渲染文章内容
		var html = $('#posts_detail').render({
			commens: res.post_word
		});
		$('#postdetail').html(html);

		// 修复评论数
		var commentsNum = Object.keys(res.post_comments).length;
		$('.page-header p').append("<span class='commNum'>评论数:" + commentsNum + "</span>");

		// 渲染评论内容
		var html = $('#post_comments').render({
			commens: res.post_comments
		});
		$('#post_C').html(html);
		
		// 打开评论编辑器
		$('.commenBtn').click(function(){
			$('.post-comments').fadeIn()
			$('.commenMask').fadeIn()
		})
		$('.commenBtnclose').click(function(){
			$('.post-comments').hide()
			$('.commenMask').hide()
		})
		$('.commenBtnpost').click(function(){
			$('.post-comments').hide()
			$('.commenMask').hide()
		})
		
		// 点击对应评论展开内容
		var combody = document.querySelectorAll('.comments-body')
		var combtn = document.querySelectorAll('.comments-btn')
		var comBtnLen = combody.length
		for (var i = 0; i < comBtnLen; i++) {
			combody[i].index = i
			combtn[i].index = i
			combody[i].addEventListener('click', function() {
				combody[this.index].classList.add("commentsActive")
				combtn[this.index].style.display = 'block'
				combtn[this.index].addEventListener('click', function() {
					combody[this.index].classList.remove("commentsActive")
					combtn[this.index].style.display = 'none'
				},false)
			},false)
		}
		

	});


	// 写评论 把数据传给后端 后端再返回前端渲染
	$('#submit').on('click', function() {
		var nickname = $('#nickname').val();
		// var content = $('#content').val();
		var content = $('.post-comments textarea').val()
		// alert(content)
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
			$.post(url + 'admin/api/post-comment.php', {
				id: id,
				nickname: nickname,
				content: content,
				time: currenttime
			}, function(data) {
				if (data > 0) {
					// 前端重新渲染
					$.get(url + 'admin/api/post-detail.php', {
						id: id
					}, function(res) {
						// 刷新评论数
						var commentsNum = Object.keys(res.post_comments).length;
						$('.commNum').html("评论数:" + commentsNum);

						// 清空评论框
						// nickname.value = ''
						// content.value = ''

						// alert('评论成功！等待审核~');
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





})
