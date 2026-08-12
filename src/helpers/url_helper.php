<?php

/**
 * Redirect page
 *
 * @param string $page Page
 *
 * @return void
 */
function redirect(string $page)
{
    header('location: ' . URLROOT . '/' . $page);
}
