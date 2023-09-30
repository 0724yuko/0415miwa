@extends('adminlte::page')

@section('title', '顧客一覧')

@section('content_header')
    <h1>顧客一覧</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">

                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th style="width: 3%">ID</th>
                                <th style="width: 20%">顧客名</th>
                                <th style="width: 52%">顧客詳細</th>
                                <th style="width: 12%">対応一覧へ</th>
                                <th style="width: 13%">顧客カードへ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($clients as $client)
                                <tr>
                                    <td>{{ $client->id }}</td>
                                    <td>{{ $client->name }}</td>
                                    <td style=" word-break: break-word;">{{ $client->data }}</td>
                                    <td><a href="/items/clientitems/{{$client->id}}">対応一覧</a></td>
                                    <td><a href="/clients/clientcard/{{$client->id}}">顧客カード</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <button type="button" onClick="history.back()" class="btn btn-outline-primary">戻る</button>
    <div class="d-flex justify-content-center align-clients-center">{{ $clients->links('vendor.pagination.bootstrap-4') }}</div> 
@stop

@section('css')
@stop

@section('js')
@stop
