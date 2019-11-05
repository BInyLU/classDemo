<!--添加分类模板-->

<div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-4">
        <h3 class="text-center">添加分类</h3>
        <form action="/index.php?act=do_cat_insert" method="post">
            <div class="form-group">

                <input type="text" class="form-control"  placeholder="分类名称" name="cat_name" value="">
            </div>
            <div class="form-group">
                <input type="number" class="form-control" placeholder="排序" name="order" value="">
            </div>


            <button type="submit" class="btn btn-info btn-block">添加</button>
        </form>


    </div>
    <div class="col-md-4"></div>
</div>
<div class="row" style="height: 30px;"></div>