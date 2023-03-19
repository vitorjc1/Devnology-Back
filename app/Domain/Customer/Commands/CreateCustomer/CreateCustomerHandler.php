<?php

namespace Domain\Customer\Commands\CreateCustomer;

use Domain\Customer\Commands\CreateCustomer\CreateCustomerCommand;
use Domain\Customer\Models\Customer;

final class CreateCustomerHandler
{
    public function __invoke(CreateCustomerCommand $command)
    {
        $customer = Customer::create([
            'name' => $command->customerDto->name,
            'document' => $command->customerDto->document,
            'birth' => $command->customerDto->birth,
        ]);

        return $customer;
    }
}
