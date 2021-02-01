<h1>Criar nova vaga</h1>

<form action="{{ isset($organization)!="" ? route('organization.update', ['url' => $organization->url]) : route('organization.store') }}" method="post">
    <p><input type="text" name="name" placeholder="Nome" value="{{ isset($organization)!="" ? $organization->name : "" }}"></p>
    <p><input type="submit" value="Cadastrar"></p>
</form>