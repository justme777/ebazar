<?php
header('Content-type: text/plain; charset=utf-8');
//phpinfo();
require_once dirname(__FILE__).'/include/DbHandler.php';

$mng = new DbHandler();

//$arr =$mng->getAddresses();
//var_dump($arr);
//echo $mng->createUser("ereke_enu@mail.ru","12345");
//$user = $mng->getUserByPassword("ereke_enu@mail.ru","12345");
//var_dump($user);
//$mng->createClassifier("Контакты Торгого места");
/*echo $mng->createClassifierValue("Телефон",2);
echo $mng->createClassifierValue("Веб-сайт",2);
echo $mng->createClassifierValue("Электронная почта",2);

$arr =$mng->getMarketTypes();
var_dump($arr);
*/
?>