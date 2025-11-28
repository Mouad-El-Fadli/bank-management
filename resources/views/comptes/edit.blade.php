@extends('layouts.app')
@section('content')
<h1>Modifier un compte</h1>
<form action="{{ route('comptes.update', $compte->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label>RIB</label>
        <input type="text" name="RIB" class="form-control" value="{{ $compte->RIB }}" required>
    </div>
    <div class="mb-3">
        <label>Solde</label>
        <input type="number" name="solde" class="form-control" value="{{ $compte->solde }}" min="0" required>
    </div>
    <div class="mb-3">
        <label>Client</label>
        <select name="client_id" class="form-control" required>
            @foreach($clients as $client)
                <option value="{{ $client->id }}" {{ $compte->client_id == $client->id ? 'selected' : '' }}>
                    {{ $client->nom }} {{ $client->prenom }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label>Statut</label>
        <select name="statut" class="form-control" required>
            <option value="actif" {{ $compte->statut == 'actif' ? 'selected' : '' }}>Actif</option>
            <option value="inactif" {{ $compte->statut == 'inactif' ? 'selected' : '' }}>Inactif</option>
            <option value="bloque" {{ $compte->statut == 'bloque' ? 'selected' : '' }}>Bloqué</option>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Mettre à jour</button>
</form>
@endsection
