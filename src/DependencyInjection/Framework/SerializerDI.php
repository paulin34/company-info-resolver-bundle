<?php

namespace App\DependencyInjection\Framework;


use JMS\Serializer\DeserializationContext;
use JMS\Serializer\SerializationContext;
use JMS\Serializer\SerializerInterface;

trait SerializerDI
{
    protected SerializerInterface $serializer;

    /**
     * @required
     */
    public function setSerializer(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    public function serializeJson($object, array $groups = [], bool $serializeNull = false): string
    {
        $ctx = SerializationContext::create()->setSerializeNull($serializeNull);
        if (!empty($groups)) {
            $ctx->setGroups($groups);
        }

        return $this->serializer->serialize($object, 'json', $ctx);
    }

    public function deserializeFromString(string $data, string $type, array $groups = [])
    {
        $ctx = empty($groups) ? null : DeserializationContext::create()->setGroups($groups);
        return $this->serializer->deserialize($data, $type, 'json', $ctx);
    }

    
}