<?php

namespace Mount\CompanyInfoResolverBundle\Resolver;

use JMS\Serializer\SerializerInterface;
use Mount\CompanyInfoResolverBundle\DTO\OpenApiDTO;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Mount\CompanyInfoResolverBundle\Exceptions\OpenApiException;

class OpenApiResolver implements ICompanyInfoResolver
{
    private SerializerInterface $serializer;
    private ?string $baseUrl;
    private ?string $apiKey;

    private ?Client $client = null;

    public function __construct($baseUrl, $apiKey, $serializer)
    {
        $this->baseUrl = $baseUrl;
        $this->apiKey = $apiKey;
        $this->serializer = $serializer;
    }

     /**
     * @throws OpenApiException
     */
    public function resolveInfoBasedOnCUI(string $cui) : OpenApiDTO
    {
         try {
            $endpoint = $this->baseUrl . '/api/companies/' . $cui;
            $response = $this->getClient()->get($endpoint);
            if ($response->getStatusCode() !== 200) {
                throw new OpenApiException('The server does not find the necessary data. Please check the entered CUI/CIF and/or fill in the data manually.');
            }

        } catch (GuzzleException $ex) {
            throw new OpenApiException($ex->getMessage());
        }

        /** @var OpenApiDTO $data */
        $data = $this->serializer->deserialize($response->getBody()->getContents(), OpenApiDTO::class , 'json');

        return $data;
    }

    /**
     * @throws OpenApiException
     */
    private function getClient(): Client
    {
        if (!($this->baseUrl && $this->apiKey)) {
            throw new OpenApiException('Invalid service configuration.');
        }

        if (!$this->client) {
            $this->client = $this->createClient();
        }

        return $this->client;
    }

    /**
     * @return Client
     */
    private function createClient(): Client
    {
        $options = [
            'timeout' => 25.0,
            'headers' => [
                'x-api-key'    => $this->apiKey,
                'Content-Type' => 'application/json',
            ]
        ];
        return new Client($options);
    }

}