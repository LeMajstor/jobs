<?php

namespace App\Http\Controllers;

use App\Models\Offers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class OffersController extends Controller
{

    private $model;

    public function __construct()
    {
        $this->model = new Offers();

        View::share('organizations', \App\Models\Organizations::get());
        View::share('offers', \App\Models\Offers::get());
    }

    public function form(Request $request)
    {
        $companies = \App\Models\Organizations::get();
        $url = $request->route('url');
        
        if(isset($url) && ! is_null($url)) {
            $offer = $this->model->where('url', $url)->get()->first();
            
            if (! is_null($offer)) {
                return view('admin.offer.form', [
                    'companies' => $companies,
                    'offer' => $offer    
                ]);
            } else {
                // Mensagem de erro
                return redirect('/')->with('status', 'Vaga não cadastrada.');
            }

        } else {
            return view('admin.offer.form', [
                'companies' => $companies
            ]);
        }
    }

    public function store(Request $request) 
    {
        $form = $request->only('title', 'description', 'organizations_id');
        $organization = \App\Models\Organizations::find($form['organizations_id']);

        if (! is_null($organization) && isset($organization)) {
            $form['url'] = $this->url_verify($form['title'], $this->model);
            $offer = $this->model->create($form);
            if ($offer->organizations()->associate($organization)->save())
            {
                @mkdir(storage_path('app') .'/'. $offer->url);
                return redirect('/')->with('status', 'Vaga cadastrada com sucesso!');
            }
        } else {
            // Retorna com mensagem de erro
            return redirect('/')->with('status', 'Organização não cadastrada.');
        }
    }

    public function update(Request $request)
    {
        $form = $request->all();
        $offer_url = $request->route('url');

        $organization = \App\Models\Organizations::find($form['organizations_id']);
        
        if (! is_null($organization) && isset($organization)) {
            $form['url'] = $this->url_verify($form['title'], $this->model);
            
            $offer = $this->model->where('url', $offer_url)->get()->first();
        
            if (! is_null($offer) && isset($offer)) {
                $old_url = $offer->url;
                $offer->update($form);
                $offer->organizations()->dissociate();
                if ($offer->organizations()->associate($organization)->save())
                {
                    @rename(storage_path('app') .'/'. $old_url, storage_path('app') .'/'. $offer->url);
                    return redirect('/')->with('status', 'Vaga atualizada com sucesso!');
                }
            } else {
                 // Retorna com mensagem de erro
                return redirect('/')->with('status', 'Vaga não cadastrada.');
            }
        } else {
            // Retorna com mensagem de erro
            return redirect('/')->with('status', 'Organização não cadastrada.');
        }
    }

    public function delete(Request $request)
    {
        $offer_url = $request->route('url');
        $offer = $this->model->where('url', $offer_url)->get()->first();

        if(! is_null($offer) && isset($offer)) 
        {
            $offer->delete();
            return redirect('/')->with('status', 'Vaga deletada com sucesso.');
        } 
        
        return redirect('/')->with('status', 'Vaga não encontrada.');
    }


}
