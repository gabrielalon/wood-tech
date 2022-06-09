<?php declare(strict_types=1);

namespace Components\Contents\Domain\Enum;

enum SnippetTypeEnum: string
{
    case COMPANY_NAME = 'company.name';
    case COMPANY_ADDRESS_LINE_1 = 'company.address_line.1';
    case COMPANY_ADDRESS_LINE_2 = 'company.address_line.2';
    case COMPANY_ZIP_CODE = 'company.zip_code';
    case COMPANY_CITY = 'company.city';
    case COMPANY_COUNTRY = 'company.country';
    case COMPANY_NIP = 'company.nip';
    case COMPANY_PHONE = 'company.phone';
    case COMPANY_EMAIL = 'company.email';
}
