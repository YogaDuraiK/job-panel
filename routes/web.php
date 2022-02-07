<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CommonController;
use App\Http\Controllers\RecruiterController;
use App\Http\Controllers\JobSeekerController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [CommonController::class, 'index']);

Route::get('recruiter', [RecruiterController::class, 'recruiter']);
Route::post('recruiter', [RecruiterController::class, 'recruiter']);
Route::get('recruiter-register', [RecruiterController::class, 'recruiterRegister']);
Route::post('recruiter-register', [RecruiterController::class, 'recruiterRegister']);

Route::get('job-seeker', [JobSeekerController::class, 'jobSeeker']);
Route::post('job-seeker', [JobSeekerController::class, 'jobSeeker']);
Route::get('job-seeker-register', [JobSeekerController::class, 'jobSeekerRegister']);
Route::post('job-seeker-register', [JobSeekerController::class, 'jobSeekerRegister']);

Route::get('logout', [CommonController::class, 'logout']);

Route::group(['middleware' => [ 'job_seeker' ] ], function ($router) {
    Route::get('find-job', [JobSeekerController::class, 'findJob']);
    Route::post('find-job', [JobSeekerController::class, 'findJob']);
    Route::get('apply-job', [JobSeekerController::class, 'applyJob']);
    Route::get('job-applied', [JobSeekerController::class, 'jobApplied']);
});

Route::group(['middleware' => [ 'recruiter' ] ], function ($router) {

    Route::get('applied-job', [RecruiterController::class, 'appliedJob']);
    Route::get('applied-job-status', [RecruiterController::class, 'appliedJobStatus']);

    Route::get('job-post', [RecruiterController::class, 'jobPost']);
    Route::get('add-edit-post-view', [RecruiterController::class, 'addEditPostView']);
    Route::post('add-edit-post', [RecruiterController::class, 'addEditPost']);
    Route::get('status_update-post', [RecruiterController::class, 'statusUpdatePost']);
    Route::get('delete-post', [RecruiterController::class, 'deletePost']);

    Route::get('candidates', [RecruiterController::class, 'candidates']);
    Route::post('candidates', [RecruiterController::class, 'candidates']);
});
