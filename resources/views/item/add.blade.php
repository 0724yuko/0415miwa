@extends('adminlte::page')

@section('title', '対応カード')

@section('content_header')
    <h1>対応カード</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-10">
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

                        <div class="form-group">
                            <label for="client_id">顧客名</label>
                            <select class="form-control" name="client_id" >
                            <option value="">顧客を選択してください</option>    
                            <option value="1" <?php // if($client_id == "1") { echo "selected"; } ?>>北見海子(北海道)</option>
                            <option value="2" <?php //if($client_id == "2") { echo "selected"; } ?>>秋山里子(秋田県)</option>
                            <option value="3" <?php //if($client_id == "3") { echo "selected"; } ?>>森山青子(青森県)</option>
                            <option value="4" <?php //if($client_id == "4") { echo "selected"; } ?>>岩田守男(岩手県)</option>
                            <option value="5" <?php //if($client_id == "5") { echo "selected"; } ?>>福田操(福島県)</option>
                            <option value="6" <?php //if($client_id == "6") { echo "selected"; } ?>>新沼武(新潟県)</option>
                            <option value="7" <?php //if($client_id == "7") { echo "selected"; } ?>>岡田忠雄(岡山県)</option>
                            <option value="8" <?php //if($client_id == "8") { echo "selected"; } ?>>沖田春雄(沖縄県)</option>
                            <option value="9" <?php //if($client_id == "9") { echo "selected"; } ?>>永井雄大(長崎県)</option>
                            <option value="10" <?php //if($client_id == "10") { echo "selected"; } ?>>宮田五郎(宮崎県)</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="user_id">登録者</label>
                            <select class="form-control" name="user_id" >
                            <option value="1" <?php //if($user_id == "1") { echo "selected"; } ?>>テック太郎</option>
                            <option value="2" <?php //if($user_id == "2") { echo "selected"; } ?>>テック次郎</option>
                            <option value="3" <?php //if($user_id == "3") { echo "selected"; } ?>>佐藤あさひ</option>
                            <option value="4" <?php //if($user_id == "4") { echo "selected"; } ?>>鈴木かずま</option>
                            <option value="5" <?php //if($user_id == "5") { echo "selected"; } ?>>高橋さくら</option>
                            <option value="6" <?php //if($user_id == "6") { echo "selected"; } ?>>田中たいよう</option>
                            <option value="7" <?php //if($user_id == "7") { echo "selected"; } ?>>伊藤はやと</option>
                            <option value="8" <?php //if($user_id == "8") { echo "selected"; } ?>>渡辺まどか</option>
                            <option value="9" <?php //if($user_id == "9") { echo "selected"; } ?>>山本はるか</option>
                            <option value="10" <?php //if($user_id == "10") { echo "selected"; } ?>>中村そうた</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="handleuser_id">対応者</label>
                            <select class="form-control" name="handleuser_id" >
                            <option value="1" <?php //if($handleuser_id == "1") { echo "selected"; } ?>>テック太郎</option>
                            <option value="2" <?php //if($handleuser_id == "2") { echo "selected"; } ?>>テック次郎</option>
                            <option value="3" <?php //if($handleuser_id == "3") { echo "selected"; } ?>>佐藤あさひ</option>
                            <option value="4" <?php //if($handleuser_id == "4") { echo "selected"; } ?>>鈴木かずま</option>
                            <option value="5" <?php //if($handleuser_id == "5") { echo "selected"; } ?>>高橋さくら</option>
                            <option value="6" <?php //if($handleuser_id == "6") { echo "selected"; } ?>>田中たいよう</option>
                            <option value="7" <?php //if($handleuser_id == "7") { echo "selected"; } ?>>伊藤はやと</option>
                            <option value="8" <?php //if($handleuser_id == "8") { echo "selected"; } ?>>渡辺まどか</option>
                            <option value="9" <?php //if($handleuser_id == "9") { echo "selected"; } ?>>山本はるか</option>
                            <option value="10" <?php //if($handleuser_id == "10") { echo "selected"; } ?>>中村そうた</option>
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
                            <input type="text" class="form-control" id="name" name="name" placeholder="対応内容">
                        </div>

                        <div class="form-group">
                            <label for="remark">備考</label>
                            <input type="text" class="form-control" id="remark" name="remark" placeholder="備考">
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

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">登録/更新</button>
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
