<!--编辑分类模板-->
<div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-4">
        <h3 class="text-center">编辑用户</h3>
        <form action="/index.php?act=do_user_edit&id=<?php echo $userCurrent[0]['id'];?>" method="post">
            <div class="form-group">

                <input type="text" class="form-control"  placeholder="用户名" name="username" value="<?php echo $userCurrent[0]['username']; ?>">
            </div>
            <div class="form-group">
                <input type="password"  class="form-control" placeholder="新密码" name="password" value="">
            </div>

            <div class="form-group">
                <input type="email"  class="form-control" placeholder="邮箱" name="email" value="<?php echo $userCurrent[0]['email']; ?>">
            </div>

            <button type="submit" class="btn btn-info btn-block">保存</button>
        </form>
    </div>
    <div class="col-md-4"></div>
</div>
<div class="row" style="height: 30px;"></div>