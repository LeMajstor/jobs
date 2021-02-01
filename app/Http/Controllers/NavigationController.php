<?php

namespace App\Http\Controllers;

use App\Models\Candidates;
use App\Models\Offers;
use App\Models\Organizations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NavigationController extends Controller
{
    private $organizations;
    private $offers;

    public function __construct()
    {
        $this->organizations = new Organizations();
        $this->offers = new Offers();
    }

    public function index()
    {
        $offers = $this->offers->get();
        $companies = $this->organizations->get();
        
        return view('pages.index', [
            'offers' => $offers,
            'companies' => $companies
        ]);
    }

    public function apply(Request $request)
    {
        $offer_url = $request->route('url');
        $offer = $this->offers->where('url', $offer_url)->get()->first();

        return ! is_null($offer) && isset($offer) 
            ? view('pages.apply', ['offer' => $offer])
            : redirect()->to('/')->with('status', 'Vaga não encontrada.');
    }

    public function store(Request $request)
    {
        $form = $request->only('name', 'surname', 'city', 'birthdate', 'document');
        $offer_url = $request->route('url');

        $offer = $this->offers->where('url', $offer_url)->get()->first();
        $form['url'] = $this->url_verify($form['name'] .'-'. $form['surname'], new \App\Models\Candidates());

        if(! is_null($offer) && isset($offer)) {

            $candidate = \App\Models\Candidates::create($form);
            $candidate->offers()->attach($offer->id);
            
            $request->file('document')->storeAs(
                $offer->url, 
                $candidate->url .'.'. $request->file('document')->extension()
            );
            
            $form['document'] = asset('storage/app/'. $offer->url . '/' . $candidate->url . '.' . $request->file('document')->extension());
            $candidate->update($form);

            return redirect()->to('/')
                ->with('status', 'Usuário cadastrado.');

        } else {
            return ['error' => true, 'message' => 'Vaga não encontrada'];
        }

    }

    public function company(Request $request)
    {
        $company_url = $request->route('url');
        $company = $this->organizations->where('url', $company_url)->get()->first();

        $offers = $company->offers()->get();

        return view('pages.company', [
            'offers' => $offers,
            'company' => $company
        ]);

    }
    
}
