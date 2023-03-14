<?php

namespace App\Core\Http\Controllers;

use Domain\Customer\Commands\CreateCustomer\CreateCustomerCommand;
use Support\CommandBus;

class CustomerController extends Controller
{
    private CommandBus $commandBus;

    public function __construct(CommandBus $commandBus)
    {
        $this->commandBus = $commandBus;
    }

   public function Create(CreateCustomerCommand $command)
   {
         $this->commandBus->handle($command);
   }
}
