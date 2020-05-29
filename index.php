<?php
    include_once("config.php");
    include_once("controller/controller.php");
    include_once("model/db.php");
    include_once("model/dao_mkn.php");
    include_once("model/mkn.php");

    $controller = new page_controller();
    $controller -> invoke();
?>