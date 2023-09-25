@extends('adminlte::page')

@section('title', '顧客一覧')

@section('content_header')
    <h1>顧客一覧</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">顧客一覧</h3>
                    <div class="card-tools">
                        <div class="input-group input-group-sm">
                            <div class="input-group-append">
                                <a href="{{ url('clients/add') }}" class="btn btn-default">顧客登録</a>
                            </div>
                        </div>
                        <h1>顧客検索</h1>
<div class="text-right">
<form action="/home/client" method="get">
    <div class="search-area container bg-success">
        <table><tr><th><input type="text" class="form-control" placeholder="顧客名検索" name="keyword" value="{{ $keyword }}"></th>
        <th><button type="submit" class="btn btn-outline-light btn-lg">検索</button></th><th class="text-light">　顧客名で検索</th></tr></table>
    </div>
</form>    
</div>
                    </div>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>顧客名</th>
                                <th>顧客詳細</th>
                                <th>対応一覧へ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($clients as $client)
                                <tr>
                                    <td>{{ $client->id }}</td>
                                    <td>{{ $client->name }}</td>
                                    <td>{{ $client->data }}</td>
                                    <td><a href="/item/index/{{$client->id}}">対応一覧</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
@stop

@section('js')
@stop
