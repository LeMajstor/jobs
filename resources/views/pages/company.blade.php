<h1>Visualizando apenas de: {{ $company->name }}</h1>

@foreach($offers as $offer)
    <ul>
        <li>{{ $offer->title }}</li>
        <li>{{ $offer->description }}</li>
        <li><b>{{ $offer->organizations()->get()->first()->name }}</b></li>
        <a href="{{ route('nav.apply', ['url' => $offer->url]) }}">Candidate-se</a>
        <a href="{{ route('offer.delete', ['url' => $offer->url]) }}">Deletar</a>
    </ul>
@endforeach