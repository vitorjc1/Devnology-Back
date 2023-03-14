<?php

namespace Domain\Customer\Commands\CreateCustomer;

use App\Models\Customer;

final class CreateCustomerHandler
{
    public function __invoke(CreateCustomerCommand $createCustomerCommand)
    {
        dd('funfou');
        // $customer = Customer::create([
        //     'nome' => $createCustomerCommand->customerDto->nome,
        //     'documento' => $createCustomerCommand->customerDto->documento,
        //     'nascimento' => $createCustomerCommand->customerDto->nascimento,
        // ]);

        // return $customer;
    }
}
