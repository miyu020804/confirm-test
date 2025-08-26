<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'last_name',
        'first_name',
        'gender',
        'email',
        'tel',
        'address',
        'building',
        'category_id',
        'detail',
    ];

    public function getNameAttribute(): string
    {
        return trim(($this->last_name ?? '') . ' ' .
            ($this->first_name ?? ''));
    }


    public function getGenderLabelAttribute(): string
    {
        $map = [1 => '男性', 2 => '女性', 3 => 'その他'];
        return $map[(int)$this->gender] ?? '';
    }


    public function category()
    {

        return
            $this->belongsTo(
                \App\Models\Category::class,
                'category_id'
            );
    }
}
