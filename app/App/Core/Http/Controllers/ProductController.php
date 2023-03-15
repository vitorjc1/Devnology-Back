<?php

namespace App\Core\Http\Controllers;

use Domain\Product\Commands\GetProduct\GetProductCommand;
use Domain\Product\Commands\GetProducts\GetProductsCommand;
use Support\CommandBus;

class ProductController extends Controller
{
    private CommandBus $commandBus;

    public function __construct(CommandBus $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    public function GetAll(GetProductsCommand $command)
    {
        $response = $this->commandBus->handle($command);

        return $response;
    }

    public function Get(GetProductCommand $command)
    {
        $response = $this->commandBus->handle($command);

        return response()->json($response);
    }
}
