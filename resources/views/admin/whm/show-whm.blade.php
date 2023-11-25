@extends('layouts.admin.b-master')

@section('title', 'WHM / C-Panel')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Detail WHM / C-Panel</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <x-card>
                <x-table>
                    <tr>
                        <td width="20%">Judul</td>
                        <td>{{$whm->title}}</td>
                    </tr>
                    <tr>
                        <td width="20%">Domain</td>
                        <td>{{$whm->domain}}</td>
                    </tr>
                    <tr>
                        <td width="20%">IP</td>
                        <td>{{$whm->ip}}</td>
                    </tr>
                    <tr>
                        <td width="20%">Username</td>
                        <td>{{$whm->username}}</td>
                    </tr>
                </x-table>
            </x-card>
        </div>
    </div>
@endsection
