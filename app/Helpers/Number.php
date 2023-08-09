<?php

namespace App\Helpers;

use Illuminate\Support\Str;

class Number
{
    private float $number;

    public function __construct(float $number)
    {
        $this->number = $number;
    }

    public function get(): float
    {
        return $this->number;
    }

    public function getInt(): int
    {
        return (int)$this->number;
    }

    public function readable(): string
    {
        return $this->doReadable($this->number);
    }

    public static function doReadable($number): string
    {
        $output = '';
        $digits = explode('.', $number);

        $digits[0] = Str::reverse(implode(',', str_split(Str::reverse($digits[0]), 3)));
        $output = $digits[0];

        if (isset($digits[1])) {
            if ($digits[1] != 0) {
                $digits[1] = Str::reverse(implode(',', str_split(Str::reverse($digits[1]), 3)));
                $output .= "." . $digits[1];
            }
        }

        return $output;
    }
}
