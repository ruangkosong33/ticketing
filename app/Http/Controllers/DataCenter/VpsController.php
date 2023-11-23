<?php

namespace App\Http\Controllers\DataCenter;

use App\Models\Vps;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class VpsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.vps.index-vps');
    }

    public function datas(Request $request)
    {
        $vps=Vps::orderBy('id', 'desc')->get();

        return datatables($vps)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                return '
                <a href="' . route('vps.detail', $row->id) . '" class="edit btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                <button onclick="editForm(`' . route('vps.show', $row->id) . '`)"  class="edit btn btn-warning btn-sm ml-1"><i class="fas fa-edit"></i></button>
                <button onclick="deleteData(`' . route('vps.destroy', $row->id) . '`)" class="destroy btn btn-danger btn-sm ml-1"><i class="fas fa-trash"></i></button>
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
            'date'=>'date_format:Y-m-d H:i',
        ]);

        if ($validator->fails())
        {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $vps=Vps::create([
            'title'=>$request->title,
            'recruitment'=>$request->recruitment,
            'date'=>$request->date,
            'ip'=>$request->ip,
            'storage'=>$request->storage,
            'core'=>$request->core,
            'ram'=>$request->ram,
            'os'=>$request->os,
            'port'=>$request->port,
            'database'=>$request->database,
        ]);

        return response()->json([$vps, 'message'=>'Data Berhasil Di Tambahkan']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Vps $vps)
    {
        return response()->json(['data'=>$vps]);
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
    public function update(Request $request, Vps $vps)
    {
        $validator = Validator::make($request->all(), [
            'title'=>'required',
            'date'=>'date_format:Y-m-d H:i',
        ]);

        if ($validator->fails())
        {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $vps->update([
            'title'=>$request->title,
            'recruitment'=>$request->recruitment,
            'date'=>$request->date,
            'ip'=>$request->ip,
            'storage'=>$request->storage,
            'core'=>$request->core,
            'ram'=>$request->ram,
            'os'=>$request->os,
            'port'=>$request->port,
            'database'=>$request->database,
        ]);

        return response()->json([$vps, 'message'=>'Data Berhasil Di Update']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vps $vps)
    {
        $vps=Vps::where('id', $vps->id);

        $vps->delete();

        return response()->json([$vps, 'message'=>'Data Berhasil Di Hapus']);
    }
}
