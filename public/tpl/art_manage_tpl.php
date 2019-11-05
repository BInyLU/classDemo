<div class="row">
    <div class="col-md-12">

        <table class="table table-hover table-bordered text-center">
            <caption class="h3 text-center">博文管理</caption>
            <thead>
            <tr class="info">
                <td class="text-center">ID</td>
                <th class="text-center">博文标题</th>
                <th class="text-center">排序</th>
                <th class="text-center">所属分类</th>
                <th class="text-center">发布时间</th>
                <th class="text-center">更新时间</th>
                <th class="text-center">操作</th>
            </tr>
            </thead>

            <tbody>
            <?php foreach($artList as $art): ?>
            <tr>
                <td><?php echo $art['id']; ?></td>
                <td class="text-left"><?php echo mb_substr($art['title'],0,25,'utf-8'); ?></td>
                <td><?php echo $art['order']; ?></td>

                <!--根据当前的分类id来确定分类的名称,注意替代语法,消灭大括号-->
                <?php foreach($catList as $cat): ?>
                    <?php if ($art['cat_id'] == $cat['id']) : ?>
                      <td><?php echo $cat['cat_name']; ?></td>
                    <?php endif; ?>
                <?php endforeach; ?>
								<?  ?>

                <td><?php ini_set('date.timezone','Asia/Shanghai'); echo date('Y/m/d H:i:s',$art['create_time']); ?></td>
                <td><?php ini_set('date.timezone','Asia/Shanghai'); echo date('Y/m/d H:i:s',$art['update_time']); ?></td>
                <td class="text-center">
                    <a href="/index.php?act=art_edit&id=<?php echo $art['id']; ?>" class="btn btn-info btn-xs">编辑</a>
                    <a href="" onclick="isDel(<?php echo $art['id'];?>);return false;" class="btn btn-danger btn-xs">删除</a>
                </td>
            </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        <a href="/index.php?act=art_insert" class="btn btn-success" style="float: right">添加博文</a>
    </div>
</div>

<!--分页类模板调度-->
<?php
//获取当前页数
//如果get存在page参数则将当前页设置为get值,否则设置为1,即默认为第1页
$pageCurrent = isset($_GET['page'])?$_GET['page']:1;
//加载首页的分页模板
include 'public/tpl/page_tpl.php';
?>

<!--为删除操作添加脚本-->
<script>
    function isDel(id) {
        if (confirm('确定要删除吗?')){
            window.location.href='/index.php?act=do_art_delete&id='+id;
        } else {
            location.href = '/index.php?act=art_manage';
        }
    }
</script>






<p></p> <!--纯粹为增加底外边距,没有其它用处-->