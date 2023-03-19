<?php

namespace Domain\Address\Commands\CreateAddress;

use Domain\Address\Dtos\AddressDto;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class CreateAddressCommand extends FormRequest
{
    public AddressDto $addressDto;

    public function __construct(AddressDto $addressDto)
    {
        $this->addressDto = $addressDto;
    }

    public function rules(): array
    {
        return [
            'zip_code' => 'required|string',
            'street' => 'required|string',
            'number' => 'required|string',
            'complement' => 'nullable|string',
            'district' => 'required|string',
            'city' => 'required|string',
            'state' => 'required|string',
        ];
    }

    protected function failedValidation($validator)
    {
        throw new HttpResponseException(response()->json(['errors' => $validator->errors()], 422));
    }

    protected function passedValidation()
    {
        $this->address->zip_code = $this->validated()['zip_code'];
        $this->address->street = $this->validated()['street'];
        $this->address->number = $this->validated()['number'];
        $this->address->complement = $this->validated()['complement'];
        $this->address->district = $this->validated()['district'];
        $this->address->city = $this->validated()['city'];
    }
}
