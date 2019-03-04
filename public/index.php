<?php

define('ROOT', dirname(__DIR__));

require ROOT.'/app/App.php';

App::load();

ob_start();

require ROOT.'/pages/shared/login.php';

$content = ob_get_clean();

$menu ='';

require ROOT.'/pages/shared/templates/default.php';