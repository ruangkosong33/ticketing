<?php

namespace App\Http\Controllers;

use App\Events\CommentNotification;
use App\Models\Notification;
use App\Models\Vpr;
use App\Models\Whm;
use App\Models\User;
use App\Models\Category;
use App\Models\Entrance;
use App\Models\Intranet;
use App\Models\Priority;
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
        $sumcategory=Category::orderBy('id')->count();
        $sumentrance=Entrance::orderBy('id')->count();
        $sumpriority=Priority::orderBy('id')->count();
        $sumvpr=Vpr::orderBy('id')->count();
        $sumwhm=Whm::orderBy('id')->count();
        $sumintranet=Intranet::orderBy('id')->count();
        $sumuser=User::orderBy('id')->count();

        return view('home', ['sumcategory'=>$sumcategory, 'sumentrance'=>$sumentrance, 'sumpriority'=>$sumpriority,
                    'sumuser'=>$sumuser, 'sumvpr'=>$sumvpr, 'sumwhm'=>$sumwhm, 'sumintranet'=>$sumintranet
        ]);
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

        toastr()->success('Profil berhasil diperbarui.');

        return redirect()->back();
    }

    public function verifiedUser($id)
    {
        $user = User::findOrFail($id);
        $user->verified = 1;
        $user->save();

        toastr()->success('Akun '.$user->name.' berhasil diverifikasi.');

        return redirect()->route('home');
    }

    public function comment(Request $request, Entrance $entrance)
    {
        $this->validate($request, [
            'content' => 'required',
        ]);

        $entrance->comments()->create([
            'content' => $request->content,
            'user_id' => auth()->user()->id,
        ]);

        event(new CommentNotification('1 komentar baru'));

        Notification::create([
            'user_id' => auth()->user()->id,
            'type' => 'comment',
            'entrance_id' => $entrance->id,
            'name' => auth()->user()->name,
        ]);

        toastr()->success('Komentar berhasil ditambahkan');

        return redirect()->back();
    }
}
