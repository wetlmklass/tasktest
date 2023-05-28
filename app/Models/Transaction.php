<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class Transaction extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'date',
        'type',
        'summ',
    ];

    public function validate()
    {
        $validator = Validator::make($this->attributes, [
            'date' => [
                'required',
                'date_format:Y-m-d H:i:s',
            ],
            'type' => [
                'required',
                'string',
            ],
            'summ' => [
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
