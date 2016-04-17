<?php
//tao ra cac link trong client
function client_url($url = '')
{
    return base_url('site/'.$url);
}