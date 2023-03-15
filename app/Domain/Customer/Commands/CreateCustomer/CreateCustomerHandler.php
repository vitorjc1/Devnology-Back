<?php

namespace Domain\Customer\Commands\CreateCustomer;

use Domain\Customer\Commands\CreateCustomer\CreateCustomerCommand;
use Domain\Customer\Models\Customer;

final class CreateCustomerHandler
{
    public function __invoke(CreateCustomerCommand $createCustomerCommand)
    {
        $existCustomer = Customer::where('document', $createCustomerCommand->customerDto->document)->first();

        if ($existCustomer) {
            throw new \Exception('Customer already exists');
        }

        $customer = Customer::create([
            'name' => $createCustomerCommand->customerDto->name,
            'document' => $createCustomerCommand->customerDto->document,
            'birth' => $createCustomerCommand->customerDto->birth,
        ]);

        return $customer;
    }
}
