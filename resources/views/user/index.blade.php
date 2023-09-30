@extends('adminlte::page')

@section('title', '担当者一覧')

@section('content_header')
    <h1>担当者一覧</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">

                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>担当者名</th>
                                <th>対応一覧へ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td><a href="/items/index/{{$user->id}}">対応一覧へ</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <button type="button" onClick="history.back()" class="btn btn-outline-primary">戻る</button>

@stop

@section('css')
@stop

@section('js')
@stop
