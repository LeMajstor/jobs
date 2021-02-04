@extends('admin.layouts.default')
@section('css')
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('admin/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
<!-- summernote -->
<link rel="stylesheet" href="{{ asset('admin/plugins/summernote/summernote-bs4.min.css') }}">
<style>
    .note-editable.card-block { min-height: 150px }
</style>
@endsection

@section('admin.content')

<form action="{{ isset($offer) ? route('offer.update', ['url' => $offer->url]) : route('offer.store') }}" method="POST">
    @csrf
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1>{{ isset($offer) ? 'Editando: ' . $offer->title : 'Cadastrar nova vaga' }}</h1>
            </div>
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Página Inicial</a></li>
                <li class="breadcrumb-item active">{{ isset($offer) ? 'Editando ' . $offer->title : 'Cadastrar nova vaga' }}</li>
            </ol>
            </div>
        </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="col-8">
                <div class="card card-primary">
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
                                    <input type="text" class="form-control" type="text" name="title" placeholder="Cargo"
                                        value="{{ isset($offer)!="" ? $offer->title : "" }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Descrição</label>
                                    <textarea id="summernote" name="description"
                                        placeholder="Descrição">{{ isset($offer)!="" ? $offer->description : "" }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Empresa</label>
                                    <select class="form-control select2" name="organizations_id" style="width: 100%;">
                                        @foreach ($companies as $company)
                                        <option value="{{ $company->id }}" @if (isset($offer)){{ $offer->organizations()->get()->first()->id == $company->id ? 'selected' : '' }} @endif>
                                            {{ $company->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary float-right">{{ isset($offer) ? 'Salvar Alterações' : 'Cadastrar' }}</button>
                    </div>
                </div>
               
            </div>
        </div>
    </section>
</form>

@endsection

@section('js')
<!-- Select2 -->
<script src="{{ asset('admin/plugins/select2/js/select2.full.min.js') }}"></script>
<!-- Summernote -->
<script src="{{ asset('admin/plugins/summernote/summernote-bs4.min.js') }}"></script>
<script>
    $(function () {
        //Initialize Select2 Elements
        $('.select2').select2()
        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })

        // Summernote
        $('#summernote').summernote({
            toolbar: [
                // [groupName, [list of button]]
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough', 'superscript', 'subscript']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']]
            ]
        })

    })

</script>
@endsection
