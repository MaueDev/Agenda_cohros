<?php

declare(strict_types=1);

namespace Agenda\Contacts\Domain\Traits;

trait PhoneHelper
{
    public static function formatPhone(string $phone): string
    {
        // Remove parênteses e espaços em branco
        $phone = str_replace(['(', ')', ' '], '', $phone);
        return $phone;
    }

    public static function unformatPhone(string $phone): string
    {
        // Adiciona parênteses e espaços em branco
        return preg_replace('/(\d{2})(\d{4,5})(\d{4})/', '($1) $2-$3', $phone);
    }
}
