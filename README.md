## 集成开放平台四大模块

- 移动应用
- 网站应用
- 公众号
- 公众号第三方平台


## 安装jzweb/open-weixin
```
composer require jzweb/open-weixin
```


# jzweb/open-weixin  

*  网站应用 微信用户登录SDK 使用示例
```
<?php
use jzweb\open\weixin\website\wxLogin;

/**
 * 测试微信登录-网站应用
 *
 * @user 刘松森 <liusongsen@gmail.com>
 * @date 2017/3/3
 */

$app_id = "APPID";
$secret = "SECRET";
$wxLogin = new wxLogin($app_id, $secret);

//构造获取code的url
$redirect_url = urlencode("http://***.**.**/wx.php");
$url = $wxLogin->getCodeUrl($redirect_url);
echo $url;
//获取微用户登录二维码
$redirect_url = urlencode("http://***.**.**/wx.php");
$data = $wxLogin->getQrCode($redirect_url);
print_r($data);
//通过code获取access_token
$code = "sdfsdf";
$data = $wxLogin->getAccessToken($code);
print_r($data);
//获取用户信息
$access_token = "sdfsdf";
$data = $wxLogin->getUser($access_token);
print_r($data);
```

------

# 问题（git 提交vendor目录至项目）

* 如果当前开发的项目中包含vender目录，安装后提交代码，发现版本库中并没有jzweb/sdk的代码文件
* 出现这种情况后，马上去服务器查看，发现也没有，是什么问题？
* 仔细查阅了一些文档，发现是因为该安装包包含.git的缘故，于是可这样操作
* 1.vendor目录已经存在

    ```
    如果已经执行了composer update/install，需要先删除vendor目录 执行：rm -rf vendor
    git add -A
    git commit -m "remove vendor"
    composer update --prefer-dist
    git add . -A 
    git commit -m "recover vendor"
    ```
* 2.vendor目录不存在
    
    ```
    composer update --prefer-dist
    git add . -A 
    git commit -m "recover vendor"
    ```
* Notice: composer update --prefer-dist 优先从缓存取，不携带组件内的.git目录。
* 对于稳定版本 compose默认采用--prefer-dist模式安装
* --optimize-autoloader (-o): 转换 PSR-0/4 autoloading 到 classmap 可以获得更快的加载支持。特别是在生产环境下建议这么做，但由于运行需要一些时间，因此并没有作为默认值。


