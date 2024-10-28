<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    // Specify the table if the default table name isn't used 
    protected $table = 'cars';

    // Define which attributes are mass assignable
    protected $fillable = [
        'car_name', 
        'model', 
        'price', 
        'availability_status'
    ];

    // Specify default values for attributes (optional)
    protected $attributes = [
        'availability_status' => true,
    ];
}
