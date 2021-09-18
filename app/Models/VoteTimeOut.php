<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Condidat;
use App\Models\User;

class VoteTimeOut extends Model
{
    use HasFactory;

    //protected $fillable = [ 'end_vote' ];
    protected $table = 'vote_time_outs';

    public function condidat(){
        return $this->hasOne(Condidat::class);
    }
}
