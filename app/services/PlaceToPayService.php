<?php

namespace App\Services;

use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PlaceToPayService
{

    public const P2P_APPROVED = 'approved';
    public const P2P_REJECTED = 'rejected';
    public const P2P_PENDING = 'pending';
    public const P2P_IN_PROCESS = 'in_process';
    
  protected $endponitBase;
  protected $login;
  protected $secretKey;

  public function __construct()
  {
    $this->endponitBase = config('services.p2p.endpoint_base');
    $this->login = config('services.p2p.login');
    $this->secretKey = config('services.p2p.secret_key');
  }

  /**
   * The place to pay api is consumed
   *
   * @param Order $order
   * @param Request $request
   * @return void
   */
  public function createRequest(Order $order, Request $request)
  {
    $response = Http::post($this->endponitBase . '/api/session/', [
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
      'returnUrl' => route('orders.show', $order->id),
      'ipAddress' => '127.0.0.1',
      'userAgent' => 'PlacetoPay Sandbox',
    ]);

    return $response->json();
  }

  /**
   * test function to consume place to pay api
   *
   * @return void
   */
  public function createRequestt()
  {
    $response = Http::post($this->endponitBase . '/api/session/', [
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

  /**
   * The requestId information is obtained
   *
   * @param int $requestId
   * @return void
   */
  public function getInformation($requestId)
  {
    $response = Http::post('https://test.placetopay.com/redirection/api/session/' . $requestId, [
      'auth' => $this->getCredentials(),
    ]);

    return $response->json();
  }

  /**
   * the credentials requested by the place to pay api are obtained
   *
   * @return void
   */
  public function getCredentials()
  {
    $login = $this->login;
    $secretKey = $this->secretKey;
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
