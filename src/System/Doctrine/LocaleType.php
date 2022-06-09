<?php declare(strict_types=1);

namespace System\Doctrine;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\ConversionException;
use Doctrine\DBAL\Types\StringType;
use System\Enum\LocaleEnum;

final class LocaleType extends StringType
{
    public const NAME = 'locale';

    /**
     * {@inheritdoc}
     *
     * @param string|LocaleEnum|null $value
     * @param AbstractPlatform $platform
     *
     * @return LocaleEnum|null
     *
     * @throws ConversionException
     */
    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        if ($value === null || $value === '') {
            return null;
        }

        if ($value instanceof LocaleEnum) {
            return $value;
        }

        try {
            $locale = LocaleEnum::from($value);
        } catch (\Exception) {
            throw ConversionException::conversionFailed($value, static::NAME);
        }

        return $locale;
    }

    /**
     * {@inheritdoc}
     *
     * @param LocaleEnum|string|null $value
     * @param AbstractPlatform $platform
     *
     * @return string|null
     *
     * @throws ConversionException
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        if ($value === null || $value === '') {
            return null;
        }

        if ($value instanceof LocaleEnum) {
            return $value->value;
        }

        throw ConversionException::conversionFailed($value, LocaleType::NAME);
    }

    /**
     * {@inheritdoc}
     *
     * @return string
     */
    public function getName()
    {
        return LocaleType::NAME;
    }

    /**
     * @param AbstractPlatform $platform
     *
     * @return array
     */
    public function getMappedDatabaseTypes(AbstractPlatform $platform)
    {
        return [self::NAME];
    }
}
