<?php

declare(strict_types=1);

namespace Test\Contacts\Domain\Dto;

use Agenda\Contacts\Domain\Dto\DeleteContactDto;
use Agenda\Contacts\Domain\Enum\Dto\ContactsEnum;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class DeleteContactDtoTest extends TestCase
{
    /** @test */
    public function fromArrayShouldWork(): void
    {
        $params = [
            'id' => 123,
        ];

        $deleteContactDto = DeleteContactDto::fromArray($params);
        self::assertSame($params['id'], $deleteContactDto->getId());
    }

    /**
     * @test
     * @dataProvider fromArrayDataProvidersErrors
     */
    public function fromArrayShouldFail(array $params, string $expectedException): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage($expectedException);

        DeleteContactDto::fromArray($params);
    }

    public static function fromArrayDataProvidersErrors(): array
    {
        $defaultParams = [
            'id' => 1,
        ];

        $substituteValue = static function ($key, $value) use ($defaultParams) {
            return array_merge($defaultParams, [$key => $value]);
        };

        return [
            'fromArrayShouldFailWhenIdIsEmpty'      => [
                $substituteValue('id', ''),
                ContactsEnum::EMPTY_ID->value,
            ],
            'fromArrayShouldFailWhenIdIsNotInteger' => [
                $substituteValue('id', 'abc'),
                ContactsEnum::INTEGER_ID->value,
            ],
        ];
    }
}
