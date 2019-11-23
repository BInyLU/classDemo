<?php 
  
require_once '../../functions.php';

header('Content-Type: application/json');

if (empty($_GET['id'])) {
	exit(json_encode(array(
	  'success' => false,
	  'message' => '缺少必要参数'
	)));
}

$id=$_GET['id'];

$rows=SqlOperation("update posts set views=views+1  where id={$id};");

$post_word=FineOne("SELECT * FROM posts where id={$id};");

$post_comments=FineAll("SELECT * FROM comments where post_id={$id} and status='approved' ORDER BY created desc;");

$json=json_encode(array(
   'post_word' => $post_word ,
   'post_comments' => $post_comments
));
//设置响应体类型
header('Content-Type: application/json');
echo $json;





