@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>顧客管理・対応管理システム</h1>
@stop

@section('content')

    <div class="container">
        <img class="d-block mx-auto img-fluid" src="/image/HOMEsm.png" alt="HOME画像">

        @csrf

        <!-- <div class="card-tools">
            <div class="input-group input-group-sm">
                <div class="input-group-append">
                    <a href="{{ url('clients/add') }}" class="btn btn-default">新規顧客登録</a>
                </div>
            </div>
        </div> -->
    <div class="d-flex justify-content-center align-items-center">
        <div class="card-tools">
            <div class="input-group input-group-lg">
                <div class="input-group-append">
                    <a href="{{ url('items/') }}" class="btn btn-default">対応一覧へ</a>
                </div>
            </div>
        </div>
        <div class="card-tools">
            <div class="input-group input-group-lg">
                <div class="input-group-append">
                    <a href="{{ url('clients') }}" class="btn btn-default">顧客一覧へ</a>
                </div>
            </div>
        </div>
        <div class="card-tools">
            <div class="input-group input-group-lg">
                <div class="input-group-append">
                    <a href="{{ url('users') }}" class="btn btn-default">担当者一覧へ</a>
                </div>
            </div>
        </div>
        <div class="card-tools">
            <div class="input-group input-group-lg">
                <div class="input-group-append">
                    <a href="{{ url('items/add') }}" class="btn btn-default">新規対応登録へ</a>
                </div>
            </div>
        </div>
        
    </div>

</div> 


@stop

@section('css')
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop

