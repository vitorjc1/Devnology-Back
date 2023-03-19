<?php

namespace Domain\Customer\Commands\CreateCustomer;

use Domain\Customer\Dtos\CustomerDto;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

final class CreateCustomerCommand extends FormRequest
{
    public CustomerDto $customerDto;

    public function __construct(CustomerDto $customerDto)
    {
        $this->customerDto = $customerDto;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'document' => 'required|string',
            'birth' => 'required|string',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json(['errors' => $validator->errors()], 422));
    }

    protected function passedValidation()
    {
        $this->customerDto->name = $this->validated()['name'];
        $this->customerDto->document = $this->validated()['document'];
        $this->customerDto->birth = $this->validated()['birth'];
    }
}
