<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Profile;

class UserProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware(['seeker', 'verified']);
    }

    public function index()
    {
        return view('profile.index');
    }

    public function store(Request $request)
    {   
        $this->validate($request, [
            'address'=> 'required',
            // 'phone_number' => 'required|numeric',
            'phone_number' => 'required|numeric|min:12',
            'experience' => 'required|min:20',
            'bio' => 'required|min:20',
        ]);
        $user_id = auth()->user()->id;
        Profile::where('user_id', $user_id)->update([
            'address'=>request('address'),
            'phone_number'=>request('phone_number'),
            'experience'=>request('experience'),
            'bio'=>request('bio'),
        ]);
        return redirect()->back()->with('message', 'Your Profile Updated Successfully');
    }

    public function coverletter(Request $request)
    {
        $this->validate($request, [
            'cover_letter' => 'required|mimes:pdf,doc,docs|max:20000',
        ]);
        $user_id =auth()-> user()->id;
        $cover = $request->file('cover_letter')->store('public/files');
        Profile::where('user_id', $user_id)->update([
            'cover_letter' => $cover,
        ]);
        return redirect()->back()->with('message', 'Cover Letter Uploaded Successfully');
    }

    public function resume(Request $request)
    {
        $this->validate($request, [
            'resume' => 'required|mimes:pdf,doc,docs,jpg,png,jpeg|max:20000'
        ]);
        $user_id =auth()-> user()->id;
        $resume = $request->file('resume')->store('public/files');
        Profile::where('user_id', $user_id)->update([
            'resume' => $resume,
        ]);
        return redirect()->back()->with('message', 'Resume Uploaded Successfully');
    }

    public function avatar(Request $request)
    {
        $this->validate($request, [
            'avatar' => 'required|mimes:jpg,png,jpeg|max:20000'
        ]);
        $user_id =auth()->user()->id;
        if($request->hasFile('avatar')){
            $file = $request->file('avatar');
            $text = $file->getClientOriginalExtension();
            $fileName = time().'.'.$text;
            $file->move('uploads/avatar', $fileName);
            Profile::where('user_id', $user_id)->update([
                'avatar' => $fileName,
            ]);
            return redirect()->back()->with('message', 'Avatar Uploaded Successfully');
        }
    }
}
