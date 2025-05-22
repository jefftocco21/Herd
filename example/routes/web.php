<?php

use Illuminate\Support\Facades\Route;
use App\Models\Job;

Route::get('/', function () {
});

//index
Route::get('/jobs', function (){
    $jobs= Job::with('employer')->latest()->paginate(5);

    return view('jobs.index', [
        'jobs' => $jobs
    ]);
});

//create
Route::get('jobs/create', function () {
     return view('jobs.create');
});

//show
Route::get('/jobs/{job}', function (Job $job) {
    // $job = Job::find($id);

    return view('jobs.show', ['job' => $job ]);   
});

//store
Route::post('/jobs', function () {
    request()->validate([
        'title' => ['required', 'min:3'],
        'salary' => ['required']
    ]);

    Job::create([
        'title' => request('title'),
        'salary' => request('salary'),
        'employer_id' => 1
    ]);

    return redirect('jobs/');
});

//edit
Route::get('/jobs/{job}/edit', function (Job $job) {

    return view('jobs.edit', ['job' => $job ]);   
});

//update
Route::patch('/jobs/{job}', function (Job $job) {
    request()->validate([
        'title' => ['required', 'min:3'],
        'salary' => ['required']
    ]);
    //authorize (not yet)
    //update job
    $job->update([
        'title' => request('title'),
        'salary' => request('salary'),
    ]);
    
    //persist
    //redirect to job page
    return redirect('/jobs/' . $job->id);
});

//destroy
Route::delete('/jobs/{job}', function (Job $job) {
    //authorize
    //delete job
    $job->delete();
    //redirect

    return redirect('/jobs');
});

Route::get('/contact', function () {
    return view('contact');
});