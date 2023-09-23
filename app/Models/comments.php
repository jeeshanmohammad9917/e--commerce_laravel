<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class comments extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';

    protected $table = 'comments';
    protected $fillable = [
        'user_id',
        'comment'];

}
