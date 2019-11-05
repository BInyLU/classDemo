<!--分类管理首页-->
<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-10">

        <table class="table table-hover table-bordered text-center">
            <caption class="h3 text-center">分类管理</caption>
            <thead>
            <tr class="info">
                <td class="text-center">ID</td>
                <th class="text-center">分类名称</th>
                <th class="text-center">排序</th>
                <th class="text-center">创建时间</th>
                <th class="text-center">最后更新时间</th>
                <th class="text-center">操作</th>
            </tr>
            </thead>

            <tbody>
            <?php foreach($catList as $cat): ?>
            <tr>
                <td><?php echo $cat['id']; ?></td>
                <td class="text-left"><?php echo $cat['cat_name']; ?></td>
                <td><?php echo $cat['order']; ?></td>
                <td><?php ini_set('date.timezone','Asia/Shanghai'); echo date('Y/m/d H:i:s',$cat['create_time']); ?></td>
                <td><?php ini_set('date.timezone','Asia/Shanghai'); echo date('Y/m/d H:i:s',$cat['update_time']); ?></td>
                <td class="text-center">
                    <a href="/index.php?act=cat_edit&id=<?php echo $cat['id']; ?>" class="btn btn-info btn-xs">编辑</a>
                    <a href="" onclick="isDel(<?php echo $cat['id'];?>);return false;" class="btn btn-danger btn-xs">删除</a>
                </td>
            </tr>
            <?php endforeach; ?>

            </tbody>
        </table>
        <a href="/index.php?act=cat_insert" class="btn btn-success" style="float: right">添加分类</a>
    </div>
    <div class="col-md-2"></div>
</div>



<!--为删除操作添加脚本-->
<script>
    function isDel(id) {
        if (confirm('确定要删除吗?')){
            window.location.href='/index.php?act=do_cat_delete&id='+id;
        } else {
            location.href = '/index.php?act=cat_manage';  //放弃则回到分类管理首页
        }
}
</script>
<p></p> <!--纯粹为增加底外边距,没有其它用处-->