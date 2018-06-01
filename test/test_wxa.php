<?php

include "../vendor/autoload.php";

use jzweb\open\weixin\lib\wxa;


$appid = 'wx5d2eb35c8cf1c873';
$sessionKey = 'vxmazFVPegFrg2qXW5808g==';

$encryptedData = "vjwZs92PoxxjlvNOiudrtUuLQsrHK8d2aYBkWNWifbnABInqqcfHyNh8xMCO0CCE9wbPgsCC5jwqI7dLOEa4yKvlOFl0RpNfE1+2qEbNQWx6mQmmSofYF4YhzTvPI2UNrFiVL+jnanlUnDuTatprlN1xhdqJtDbfnbFJqggXszSWXS0pyAlfv5a0TjdNpxuM7guw7zJyK0PBybmrf3P8+aVZa/f6zs2uvRfOMAWBeAvd4KF7AtR3XAnxu4wwuK4DiNrj/ZhswkBWNfz84tLobtxEATm8YsZiMux5ogMx4YhADhwl1V0Be25uPmAP9qe7ZOnlI6B6agHJ+l1Z+beR3c2PO75GDaPdObEUe1Cf8gbTbH8WxNc5cOEetiu+6wNhGFZ3h/Bu019pbKotxYc3ChxnDTq2e72uJ6s5pyYUqj1fbrePBoSaQL62HqNCs1eGMUdXpElaeI1eyhB5VVODw8C46ewpSpCxgaz/INNXtCJlDafltgTscZFI6qibSYsXgnyRivIgJ3aXIUWlqviF3g==";

$iv = '7slnzbIdR3nKnJKLSfBS1w==';

$data = "";
$errCode = (new wxa())->decryptData($appid, $sessionKey, $encryptedData, $iv, $data);

if ($errCode) {
    print_r($data);
} else {
    print($errCode . "\n");
}


