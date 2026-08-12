<?php

require_once 'config/config.php';
require_once '../vendor/autoload.php';
require_once 'helpers/url_helper.php';
require_once 'helpers/session_helper.php';

/**
 * Exception handler.
 *
 * @param mixed $exception Exception
 *
 * @return void
 */
function myExceptionHandler($exception)
{
    echo "Uncaught exception: <p>" . $exception->getMessage() . "</p><pre>" . $exception->getTraceAsString(), "</pre>";
}
set_exception_handler('myExceptionHandler');

/**
 * Print
 *
 * @param mixed $content Stuff to print
 *
 * @return void
 */
function prePrint($content)
{
    echo "<pre>" . print_r($content, 1) . "</pre>";
}
