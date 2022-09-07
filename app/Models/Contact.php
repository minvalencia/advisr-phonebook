<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
    protected $table = 'contacts';
    protected $fillable = [
        'number'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'contact_users', 'contact_id', 'user_id')->withPivot('nickname');
    }
}
