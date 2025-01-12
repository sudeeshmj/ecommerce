<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    use HasFactory;

    protected $table='languages';

    protected $fillable = [
        'language_name',
        'status'
    ];
    
    // Append custom attributes to the model's array and JSON forms
    protected $appends = ['status_text'];

    public function getStatusTextAttribute(){
        
        return $this->status?'Active':'Inactive';
    }

    public function books(){

        return $this->hasMany(Book::class,'language_id','id');
    }
}
