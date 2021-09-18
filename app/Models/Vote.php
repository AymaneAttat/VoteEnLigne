<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Auth;
use App\Models\Condidat;
use App\Models\User;

class Vote extends Model
{
    use HasFactory, SoftDeletes;

    public function condidat(){
        return $this->belongsTo(Condidat::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function findId($value){
        $val = Crypt::decryptString($value);
        $cond = Condidat::where('nom', $val)->first();
        return $cond->id;
    }

    public function setcondidatNomAttribute($value){
        $this->attributes['condidat_nom'] = Crypt::encryptString($value);
    }

    public function getcondidatNomAttribute($value){
        if (Auth::check()) {
            if( in_array(Auth::user()->role_id, [1, 3]) ){
                try {
                    return Crypt::decryptString($value);
                } catch (DecryptException $e) {
                    //
                }
            }
            return $this->attributes['condidat_nom'];
        }
        
        return $this->attributes['condidat_nom'];
    }
}
