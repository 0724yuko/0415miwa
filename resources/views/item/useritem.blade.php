@extends('adminlte::page')

@section('title', '担当者対応一覧')

@section('content_header')
    <h1>担当者対応一覧</h1>
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
            <form method="GET" action="{{ route('items.useritem',['sort' => $sort,'id' =>$handleuser_id]) }}" id="filterForm">
                <div class="card-header">
                    <h3 class="card-title col-md-12">担当者</h3>
                    <div class="row">
                        <div class="col-md-10">
                            <h3>　　{{ $handleuser_name }}</h3>
                        </div>
                        <div class="col-md-2 text-right">
                            <button type="submit" class="btn btn-outline-primary btn-m">並べ替え</button>　　
                        </div>
                    </div>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>顧客名</th>
                                <th>対応内容</th>
                                <th>対応日　　
                                <div class="sort">
                                    <select name="sort" >
                                    <option value="">更新順</option>
                                    <option value="asc" {{ $sort === 'asc' ? 'selected' : '' }}>昇順</option>
                                    <option value="desc" {{ $sort === 'desc' ? 'selected' : '' }}>降順</option>
                                    </select>
                                </div>                                
                                </th>
                                <th>ステータス
                                <div class="statusradio" style="font-weight:normal;">
                                    <input type="radio" style="transform:scale(1);" name="exclude_completed" value="1" {{ request('exclude_completed') ? 'checked' : '' }} >
                                    完了を除く
                                </div>
                               </th>
                                <th>対応カードへ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->client_name}}</td>
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
            </form>    
            </div>
        </div>
        <button type="button" onClick="history.back()" class="btn btn-outline-primary">戻る</button>

    </div>
    <div class="d-flex justify-content-center align-items-center">{{ $items->links('vendor.pagination.bootstrap-4') }}</div> 
@stop

@section('css')
@stop

@section('js')
@stop
