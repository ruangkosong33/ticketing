<?php

namespace App\Http\Controllers\Profil;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AboutTwoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.abouttwo.index-abouttwo');
    }

    public function datas(Request $request)
    {
        $abouttwo=Abouttwo::orderBy('id')->get();

        return datatables($abouttwo)
        ->addIndexColumn()
        ->addColumn('action', function($row){
            return '
            <button onclick="editForm(`'.route('abouttwo.show', $row->id).'`)"  class="edit btn btn-warning btn-sm ml-1"><i class="fas fa-edit"></i></button>
            <button onclick="deleteData(`'.route('abouttwo.destroy', $row->id).'`)" class="destroy btn btn-danger btn-sm ml-1"><i class="fas fa-trash"></i></button>
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
            'body'=>'required',
        ]);

        if($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()], 422);
        }

        $abouttwo=Abouttwo::create([
            'title'=>$request->title,
            'body'=>$request->body,
        ]);

        return response()->json(['success', 'Data Berhasil Di Simpan']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Abouttwo $abouttwo)
    {
        return response()->json(['data'=>$abouttwo]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Abouttwo $abouttwo)
    {
        $validator=Validator::make($request->all(), [
            'title'=>'required',
            'body'=>'required',
        ]);

        if($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()], 422);
        }

        $abouttwo->update([
            'title'=>$request->title,
            'body'=>$request->body,
        ]);

        return response()->json(['success', 'Data Berhasil Di Update']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Abouttwo $abouttwo)
    {
        $abouttwo=Abouttow::where('id', $abouttwo->id);

        $abouttwo->delete();

        return response()->json(['success', 'Data Berhasil Di Hapus']);
    }
}
