<?php
include "../vendor/autoload.php";

use \jzweb\open\weixin\lib\qrcode;


/**
 * 测试临时素材上传
 *
 * @user 刘松森 <liusongsen@gmail.com>
 * @date 2017/3/30
 */

$access_token="YcWRLzW4peXbg7ed9jdZcDl34FPEG9-MmFgw7MzRwe2pCtx5rO0PBE4niv7UkREZAYFf81-QzPY74hjyYy1SWG3Uji8D0ZImnZeyTt9VsIfKuXgWgA3QHFOEqzwLE-yMXFSaAMDTBO";

$qrcode = new qrcode();
$result=$qrcode->createQrScane($access_token,1,3600*24);
var_dump($result);

$result=$qrcode->createQrLimitScane($access_token,2);
var_dump($result);