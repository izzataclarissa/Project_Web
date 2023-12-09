<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;
use App\Http\Requests\ProfileStoreRequest;

class UserController extends Controller
{
    public function pelamar($jobpostId){
        $jobpost_id = $jobpostId;
        return view('seeker.lamaran', compact('jobpost_id'));
    }

    public function pelamarStore(ProfileStoreRequest $request){
        try {
            $user_id = auth()->id();
            $jobpost_id = $request->input('jobpost_id');
    
            // Memeriksa apakah seeker sudah pernah mengirimkan lamaran untuk job post tertentu
            if (Profile::where('user_id', $user_id)->where('jobpost_id', $jobpost_id)->exists()) {
                return redirect()->route('seeker')->with([
                    'message' => 'Anda sudah mengirimkan lamaran untuk job post ini.',
                    'alert-type' => 'warning'
                ]);
            }
    
            // Jika belum, simpan lamaran
            $gambarcv = $request->file('gambarcv')->store('assets/gambarcv', 'public');
            Profile::create($request->except('gambarcv') + [
                'gambarcv' => $gambarcv,
                'user_id' => $user_id,
                'jobpost_id' => $jobpost_id,
            ]);
    
            return redirect()->route('seeker')->with([
                'message' => 'Lamaran anda berhasil dikirim',
                'alert-type' => 'success'
            ]);
        } catch (\Exception $e) {
            return redirect()->route('seeker')->with([
                'message' => 'Gagal membuat lamaran. Error: ' . $e->getMessage(),
                'alert-type' => 'danger'
            ]);
        }
    }
}
