<?php

namespace Domain\Order\Commands\CreateOrder;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class CreateOrderCommand extends FormRequest
{
    public int $customer_id;
    public array $items;

    public function __construct()
    {
        $this->customer_id = 0;
        $this->items = [];
    }

    public function rules(): array
    {
        return [
            'customer_id' => 'required|integer',
            'items' => 'required|array',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.supplier_id' => 'required|integer',
            'items.*.id' => 'required|integer',
        ];
    }

    protected function failedValidation($validator)
    {
        throw new HttpResponseException(response()->json(['errors' => $validator->errors()], 422));
    }

    protected function passedValidation()
    {
        $this->customer_id = $this->validated()['customer_id'];
        $this->items = $this->validated()['items'];
    }
}
