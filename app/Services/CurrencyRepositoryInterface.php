<?php

namespace App\Services;

interface CurrencyRepositoryInterface
{
    // todo implement

    public function findAll(): array;

    public function findActive(): array;

    public function findById(int $id): ?Currency;

    public function save(Currency $currency): void;

    public function delete(Currency $currency): void;
}