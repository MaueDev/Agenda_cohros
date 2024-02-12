<?php

declare(strict_types=1);

namespace Test\Contacts\Domain\Dto;

use Agenda\Contacts\Domain\Dto\SaveContactsDto;
use Agenda\Contacts\Domain\Enum\Dto\ContactsEnum;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class SaveContactsDtoTest extends TestCase
{
    /** @test */
    public function fromArrayShouldWork(): void
    {
        $params = [
            'name' => 'John Doe',
            'email' => 'john.doe@example.com',
            'address' => '123 Main Street',
            'phones' => ['(34) 3434-3434', '(34) 5656-5656'],
            'authorizationHeader' => 'Bearer token'
        ];

        $saveContactsDto = SaveContactsDto::fromArray($params);
        self::assertSame($params['name'], $saveContactsDto->getName());
        self::assertSame($params['email'], $saveContactsDto->getEmail());
        self::assertSame($params['address'], $saveContactsDto->getAddress());
        self::assertSame($params['authorizationHeader'], $saveContactsDto->getAuthorizationHeader());
    }

    /**
     * @test
     * @dataProvider fromArrayDataProvidersErrors
     */
    public function fromArrayShouldFail(array $params, string $expectedException): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage($expectedException);

        SaveContactsDto::fromArray($params);
    }

    public static function fromArrayDataProvidersErrors(): array
    {
        $defaultParams = [
            'name' => 'John Doe',
            'email' => 'john.doe@example.com',
            'address' => '123 Main Street',
            'phones' => ['(34) 3434-3434', '(34) 5656-5656'],
            'authorizationHeader' => 'Bearer token'
        ];

        $substituteValue = static function ($key, $value) use ($defaultParams) {
            return array_merge($defaultParams, [$key => $value]);
        };

        return [
            'fromArrayShouldFailWhenAuthorizationHeaderIsEmpty' => [
                $substituteValue('authorizationHeader', ''),
                ContactsEnum::EMPTY_AUTH_HEADER->value,
            ],
            'fromArrayShouldFailWhenAuthorizationHeaderIsNotString' => [
                $substituteValue('authorizationHeader', null),
                ContactsEnum::EMPTY_AUTH_HEADER->value,
            ],
            'fromArrayShouldFailWhenEmailIsEmpty' => [
                $substituteValue('email', ''),
                ContactsEnum::EMPTY_EMAIL->value,
            ],
            'fromArrayShouldFailWhenEmailIsNotValid' => [
                $substituteValue('email', 'invalidemail'),
                ContactsEnum::INVALID_EMAIL->value,
            ],
            'fromArrayShouldFailWhenAddressIsEmpty' => [
                $substituteValue('address', ''),
                ContactsEnum::EMPTY_ADDRESS->value,
            ],
        ];
    }
}
