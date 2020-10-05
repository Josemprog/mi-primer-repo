<?php

namespace App\Services;

use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PlaceToPayService
{

  public function createRequest(Order $order, Request $request)
  {
    $response = Http::post('https://test.placetopay.com/redirection/api/session/', [
      'auth' => $this->getCredentials(),
      'payment' => [
        'reference' => $order->id,
        'description' => $request->textArea,
        'amount' => [
          'currency' => 'COP',
          'total' => $order->total,
        ],
      ],
      'expiration' => date('c', strtotime('1 hour')),
      'returnUrl' => 'http://localhost:3000/products',
      'ipAddress' => '127.0.0.1',
      'userAgent' => 'PlacetoPay Sandbox',
    ]);

    return $response->json();
  }

  public function createRequestt()
  {
    $response = Http::post('https://test.placetopay.com/redirection/api/session/', [
      'auth' => $this->getCredentials(),
      'payment' => [
        'reference' => '2020sep080704',
        'description' => 'Pago básico de prueba',
        'amount' => [
          'currency' => 'COP',
          'total' => 45000,
        ],
      ],
      'expiration' => date('c', strtotime('1 hour')),
      'returnUrl' => 'http://localhost:3000/',
      'ipAddress' => '127.0.0.1',
      'userAgent' => 'PlacetoPay Sandbox',
    ]);

    return $response->json();
  }


  public function getInformation($requestId)
  {
    $response = Http::post('https://test.placetopay.com/redirection/api/session/' . $requestId, [
      'auth' => $this->getCredentials(),
    ]);

    return $response->json();
  }


  public function getCredentials()
  {
    $login = '6dd490faf9cb87a9862245da41170ff2';

    $secretKey = '024h1IlD';

    $seed = date('c');

    if (function_exists('random_bytes')) {
      $nonce = bin2hex(random_bytes(16));
    } elseif (function_exists('openssl_random_pseudo_bytes')) {
      $nonce = bin2hex(openssl_random_pseudo_bytes(16));
    } else {
      $nonce = mt_rand();
    }

    $nonceBase64 = base64_encode($nonce);

    $tranKey = base64_encode(sha1($nonce . $seed . $secretKey, true));

    return [
      'login' => $login,
      'seed' => $seed,
      'nonce' => $nonceBase64,
      'tranKey' => $tranKey,
    ];
  }
}
