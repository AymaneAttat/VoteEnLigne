<?php

namespace App\Http\Controllers;

use App\Models\Vote;
use App\Models\User;
use App\Models\Condidat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class VoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $votes = Vote::orderBy('created_at', 'desc')->get();
        //$this->authorize('viewAny', Auth::user());
        $this->authorize('viewAny', Vote::class);
        return view('vote.index')->with('votes', $votes);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function archive()
    {
        $votes = Vote::onlyTrashed()->get();
        //$this->authorize('archive', $votes);
        $this->authorize('archive', Vote::class);
        return view('vote.index')->with('votes', $votes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //$this->authorize('create', Vote::class);
        $condidats = Condidat::all();
        return view('vote.create')->with('condidats', $condidats);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //$this->authorize('create', Vote::class);
        
        
        if(Auth::check()){
            $this->validate($request, [
                'prenom' => 'required|max:255',
                'condidat_nom' => 'required'
            ]);
            $this->authorize('create', Vote::class);
            $vote = new Vote();
            $vote->nom = Auth::user()->name;
            $vote->prenom = $request->input('prenom');
            $vote->cin = Auth::user()->cin;
            $vote->email = Auth::user()->email;
            $vote->naissance = $request->input('naissance');
            $vote->condidat_nom = $request->input('condidat_nom');
            $vote->condidat_id = $vote->findId($vote->condidat_nom);
            $user = User::findOrFail(Auth::user()->id);
            $user->voted = true;
            $user->save();
            $vote->save();
            $request->session()->flash('status', 'Voté avec succès');
            return redirect()->route('vote.create')->withSuccessMessage('Voté avec succès');
        }
        $this->validate($request, [
            'email' => 'required|string|max:255|email|unique:users',
            'cin' => 'required|max:255|unique:users',
            'nom' => 'required|max:255',
            'prenom' => 'required|max:255',
            'condidat_nom' => 'required'
        ]);
        $vote = new Vote();
        $vote->nom = $request->input('nom');
        $vote->prenom = $request->input('prenom');
        $vote->cin = $request->input('cin');
        $vote->email = $request->input('email');
        $vote->naissance = $request->input('naissance');
        $vote->condidat_nom = $request->input('condidat_nom');
        $vote->condidat_id = $vote->findId($vote->condidat_nom);
        //$vote->condidat_id = $vote->condidat()->id;
        $user = User::create([
            'name' => $vote->nom,
            'email' => $vote->email,
            'cin' => $vote->cin,
            'password' => Hash::make($vote->cin),
            'is_admin'=> 0,
            'role_id'=> 4,
            'voted' => true,
        ]);
        $vote->save();
        $request->session()->flash('status', 'Voté avec succès');
        return redirect()->route('vote.create')->withSuccessMessage('Voté avec succès');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $vote = Vote::findOrFail($id);
        //$this->authorize('delete', $vote);
        $this->authorize('delete', Vote::class);
        $vote->delete();
        //Post::destroy($id);
        $request->session()->flash('status', 'Vote à été supprimer');
        return redirect()->route('vote.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore(Request $request, $id)
    {
        $vote = Vote::onlyTrashed()->where('id', $id)->first();
        //$this->authorize('restore', $vote);
        $this->authorize('restore', Vote::class);
        $vote->restore();
        $request->session()->flash('status', 'Vote à réstorer');
        return redirect()->route('vote.index');
    }
}
