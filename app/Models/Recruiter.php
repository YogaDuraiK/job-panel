<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Recruiter extends Authenticatable
{
    use HasFactory;

    protected $table = 'recruiter';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'password',
    ];

    protected $hidden = [
        'password'
    ];

    public function createOrUpdate(array $attributes, array $values = array())
    {
        $instance = Recruiter::firstOrNew($attributes);
        $instance->fill($values)->save();
       
        return $instance;
    }
}
