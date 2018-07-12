<?php

namespace App\Services;


class CurrencyGenerator
{
    public static function generate(): array
    {
        return [
            new Currency(
                1,
                'Bitcoin',
                'BTC',
                6428.96,
                new \DateTime('2018-07-11'),
                true
            ),
            new Currency(
                2,
                'Ethereum',
                'ETH',
                445.12,
                new \DateTime('2018-07-11'),
                true
            ),
            new Currency(
                3,
                'Litecoin',
                'LTC',
                78.84,
                new \DateTime('2018-07-11'),
                true
            ),
            new Currency(
                4,
                'Dash',
                'DASH',
                220.26,
                new \DateTime('2018-07-11'),
                false
            ),
            new Currency(
                5,
                'Mixin',
                'XIN',
                469.62,
                new \DateTime('2018-07-11'),
                false
            ),
            new Currency(
                6,
                'Paypex',
                'PAYX',
                1.35,
                new \DateTime('2018-07-11'),
                true
            ),
            new Currency(
                7,
                'Enigma',
                'ENG',
                1.24,
                new \DateTime('2018-07-11'),
                false
            ),
        ];
    }
}