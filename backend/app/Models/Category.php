<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'category_name',
        'status'
    ];
    
    // Append custom attributes to the model's array and JSON forms
    protected $appends = ['status_text'];

    public function getStatusTextAttribute(){
        
        return $this->status?'Active':'Inactive';
    }
    

    public function subCategories()
    {
        return $this->hasMany(SubCategory::class,'category_id','id');
    }

    public function books(){

        return $this->hasMany(Book::class,'category_id','id');
    }
}
