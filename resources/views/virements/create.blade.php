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
        <div class="card-header bg-transparent border-bottom">
            <h5 class="card-title mb-0 text-white">
                <i class="fas fa-list me-2"></i>Liste des Virements
            </h5>
        </div>
        <div class="card-body">
            <!-- Votre contenu virements ici -->
        </div>
    </div>
</div>
@endsection