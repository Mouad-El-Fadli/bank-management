@extends('layouts.app')

@section('title', 'Nouveau Virement')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="text-white">
            <i class="fas fa-exchange-alt me-2"></i>Nouveau Virement
        </h1>
        <a href="{{ route('virements.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-2"></i>Retour
        </a>
    </div>

    <div class="card card-custom shadow">
        <div class="card-header bg-transparent border-bottom">
            <h5 class="card-title mb-0 text-white">
                <i class="fas fa-plus-circle me-2"></i>Formulaire de Virement
            </h5>
        </div>
        <div class="card-body">
            <form action="{{ route('virements.store') }}" method="POST">
                @csrf
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="compte_source" class="form-label text-white">Compte Source</label>
                            <select class="form-select" id="compte_source" name="compte_source" required>
                                <option value="">Sélectionnez un compte</option>
                                <option value="COMPTE-12345">COMPTE-12345 (Solde: 5 000,00 €)</option>
                                <option value="COMPTE-67890">COMPTE-67890 (Solde: 3 200,00 €)</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="compte_destination" class="form-label text-white">Compte Destination</label>
                            <input type="text" class="form-control" id="compte_destination" name="compte_destination" required placeholder="Numéro de compte destination">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="montant" class="form-label text-white">Montant</label>
                            <div class="input-group">
                                <input type="number" class="form-control" id="montant" name="montant" step="0.01" min="0.01" required placeholder="0.00">
                                <span class="input-group-text">€</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="date_virement" class="form-label text-white">Date du Virement</label>
                            <input type="date" class="form-control" id="date_virement" name="date_virement" required>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="motif" class="form-label text-white">Motif</label>
                    <textarea class="form-control" id="motif" name="motif" rows="3" placeholder="Raison du virement..."></textarea>
                </div>

                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button type="reset" class="btn btn-secondary me-md-2">
                        <i class="fas fa-redo me-2"></i>Réinitialiser
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-paper-plane me-2"></i>Effectuer le Virement
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection