@extends('adminlte::page')

@section('title', '対応カード')

@section('content_header')
        <h1>対応カード</h1>
@stop

@section('content')
    <!-- <div class="row"> -->
    <div class = "container">   
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
                <form action="/items/store" method="POST">
                    @csrf
                    <div class="card-body">
                    <table>
                        <div class="form-group">
                            <label for="client_id">顧客名</label>
                            <select class="form-control" name="client_id" >
                            <option value="">顧客を選択してください</option> 
                            @foreach($clients as $client)   
                            <option value="{{ $client->id }}" @if( $client_id ==  $client->id ) selected @endif >{{ $client->name }}</option>
                            @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="user_id">登録者</label>
                            <select class="form-control" name="user_id" >
                            @foreach($users as $user)   
                            <option value="{{ $user->id }}" >{{ $user->name }}</option>
                            @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="handleuser_id">対応者</label>
                            <select class="form-control" name="handleuser_id" >
                            @foreach($users as $user)   
                            <option value="{{ $user->id }}" >{{ $user->name }}</option>
                            @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="makeitem_at">対応作成日</label>
                            <input type="date" class="form-control" id="makeitem_at" name="makeitem_at" placeholder="対応作成日">
                        </div>

                        <div class="form-group">
                            <label for="handle_at">対応日</label>
                            <input type="date" class="form-control" id="handle_at" name="handle_at" placeholder="対応日">
                        </div>

                        <div class="form-group">
                            <label for="name">対応内容</label>
                            <textarea class="form-control" id="name" name="name" rows="3" placeholder="対応内容" required>{{old('name')}}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="remark">備考</label>
                            <textarea class="form-control" id="remark" name="remark" rows="3" placeholder="備考">{{old('remark')}}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="status">ステータス</label>
                            <select class="form-control" name="status" >
                            <option value="1" <?php //if($status == "1") { echo "selected"; } ?>>未着手</option>
                            <option value="2" <?php //if($status == "2") { echo "selected"; } ?>>進行中</option>
                            <option value="3" <?php //if($status == "3") { echo "selected"; } ?>>待機</option>
                            <option value="4" <?php //if($status == "4") { echo "selected"; } ?>>中断</option>
                            <option value="5" <?php //if($status == "5") { echo "selected"; } ?>>完了</option>
                            </select>
                        </div>

                    </div>
                    </table>

                    <div class="btn-toolbar">
                        <div class="btn-group">
                            <button type="button" onClick="history.back()" class="btn btn-outline-primary">戻る</button>
                        </div>
                        <div class="col-md-9 text-right">
                            <input type="checkbox" name="continue_registration" id="continue_registration" value="1" style="transform:scale(2)">
                            <label for="continue_registration">　続けて登録</label>
                        </div> 
                        <div class="btn-group text-right ml-auto col-md-2">
                             <button type="submit" class="btn btn-outline-primary btn-m">登録</button>
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
