<?php

namespace Domain\Customer\Dtos;

use Spatie\LaravelData\Data;

class CustomerDto extends Data
{
    public string $name;
    public string $document;
    public string $birth;
}
