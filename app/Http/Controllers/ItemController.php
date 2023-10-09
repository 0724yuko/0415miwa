<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Session;
use App\Models\Item;
use App\Models\Client;
use App\Models\User;

class ItemController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    
    /**
     * 対応一覧2
     */
    public function list(Request $request)
    {
        // dd($request);
        $query = Item::select([
            'items.*',
            'users.name as handleuser_name',
            'clients.name as client_name'
        ])
        ->join('clients', 'items.client_id', '=', 'clients.id')
        ->join('users', 'items.handleuser_id', '=', 'users.id')
        ->orderBy('updated_at','desc');
    
        // statusが5を除くチェックボックスがONの場合
        if ($request->input('exclude_completed')) {
            $query->where('items.status', '<>', 5);
        }
    
        $items = $query->paginate(10)->appends(['exclude_completed' => $request->exclude_completed]);
    
        return view('item.index', compact('items'));
    }

    /**
     * 対応一覧handle_atならべかえ
     */
    public function handle(Request $request)
    {
        //パラメーターからソート情報を取得
        $sort = $request->input('sort');
        $exclude_completed = $request->input('exclude_completed', 0);

        //ソートや「完了を除く」の条件に戻づいてデータを取得
        // dd($request);
        $query = Item::select([
            'items.*',
            'users.name as handleuser_name',
            'clients.name as client_name'
        ])
        ->join('clients', 'items.client_id', '=', 'clients.id')
        ->join('users', 'items.handleuser_id', '=', 'users.id');
        if($exclude_completed){
            $query->where('items.status', '<>', 5);
        }
        if($sort === 'asc'){
            $query->orderBy('handle_at', 'asc');
        }elseif($sort === 'desc'){
            $query->orderBy('handle_at', 'desc');
        }
        //他の条件に基づく絞り込みやソートを追加できます
        
        // ->orderBy('handle_at',$request->input('sort')??'asc');
        // //->orderBy('updated_at', 'asc');
    
        // // statusが5を除くチェックボックスがONの場合
        // if ($request->input('exclude_completed')) {
        //     $query->where('items.status', '<>', 5);
        // }
        //ページネーション
        $items = $query->paginate(10)->appends(['exclude_completed' => $request->exclude_completed,'sort'=>$request->sort]);
        //ビューにデータを渡す
        return view('item.index',[
            'items' => $items,
            'sort' => $sort,
            'exclude_completed' => $exclude_completed,
        ]);
           
    }
    
    ////セッションを使う

// public function list(Request $request)
// {
//     $query = Item::select([
//         'items.*',
//         'users.name as handleuser_name',
//         'clients.name as client_name'
//     ])
//     ->join('clients', 'items.client_id', '=', 'clients.id')
//     ->join('users', 'items.handleuser_id', '=', 'users.id')
//     ->orderBy('updated_at', 'desc');

//     // statusが5を除くチェックボックスがONの場合
//     if ($request->input('exclude_completed')) {
//         $query->where('items.status', '<>', 5);
//         Session::put('exclude_completed', true);
//     } else {
//         Session::forget('exclude_completed');
//     }

//     $items = $query->paginate(3);
//     $excludeCompleted = Session::get('exclude_completed', false);

