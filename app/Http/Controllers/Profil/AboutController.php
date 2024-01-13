<?php

namespace App\Http\Controllers\Profil;

use App\Models\About;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.about.index-about');
    }

    public function datas(Request $request)
    {
        $about=About::orderBy('id')->get();

        return datatables($about)
            ->addIndexColumn()
            ->addColumn('action', function($row)
            {
                return '
                <button onclick="editForm(`'.route('about.show', $row->id).'`)"  class="edit btn btn-warning btn-sm ml-1"><i class="fas fa-edit"></i></button>
                <button onclick="deleteData(`'.route('about.destroy', $row->id).'`)" class="destroy btn btn-danger btn-sm ml-1"><i class="fas fa-trash"></i></button>
                ';
            })
            ->rawColumns(['action'])
            ->escapeColumns([])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator=Validator::make($request->all(), [
            'title'=>'required',
            'description'=>'required',
        ]);

        if($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()], 422);
        }

        $about=About::create([
            'title'=>$request->title,
            'description'=>$request->description,
        ]);

        return response()->json([$about, 'message'=>'Data Berhasil Di Tambahkan']);
    }

    /**
     * Display the specified resource.
     */
    public function show(About $about)
    {
        return response()->json(['data'=>$about]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, About $about)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, About $about)
    {
        $validator=Validator::make($request->all(), [
            'title'=>'required',
            'description'=>'required',
        ]);

        if($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()], 422);
        }

        $validator->update([
            'title'=>$request->title,
            'description'=>$request->description,
        ]);

        return response()->json([$about, 'message'=>'Data Berhasil Di Update']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(About $about)
    {
        $about=About::where('id', $about->id);

        $about->delete();

        return response()->json([$about, 'message'=>'Data Berhasil Di Hapus']);
    }
}
