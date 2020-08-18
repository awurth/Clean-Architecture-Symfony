<?php

namespace App\Infrastructure\Persistence\Doctrine\Type;

use App\Domain\Id;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\ConversionException;
use Doctrine\DBAL\Types\GuidType;
use Exception;

abstract class UuidType extends GuidType
{
    public function convertToDatabaseValue($value, AbstractPlatform $platform): ?string
    {
        if ($value === null || $value === '') {
            return null;
        }

        if ($value instanceof Id) {
            return $value->toString();
        }

        throw ConversionException::conversionFailed($value, $this->getName());
    }

    public function convertToPHPValue($value, AbstractPlatform $platform): ?Id
    {
        if ($value === null || $value === '') {
            return null;
        }

        if ($value instanceof Id) {
            return $value;
        }

        try {
            return ($this->getClass())::fromString($value);
        } catch (Exception $e) {
            throw ConversionException::conversionFailed($value, $this->getName());
        }
    }

    public function getName(): string
    {
        return $this->getTypeName();
    }

    public function requiresSQLCommentHint(AbstractPlatform $platform): bool
    {
        return true;
    }

    abstract protected function getClass(): string;

    abstract protected function getTypeName(): string;
}
