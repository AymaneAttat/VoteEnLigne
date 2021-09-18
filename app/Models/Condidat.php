<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\Models\VoteTimeOut;
use App\Models\Condidat;
use App\Models\User;

class Condidat extends Model
{
    use HasFactory, SoftDeletes;
    
    public function votestimeout(){
        return $this->belongsTo(VoteTimeOut::class, 'end_vote_id');
    }

    public function vote(){
        return $this->hasOne(Vote::class);
    }
    
    
}
