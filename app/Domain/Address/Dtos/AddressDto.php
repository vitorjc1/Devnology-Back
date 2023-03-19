<?php

namespace Domain\Address\Dtos;

use Spatie\LaravelData\Data;

class AddressDto extends Data
{
    public string $zip_code;
    public string $street;
    public string $number;
    public string | null $complement;
    public string $district;
    public string $city;
}
