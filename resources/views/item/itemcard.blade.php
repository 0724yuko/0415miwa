@extends('adminlte::page')

@section('title', '対応カード')

@section('content_header')
    <h1>対応カード</h1>
@stop
<!-- <a href="/items" class="lh-lg fw-bold">>>>一覧に戻る</a> -->

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
<form action="/items/update/{{$item->id}}" method="post">
                @csrf
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                            <tr><th>ID</th><td>{{ $item->id }}</td></tr>
                            <tr><th>顧客名</th><td>{{ $item->client_name }}</td></tr>
                            <tr><th>対応内容</th><td>
                                <textarea name="name" id="produntonInputName" class="form-control col-xs-2" rows="5" required>{{old('name', $item->name) }}</textarea></td></tr>
                            <tr><th>対応者</th><td>{{ $item->handleuser_name }}</td></tr>
                            <tr><th>対応日</th><td>{{ $item->handle_at->format('Y-m-d') }}</td></tr>
                            <tr><th>備考</th><td>
                                <textarea name="remark" id="produntonInputRemark" class="form-control col-xs-2" rows="5">{{old('remark', $item->remark) }}</textarea></td></tr>
                            <tr><th>ステータス</th>
                                <td>
                                <selected id="productonInputStatus" name="status">
                                <select type=text class="form-control" name="status" id="productonInputStatus" >
                                    <!-- <option value=""></option> -->
                                    <option value="1" <?php if($item->status == "1") { echo "selected"; } ?>>未着手</option>
                                    <option value="2" <?php if($item->status == "2") { echo "selected"; } ?>>進行中</option>
                                    <option value="3" <?php if($item->status == "3") { echo "selected"; } ?>>待機</option>
                                    <option value="4" <?php if($item->status == "4") { echo "selected"; } ?>>中断</option>
                                    <option value="5" <?php if($item->status == "5") { echo "selected"; } ?>>完了</option>
                                </select>     
                                </td></tr>
                            <tr><th>完了日</th><td>
                                <input type="date" class="form-control" id="produntonInputComp_at" name="comp_at" >{{ old('comp_at',$item->comp_at) }}</td></tr>
                    </table>
                </div>
                      
                <div class="mb-2">
                    <button type="submit" class="btn btn-primary btn-sm">更新</button>
                </div>
            </form>

@stop

@section('css')
@stop

@section('js')
@stop
