<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Condidat;
use App\Models\User;
use App\Models\Vote;

class VoteCondidatController extends Controller
{
    /*public function index()
    {
        $votes = Vote::orderBy('created_at', 'desc')->get();
        foreach ($votes as $vote) {
            $cry = Crypt::decryptString($vote->condidat_nom);
            $vote->condidat_nom = $cry;
        }
        //$this->attributes['condidat_nom'] = Crypt::decryptString($value);
        //$this->authorize('viewAny', Auth::user());
        //$this->authorize('viewAny', Vote::class);
        return view('vote.index')->with('votes', $votes);
    }*/

    public function index(Request $request){
        $arr['nbvote'] = Vote::count();
        $arr['nbvoteTrashed'] = Vote::onlyTrashed()->count();
        $nb = Condidat::max('votes');
        $arr['condidat'] = Condidat::where('votes', $nb)->first();
        //$arr['condidat'] = Condidat::where('votes', max('votes'));
        $this->authorize('index.vote.condidat');
        $request->session()->flash('status', 'Actualisation effectuer');
        return view('dashboard')->with($arr);
        //dd($arr);
    }

    public function countVote(Request $request){
        $this->authorize('countVote');
        $condidats = Condidat::get();
        foreach ($condidats as $con) {
            $vote = Vote::where('condidat_id' , $con->id)->count();
            //Condidat::update([ 'votes' => $vote ]);
            $con->votes = $vote;
            $con->save();
        }
        $request->session()->flash('status', 'Chargement des votes effectuer');
        if(Auth::user()->is_admin){
           return redirect()->route('condidat.index'); 
        }elseif(Auth::user()->role_id == 3){
            return redirect()->route('vote.index');
        }
            
        //$comment = $post->comments()->create([
        //'content' => $request->content,
        //'user_id' => $request->user()->id ]);
    }
    
}
