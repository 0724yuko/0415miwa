@extends('adminlte::page')

@section('title', '管理者用対応一覧')

@section('content_header')
    <h1>管理者用対応一覧</h1>
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
<style>
    /* テーブル内のテキストを改行せずに表示 */
    table {
        table-layout: fixed; /* テーブルの幅を固定 */
        width: 100%; /* テーブルの幅を100%に設定 */
    }

    /* セル内のテキストを改行せずに表示 */
    table td {
        white-space: nowrap; /* テキストを折り返さずに表示 */
        overflow: hidden; /* 要素からはみ出たテキストを隠す */
        text-overflow: ellipsis; /* 隠れたテキストを省略記号で表示 */
    }
</style>
    <div class="row">
        <div class="col-12">
            <div class="card">
            <form method="GET" action="{{ route('items.mnitems',['sort' => $sort,'id' =>$manageuser_id]) }}" id="filterForm">
                <div class="card-header">
                    <h3 class="card-title col-md-12">管理者</h3>
                    <div class="row">
                        <div class="col-md-10">
                            <h3>　　{{ $manageuser_name }}</h3>
                        </div>
                        <div class="col-md-2 text-right">
                            <button type="submit" class="btn btn-outline-primary btn-m">並べ替え</button>　　
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table" style="width: 100%;">
                        <thead>
                            <tr>
                                <th style="width: 4%;">ID</th>
                                <th style="width: 10%;">顧客名</th>
                                <th style="width: 8%;">登録者</th>
                                <th style="width: 8%;">対応者</th>
                                <th style="width: 18%;">対応内容</th>
                                <th style="width: 8%;">対応日　　
                                <div class="sort">
                                    <select name="sort" >
                                    <option value="">更新順</option>
                                    <option value="asc" {{ $sort === 'asc' ? 'selected' : '' }}>昇順</option>
                                    <option value="desc" {{ $sort === 'desc' ? 'selected' : '' }}>降順</option>
                                    </select>
                                </div>                                
                                </th>
                                <th style="width: 9%;">ステータス
                                <div class="statusradio" style="font-weight:normal;">
                                    <input type="radio" style="transform:scale(1);" name="exclude_completed" value="1" {{ request('exclude_completed') ? 'checked' : '' }} >
                                    <span style="font-size: 80%;">完了を除く</span>
                                </div>
                               </th>
                               <th style="width: 11%;">対応カードへ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->client_name}}</td>
                                    <td>{{ $item->user->name}}</td>
                                    <td>{{ $item->handleUser->name}}</td>
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
