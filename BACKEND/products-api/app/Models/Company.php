<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "email",
        "cnpj"
    ];

    public function user()
    {
        return $this->hasMany(User::class);
    }

    public function product()
    {
        return $this->hasMany(Product::class);
    }

}
