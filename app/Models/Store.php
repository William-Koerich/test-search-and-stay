<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    protected $fillable = ['name', 'address', 'active'];

    public function books()
    {
        return $this->belongsToMany(Book::class);
    }
}
