@extends('layouts.app')

@section('title', 'Gestion des Comptes')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="text-white">
            <i class="fas fa-credit-card me-2"></i>Gestion des Comptes
        </h1>
        <a href="{{ route('comptes.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i>Nouveau Compte
        </a>
    </div>

    <div class="card card-custom shadow">
        <div class="card-header bg-transparent border-bottom">
            <h5 class="card-title mb-0 text-white">
                <i class="fas fa-list me-2"></i>Liste des Comptes
            </h5>
        </div>
        <div class="card-body">
            @if($comptes->isEmpty())
                <div class="text-center py-5">
                    <i class="fas fa-credit-card fa-3x text-muted mb-3"></i>
                    <h4 class="text-muted">Aucun compte trouvé</h4>
                    <p class="text-muted">Commencez par créer votre premier compte.</p>
                    <a href="{{ route('comptes.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus me-2"></i>Créer un compte
                    </a>
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-custom table-hover">
                        <thead>
                            <tr>
                                <th>RIB</th>
                                <th>Client</th>
                                <th>Solde</th>
                                <th>Date Ouverture</th>
                                <th>Statut</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($comptes as $compte)
                            <tr>
                                <td class="font-monospace">{{ $compte->RIB }}</td>
                                <td>
                                    @if($compte->client)
                                        {{ $compte->client->nom }} {{ $compte->client->prenom }}
                                    @else
                                        <span class="text-warning">Client inconnu</span>
                                    @endif
                                </td>
                                <td class="fw-bold {{ $compte->solde >= 0 ? 'text-success' : 'text-danger' }}">
                                    {{ number_format($compte->solde, 2, ',', ' ') }} €
                                </td>
                                <td>
                                    @if($compte->date_ouverture)
                                        {{ \Carbon\Carbon::parse($compte->date_ouverture)->format('d/m/Y') }}
                                    @else
                                        <span class="text-muted">Non définie</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="badge bg-{{ $compte->statut === 'actif' ? 'success' : 'warning' }}">
                                        {{ ucfirst($compte->statut) }}
                                    </span>
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <button class="btn btn-info" disabled title="Détails">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <a href="{{ route('comptes.edit', $compte) }}" class="btn btn-warning" title="Modifier">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <!-- Pagination -->
                @if($comptes->hasPages())
                    <div class="d-flex justify-content-center mt-4">
                        {{ $comptes->links() }}
                    </div>
                @endif
            @endif
        </div>
    </div>
</div>
@endsection