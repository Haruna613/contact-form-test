<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'first_name',
        'last_name',
        'gender',
        'email',
        'tel',
        'address',
        'building',
        'detail',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function scopeCategorySearch($query, $category_id)
    {
        if (!empty($category_id)){
            $query->where('category_id', $category_id);
        }
        return $query;
    }

    public function scopeKeywordSearch($query, $keyword)
    {
        if (!empty($keyword)) {
            $query->where(function ($query) use ($keyword) {
                $query->where('last_name', 'like', '%' . $keyword . '%')
                    ->orwhere('first_name', 'like', '%' . $keyword . '%')
                    ->orwhere('email', 'like', '%' . $keyword . '%');
            });
        }
        return $query;
    }

    public function scopeGenderSearch($query, $gender)
    {
        if (!empty($gender)){
            $query->where('gender', $gender);
        }
        return $query;
    }

    public function scopeCreated_atSearch($query, $created_at)
    {
        if (!empty($created_at)){
            $query->whereDate('created_at', $created_at);
        }
        return $query;
    }

    protected function getGenderAttribute($value)
    {
        return match ((int) $value) {
            1 => '男性',
            2 => '女性',
            3 => 'その他',
            default => '不明',
        };
    }
}
