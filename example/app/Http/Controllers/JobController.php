<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function index()
    {
        $jobs= Job::with('employer')->latest()->paginate(5);

        return view('jobs.index', [
            'jobs' => $jobs
        ]);
    }

    public function create()
    {
        return view('jobs.create');
    }

    public function show(Job $job)
    {
        return view('jobs.show', ['job' => $job ]);   
    }

    public function store()
    {
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
    }

    public function edit(Job $job)
    {
        return view('jobs.edit', ['job' => $job ]);  
    }

    public function update(Job $job)
    {
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
    }

    public function destroy(Job $job)
    {
        //authorize
        //delete job
        $job->delete();
        //redirect

        return redirect('/jobs');
    }
}
