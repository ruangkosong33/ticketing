<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
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
    public function index()
    {
        return view('home');
    }

    public function profile()
    {
        $user = auth()->user();
        return view('admin.profile', compact('user'));
    }

    public function update_profile(Request $request)
    {
        $user = auth()->user();
        $this->validate($request, [
            'name'=> 'required',
            'email'=> 'required',
            'opd_name'=> 'required',
            'nip'=> 'required',
            'phone'=> 'required',
            'address'=> 'required',
        ]);
        if (isset($request->password)) {
            $user->password = Hash::make($request->password);
        }
        $user->email = $request->email;
        $user->name = $request->name;


        if($user->opd()->count() > 0) {
            $opd = $user->opd;
            $opd->name = $request->opd_name;
            $opd->nip = $request->nip;
            $opd->phone = $request->phone;
            $opd->address = $request->address;
            $opd->save();
        }
        else {
            $opd = $user->opd()->create([
                'name' => $request->opd_name,
                'nip' => $request->nip,
                'phone' => $request->phone,
                'address' => $request->address
            ]);
            $user->opd_id = $opd->id;
        }
        $user->save();

        return redirect()->back();
    }

    public function verifiedUser($id)
    {
        $user = User::findOrFail($id);
        $user->verified = 1;
        $user->save();

        return redirect()->route('home');
    }
}
