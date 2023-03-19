<?php

namespace Domain\Order\Commands\CreateOrder;

use Domain\Address\Dtos\AddressDto;
use Domain\Customer\Dtos\CustomerDto;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Log;

class CreateOrderCommand extends FormRequest
{
    public CustomerDto $customer;
    public AddressDto $address;
    public array $items;
    public string $payment_method;

    public function __construct()
    {
        $this->customer = new CustomerDto();
        $this->address = new AddressDto();
        $this->payment_method = '';
        $this->items = [];
    }

    public function rules(): array
    {
        return [
            'customer' => 'required',
            'customer.name' => 'required|string',
            'customer.document' => 'required|string',
            'customer.birth' => 'required|date',
            'address' => 'required',
            'address.zip_code' => 'required|string',
            'address.street' => 'required|string',
            'address.number' => 'required|string',
            'address.complement' => 'nullable|string',
            'address.district' => 'required|string',
            'address.city' => 'required|string',
            'payment_method' => 'required|string',
            'items' => 'required|array',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.supplier_id' => 'required|integer',
            'items.*.external_id' => 'required|integer',
        ];
    }

    protected function failedValidation($validator)
    {
        throw new HttpResponseException(response()->json(['errors' => $validator->errors()], 422));
    }

    protected function passedValidation()
    {
        $this->customer->name = $this->validated()['customer']['name'];
        $this->customer->document = $this->validated()['customer']['document'];
        $this->customer->birth = $this->validated()['customer']['birth'];
        $this->items = $this->validated()['items'];

        $this->address->zip_code = $this->validated()['address']['zip_code'];
        $this->address->street = $this->validated()['address']['street'];
        $this->address->number = $this->validated()['address']['number'];
        $this->address->complement = $this->validated()['address']['complement'];
        $this->address->district = $this->validated()['address']['district'];
        $this->address->city = $this->validated()['address']['city'];

        $this->payment_method = $this->validated()['payment_method'];
    }
}
