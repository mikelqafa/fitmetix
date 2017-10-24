<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;

//use Illuminate\Database\Eloquent\SoftDeletes;

class Review extends Model
{
    //use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    //protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['rating', 'message', 'user_id', 'event_id', 'status'];

    /**
     * Validation rules.
     *
     * @var array
     */
    public static $rules = [
        'rating'    => 'required',
        'message'   => 'required',
        'event_id'  => 'exists:events,id',
        'status'    => 'in:1,2,3'
    ];


    public function event()
    {
        return $this->belongsTo('App\Event');
    }

    public function users()
    {
        return $this->belongsTo('App\User');
    }


    public function chkPageUser($event_id, $user_id) {
        $page_user = DB::table('reviews')->where('event_id', '=', $event_id)->where('user_id', '=', $user_id)->first();
        $result = $page_user ? $page_user : false;

        return $result;
    }

    public function updateStatus($page_user_id)
    {
        $page_user = DB::table('reviews')->where('id', $page_user_id)->update(['status' => 1]);
        $result = $page_user ? true : false;

        return $result;
    }


}
