@extends('layouts.admin.b-master')

@section('title', 'Detail')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Detail Permohonan Tiket</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <x-card>
                <x-table>
                    <tr>
                        <td width="20%">Judul Permohonan</td>
                        <td>{{$entrance->title}}</td>
                    </tr>
                    <tr>
                        <td width="20%">Kategori</td>
                        <td>{{$entrance->category->title}}</td>
                    </tr>
                    <tr>
                        <td width="20%">Prioritas</td>
                        <td>{{$entrance->priority->title}}</td>
                    </tr>
                    <tr>
                        <td width="20%">Tanggal Permohonan</td>
                        <td>{{$entrance->date}}</td>
                    </tr>
                    <tr>
                        <td width="20%">Status</td>
                        <td>{{$entrance->status}}</td>
                    </tr>
                    <tr>
                        <td width="20%">File Surat</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td width="30%">Deskripsi</td>
                        <td>{!!$entrance->description!!}</td>
                    </tr>
                </x-table>
            </x-card>
        </div>

        @include('admin.entrance.comments', ['entrance'=>$entrance])
    </div>
@endsection