//     return view('item.index', compact('items', 'excludeCompleted'));
// }


    /**
     * 対応一覧
     */
    public function index()
    {
        // 対応一覧取得
        // $items = Item::all();
        $items =Item::select([
            'items.*',
            'users.name as handleuser_name',
            'clients.name as client_name'
          ])->join('clients','items.client_id','=','clients.id')
        //   ->join('users','items.user_id','=','users.id')
          ->join('users','items.handleuser_id','=','users.id')
          ->orderBy('updated_at', 'desc')
          ->paginate(10);
        //   ->get();

        // select * from items join on items.user_id = users.id
        // select * from items join on items.client_id = clients.id
// dump($items);
        return view('item.index', compact('items'));
    }

    /**
     * 新規対応登録画面表示
     */
    public function add(Request $request , $client_id)
    {
        if($client_id=='new'){
            $client_id = null;
        }
        $clients = Client::all();
        $users = User::all();


        return view('item.add',compact('clients','users','client_id'));
    }
    // /**
    //  * 特定顧客新規対応登録画面表示
    //  */
    // public function add_client_id($client_id)
    // {
    //     $clients = Client::all();
    //     $users = User::all();


    //     return view('item.add',compact('clients','users'));
    // }

    //新規登録を保存
    public function store(Request $request)
    {      
        $messages = [
            'name.max' => '500文字までです。',
            'remark.max' => '500文字までです。',
            // 'detail.unique' => '重複しています。', 
        ];
        $request->validate([
            'client_id' => 'required',
            'user_id' => 'required',
            'handleuser_id' => 'required',
            'makeitem_at' => 'required|date',
            'handle_at' => 'required|date',
            'name' => 'required|max:500',
            'remark' => 'nullable|max:500',
            'status' => 'nullable',
            'comp_at' => 'nullable|date',
        ],$messages);

        $item = new Item;
        $item -> create([
            'client_id' => $request -> client_id,
            'user_id' =>  $request -> user_id,
            'handleuser_id' =>  $request -> handleuser_id,
            'makeitem_at' =>  $request -> makeitem_at,
            'handle_at' =>  $request -> handle_at,
            'name' =>  $request -> name,
            'remark' => $request -> remark,
            'status' =>  $request -> status,
            'comp_at' =>  $request -> comp_at,
        ]);

        // return redirect('/items');
        if($request->input('continue_registration') == 1) {
            //「続けて登録」にチェックが入っている場合
            $client_id = $request->input('client_id');
            return redirect('/items/add/'. $client_id);
            // return view('item.add',compact('clients','users','client_id'));
        }else{
            //チェックが入っていない場合
            return redirect('/items');
        }

        
    }






    //該当顧客IDの対応一覧を表示
    // public function clientitem(Request $request,$id)
    // {
    //     $client =Item::select([
    //         'items.*',
    //         'users.name as user_name',
    //         'clients.name as client_name'
    //       ])->join('clients','items.client_id','=','clients.id')
    //       ->join('users','items.user_id','=','users.id')
    //       ->where('clients.id','=',$id)
    //       ->orderBy('items.handle_at','desc')
    //       ->get();
    //     // $query = Item::query();

    //     $id = Client::find($id);
    //     // return view('item/index',['client' => $client]);
    //     return view('item.clientitem');
    // }

       // 該当IDの編集画面呼び出し

       public function itemcard(Request $request,$id)
       {
        //    $item = Item::find($id);

           $item =Item::select([
            'items.*',
            'users.name as handleuser_name',
            'clients.name as client_name'
          ])->join('clients','items.client_id','=','clients.id')
        //   ->join('users','items.user_id','=','users.id')
          ->join('users','items.handleuser_id','=','users.id')
          ->where('items.id',$id)->first();

    //     'users.name as handleuser_name',
    //     'clients.name as client_name'
    //   ])->join('clients','items.client_id','=','clients.id')
    // //   ->join('users','items.user_id','=','users.id')
    //   ->join('users','items.handleuser_id','=','users.id')
    //   ->get();
           return view('item.itemcard',['item' => $item]);
       } 

    // 削除処理
    public function delete($id)
    {
        Item::find($id)->delete();
        return redirect('/items');
    }    
    
       // 編集画面を保存
       public function update(Request $request,$id)
       {
        $messages = [
            'name.max' => '500文字までです。',
            'remark.max' => '500文字までです。',
           ];
   
           $request->validate([
            'name' => 'required|max:500',
            'remark' => 'nullable|max:500',
            'status' => 'nullable',
            'comp_at' => 'nullable|date',
        ],$messages);  
   
           $item = Item::find($id);
           $item->name = $request->name;
           $item->remark = $request->remark;
           $item->status = $request->status;
           $item->comp_at= $request->comp_at;
   
           $item->save();
           return redirect('/items');
       }

    // 担当者該当IDの対応一覧画面呼び出し

    public function useritem(Request $request,$id)
    {
        $sort = $request->input('sort');
        $query =Item::select([
        'items.*',
        'users.name as handleuser_name',
        'clients.name as client_name'
        ])
        ->join('clients','items.client_id','=','clients.id')
        ->join('users','items.handleuser_id','=','users.id')
        ->where('items.handleuser_id',$id);
        if($sort){
            $query->orderBy('handle_at',$sort);
        }else{
            $query->orderBy('updated_at', 'desc');
        }
        // statusが5を除くチェックボックスがONの場合
        if ($request->input('exclude_completed')) {
            $query->where('items.handleuser_id',$id)
            ->where('items.status', '<>', 5);
        }
        $items = $query->paginate(10)->appends(['exclude_completed' => $request->exclude_completed,'sort'=>$request->sort]);
        // ->paginate(10);
        // ->get();
        $handleuser_name = isset($items[0]) ? $items[0]->handleuser_name : '';


        return view('item.useritem',[
            'items' => $items,
            'handleuser_name' => $handleuser_name,
            'handleuser_id' => $id,
            'sort' => $sort
        ]);
    } 

       


    // 顧客該当IDの対応一覧画面呼び出し

    public function clientitems(Request $request,$id)
    {
        //クライアント情報を取得
        $client = Client::FindOrFail($id);
        //アイテム情報を取得
        $items =Item::select([
        'items.*',
        'users.name as handleuser_name',
        'clients.name as client_name',
        'clients.id as client_id'
        ])->orderBy('updated_at', 'desc')
        ->join('clients','items.client_id','=','clients.id')
    //   ->join('users','items.user_id','=','users.id')
        ->join('users','items.handleuser_id','=','users.id')
        ->where('items.client_id',$id)
        ->paginate(10);
        // ->get();
        $client_name = isset($items[0]) ? $items[0]->client_name : '';
        $client_id = isset($items[0]) ? $items[0]->client_id : '';
        // ☝データがないときのエラー回避

        return view('item.clientitems',[
            'items' => $items,
            'client_id' => $client_id,
            'client_name' => $client_name,
        ]);
    } 
}

