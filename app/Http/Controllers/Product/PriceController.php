<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use http\Exception\InvalidArgumentException;

class PriceController extends Controller implements \Stringable
{
    public array $currencies = [
        'RUB' => '₽'
    ];

    public function __construct(
        private readonly int $value,
        private readonly string $currency = 'RUB',
        private readonly float $precision = 100
    )
    {
        if($this->value < 0){
            throw new InvalidArgumentException('Price must be more than 0.');
        }
        if (!isset($this->currencies[$this->currency])){
            throw new InvalidArgumentException('Currency not found.');
        }
    }

    public function value(): int | float
    {
        return $this->value;
    }

    public function totalPrice(): int | float
    {
        return $this->value / $this->precision;
    }


    public function currency(): string
    {
        return $this->currency();
    }

    public function symbol(): string
    {
        return $this->currencies[$this->currency()];
    }

    public function __toString(): string
    {
        return number_format($this->value(), 0, ',', ' ') . ' ' . $this->symbol();
    }
}
