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
                    　　<h3><div class="col-md-6"> 
                                <div class="client_name">{{ $client_name }}</div>
                            </div>
                            <div class="col-md-6 text-right ml-auto col-md-2">  
                                <a class="btn btn-outline-primary btn-m" href="{{ route('clientcard',['id' => $client_id]) }}">顧客カードへ</a>
                            </div>
                        </h3>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th style="width: 3%">ID</th>
                                <th style="width: 36%">対応内容</th>
                                <th style="width: 13%">対応者</th>
                                <th style="width: 11%">対応日</th>
                                <th style="width: 8%">ステータス</th>
                                <th style="width: 15%">対応カードへ</th>
                                <!-- <th>ID</th>
                                <th>対応者名</th>
                                <th>対応内容</th>
                                <th>対応日</th>
                                <th>ステータス</th>
                                <th>対応カードへ</th> -->
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td style=" word-break: break-word;" rows="2">{{ $item->name}}</td>
                                    <td>{{ $item->handleuser_name }}</td>
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
<div class="row">
    <div class="col-6">
        <button type="button" onClick="history.back()" class="btn btn-outline-primary col-md-2">戻る</button>
    </div>
    <div class="btn-group text-right ml-auto">
        <a class="btn btn-outline-primary btn-m" href="{{ route('items.add',['client_id' => $client_id]) }}">新規対応登録</a>　　
    </div>
    <div class="d-flex justify-content-center align-items-center">{{ $items->links('vendor.pagination.bootstrap-4') }}</div>
</div>
@stop

@section('css')
@stop

@section('js')
@stop
