<h1>Criar nova vaga</h1>

<form action="{{ isset($offer)!="" ? route('offer.update', ['url' => $offer->url]) : route('offer.store') }}" method="post">
    <p><input type="text" name="title" placeholder="Cargo" value="{{ isset($offer)!="" ? $offer->title : "" }}"></p>
    <p><textarea name="description" placeholder="Descrição">{{ isset($offer)!="" ? $offer->description : "" }}</textarea></p>
    <p>
        <select name="organizations_id">
            @foreach ($companies as $company)
                <option value="{{ $company->id }}" 
                    @if (isset($offer)){{ $offer->organizations()->get()->first()->id == $company->id ? 'selected' : '' }} @endif>
                    {{ $company->name }}
                </option>
            @endforeach
        </select>
    </p>
    <p><input type="submit" value="Cadastrar"></p>
</form>