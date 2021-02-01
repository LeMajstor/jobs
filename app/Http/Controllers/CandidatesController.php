<?php

namespace App\Http\Controllers;

use App\Models\Candidates;
use Illuminate\Http\Request;

class CandidatesController extends Controller
{
    
    private $model;

    public function __construct()
    {
        $this->model = new Candidates();
    }


    public function list()
    { 
        $candidates = $this->model->get();
        return view('admin.candidate.index', ['candidates' => $candidates]);
    }

    public function offer(Request $request)
    {

        $offer_url = $request->route('url');
        $offer = \App\Models\Offers::where('url', $offer_url)->get()->first();

        if (isset($offer) && ! is_null($offer))
        {
            $candidates = $offer->candidates()->get();

            return view('admin.candidate.index', [
                'offer' => $offer,
                'candidates' => $candidates
            ]);
        }

        return redirect()->to('/')->with('status', 'Vaga não cadastrada!');
    
    }

    public function delete(Request $request)
    {
        $candidate_id = $request->route('id');
        $candidate = $this->model->find($candidate_id);

        if(! is_null($candidate) && isset($candidate))
        {
            
            $offer = $candidate->offers()->get()->first();
            @unlink(storage_path('app/'.$offer->url.'/'.$candidate->url.'.pdf'));
            $candidate->delete();            
            
            return redirect()->to('/')->with('status', 'Candidato deletado.');
        }

        return redirect()->to('/')->with('status', 'Candidato não encontrado!');

    }
}
