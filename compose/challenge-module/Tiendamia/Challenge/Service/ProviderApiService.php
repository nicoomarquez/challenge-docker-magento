<?php

declare(strict_types=1);

namespace Tiendamia\Challenge\Service;

use GuzzleHttp\Client;
use GuzzleHttp\ClientFactory;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\ResponseFactory;
use Magento\Framework\Webapi\Rest\Request;
use Tiendamia\Challenge\Helper\Data as HelperData;

class ProviderApiService
{
    /**
     * @param ClientFactory $clientFactory
     * @param ResponseFactory $responseFactory
     * @param HelperData $helperData
     */
    public function __construct(
        private ClientFactory   $clientFactory,
        private ResponseFactory $responseFactory,
        private HelperData      $helperData
    ) {
    }

    /**
     * Fetch data from API
     *
     * @param string $sku
     *
     * @return mixed
     * @throws \Exception
     */
    public function getBestOfferBySku($sku)
    {
        $response = $this->doRequest(str_replace(':sku', $sku, $this->helperData->getProviderOffersEndpoint()));
        $status = $response->getStatusCode();
        if ($status != 200) {
            throw new \Exception($response->getReasonPhrase());
        }
        $responseBody = $response->getBody();
        $offersBySku = json_decode($responseBody->getContents(), true);

        //Filter for offers without stock
        foreach ($offersBySku['offers'] as $key => $offer) {
            if ($offer['stock'] == 0) {
                unset($offersBySku['offers'][$key]);
            }
        }

        return $offersBySku;
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
    ): Response {
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
