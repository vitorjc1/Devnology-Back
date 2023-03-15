<?php

namespace Domain\Product\Commands\GetProduct;


use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class GetProductCommand extends FormRequest
{
    public int $external_id;
    public int $supplier_id;

    public function __construct()
    {
        $this->external_id = 0;
        $this->supplier_id = 0;
    }

    public function rules(): array
    {
        return [
            'external_id' => 'required|integer',
            'supplier_id' => 'required|integer',
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge(['external_id' => $this->route('external_id'), 'supplier_id' => $this->route('supplier_id')]);
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json(['errors' => $validator->errors()], 422));
    }

    protected function passedValidation()
    {
        $this->external_id = $this->validated()['external_id'];
        $this->supplier_id = $this->validated()['supplier_id'];
    }
}
