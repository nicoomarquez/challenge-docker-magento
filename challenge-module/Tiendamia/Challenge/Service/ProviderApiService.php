<?php

declare(strict_types=1);

namespace Tiendamia\Challenge\Service;

use GuzzleHttp\Client;
use GuzzleHttp\ClientFactory;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\ResponseFactory;
use Magento\Framework\Webapi\Rest\Request;
use Psr\Log\LoggerInterface as PsrLoggerInterface;
use Tiendamia\Challenge\Helper\Data as HelperData;

class ProviderApiService
{
    /**
     * @param ClientFactory $clientFactory
     * @param ResponseFactory $responseFactory
     */
    public function __construct(
        private ClientFactory   $clientFactory,
        private ResponseFactory $responseFactory,
        private PsrLoggerInterface $logger,
        private HelperData      $helperData
    ) {}

    public function getBestOfferBySku($sku): mixed
    {
        $offersBySku = [
            'sku' => $sku,
            'offers' => [
                [
                    "id" => 1,
                    "price" => 1000.50,
                    "stock" => 1,
                    "shipping_price" => 0.00,
                    "delivery_date" => '2023-05-28',
                    "can_be_refunded" => true,
                    "status" => "new",
                    "guarantee" => true,
                    "seller" => [
                        "name" => "xxxx",
                        "qualification" => 0,
                        "reviews_quantity" => 0,
                    ]
                ],
                [
                    "id" => 3,
                    "price" => 5000,
                    "stock" => 1,
                    "shipping_price" => 0.00,
                    "delivery_date" => '2023-05-27',
                    "can_be_refunded" => true,
                    "status" => "new",
                    "guarantee" => false,
                    "seller" => [
                        "name" => "xxxx",
                        "qualification" => 0,
                        "reviews_quantity" => 0,
                    ]
                ],
                [
                    "id" => 4,
                    "price" => 100000,
                    "stock" => 1,
                    "shipping_price" => 0.00,
                    "delivery_date" => '2023-04-10',
                    "can_be_refunded" => true,
                    "status" => "new",
                    "guarantee" => false,
                    "seller" => [
                        "name" => "xxxx",
                        "qualification" => 0,
                        "reviews_quantity" => 0,
                    ]
                ]
            ]
        ];

        //Filter for offers without stock
        foreach ($offersBySku['offers'] as $key => $offer){
            if ($offer['stock'] == 0) {
                unset($offersBySku['offers'][$key]);
            }
        }

        return $offersBySku;
    }

    /**
     * Fetch some data from API
     */
    public function getBestOfferBySkuWithAPI($sku): void
    {
        $response = $this->doRequest($this->helperData->getProviderOffersEndpoint());
        $status = $response->getStatusCode(); // 200 status code
        if ($status != 200) {
            //$response->getReasonPhrase();
        }
        $responseBody = $response->getBody();
        $responseContent = $responseBody->getContents(); // here you will have the API response in JSON format
        // Add your logic using $responseContent
    }

    /**
     * Do API request with provided params
     *
     * @param string $uriEndpoint
     * @param array $params
     * @param string $requestMethod
     *
     * @return Response
     */
    private function doRequest(
        string $uriEndpoint,
        array  $params = [],
        string $requestMethod = Request::HTTP_METHOD_GET
    ): Response
    {
        /** @var Client $client */
        $client = $this->clientFactory->create(['config' => [
            'base_uri' => $this->helperData->getProviderHost()
        ]]);

        try {
            $response = $client->request(
                $requestMethod,
                $uriEndpoint,
                $params
            );
        } catch (GuzzleException $exception) {
            /** @var Response $response */
            $response = $this->responseFactory->create([
                'status' => $exception->getCode(),
                'reason' => $exception->getMessage()
            ]);
        }

        return $response;
    }
}
