<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ordinance extends Model
{
    protected $fillable = [
        'ordinance_number',
        'title',
        'date_passed',
        'author_sponsor',
        'description',
        'status'
    ];

    protected function casts(): array
    {
        return [
            'date_passed' => 'date',
        ];
    }
}
