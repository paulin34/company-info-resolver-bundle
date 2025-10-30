<?php

namespace Mount\CompanyInfoResolverBundle\Factory;

use Mount\CompanyInfoResolverBundle\Resolver\ICompanyInfoResolver;
use Mount\CompanyInfoResolverBundle\Resolver\OpenApiResolver;
use JMS\Serializer\SerializerInterface;

class ResolverFactory
{
    private string $openApiBaseUrl;
    private SerializerInterface $serializer;

    public function __construct($openApiBaseUrl, SerializerInterface $serializer)
    {
        $this->openApiBaseUrl = $openApiBaseUrl;
        $this->serializer = $serializer;
    }
    public function getOpenApiResolver($apiKey) : ICompanyInfoResolver
    {
        return new OpenApiResolver($this->openApiBaseUrl, $apiKey, $this->serializer);
    }
}