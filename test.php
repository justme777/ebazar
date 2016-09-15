<?php

require_once dirname(__FILE__).'/include/DbHandler.php';

$mng = new DbHandler();
//$mng->createCity("test",1);
$mng->getCities();

?>