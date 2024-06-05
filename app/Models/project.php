<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Type;

class project extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'summary', 'slug','client_name', 'cover_image', 'type_id'];
        public function type() {
            return $this->belongsTo(Type::class); 
        }
}
