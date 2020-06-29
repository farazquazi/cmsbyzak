
For example a file name is order.htm and has url with one parameter like below 

url = /order/:record_id?

<?php 


$fileName = 'order.htm';
$params = [
    'record_id' => 25,
];
$this->controller->pageUrl($fileName, $params);
// and it will generate <DOMAIN_NAME>/order/25 