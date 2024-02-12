<?php

declare(strict_types=1);

namespace Test\Contacts\Domain\Dto;

use Agenda\Contacts\Domain\Dto\UpdateContactDto;
use Agenda\Contacts\Domain\Enum\Dto\ContactsEnum;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class UpdateContactDtoTest extends TestCase
{
    /** @test */
    public function fromArrayShouldWork(): void
    {
        $params = [
            'id'      => 123,
            'name'    => 'John Doe',
            'email'   => 'john.doe@example.com',
            'address' => '123 Main Street',
            'phones'  => ['(34) 3434-3434', '(34) 5656-5656'],
        ];

        $updateContactDto = UpdateContactDto::fromArray($params);
        self::assertSame($params['id'], $updateContactDto->getId());
        self::assertSame($params['name'], $updateContactDto->getName());
        self::assertSame($params['email'], $updateContactDto->getEmail());
        self::assertSame($params['address'], $updateContactDto->getAddress());
    }

    /**
     * @test
     * @dataProvider provideInvalidData
     */
    public function fromArrayShouldFail(array $params, string $expectedException): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage($expectedException);

        UpdateContactDto::fromArray($params);
    }

    public function provideInvalidData(): array
    {
        $defaultParams = [
            'id'      => 123,
            'name'    => 'John Doe',
            'email'   => 'john.doe@example.com',
            'address' => '123 Main Street',
            'phones'  => ['(34) 3434-3434', '(34) 5656-5656'],
        ];

        $substituteValue = static function ($key, $value) use ($defaultParams) {
            return array_merge($defaultParams, [$key => $value]);
        };

        return [
            'fromArrayShouldFailWhenIdIsEmpty'       => [
                $substituteValue('id', ''),
                ContactsEnum::EMPTY_ID->value,
            ],
            'fromArrayShouldFailWhenIdIsNotInteger'  => [
                $substituteValue('id', 'abc'),
                ContactsEnum::INTEGER_ID->value,
            ],
            'fromArrayShouldFailWhenEmailIsEmpty'    => [
                $substituteValue('email', ''),
                ContactsEnum::EMPTY_EMAIL->value,
            ],
            'fromArrayShouldFailWhenEmailIsNotValid' => [
                $substituteValue('email', 'invalidemail'),
                ContactsEnum::INVALID_EMAIL->value,
            ],
            'fromArrayShouldFailWhenAddressIsEmpty'  => [
                $substituteValue('address', ''),
                ContactsEnum::EMPTY_ADDRESS->value,
            ],
        ];
    }
}
