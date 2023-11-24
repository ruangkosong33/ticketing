@extends('layouts.admin.b-master')

@section('title', 'Detail')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Detail Perangkat Lunak</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <x-card>
                <x-table>
                    <tr>
                        <td width="20%">Nama Software / Aplikasi</td>
                        <td>{{$software->title}}</td>
                    </tr>
                    
                </x-table>
            </x-card>
        </div>
    </div>
@endsection
