<?php

namespace App\Http\Controllers;

use App\Models\Jobpost;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    // public function index()
    // {
    //     return view('home');
    // }
    public function indexseeker()
    {
        $this->middleware('admin');
        $jobposts = Jobpost::latest()->get();
        return view('seeker.home', compact('jobposts'));
    }

    public function seekerjob(){
        $jobposts = Jobpost::latest()->get();
        return view('seeker.job', compact('jobposts'));
    }

    public function applications()
{
    $user_id = auth()->id();
    $applications = Profile::where('user_id', $user_id)->get();

    return view('seeker.applications', compact('applications'));
}

    public function seekerprofile()
    {
        return view('seeker.profile');
    }

    public function seekerupdateProfile(Request $request)
    {
        // Validate the form data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . Auth::user()->id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        // Get the authenticated user
        $user = Auth::user();

        // Update the user's name and email
        $user->name = $request->input('name');
        $user->email = $request->input('email');

        // Update the password if provided
        if ($request->filled('password')) {
            $user->password = Hash::make($request->input('password'));
        }

        // Save the changes
        $user->save();

        return redirect()->route('seeker')->with([
            'message' => 'Profile successfully updated.',
            'alert-type' => 'success'
        ]);
    }

    public function detailseeker($jobpostId)
    {
        $jobpost = Jobpost::findOrFail($jobpostId);
        return view('seeker.show', compact('jobpost'));
    }
    
    
    public function indexrecruter()
    {
        $this->middleware('admin');
        $jobposts = Jobpost::latest()->get();
        return view('recruter.home', compact('jobposts'));
    }

    public function recruterprofile()
    {
        return view('recruter.profile');
    }

    public function recruterupdateProfile(Request $request)
    {
        // Validate the form data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . Auth::user()->id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        // Get the authenticated user
        $user = Auth::user();

        // Update the user's name and email
        $user->name = $request->input('name');
        $user->email = $request->input('email');

        // Update the password if provided
        if ($request->filled('password')) {
            $user->password = Hash::make($request->input('password'));
        }

        // Save the changes
        $user->save();

        return redirect()->route('recruter')->with([
            'message' => 'Profile successfully updated.',
            'alert-type' => 'success'
        ]);
    }

    public function detailrecruter($jobpostId)
    {
        $jobpost = Jobpost::findOrFail($jobpostId);
        return view('recruter.show', compact('jobpost'));
    }
    
    public function indexadmin()
    {
        $this->middleware('admin');
        $jobposts = Jobpost::latest()->get();
        return view('admin.home', compact('jobposts'));
    }

    public function detailadmin($jobpostId)
    {
        $jobpost = Jobpost::findOrFail($jobpostId);
        return view('admin.show', compact('jobpost'));
    }
}
