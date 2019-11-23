$('#searchBtn').click(function() {
	
	// 封装去除空格功能 使用正则表达式
	function trim(str){
		return str.replace(/(^\s*)|(\s*$)/g, "");
	}
	
	// 取得值
	var parm = $("#search").val()
	
	// 对值进行去除空格 重新赋值
	var parmStr = trim(parm)
	
	// 如果去除空格后值还是为空 直接显示不能为空
	if(parmStr == ''){
		$('#searchRes').html('<h3>不能为空</h3>');
		return
	}
	
	// 正常值 开始请求后端
	$.get( url + 'admin/api/search.php?keywords=' + parmStr, function (data) {
		
		// 如果从后端拿到的值只有0 表明为搜索不到
		if(data == '0'){
			$('#searchRes').html('<h3>搜索不到相关信息</h3>');
			return
		}
		// 渲染搜索结果
		var html = $('#searchRestep').render({
			search: data
		});
		$('#searchRes').html(html);
		
	});
})