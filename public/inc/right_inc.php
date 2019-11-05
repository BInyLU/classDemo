<!--全部左边列表,显示10条推荐信息-->
<div class="col-md-4" id="right" style="display: none;">
    <div class="list-group">
        <?php
        $counter = 1; //设置计数器初始值
        foreach ($artListAll as $key => $art) {
            if ($counter <= 10) { //使用计数器做为循环终止条件

                /**
                 * 第一条应该设置为激活状态,用class='active'控制
                 * 根据当前记录的索引键名判断记录顺序,来动态设置active的状态
                 * 注意三元运算符的用法,用它可大大简化代码
                 */
                ($key == 0) ? ($active = 'active') : ($active = '') ;
                echo '<a href="'.$art['title_url'].'" class="list-group-item '.$active.'">';
                echo mb_substr($art['title'],0,20,'utf-8');
                echo '<span class="badge">'.$counter.'</span></a>';
            } else {
                break;  //显示了10条信息后提前结束循环
            }
            $counter++; //计数器累计,更新循环条件,否则会输出全部记录
        }
        ?>
    </div>
</div>