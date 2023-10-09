@extends('adminlte::page')

@section('title', '顧客カード')

@section('content_header')
    <h1>顧客カード</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                       @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                       @endforeach
                    </ul>
                </div>
            @endif

            <div class="card card-primary">
            <form action="/clients/update/{{$client->id}}" method="post">
                @csrf
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                            <tr>
                                <th style="width: 10%">ID</th>
                                <td style="width: 90%">{{ $client->id }}</td>
                                <td>
                                    <a onclick="return confirm('この顧客データを削除しますか?')" class="btn btn-danger" href="/clients/delete/{{$client->id}}">削除</a>
                                </td>
                            </tr>
                            <tr><th>顧客名</th><td>
                                <textarea name="name" id="produntonInputName" class="form-control col-xs-2" required>{{old('name', $client->name) }}</textarea></td></tr>
                            <tr><th>顧客詳細</th><td>
                                <textarea name="data" id="produntonInputData" class="form-control col-xs-2" rows="5" required>{{old('data', $client->data) }}</textarea></td></tr>
                    </table>
                </div>
                <div class="btn-toolbar">
                    <div class="btn-group">
                        <button type="button" onClick="history.back()" class="btn btn-outline-primary">戻る</button>
                    </div>

                    <div class="btn-group text-right ml-auto col-md-2">
                       <a class="btn btn-outline-primary btn-m" href="/items/add/{{$client->id}}">新規対応登録</a>
                    </div>

                    <div class="btn-group text-right mr-1  col-md-2">
                        <button type="submit" class="btn btn-outline-primary btn-m">更新</button>
                    </div>
                </div>

            </form>

            </div>
        </div>
    </div>

@stop

@section('css')
@stop

@section('js')
@stop
