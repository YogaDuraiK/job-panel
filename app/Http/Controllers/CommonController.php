<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Session;

use App\Models\JobPost;


class CommonController extends Controller
{
    public function __construct(){
        $this->job_post = new JobPost();
    }

    public function index(){
        if(Auth::guard('job_seeker')->check()){
            return redirect('find-job');
        } else if(Auth::guard('recruiter')->check()){
            return redirect('applied-job');
        } else {
            $data['list'] = $this->job_post->where('status', 'active')
                            ->with('recruiter_details')->get();
            return view('index', $data);
        }
    }

    public function logout(){
        Auth::logout();
        Session::flush();
        return redirect('/');
    }

}