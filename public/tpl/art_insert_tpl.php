<!--添加博文模板-->
<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-10">
        <h3 class="text-center">添加博文</h3>
        <form action="/index.php?act=do_art_insert" method="post">
            <div class="form-group">
                <input type="text" class="form-control"  placeholder="博文标题[必选]" name="title" value="" autofocus>
            </div>

            <div class="form-group" >
            <textarea class="form-control" rows="12"  name="content" id="editor">
            </textarea>
            </div>

            <div class="form-group">
                <input type="number" class="form-control" placeholder="排序[必选]" name="order" value="">
            </div>

            <div class="form-group">
                <select class="form-control" name="cat_id">
                    <option selected>---所属分类[必选]---</option>

                    <?php foreach($catList as $cat):?>

                    <option value="<?php echo $cat['id'];?>" ><?php echo $cat['cat_name']; ?> </option>

                    <?php endforeach; ?>

                </select>
            </div>

            <div class="form-group">
                <select class="form-control" name="recommend">
                    <option selected>---是否推荐[必选]---</option>

                    <option  value="1">推荐</option>
                    <option  value="0">暂不推荐</option>

                </select>
            </div>

            <button type="submit" class="btn btn-info btn-block">添加</button>
        </form>


    </div>
    <div class="col-md-2"></div>
</div>
<div class="row" style="height: 30px;"></div>

