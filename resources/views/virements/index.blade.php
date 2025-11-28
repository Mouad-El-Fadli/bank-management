@extends('layouts.app')

@section('title', 'Gestion des Virements')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="text-white">
            <i class="fas fa-exchange-alt me-2"></i>Gestion des Virements
        </h1>
        <a href="{{ route('virements.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i>Nouveau Virement
        </a>
    </div>

    <div class="card card-custom shadow">
        <div class="card-body text-center py-5">
            @if(session('download_receipt'))
                <div class="alert alert-success mb-4">
                    <h4 class="alert-heading"><i class="fas fa-check-circle me-2"></i>Virement réussi !</h4>
                    <p>Votre virement a été traité avec succès.</p>
                    <hr>
                    <a href="{{ route('virements.receipt') }}" class="btn btn-dark">
                        <i class="fas fa-file-pdf me-2"></i>Télécharger le reçu
                    </a>
                </div>
            @endif

            <h3 class="text-white mb-4">Effectuer un virement bancaire</h3>
            <p class="text-white-50 mb-4">Transférez de l'argent entre les comptes en toute sécurité.</p>
            <a href="{{ route('virements.create') }}" class="btn btn-lg btn-success">
                <i class="fas fa-paper-plane me-2"></i>Commencer un virement
            </a>
        </div>
    </div>
</div>
@endsection