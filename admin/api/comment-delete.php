<?php 
require_once '../../functions.php';
//根据客户端传递过来的ID删除对应数据
//
if (empty($_GET['id'])) {
	exit(json_encode(array(
	  'success' => false,
	  'message' => '缺少必要参数'
	)));
}
$id=$_GET['id'];

$rows=SqlOperation('delete from comments where id in (' . $id . ');');

header('Content-Type: application/json');
// header('Location: /admin/comments.php');
// if ($rows>0) {
// 	# code...
// }
echo json_encode($rows>0);


