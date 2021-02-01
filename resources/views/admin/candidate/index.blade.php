
<h1>Listagem de candidatos{{ isset($offer) ? ": " . $offer->title : ""}} </h1>
<a href="{{ isset($offer) ? route('download.files', ['url' => $offer->url]) : route('download.files') }}">Baixar Currículos</a>
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
@endforeach