<?php

namespace Domain\Customer\Commands\CreateCustomer;

use Domain\Customer\Dtos\CustomerDto;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

final class CreateCustomerCommand extends FormRequest
{
    public CustomerDto $customerDto;

    public function __construct()
    {
        $this->customerDto = new CustomerDto();
    }

    public function rules(): array
    {
        return [
            'nome' => 'required|string',
            'documento' => 'required|string',
            'nascimento' => 'required|string',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json(['errors' => $validator->errors()], 422));
    }

    protected function passedValidation()
    {
        $this->customerDto->nome = $this->validated()['nome'];
        $this->customerDto->documento = $this->validated()['documento'];
        $this->customerDto->nascimento = $this->validated()['nascimento'];
    }
}
