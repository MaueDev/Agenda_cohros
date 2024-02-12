<?php

declare(strict_types=1);

namespace Test\Contacts\Domain\Dto;

use Agenda\Contacts\Domain\Dto\GetContactsDto;
use Agenda\Contacts\Domain\Enum\Dto\ContactsEnum;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class GetContactsDtoTest extends TestCase
{
    /** @test */
    public function fromHeaderShouldWork(): void
    {
        $header = 'Bearer token123';

        $getContactsDto = GetContactsDto::fromHeader($header);
        self::assertSame($header, $getContactsDto->getHeader());
    }

    /**
     * @test
     * @dataProvider fromHeaderDataProvidersErrors
     */
    public function fromHeaderShouldFail(string $header, string $expectedException): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage($expectedException);

        GetContactsDto::fromHeader($header);
    }

    public function fromHeaderDataProvidersErrors(): array
    {
        return [
            'fromHeaderShouldFailWhenHeaderIsEmpty' => [
                '',
                ContactsEnum::EMPTY_AUTH_HEADER->value,
            ],
        ];
    }
}
