<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if ( ! function_exists('item_index'))
{
    function item_index($step, $current_page)
    {
        return $current_page * $step - $step;
    }
}