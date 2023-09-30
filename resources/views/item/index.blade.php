@extends('adminlte::page')

@section('title', '対応一覧')

@section('content_header')
    <h1>対応一覧</h1>
    <!-- <div class="card-tools">
        <div class="input-group ">
            <div class="input-group-append ml-auto">
                <a href="{{ url('items/add') }}" class="btn btn-default">新規対応登録</a>
            </div>
        </div>
    </div> -->
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">

                <div class="card-body table-responsive p-0">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th style="width: 3%">ID</th>
                                <th style="width: 16%">顧客名</th>
                                <th style="width: 36%">対応内容</th>
                                <th style="width: 13%">対応者</th>
                                <th style="width: 11%">対応日</th>
                                <th style="width: 8%">ステータス</th>
                                <th style="width: 15%">対応カードへ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->client_name}}</td>
                                    <td style=" word-break: break-word;" rows="2">{{ $item->name }}</td>
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
                                    <td><a href="/items/itemcard/{{$item->id}}">対応カード</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
        <button type="button" onClick="history.back()" class="btn btn-outline-primary">戻る</button>

    <div class="d-flex justify-content-center align-items-center">{{ $items->links('vendor.pagination.bootstrap-4') }}</div> 
@stop

@section('css')
@stop

@section('js')
@stop
