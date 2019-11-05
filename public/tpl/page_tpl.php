<?php
//如果当前url没有get参数或者第一个get参数键名为page,肯定是首页
if (count($_GET)==0 || (array_keys($_GET)) [0] =='page') {
    $prefix = '?';
} else {

    $prefix = '?'.key($_GET).'='.current($_GET).'&';

    /**
     * 第一种方法:使用array_filter()函数过滤掉GET参数中多余部分
     * 如果不是首页的话,必须从url中将page参数过滤掉,否则会在多次翻页时出现page参数累加现象
     * 先获取当前GET中的所有键名,并组成新数组,该数组的键名就是我们要处理目标,里面肯定有page参数
     *
     */

//    $getKeyArr = array_keys($_GET);
//    $filter = 'page';  //设置要过滤掉的get键名
    //从当前查询字符串中,过滤掉键名等于'page'的元素,注意回调中use关键字调用外部变量的方法
//    $queryArr = array_filter($getKeyArr, function ($key) use ($filter){
//       return $key != $filter;  //仅返回键名不是page的参数
//    },0);

    /**
     * $queryArr[0]为GET数组第一个键名,目前是cat,用在后台中,会自动变成act，
     * GET中,从第二参数起,分隔符为&,要格外注意哟~~
     *
    //获取当前的操作名称,例如cat表示前台,act表示后台操作
//    $opt = $getKeyArr[0];

//    $prefix = '?'.$queryArr[0].'='.$_GET[$opt].'&';


    /**
     * 第二种方法: 最简洁,强烈推荐
     * key()取当前数组元素的键名,current()取当前数组元素的值,默认从数组第一元素开始
     * 当前$_GET数组,第一个元素必然是cat=?所以可以使用这二个函数来取值
     * 最终拼接的新查询字符串的前缀是: ?cat=n& 这样的格式
     */

}
?>

<div class="row">
    <div class="col-md-10">

        <nav aria-label="Page navigation" style="text-align: center;">
            <ul class="pagination">

                <li>
                    <a href="
                    <?php
                    //前一页的处理:如果当前页已是首页,则前一页默认必须是第一页
                        $page = ($pageCurrent-1)<=1 ? 1 : ($pageCurrent-1);
                        echo $prefix.'page='. $pageCurrent;
                    ?>
                    " aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
                <?php
                //求出总页数: ceil()向是舍入函数,总页数第于记录总数除以每页显示数量
                $total = ceil($count / $num);

                //生成分页的取范围,并保存在数组$pageRange中
                $pageRange = range(1,$total);

                //遍历生成分页条
                foreach ($pageRange as $pageNum) {
                    //设置当页被激活页的显示状态,其实就是设置类样式active的值,默认为空串
                    $active = ($pageNum == $pageCurrent) ? 'active' : '';

                    //循环显示出当前分页条
                    echo '<li class="'.$active.'"><a href="'.$prefix.'page='.$pageNum.'">'.$pageNum.'</a></li>';

                }
                ?>


                <li>
                    <a href="
                    <?php
                    //尾页处理:如果当前页已是最后一页,如果再翻页必须是分页总数,不能越界。
                        $page = ($pageCurrent+1) >= $total ? $total : ($pageCurrent+1);
                        echo $prefix.'page='. $pageCurrent;
                    ?>
                    " aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>

    </div>

</div>