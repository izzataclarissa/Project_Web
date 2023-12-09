<?php

namespace App\Http\Controllers;

use App\Models\Jobpost;
use App\Models\Profile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\JobPostStoreRequest;
use App\Http\Requests\JobPostUpdateRequest;
use Illuminate\Auth\Access\AuthorizationException;
use App\Models\User;

class AdminController extends Controller
{
    public function index()
    {
        $this->middleware('admin');
        $jobposts = Jobpost::latest()->get();

        return view('admin.job', compact('jobposts'));
    }

    public function create()
    {
        return view('admin.create');
    }

    public function store(JobPostStoreRequest $request)
    {
        try {
            if ($request->validated()) {
                $user_id = auth()->id();
                $gambar = $request->file('gambar')->store('assets/jobpost', 'public');
                Jobpost::create($request->except('gambar') + ['gambar' => $gambar, 'user_id' => $user_id]);
            }

            return redirect()->route('admin.job')->with([
                'message' => 'Job Berhasil Dibuat',
                'alert-type' => 'success'
            ]);
        } catch (\Exception $e) {
            return redirect()->route('admin.job')->with([
                'message' => 'Gagal membuat job post. Error: ' . $e->getMessage(),
                'alert-type' => 'danger'
            ]);
        }
    }

    public function edit(Jobpost $jobpost)
    {
        try {
            $this->authorize('update', $jobpost);

            // Lanjutkan dengan tampilan edit jika pengguna diotorisasi
            return view('admin.edit', compact('jobpost'));
        } catch (AuthorizationException $e) {
            return redirect()->route('admin.job')->with([
                'message' => 'Anda tidak diizinkan mengedit job post ini.',
                'alert-type' => 'warning'
            ]);
        }
    }

    public function update(JobPostUpdateRequest $request, Jobpost $jobpost)
    {
        if ($request->validated()) {
            $jobpost->update($request->validated());
        }

        return redirect()->route('admin.job')->with([
            'message' => 'Data Berhasil Diedit',
            'alert-type' => 'info'
        ]);
    }

    public function updateImage(Request $request, $jobpostId)
    {
        $request->validate([
            'gambar' => 'required|image'
        ]);
        $jobpost = Jobpost::findOrFail($jobpostId);
        if ($request->gambar) {
            unlink('storage/' . $jobpost->gambar);
            $gambar = $request->file('gambar')->store('assets/jobpost', 'public');

            $jobpost->update(['gambar' => $gambar]);
        }

        return redirect()->back()->with([
            'message' => 'Gambar Berhasil Diedit',
            'alert-type' => 'info'
        ]);
    }

    public function destroy(Jobpost $jobpost)
    {
        try {
            $this->authorize('delete', $jobpost);
            if ($jobpost->gambar) {
                unlink('storage/' . $jobpost->gambar);
            }
            $jobpost->delete();

            return redirect()->back()->with([
                'message' => 'Data Berhasil DiHapus',
                'alert-type' => 'danger'
            ]);
        } catch (AuthorizationException $e) {
            return redirect()->route('admin.job')->with([
                'message' => 'Anda tidak diizinkan menghapus job post ini.',
                'alert-type' => 'warning'
            ]);
        }
    }

    public function indexprofile(Request $request, $jobPostId = null)
    {
        // Jika rekruter tidak login, redirect ke halaman login
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Jika ada parameter jobPostId
        if ($jobPostId) {
            // Temukan pekerjaan dengan ID yang sesuai
            $jobPost = Jobpost::findOrFail($jobPostId);

            // Pastikan rekruter hanya dapat melihat pelamar untuk pekerjaannya sendiri
            if (auth()->id() != $jobPost->user_id) {
                abort(403, 'Unauthorized action.');
            }

            // Ambil daftar pelamar untuk pekerjaan tertentu
            $profiles = Profile::where('jobpost_id', $jobPostId)->get();

            return view('recruter.pelamar', compact('profiles', 'jobPost'));
        }

        // Jika tidak ada parameter jobPostId
        // Ambil daftar semua pelamar yang sesuai dengan pekerjaan yang dibuat oleh rekruter yang sedang login
        $profiles = Profile::whereHas('jobpost', function ($query) {
            $query->where('user_id', Auth::id());
        })->get();

        return view('admin.pelamar', compact('profiles'));
    }

    
    public function listUsers()
    {
        $users = User::all();
        return view('admin.listUsers', compact('users'));
    }

    public function deleteUser(User $user)
    {
        try {
    
            // Hapus semua course terkait user
            $user->jobposts()->each(function ($jobpost) {
                // Hapus gambar terkait course
                if ($jobpost->gambar) {
                    unlink('storage/' . $jobpost->gambar);
                }
                $jobpost->delete();
            });
    
            // Hapus user
            $user->delete();
    
            return redirect()->route('admin.user')->with('message', 'User deleted successfully');
        } catch (\Exception $e) {
            return redirect()->route('admin.user')->with('message', 'Failed to delete user. Error: ' . $e->getMessage());
        }
    }
}
