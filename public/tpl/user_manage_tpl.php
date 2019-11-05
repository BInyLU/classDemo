<!--分类管理首页-->
<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-10">

        <table class="table table-hover table-bordered text-center">
            <caption class="h3 text-center">用户管理</caption>
            <thead>
            <tr class="info">
                <td class="text-center">ID</td>
                <th class="text-center">用户名称</th>
                <th class="text-center">用户邮箱</th>
                <th class="text-center">最后更新时间</th>
                <th class="text-center">操作</th>
            </tr>
            </thead>

            <tbody>
            <?php foreach($userList as $user): ?>
            <tr>
                <td><?php echo $user['id']; ?></td>
                <td class="text-left"><?php echo $user['username']; ?></td>
                <td><?php echo $user['email']; ?></td>
                <td><?php ini_set('date.timezone','Asia/Shanghai'); echo date('Y/m/d H:i:s',$user['update_time']); ?></td>
                <td class="text-center">
                    <a href="/index.php?act=user_edit&id=<?php echo $user['id']; ?>" class="btn btn-info btn-xs">编辑</a>

                </td>
            </tr>
            <?php endforeach; ?>

            </tbody>
        </table>
    </div>
    <div class="col-md-2"></div>
</div>



<!--为删除操作添加脚本-->
<script>
    function isDel(id) {
        if (confirm('确定要删除吗?')){
            window.location.href='/index.php?act=do_cat_delete&id='+id;
        } else {
            location.href = '/index.php?cat=cat_manage';  //放弃则回到分类管理首页
        }
}
</script>
<p></p> <!--纯粹为增加底外边距,没有其它用处-->