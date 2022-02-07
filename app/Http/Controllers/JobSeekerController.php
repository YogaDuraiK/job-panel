<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

use App\Mail\JobApplyMail;

use App\Models\JobSeeker;
use App\Models\JobPost;
use App\Models\AppliedJob;
use App\Models\Recruiter;
use App\Models\Location;

class JobSeekerController extends Controller
{
    public function __construct(){
        $this->job_seeker = new JobSeeker();
        $this->job_post = new JobPost();
        $this->applied_job = new AppliedJob();
    }

    public function jobSeeker(Request $request){
        if($request->input()){
            $credentials = $request->only('email', 'password');
            $validator = Validator::make($credentials, [
                'email' => 'required|email',
                'password' => 'required|string|min:6|max:50'
            ]);
            if($validator->fails()) {
                return redirect()->back()->withErrors($validator);
            }
            if(Auth::guard('job_seeker')->attempt(['email' => $request->email, 'password' => $request->password])) {
                Auth::shouldUse('job_seeker');
                $request->session()->regenerate();
                toastr()->success('Login Success.');
                return redirect('find-job');
            } else {
                toastr()->error('Invalid Credentials. Please Try Again.');
                return redirect('job-seeker');
            }
        } else {
            return view('jobseeker.login');
        }
    }

    public function jobSeekerRegister(Request $request){
        if($request->input()){
            $credentials = $request->only('name', 'email', 'password', 'phone', 'experience', 'notice_period', 'skils', 'job_location', 'resume', 'photo');
            $validator = Validator::make($credentials, [
                'name' => 'required',
                'email' => 'required|email|unique:job_seeker',
                'password' => 'required|string|min:6|max:50',
                'phone' => 'required|regex:/[0-9]{10}/',
                'experience' => 'required|numeric',
                'notice_period' => 'required|integer',
                'skils' => 'required',
                'job_location' => 'required',
                'resume' => 'required|mimes:doc,pdf,docx|max:10000',
                'photo' => 'required|mimes:png,jpg,jpeg|max:10000',
            ]);
            if($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            $requestData = $request->input();
            
            if($request->file()) {
                $imageName = $request->name.'_'.time().'.'.$request->file('photo')->getClientOriginalExtension();
                $request->file('photo')->move(base_path().'/public/file/photo',$imageName);
                $requestData['photo'] = $imageName;

                $imageName = $request->name.'_'.time().'.'.$request->file('resume')->getClientOriginalExtension();
                $request->file('resume')->move(base_path().'/public/file/resume',$imageName);
                $requestData['resume'] = $imageName;
            }
            $updateQuery = ["id" => ""];
            $requestData['password'] = Hash::make($requestData['password']);
            $updateStatus = $this->job_seeker->createOrUpdate($updateQuery, $requestData);
            if($updateStatus){
                toastr()->success('Job Seeker Registered Successfully. Please Login.');
                return redirect('job-seeker');
            } else {
                toastr()->error('Job Seeker Registered Failed. Please Try Again.');
                return redirect('job-seeker-register');
            }
        } else {
            $data['location'] = Location::get();
            return view('jobseeker.register', $data);
        }
    }

    public function findJob(Request $request){
        $userId = Auth::user()->id;
        $queryData = [];
        if($request->input()){
            $query = $this->job_post->where('status', 'active');
            if($request->skils){
                $query = $query->where('skils', 'like', '%' . $request->skils . '%');
            }
            if($request->min){
                $query = $query->where('experience', '>=', $request->min);
            }
            if($request->max){
                $query = $query->where('experience', '<=', $request->max);
            }
            $query = $query->with('recruiter_details', 'applied_job');
            if($request->company_name){
                $value = $request->company_name;
                $query = $query->whereHas('recruiter_details', function($q) use($value) {
                    $q->where('name', 'like', '%' . $value . '%');
                });
            }
            if($request->location){
                $value = $request->location;
                $query = $query->whereHas('recruiter_details', function($q) use($value) {
                    $q->where('address', 'like', '%' . $value . '%');
                });
            }
            $queryData =  $query;
        } else { //  applied_job
            $queryData = $this->job_post->where('status', 'active')
                            ->with('recruiter_details', 'applied_job');
        }
        $data['list'] = $queryData->get()->map(function ($row) use ($userId){
            if(count($row['applied_job']) > 0){;
                $i = 0;
                foreach($row['applied_job'] as $res){
                    if($res['job_seeker_id'] == $userId){
                        $i = 1;
                    }
                }
                if($i == 0){
                    return $row;
                }
            } else {
                return $row;
            }
        })->filter(function ($value) { return !is_null($value); })->values();
        return view('jobseeker.findjob', $data);
    }

    public function applyJob(Request $request){
        $upData['job_seeker_id'] = Auth::user()->id;
        $upData['job_post_id'] = $request->post;
        $postData = $this->job_post->where('id', $request->post)->with('recruiter_details')->first();
        $upData['recruiter_id'] = $postData->recruiter_id;
        $upData['status'] = 'applied';
        $updateQuery = ["id" => ""];
        $updateStatus = $this->applied_job->createOrUpdate($updateQuery, $upData);
        if($updateStatus){
            $details = [
                'text' => Auth::user()->name.' Applied Job Title '.$postData->title.'. More Details Check With Job Portal.'
            ];

            Mail::to($postData->recruiter_details->email)->send(new JobApplyMail($details));

            toastr()->success('Job Applied Successfully.');
            return redirect('find-job');
        } else {
            toastr()->error('Job Applied Failed. Please Try Again.');
            return redirect('find-job');
        }
    }

    public function jobApplied(){
        $userId = Auth::user()->id;
        $data['list'] = $this->applied_job->where('job_seeker_id', $userId)->with('recruiter_details', 'job_post')->get();
        return view('jobseeker.appliedjob', $data);
    }
}