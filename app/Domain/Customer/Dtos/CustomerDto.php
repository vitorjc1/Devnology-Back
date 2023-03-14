<?php

namespace Domain\Customer\Dtos;

use Spatie\LaravelData\Data;

class CustomerDto extends Data
{
    public string $nome;
    public string $documento;
    public string $nascimento;
}
