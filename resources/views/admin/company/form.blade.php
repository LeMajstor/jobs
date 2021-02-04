@extends('admin.layouts.default')
@section('admin.content')
    
<form action="{{ isset($organization) ? route('organization.update', ['url' => $organization->url]) : route('organization.store') }}" method="POST">
    @csrf
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1>{{ isset($organization) ? 'Editando ' . $organization->name : 'Cadastrar nova empresa' }}</h1>
            </div>
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Página Inicial</a></li>
                <li class="breadcrumb-item active">{{ isset($organization) ? 'Editando ' . $organization->name : 'Cadastrar nova empresa' }}</li>
            </ol>
            </div>
        </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="col-8">
                <!-- SELECT2 EXAMPLE -->
                <div class="card card-secondary">
                    <div class="card-header">
                        <h3 class="card-title">Formulário de cadastro</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Nome</label>
                                    <input type="text" class="form-control" type="text" name="name" placeholder="Empresa"
                                        value="{{ isset($organization)!="" ? $organization->name : "" }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-secondary float-right">{{ isset($organization) ? 'Editar' : 'Cadastrar' }}</button>
                    </div>
                </div>
               
            </div>
        </div>
    </section>
</form>

@endsection