

<?php 
  
require_once '../../functions.php';

// 定义参数
$keywords = $_GET["keywords"];

// $result = FineAll("SELECT * FROM posts WHERE title like '%$keyword%' ORDER BY ID DESC");

$result=FineAll("select posts.*,t1.count from posts left outer join ( select post_id ,count(*) as count from comments group by post_id ) t1 on t1.post_id = posts.id where title like '%$keywords%' order by id desc");

//设置响应体类型
header('Content-Type: application/json');

// 假如搜索结果为空 返回给json一个0 ，不为空则正常输出
if(empty($result)){
	echo (json_encode('0'));
}else{
	$json=json_encode($result);
	echo $json;
}

