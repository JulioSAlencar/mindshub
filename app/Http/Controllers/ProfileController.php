<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Discipline;
use App\Models\MissionFeedback;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    public function editPerfil(Request $request): View
    {
        $user = $request->user(); // Or auth()->user();
        $feedbacks = collect();  // Initialize with an empty collection

        if ($user) { // Ensure $user is not null
            $feedbacksQuery = null;

            if ($user->can('is-student')) {
                $feedbacksQuery = MissionFeedback::where('user_id', $user->id);
            } elseif ($user->can('is-teacher')) {
                $feedbacksQuery = MissionFeedback::whereHas('mission', function ($query) use ($user) {
                    $query->where('user_id', $user->id);
                });
            }

            if ($feedbacksQuery instanceof \Illuminate\Database\Eloquent\Builder) {
                $feedbacks = $feedbacksQuery->where('category', 'Elogio') // Assuming 'Elogio' is for positive feedback
                    ->latest()
                    ->get();
            }
        }

        return view('profile.show', [
            'user' => $user,
            'feedbacks' => $feedbacks, // Pass the feedbacks variable           
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
        $user->fill($request->validated());
    
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }
    
        if ($request->hasFile('profile_photo')) {
            // Apagar imagem antiga, se existir
            if ($user->profile_photo && File::exists(public_path($user->profile_photo))) {
                File::delete(public_path($user->profile_photo));
            }
    
            // Gerar novo nome e salvar a nova imagem
            $filename = Str::uuid() . '.' . $request->file('profile_photo')->getClientOriginalExtension();
            $request->file('profile_photo')->move(public_path('assets/profile_photos'), $filename);
    
            $user->profile_photo = 'assets/profile_photos/' . $filename;
        }
    
        $user->save();
    
        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function deletePhoto(Request $request)
    {
        $user = auth()->user();

        if ($user->profile_photo && File::exists(public_path($user->profile_photo))) {
            File::delete(public_path($user->profile_photo));
        }

        // Define como null ou um caminho padrão, se preferir
        $user->profile_photo = null;
        $user->save();

        return redirect()->back()->with('success', 'Foto de perfil removida com sucesso.');
    }
}
