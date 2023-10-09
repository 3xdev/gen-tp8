<?php

use think\facade\Route;
use think\facade\Request;

env('app_debug') && trace(Request::method() . ' ' . Request::url(), 'debug');

Route::miss(function () {
    return common_response('资源未找到', 404);
});
