<?php

namespace App\Http\Controllers\Landing;

use App\Models\Vpr;
use App\Models\Entrance;
use App\Models\Intranet;
use App\Models\Software;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FrontController extends Controller
{
    public function beranda()
    {
        $vprs=Vpr::orderBy('id')->get();

        $entrances=Entrance::where('status', 'process')->orderBy('status')->get();

        $intranets=Intranet::orderBy('id')->get()->count();

        $whms=Whm::orderBy('id')->get();

        $softwares=Software::orderBy('id')->get();

        return view('layouts.guest.beranda.index-beranda', [
            'vprs'=>$vprs, 'entrances'=>$entrances, 'intranets'=>$intranets, 'softwares'=>$softwares,
        ]);
    }
}
