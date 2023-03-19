<?php

namespace Domain\Address\Commands\CreateAddress;

use Domain\Address\Models\Address;

class CreateAddressHandler
{
    public function __invoke(CreateAddressCommand $command)
    {
        $address = Address::create([
            'zip_code' => $command->addressDto->zip_code,
            'street' => $command->addressDto->street,
            'number' => $command->addressDto->number,
            'complement' => $command->addressDto->complement,
            'district' => $command->addressDto->district,
            'city' => $command->addressDto->city,
        ]);

        return $address;
    }
}
