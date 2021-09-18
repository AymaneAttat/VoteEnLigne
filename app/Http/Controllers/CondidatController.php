<?php

namespace App\Http\Controllers;

use App\Models\Condidat;
use App\Models\Vote;
use App\Models\User;
use App\Models\VoteTimeOut;
use Illuminate\Http\Request;

class CondidatController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $condidats = Condidat::orderBy('created_at', 'desc')->with('votestimeout')->paginate(3);
        //$voteend = VoteTimeOut::where($condidats->end_vote_id, 'id')->first();
        //dd($voteend);
        //$this->authorize('viewAny', $condidats);->get()->with('votestimeout')->paginate(3)
        $this->authorize('viewAny', Condidat::class);
        //dd(VoteTimeOut::all());
        return view('condidat.index')->with('condidats', $condidats);
    }

    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function archive()
    {
        $condidats = Condidat::onlyTrashed()->paginate(3);
        //$this->authorize('archive', $condidats);->get()
        $this->authorize('archive', Condidat::class);
        return view('condidat.index')->with('condidats', $condidats);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Condidat::class);
        $endvotes = VoteTimeOut::all();
        return view('condidat.create')->with('endvotes', $endvotes);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', Condidat::class);
        $this->validate($request, [
            'nom' => 'required|max:255',
            'prenom' => 'required|max:255',
            'description' => 'required',
            'end_vote_id' => 'required'
        ]);
        $condidat = new Condidat();
        $condidat->nom = $request->input('nom');
        $condidat->prenom = $request->input('prenom');
        $condidat->description = $request->input('description');
        $condidat->votes = $request->input('votes');
        $condidat->end_vote_id = $request->input('end_vote_id');
        $condidat->save();
        $request->session()->flash('status', 'Création avec succès');
        return redirect()->route('condidat.create')->withSuccessMessage('Création avec succès');
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
        $condidat = Condidat::findOrFail($id);
        //$this->authorize('delete', $condidat);
        $this->authorize('delete', Condidat::class);
        $condidat->delete();
        //Post::destroy($id);
        $request->session()->flash('status', 'Condidat à été supprimer');
        return redirect()->route('condidat.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore(Request $request, $id)
    {
        $condidat = Condidat::onlyTrashed()->where('id', $id)->first();
        //$this->authorize('restore', $condidat);
        $this->authorize('restore', Condidat::class);
        $condidat->restore();
        $request->session()->flash('status', 'Condidat à réstorer');
        return redirect()->route('condidat.index');
    }
}
