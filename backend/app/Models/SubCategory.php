<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;
    
    protected $table='sub_categories';

    protected $fillable = [
        'category_id',
        'subcategory_name',
        'status'
    ];
    
    // Append custom attributes to the model's array and JSON forms
    protected $appends = ['status_text'];

    public function getStatusTextAttribute(){
        
        return $this->status?'Active':'Inactive';
    }

    public function category()
    {
        return $this->belongsTo(Category::class,'category_id','id');
    }
}
