<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = ['name', 'isbn', 'value', 'store_id'];

    public function store()
    {
        return $this->belongsTo(Store::class);
    }
}

