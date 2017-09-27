<?php

namespace App;

use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Audit extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'method', 'path', 'query', 'userAgent', 'ip', 'device' , 'platform', 'browser' , 'isDesktop', 'isMobile' , 'isPhone' , 'isTablet'
    ];


    public function user ()
    {
        return $this->belongsTo(User::class);
    }


    /**
     * Get online users
     *
     * @param int $min
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function online ($min = 3)
    {

        return $this->select('user_id')
                    ->where('audits.created_at', '>=', Carbon::now()->subMinutes($min)->toDateTimeString())
                    ->distinct('user_id')
                    ->with('user')
                    ->get()->map(function ($item) {
                        return $item->user;
                    });

    }
}
