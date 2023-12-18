<?php

return [
    // 加密算法
    'algo'        => env('JWT_ALGO', 'HS256'),
    'secret'      => env('JWT_SECRET'),
    // Time To Live(单位秒，默认半小时)
    'ttl'         => env('JWT_TTL', 3600),
    // Refresh Time To Live(单位分，默认14天)
    'refresh_ttl' => env('JWT_REFRESH_TTL', 20160),
    // Token获取方式，靠前优先
    'token_mode'    => ['header', 'param'],
    // 黑名单宽限期(秒)
    'blacklist_grace_period' => env('BLACKLIST_GRACE_PERIOD', 10),
    'blacklist_storage' => thans\jwt\provider\storage\Tp6::class,
];
