<?php

namespace App\Services;

class CurrencyRepository implements CurrencyRepositoryInterface
{
    private $currencies;

    public function __construct(array $currencies)
    {
        $this->currencies = $currencies;
    }

    public function findAll(): array
    {
        return $this->currencies;
    }

    public function findActive(): array
    {
        $activeCurrencies = [];
        foreach ($this->currencies as $currency) {
            if ($currency->isActive()) {
                array_push($activeCurrencies, $currency);
            }
        }
        return $activeCurrencies;
    }

    public function findById(int $id): ?Currency
    {
        foreach ($this->currencies as $currency) {
            if ($currency->getId() === $id) {
                return $currency;
            }
        }
        return null;
    }

    public function save(Currency $currency): void
    {
        $this->currencies[$currency->getId()] = $currency;
    }

    public function delete(Currency $currency): void
    {
        $index = array_search($currency, $this->currencies);
        array_splice($this->currencies, $index, 1);
    }

}