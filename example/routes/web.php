<?php

use Illuminate\Support\Facades\Route;
use App\Models\Job;

Route::get('/', function () {
});

//Index
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
Route::get('/jobs/{id}', function ($id) {
    $job = Job::find($id);

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
Route::get('/jobs/{id}/edit', function ($id) {
    $job = Job::find($id);

    return view('jobs.edit', ['job' => $job ]);   
});

//update
Route::patch('/jobs/{id}', function ($id) {
    request()->validate([
        'title' => ['required', 'min:3'],
        'salary' => ['required']
    ]);
    //authorize (not yet)
    //update job
    $job = Job::findorFail($id);
    $job->update([
        'title' => request('title'),
        'salary' => request('salary'),
    ]);
    
    //persist
    //redirect to job page
    return redirect('/jobs/' . $job->id);
});

//destroy
Route::delete('/jobs/{id}', function ($id) {
    //authorize
    //delete job
    $job = Job::findorFail($id)->delete();
    //redirect

    return redirect('/jobs');
});

Route::get('/contact', function () {
    return view('contact');
});