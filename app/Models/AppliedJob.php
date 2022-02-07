<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppliedJob extends Model
{
    use HasFactory;

    protected $table = 'applied_job';

    protected $fillable = [
        'job_seeker_id',
        'job_post_id',
        'recruiter_id',
        'status'
    ];

    public function createOrUpdate(array $attributes, array $values = array())
    {
        $instance = AppliedJob::firstOrNew($attributes);
        $instance->fill($values)->save();
       
        return $instance;
    }

    public function recruiter_details(){
        return $this->hasOne('App\Models\Recruiter', 'id', 'recruiter_id');
    }

    public function job_post(){
        return $this->hasOne('App\Models\JobPost', 'id', 'job_post_id');
    }

    public function job_seeker(){
        return $this->hasOne('App\Models\JobSeeker', 'id', 'job_seeker_id');
    }

}
