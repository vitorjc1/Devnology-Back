<?php

namespace Domain\Customer\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customers';

    private const NAME = 'name';
    private const DOCUMENT = 'document';
    private const BIRTH = 'birth';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        self::NAME,
        self::DOCUMENT,
        self::BIRTH,
    ];

}
