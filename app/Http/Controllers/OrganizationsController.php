<?php

namespace App\Http\Controllers;

use App\Models\Organizations;
use Illuminate\Http\Request;

class OrganizationsController extends Controller
{
    private $model;

    public function __construct()
    {
        $this->model = new Organizations();
    }

    public function form(Request $request)
    {   
        $url = $request->route('url');

        if (isset($url) && ! is_null($url)) {
            $organization = $this->model->where('url', $url)->get()->first();
            return view('admin.company.form', [
                'organization' => $organization
            ]);
        } else {
            return view('admin.company.form');
        }
    }

    public function store(Request $request)
    {   
        
        $form = $request->only('name');
        $form['url'] = $this->url_verify($form['name'], $this->model);
       
        return $this->model->create($form) 
            ? redirect('/')->with('status', 'Organização cadastrada com sucesso')
            : redirect('/')->with('status', 'Erro ao cadastrar organização');
        
    }

    public function delete(Request $request)
    {
        $organization_url = $request->route('url');
        $organization = $this->model->where('url', $organization_url)->get()->first();

        if (isset($organization) && ! is_null($organization)) 
        {
            $organization->delete();
            return redirect('/')->with('status', 'Organização deletada!');
        }  

        return redirect('/')->with('status', 'Organização não cadastrada!');

    }


}
