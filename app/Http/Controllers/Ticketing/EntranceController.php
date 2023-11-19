<?php

namespace App\Http\Controllers\Ticketing;

use App\Models\User;
use App\Models\Category;
use App\Models\Entrance;
use App\Models\Priority;
use Illuminate\Support\Str;
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
        $entrance=Entrance::orderBy('date', 'desc')->get();

        return datatables($entrance)
            ->addIndexColumn()
            ->editColumn('title', function($title)
            {
                return Str::limit($title->title, 15, '....');
            })
            ->editColumn('status', function ($status) {
                return '<span class="badge badge-'. $status->statusColor() .'">'. $status->status .'</span>';
            })
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
                <a href="' . route('entrance.detail', $row->id) . '" class="edit btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                <button onclick="editForm(`'.route('entrance.show', $row->id).'`)"  class="edit btn btn-warning btn-sm ml-1"><i class="fas fa-edit"></i></button>
                <button onclick="deleteData(`'.route('entrance.destroy', $row->id).'`)" class="destroy btn btn-danger btn-sm ml-1"><i class="fas fa-trash"></i></button>
                ';
            })
            ->rawColumns(['action' ,'status'])
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
            'file'=>'required|mimes:pdf|max:5000',
        ]);

        if($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()], 422);
        }

        if($request->file('file'))
        {
            $file=$request->file('file');
            $extension=$file->getClientOriginalName();
            $files=$extension;
            $file->storeAs('public/uploads/file-ticket', $files);
        }
        
        $entrance=Entrance::create([
            'title'=>$request->title,
            'category_id'=>$request->category_id,
            'priority_id'=>$request->priority_id,
            'date'=>$request->date,
            'description'=>$request->description,
            'file'=>$files,
            'user_id'=>Auth::id(),
        ]);

        return response()->json([$entrance, 'message'=>'Data Berhasil Di Tambahkan']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Entrance $entrance)
    {
        return response()->json(['data'=>$entrance]);
    }

    public function detail(Entrance $entrance)
    {
        return view('admin.entrance.show-entrance', ['entrance'=>$entrance]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Entrance $entrance)
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
            'status'=>$request->status,
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
