<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Mail;

use App\Mail\JobApplyMail;

use App\Models\JobPost;
use App\Models\Recruiter;
use App\Models\JobSeeker;
use App\Models\AppliedJob;

class RecruiterController extends Controller
{
    public function __construct(){
        $this->recriter = new Recruiter();
        $this->job_post = new JobPost();
        $this->job_seeker = new JobSeeker();
        $this->applied_job = new AppliedJob();
    }

    public function recruiter(Request $request){
        if($request->input()){
            $credentials = $request->only('email', 'password');
            $validator = Validator::make($credentials, [
                'email' => 'required|email',
                'password' => 'required|string|min:6|max:50'
            ]);
            if($validator->fails()) {
                return redirect()->back()->withErrors($validator);
            }
            if(Auth::guard('recruiter')->attempt(['email' => $request->email, 'password' => $request->password])) {
                Auth::shouldUse('recruiter');
                $request->session()->regenerate();
                toastr()->success('Login Success.');
                return redirect('applied-job');
            } else {
                toastr()->error('Invalid Credentials. Please Try Again.');
                return redirect('recruiter');
            }
        } else {
            return view('recruiter.login');
        }
    }

    public function recruiterRegister(Request $request){
        if($request->input()){
            $credentials = $request->only('name', 'email', 'password', 'phone', 'address');
            $validator = Validator::make($credentials, [
                'name' => 'required',
                'email' => 'required|email|unique:recruiter',
                'password' => 'required|string|min:6|max:50',
                'phone' => 'required|regex:/[0-9]{10}/',
                'address' => 'required',
            ]);
            if($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            $requestData = $request->input();
            $updateQuery = ["id" => ""];
            $requestData['password'] = Hash::make($requestData['password']);
            $updateStatus = $this->recriter->createOrUpdate($updateQuery, $requestData);
            if($updateStatus){
                toastr()->success('Recruiter Registered Successfully. Please Login.');
                return redirect('recruiter');
            } else {
                toastr()->error('Recruiter Registered Failed. Please Try Again.');
                return redirect('recruiter-register');
            }
        } else {
            return view('recruiter.register');
        }
    }

    public function jobPost(){
        $data['list'] = $this->job_post->where('recruiter_id', Auth::user()->id)->get();
        return view('recruiter.post', $data);
    }

    public function addEditPostView(Request $request){
        if($request->input()){
            $id = $request->id;
            $data['details'] = $this->job_post->where('id', $id)->first();
        } else {
            $id = '';
            $data['details']['id'] = $id;
        }
        
        return view('recruiter.addeditpost', $data);
    }

    public function addEditPost(Request $request){
        $credentials = $request->only('title', 'experience', 'description', 'skils');
        $validator = Validator::make($credentials, [
            'title' => 'required',
            'experience' => 'required|numeric',
            'description' => 'required',
            'skils' => 'required',
        ]);
        if($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        $requestData = $request->input();
        $requestData['status'] = 'active';
        $requestData['recruiter_id'] = Auth::user()->id;
        $updateQuery = ["id" => $requestData['id']];
        unset($requestData['id']);
        $updateStatus = $this->job_post->createOrUpdate($updateQuery, $requestData);
        if($updateStatus){
            toastr()->success('Job Post Add/Edit Success.');
            return redirect('job-post');
        } else {
            toastr()->error('Job Post Add/Edit Failure.');
            return redirect('job-post');
        }
    }

    public function statusUpdatePost(Request $request){
        $updateQuery = ["id" => $request['id']];
        if($request['status'] == 'active'){
            $upsData['status'] = 'inactive';
        } else {
            $upsData['status'] = 'active';
        }
        $updateStatus = $this->job_post->createOrUpdate($updateQuery, $upsData);
        if($updateStatus){
            toastr()->success('Job Post Status Updated Success.');
            return redirect('job-post');
        } else {
            toastr()->error('Job Post Status Updated Failure.');
            return redirect('job-post');
        }
    }

    public function deletePost(Request $request){
        $updateStatus = $this->job_post->where('id', $request->id)->delete();
        if($updateStatus){
            toastr()->success('Job Post Deleted Success.');
            return redirect('job-post');
        } else {
            toastr()->error('Job Post Deleted Failure.');
            return redirect('job-post');
        }
    }

    public function candidates(Request $request){
        if($request->input()){
            $query = $this->job_seeker;
            if($request->skils){
                $query = $query->where('skils', 'like', '%' . $request->skils . '%');
            }
            if($request->notice_period){
                $query = $query->where('notice_period', '<=', $request->notice_period);
            }
            if($request->min){
                $query = $query->where('experience', '>=', $request->min);
            }
            if($request->max){
                $query = $query->where('experience', '<=', $request->max);
            }
            if($request->location){
                $query = $query->where('job_location', $request->location);
            }
            $data['list'] =  $query->get();
        } else {
            $data['list'] =  $this->job_seeker->get();
        }
        
        return view('recruiter.candidate', $data);
    }

    public function appliedJob(){
        $userId = Auth::user()->id;
        $data['list'] = $this->applied_job->where('recruiter_id', $userId)->with('job_post', 'job_seeker')->get();
        return view('recruiter.appliedjob', $data);
    }

    public function appliedJobStatus(Request $request){
        $updateQuery = ["id" => $request->id];
        $updateStatus = $this->applied_job->createOrUpdate($updateQuery, ['status' => $request->status]);
        if($updateStatus){
            $postData = $this->applied_job->where('id', $request->id)->with('job_post', 'job_seeker')->first();
            if($request->status == 'accepted'){
                $details = [
                    'text' => 'Yoru Job Application '.$postData->job_post->title.'. is Accepted.'
                ];
            } else {
                $details = [
                    'text' => 'Yoru Job Application '.$postData->job_post->title.'. is Rejected.'
                ];
            }
            Mail::to($postData->job_seeker->email)->send(new JobApplyMail($details));
            toastr()->success('Job Status Affected.');
            return redirect('applied-job');
        } else {
            toastr()->error('Job Status Not Affected. Please Try Again.');
            return redirect('applied-job');
        }
    }
}