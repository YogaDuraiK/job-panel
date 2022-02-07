<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobPost extends Model
{
    use HasFactory;

    protected $table = 'job_post';

    protected $fillable = [
        'title',
        'experience',
        'description',
        'skils',
        'status',
    	'recruiter_id'
    ];

    public function createOrUpdate(array $attributes, array $values = array())
    {
        $instance = JobPost::firstOrNew($attributes);
        $instance->fill($values)->save();
       
        return $instance;
    }

    public function recruiter_details(){
        return $this->hasOne('App\Models\Recruiter', 'id', 'recruiter_id');
    }

    public function applied_job(){
        return $this->hasMany('App\Models\AppliedJob', 'job_post_id', 'id');
    }
}
