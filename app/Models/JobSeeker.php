<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class JobSeeker extends Authenticatable
{
    use HasFactory;

    protected $table = 'job_seeker';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'experience',
        'notice_period',
        'skils',
        'job_location',
        'resume',
        'photo',
        'password',
    ];

    protected $hidden = [
        'password'
    ];

    public function createOrUpdate(array $attributes, array $values = array())
    {
        $instance = JobSeeker::firstOrNew($attributes);
        $instance->fill($values)->save();
       
        return $instance;
    }

}
