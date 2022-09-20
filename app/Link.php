<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use User;
use Auth;
//use App\File;

class Link extends Model
{

	protected $fillable = [
        'site_url', 'short_url',
    ];

    //
	public function user()
    {
        return $this->belongsTo(User::class, 'creator_id');
    }

	public static function validateLink(){
        return Validator::make(request()->all(), [
            'site_url' => 'required|string',
        ]);
    }

    public static function store($data){
        $creator_id =  auth()->user()->id;

    	$link = new Link;
    	$link->site_url = $data->site_url;
    	$link->creator_id = $creator_id;
    	$link->short_url = substr(md5(microtime()), rand(0, 26), 5);

        //$qr = \QrCode::size(5)->generate($link->short_url);
        //$link->qr_code = $qr;   	

    	return $link->save();
    }

}
