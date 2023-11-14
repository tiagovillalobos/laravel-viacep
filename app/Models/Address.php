<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = [
        'zipcode',
        'street',
        'number',
        'district',
        'city',
        'state',
        'complement',
    ];

    public function setZipcodeAttribute(string $value): void
    {
        $this->attributes['zipcode'] = str_replace(
            search: '-',
            replace: '',
            subject: $value
        );
    }

    public function getZipcodeAttribute(string $value): string
    {
        return substr_replace(
            string: $value,
            replace: '-',
            offset: 5,
            length: 0
        );
    }

    public function scopeByZipcode($query, string $zipcode)
    {
        return $query->where('zipcode', $zipcode);
    }
}
