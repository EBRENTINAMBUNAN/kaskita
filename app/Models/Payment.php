<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $table = 'payment_historys';

    protected $fillable = [
        'username', 'nim', 'pekan', 'amount' ,'image' ,'created_at'
    ];
}
