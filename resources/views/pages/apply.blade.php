<h1>Vaga: {{ $offer->title }}</h1>

<form action="{{ route('nav.submit', ['url'=> $offer->url]) }}" method="post" enctype="multipart/form-data">
    @csrf
    <p><input type="text" name="name" placeholder="Nome"></p>
    <p><input type="text" name="surname" placeholder="Sobrenome"></p>
    <p><input type="text" name="city" placeholder="Cidade"></p>
    <p><input type="text" name="birthdate" placeholder="Data nascimento">
    <small>Data deve ser do formato: YYYY-MM-DD</small></p>
    <p><input type="file" name="document" id="" accept="application/pdf"></p>
    <p><input type="submit" value="Candidatar-se"></p>
</form>