## 项目配置修改：

1、修改数据库配置文件：\config.php

```php
// 我们项目中用到的配置信息,在这里需要配置我们对应数据库的信息，如数据库名字，密码和用户名，需要跟自己本地的对应

// 数据库主机
define('DB_HOST', 'localhost');

// 数据库用户名
define('DB_USER', 'root');

// 数据库密码
define('DB_PASS', 'root');

// 数据库名字
define('DB_NAME', 'classdemo');
```

2、修改公共配置脚本：\static\assets\js\common.js

```js
var fileNames = 'classDemo'
var localtionNames = 'localhost:8080'
```

## 项目结构：

```
├─admin  //后台
│  │
│  │
│  ├─api //所有后端接口，返回前端Json数据
│  │      avator.php //
│  │      category.php
│  │      comment-delete.php
│  │      comments.php
│  │      comment-status.php
│  │      post-category.php
│  │      post-comment.php
│  │      post-detail.php
│  │      search.php
│  │      upload.php
│  │      
│  ├─inc
│  │      navbar.php
│  │      sidebar.php
│  │
│  │categories.php
│  │category-delete.php
│  │comments.php
│  │index.php
│  │login.php
│  │password-reset.php
│  │post-add.php
│  │post-delete.php
│  │posts.php
│  │profile.php
│  │register.php
│  │settings.php
│  │user-delete.php
│  │users.php
│  │
│  │
├─article
│  ├─category
│  │      category.html
│  │      
│  ├─detail
│  │      post-detail.html
│  │
│   index.html
│  │
│  │
├─sql
│   classDemo.sql
│  │
├─static
│  ├─assets
│  │    ├─css
│  │    ├─fonts
│  │    ├─img
│  │    ├─js
│  │    ├─vendors
│  │
│  │
│  ├─uploads
│  │      1.png  //各种从后端上传的图片
│  
│  config.php
│  favicon.ico
│  functions.php
│  index.html
```

