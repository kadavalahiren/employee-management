<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $appends = ['profile_image_url'];

    protected $fillable = [];

    public function getProfileImageUrlAttribute()
    {
        if ($this->photo) {
            return  asset('employee/'.$this->photo);
        }
    }
}
