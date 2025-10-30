<?php

namespace Mount\CompanyInfoResolverBundle\DTO;
use JMS\Serializer\Annotation as Serializer;

class OpenApiDTO
{
    /**
     * @Serializer\SerializedName("cif")
     * @Serializer\Type("integer")
     */
    public ?int $unique_registration_code = null;

    /**
     * @Serializer\SerializedName("denumire")
     * @Serializer\Type("string")
     */
    public ?string $company_name = null;
    /**
     * @Serializer\SerializedName("adresa")
     * @Serializer\Type("string")
     */
    public ?string $address = null;

    /**
     * @Serializer\SerializedName("numar_reg_com")
     * @Serializer\Type("string")
     */
    public ?string $reg_com = null;

    /**
     * @Serializer\SerializedName("telefon")
     * @Serializer\Type("string")
     */
    public ?string $phone_number = null;
    /**
     * @Serializer\SerializedName("judet")
     * @Serializer\Type("string")
     */
    public ?string $county = null;

    /**
     * @Serializer\SerializedName("radiata")
     * @Serializer\Type("boolean")
     */
    private ?bool $company_closed = null;
}