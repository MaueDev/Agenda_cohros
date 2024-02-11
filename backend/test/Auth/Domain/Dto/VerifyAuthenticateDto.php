<?php

declare(strict_types=1);

namespace Test\Auth\Domain\Dto;

use Agenda\Auth\Domain\Dto\VerifyAuthenticateDto;
use Agenda\Auth\Domain\Enum\Dto\AuthEnum;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class VerifyAuthenticateDtoTest extends TestCase
{
    /** @test */
    public function fromHeaderShouldWork(): void
    {
        $header = 'Bearer token123';

        $verifyAuthenticateDto = VerifyAuthenticateDto::fromHeader($header);
        self::assertSame($header, $verifyAuthenticateDto->getHeader());
    }

    /**
     * @test
     * @dataProvider fromHeaderDataProvidersErrors
     */
    public function fromHeaderShouldFail(string $header, string $expectedException): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage($expectedException);

        VerifyAuthenticateDto::fromHeader($header);
    }

    public function fromHeaderDataProvidersErrors(): array
    {
        return [
            'fromHeaderShouldFailWhenHeaderIsEmpty' => [
                '',
                AuthEnum::EMPTY_HEADER->value,
            ],
        ];
    }
}
