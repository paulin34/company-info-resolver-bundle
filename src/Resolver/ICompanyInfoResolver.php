<?php

namespace Mount\CompanyInfoResolverBundle\Resolver;
use Mount\CompanyInfoResolverBundle\DTO\OpenApiDTO;

interface ICompanyInfoResolver
{
    public function resolveInfoBasedOnCUI(string $cui) : OpenApiDTO ; 
}