<?php

return [
    // 加密算法
    'algo'        => env('jwt.algo', 'HS256'),
    'secret'      => env('jwt.secret'),
    // Time To Live(单位秒，默认半小时)
    'ttl'         => env('jwt.ttl', 1800),
    // Refresh Time To Live(单位分，默认14天)
    'refresh_ttl' => env('jwt.refresh_ttl', 20160),
    // Token获取方式，靠前优先
    'token_mode'    => ['header', 'param'],
    // 黑名单宽限期(秒)
    'blacklist_grace_period' => env('jwt.blacklist_grace_period', 10),
    'blacklist_storage' => thans\jwt\provider\storage\Tp6::class,
];
