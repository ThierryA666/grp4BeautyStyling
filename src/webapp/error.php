<?php
declare(strict_types=1);

namespace beautyStyling\webapp;

require_once '../../vendor/autoload.php';

//called when server error
$display = 'd-none';
$show = false;
if (isset($_SERVER['HTTP_REFERER'])) {
    $display = '';
    $show = true;
    $url = $_SERVER['HTTP_REFERER'];
}

include '../view/verror.php';
?>