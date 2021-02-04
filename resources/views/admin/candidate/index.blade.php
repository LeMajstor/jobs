@extends('admin.layouts.default')
@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="{{ asset('admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{ asset('admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
@endsection
@section('admin.content')
    
    {{-- <h1>Listagem de candidatos{{ isset($offer) ? ": " . $offer->title : ""}} </h1>
    <a href="{{ isset($offer) ? route('download.files', ['url' => $offer->url]) : route('download.files') }}">Baixar
        Currículos</a>
    @foreach($candidates as $candidate)
    <ul>
        <hr>
        <li>Nome: {{ $candidate->name }}</li>
        <li>Sobrenome: {{ $candidate->surname }}</li>
        <li>Cidade: {{ $candidate->city }}</li>
        <li>Data de nascimento: {{ $candidate->birthdate }}</li>
        <li>Registrado em: {{ $candidate->created_at }}</li>
        <a href="{{ route('candidate.delete', ['id' => $candidate->id]) }}">Deletar</a>
    </ul>
    @endforeach --}}

      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1>Vaga: {{ $offer->title }} 
                <span style="font-size: 18px">
                    <a class="ml-3" href="{{ route('offer.form', ['url' => $offer->url]) }}"><i class="ml-3 fas fa-edit"></i> Editar</a>
                </span>
            </h1>
            </div>
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Página Inicial</a></li>
                <li class="breadcrumb-item active">{{ $offer->title }}</li>
            </ol>
            </div>
        </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="col-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Listagem de candidatos</h3>
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
                                <table id="datatable-default" class="table table-bordered table-striped mb-0"
                                id="datatable-default" data-delete="{{ route('candidate.delete') }}"
                                data-single="{{ route('candidate.single') }}"
                                data-list="{{ route('candidate.list.all', ['url' => $offer->url]) }}" data-cols='[
                                    { "data": "name","title":"Nome" },
                                    { "data": "surname","title":"Sobrenome" },
                                    { "data": "city","title":"Cidade" },
                                    { "data": "birthdate","title":"Data de Nascimento" },
                                    { "title":"Opções" }
                                ]'>
                                    <thead>
                                    </thead>
                                    <tbody>
                
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        @if ($offer->candidates()->count())
                            <button type="submit" class="btn btn-primary float-right" onclick="location.href='{{ route('download.files', ['url' => $offer->url]) }}'"><i class="fas fa-file-download mr-3"></i>Exportar Currículos</button>
                        @endif
                    </div>
                </div>
               
            </div>
        </div>
    </section>

@endsection

@section('js')
    <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ asset('admin/js/datatable.js') }}"></script>
@endsection