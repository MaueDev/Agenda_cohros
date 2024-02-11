<?php

declare(strict_types=1);

namespace Test\Auth\Domain\Dto;

use Agenda\Auth\Domain\Dto\AuthenticationDto;
use Agenda\Auth\Domain\Enum\Dto\AuthEnum;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class AuthenticationDtoTest extends TestCase
{
    /** @test */
    public function fromArrayShouldWork(): void
    {
        $params = [
            'username' => 'test',
            'password' => '123',
        ];

        $authenticationDto = AuthenticationDto::fromArray($params);
        self::assertSame($params['username'], $authenticationDto->getUsername());
        self::assertSame($params['password'], $authenticationDto->getPassword());
    }

    /**
     * @test
     * @dataProvider fromArrayDataProvidersErrors
     */
    public function fromArrayShouldFail(array $params, string $expectedException): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage($expectedException);

        AuthenticationDto::fromArray($params);
    }

    public static function fromArrayDataProvidersErrors(): array
    {
        $defaultParams = [
            'username' => 'user123',
            'password' => 'password123',
        ];

        $substituteValue = static function ($key, $value) use ($defaultParams) {
            return array_merge($defaultParams, [$key => $value]);
        };
        return [
            'fromArrayShouldFailWhenUsernameIsEmpty'     => [
                $substituteValue('username', ''),
                AuthEnum::EMPTY_USERNAME->value,
            ],
            'fromArrayShouldFailWhenPasswordIsEmpty'     => [
                $substituteValue('password', ''),
                AuthEnum::EMPTY_PASSWORD->value,
            ],
            'fromArrayShouldFailWhenUsernameIsNotString' => [
                $substituteValue('username', 123),
                AuthEnum::STRING_USERNAME->value,
            ],
            'fromArrayShouldFailWhenPasswordIsNotString' => [
                $substituteValue('password', 123),
                AuthEnum::STRING_PASSWORD->value,
            ],
        ];
    }
}
