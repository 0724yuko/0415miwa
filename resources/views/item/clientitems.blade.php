@extends('adminlte::page')

@section('title', '顧客対応一覧')

@section('content_header')
    <h1>顧客対応一覧</h1>
@stop

@section('content')

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@csrf
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">顧客名</h3>
                    　　<h3><div class="client_name">{{ $client_name }}</div></h3>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>対応者名</th>
                                <th>対応内容</th>
                                <th>対応日</th>
                                <th>ステータス</th>
                                <th>対応カードへ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->handleuser_name}}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->handle_at ->format('Y-m-d')}}</td>
                                    <td>
                                    @switch($item->status)
                                        @case(1) 未着手 @break
                                        @case(2) 進行中 @break
                                        @case(3) 待機 @break
                                        @case(4) 中断 @break
                                        @case(5) 完了 @break
                                        @default 
                                    @endswitch
                                    </td>
                                    <td><a href="/items/itemcard/{{$item->id}}">対応カードへ</a></td>
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
