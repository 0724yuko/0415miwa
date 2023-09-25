<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Item extends Model
{
    /**
     * アイテムに関連している対応者(ユーザー)の取得
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    /**
     * アイテムに関連している顧客(クライアント)の取得
     */
    public function client()
    {
        return $this->belongsTo(Client::class);
    }


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'client_id',
        'handleuser_id',
        'makeitem_at',
        'handle_at',
        'name',
        'remark',
        'status',
        'comp_at',
    ];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'handle_at'=> 'datetime:Y-m-d'
    ];
}
