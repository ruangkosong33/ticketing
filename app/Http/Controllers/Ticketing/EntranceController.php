<?php

namespace App\Http\Controllers\Ticketing;

use App\Models\User;
use App\Models\Category;
use App\Models\Entrance;
use App\Models\Priority;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class EntranceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $category=Category::orderBy('id')->get();

        $priority=Priority::orderBy('id')->get();

        return view('admin.entrance.index-entrance', ['category'=>$category, 'priority'=>$priority]);
    }

    public function datas()
    {
        $entrance=Entrance::orderBy('date')->get();

        return datatables($entrance)
            ->addIndexColumn()
            ->addColumn('user', function($user)
            {
                return $user->user->name;
            })
            ->addColumn('categoryticket', function($category)
            {
                return $category->category->title;
            })
            ->addColumn('priorityticket', function($priority)
            {
                return $priority->priority->title;
            })
            ->addColumn('action', function($row)
            {
                return '
                <button onclick="editForm(`'.route('entrance.show', $row->id).'`)"  class="edit btn btn-warning btn-sm "><i class="fas fa-edit"></i></button>
                <button onclick="deleteData(`'.route('entrance.destroy', $row->id).'`)" class="destroy btn btn-danger btn-sm ml-1"><i class="fas fa-trash"></i></button>
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
        $validator=Validator::make($request->all(),[
            'title'=>'required',
            'category_id'=>'required',
            'priority_id'=>'required',
            'date'=>'required|date_format:Y-m-d H:i',
            'description'=>'required',
        ]);

        if($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()], 422);
        }


        $entrance=Entrance::create([
            'title'=>$request->title,
            'category_id'=>$request->category_id,
            'priority_id'=>$request->priority_id,
            'date'=>$request->date,
            'description'=>$request->description,
            'user_id'=>Auth::id(),
        ]);

        return response()->json([$entrance, 'message'=>'Data Berhasil Di Tambahkan']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
    public function update(Request $request, Entrance $entrance)
    {
        $validator=Validator::make($request->all(),[
            'status'=>'required',
        ]);

        if($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()], 422);
        }


        $entrance->update([
            'title'=>$request->title,
            'category_id'=>$request->category_id,
            'priority_id'=>$request->priority_id,
            'date'=>$request->date,
            'status'=>$request->status,
            'description'=>$request->description,
            'user_id'=>Auth::id(),
        ]);

        return response()->json([$entrance, 'message'=>'Data Berhasil Di Update']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Entrance $entrance)
    {
        $entrance=Entrance::where('id', $entrance->id);

        $entrance->delete();

        return response()->json([$entrance, 'message'=>'Data Berhasil Di Hapus']);
    }
}
