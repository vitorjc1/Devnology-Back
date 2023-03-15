<?php

namespace App\Core\Http\Controllers;

use Domain\Order\Commands\CreateOrder\CreateOrderCommand;
use Support\CommandBus;

class OrderController extends Controller
{
    private CommandBus $commandBus;

    public function __construct(CommandBus $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    public function Create(CreateOrderCommand $command)
    {
        try {
            $response = $this->commandBus->handle($command);
            return response()->json($response);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 422);
        }
    }
}
