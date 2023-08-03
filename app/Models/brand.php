<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class brand extends Model
{
    use HasFactory;
    protected $table='brands';

    protected $primarykey='id';
    
    protected $fillable = [
        'name',
        'description',
        'image',
        'is_active',
    ];
}
