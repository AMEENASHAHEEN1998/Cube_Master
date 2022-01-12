<?php

namespace App\Models;

use App\Models\Invoice;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Section extends Model
{
    use HasFactory;
    protected $fillable = ['section_name' , 'description'];

    public function products(){
        return $this->hasMany(Product::class , 'section_id');
    }

    public function invoices(){
        return $this->hasMany(Invoice::class);
    }
}
