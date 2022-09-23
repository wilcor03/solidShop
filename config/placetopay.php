<?php
return [
	'login' => env('PTP_LOGIN'), // Provided by PlacetoPay
    'tranKey' => env('PTP_TRANKEY'), // Provided by PlacetoPay
    'url' => env('PTP_BASE_URL'),
    'timeout' => 15, // (optional) 15 by default
];