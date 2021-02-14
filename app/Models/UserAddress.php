<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class userAddress extends Model
{
    use HasFactory;
    protected $table = 'user_addresses';
    protected $guarded = [];
//    protected $fillable = [
//        'user_id',
//        'address'
//    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
