@if (session('status'))
    <div style="margin-bottom: 15px" class="alert alert-success">
        <b>{{ session('status') }}</b>
    </div>
@endif

@foreach($offers as $offer)
    <ul>
        <li>{{ $offer->title }}</li>
        <li>{{ $offer->description }}</li>
        <li><b>{{ $offer->organizations()->get()->first()->name }}</b></li>
        <a href="{{ route('nav.apply', ['url' => $offer->url]) }}">Candidate-se</a><br>
        <a href="{{ route('candidate.offer', ['url' => $offer->url]) }}">Ver candidatos</a>
        <a href="{{ route('offer.form', ['url' => $offer->url]) }}">Alterar</a>
        <a href="{{ route('offer.delete', ['url' => $offer->url]) }}">Deletar</a>
    </ul>
@endforeach

<h2 style="margin-top: 35px">Visualizar vagas apenas de: </h2>
<ul>
    @foreach($companies as $company)
    <li><a href="{{ route('nav.company', ['url' => $company->url]) }}">{{ $company->name }}</a> | 
        <a href="{{ route('organization.delete', ['url' => $company->url]) }}">Deletar</a></li>
    @endforeach
</ul>

<ul style="margin-top: 35px">
    <li><a href="{{ route('offer.form') }}">Cadastrar nova vaga</a></li>
    <li><a href="{{ route('organization.form') }}">Cadastrar nova empresa</a></li>
    <li><a href="{{ route('candidate.list') }}">Listar candidatos</a></li>
</ul>
