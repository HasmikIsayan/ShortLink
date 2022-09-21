<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use App\User;
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
        if ($link->save()) {
            return self::createUserReport();
        }


    }

    public static function createUserReport() {
        $user = auth()->user();

        $path = storage_path('app/public/docs/user_docs/');
        $fileName = $user->id .'_reports.csv';
        $file = fopen($path.$fileName, 'w');
        $columns = array('Site Url', 'Short Url', 'Created Date');

        fputcsv($file, $columns);
        foreach ($user->links as $key => $link) {
            $data = [
                'Site Url' => $link->site_url,
                'Short Url' => $link->short_url,
                'Created Date' => $link->created_at,

            ];
            fputcsv($file, $data);
        }
        fclose($file);
            
        return true;
    }

}
