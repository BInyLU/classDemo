<!--加载全局配置文件-->
<?php include 'controller/config.php'; ?>
<!--加载公共头部-->
<?php include 'view/inc/header_inc.php'; ?>
<!--加载当前页面模板-->
<?php auto_load_tpl($tplName);  ?>
<!--加载公共底部-->
<?php include 'view/inc/footer_inc.php' ?>