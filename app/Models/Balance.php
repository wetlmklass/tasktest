<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class Balance extends Model
{
    use HasFactory;

    protected $fillable = [
        'sum',
    ];

    public function validate()
    {
        $validator = Validator::make($this->attributes, [
            'sum' => [
                'required',
                'numeric',
                'min:0',
            ],
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
    }
}
