@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">
                        <i class="fas fa-plus-circle me-2"></i>Ajouter un nouveau compte
                    </h4>
                    <a href="{{ route('comptes.index') }}" class="btn btn-light btn-sm">
                        <i class="fas fa-arrow-left me-1"></i> Retour à la liste
                    </a>
                </div>
                
                <div class="card-body">
                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <h5 class="alert-heading">
                                <i class="fas fa-exclamation-triangle me-2"></i>Erreurs de validation
                            </h5>
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <form action="{{ route('comptes.store') }}" method="POST" id="compteForm">
                        @csrf
                        
                        <div class="row">
                            <!-- Colonne Informations Compte -->
                            <div class="col-md-6">
                                <div class="border rounded p-4 h-100">
                                    <h5 class="text-primary mb-4">
                                        <i class="fas fa-credit-card me-2"></i>Informations du compte
                                    </h5>
                                    
                                    <div class="mb-3">
                                        <label for="RIB" class="form-label fw-semibold">
                                            RIB <span class="text-danger">*</span>
                                            <small class="text-muted">(20 caractères)</small>
                                        </label>
                                        <input type="text" 
                                               name="RIB" 
                                               id="RIB"
                                               class="form-control form-control-lg @error('RIB') is-invalid @enderror" 
                                               value="{{ old('RIB') }}"
                                               maxlength="20"
                                               placeholder="Ex: 12345678901234567890"
                                               required
                                               oninput="formatRIB(this)">
                                        @error('RIB')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <div class="form-text">
                                            Le RIB doit contenir exactement 20 caractères numériques.
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="solde" class="form-label fw-semibold">
                                            Solde initial <span class="text-danger">*</span>
                                        </label>
                                        <div class="input-group input-group-lg">
                                            <input type="number" 
                                                   name="solde" 
                                                   id="solde"
                                                   class="form-control @error('solde') is-invalid @enderror" 
                                                   value="{{ old('solde', 0) }}" 
                                                   min="0" 
                                                   max="1000000"
                                                   step="0.01"
                                                   required>
                                            <span class="input-group-text">€</span>
                                        </div>
                                        @error('solde')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <div class="form-text">
                                            Le solde initial ne peut pas être négatif.
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="date_ouverture" class="form-label fw-semibold">
                                            Date d'ouverture
                                        </label>
                                        <input type="date" 
                                               name="date_ouverture" 
                                               id="date_ouverture"
                                               class="form-control form-control-lg" 
                                               value="{{ old('date_ouverture', date('Y-m-d')) }}">
                                        <div class="form-text">
                                            Date à laquelle le compte est ouvert (par défaut aujourd'hui).
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Colonne Sélection Client -->
                            <div class="col-md-6">
                                <div class="border rounded p-4 h-100">
                                    <h5 class="text-primary mb-4">
                                        <i class="fas fa-user me-2"></i>Sélection du client
                                    </h5>

                                    <div class="mb-3">
                                        <label for="client_id" class="form-label fw-semibold">
                                            Client <span class="text-danger">*</span>
                                        </label>
                                        <select name="client_id" 
                                                id="client_id"
                                                class="form-select form-select-lg @error('client_id') is-invalid @enderror" 
                                                required>
                                            <option value="">Sélectionnez un client...</option>
                                            @foreach($clients as $client)
                                                <option value="{{ $client->id }}" 
                                                    {{ old('client_id') == $client->id ? 'selected' : '' }}
                                                    data-email="{{ $client->email }}"
                                                    data-telephone="{{ $client->telephone }}"
                                                    data-cin="{{ $client->cin }}">
                                                    {{ $client->nom }} {{ $client->prenom }} 
                                                    @if($client->cin)
                                                        ({{ $client->cin }})
                                                    @endif
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('client_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Informations client sélectionné -->
                                    <div id="clientInfo" class="card mt-3" style="display: none;">
                                        <div class="card-body bg-light">
                                            <h6 class="card-title text-primary">
                                                <i class="fas fa-info-circle me-2"></i>Informations du client
                                            </h6>
                                            <div class="row small">
                                                <div class="col-6">
                                                    <strong>Email:</strong>
                                                    <div id="clientEmail" class="text-muted">-</div>
                                                </div>
                                                <div class="col-6">
                                                    <strong>Téléphone:</strong>
                                                    <div id="clientTelephone" class="text-muted">-</div>
                                                </div>
                                                <div class="col-12 mt-2">
                                                    <strong>CIN:</strong>
                                                    <div id="clientCIN" class="text-muted">-</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Aucun client disponible -->
                                    @if($clients->isEmpty())
                                        <div class="alert alert-warning mt-3">
                                            <i class="fas fa-exclamation-triangle me-2"></i>
                                            <strong>Aucun client disponible.</strong>
                                            <a href="{{ route('clients.create') }}" class="alert-link">
                                                Créer un client d'abord
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Boutons d'action -->
                        <div class="row mt-4">
                            <div class="col-12">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <small class="text-muted">
                                            <span class="text-danger">*</span> Champs obligatoires
                                        </small>
                                    </div>
                                    <div class="btn-group">
                                        <button type="reset" class="btn btn-outline-secondary">
                                            <i class="fas fa-undo me-2"></i>Réinitialiser
                                        </button>
                                        <button type="submit" class="btn btn-success px-4">
                                            <i class="fas fa-save me-2"></i>Créer le compte
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Script JavaScript pour les interactions -->
@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Formatage du RIB (espace tous les 4 caractères)
    function formatRIB(input) {
        let value = input.value.replace(/\s/g, '');
        if (value.length > 0) {
            value = value.match(new RegExp('.{1,4}', 'g')).join(' ');
        }
        input.value = value;
    }

    // Affichage des informations du client sélectionné
    const clientSelect = document.getElementById('client_id');
    const clientInfo = document.getElementById('clientInfo');
    const clientEmail = document.getElementById('clientEmail');
    const clientTelephone = document.getElementById('clientTelephone');
    const clientCIN = document.getElementById('clientCIN');

    clientSelect.addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        
        if (selectedOption.value) {
            clientEmail.textContent = selectedOption.getAttribute('data-email') || '-';
            clientTelephone.textContent = selectedOption.getAttribute('data-telephone') || '-';
            clientCIN.textContent = selectedOption.getAttribute('data-cin') || '-';
            clientInfo.style.display = 'block';
        } else {
            clientInfo.style.display = 'none';
        }
    });

    // Validation du formulaire
    const form = document.getElementById('compteForm');
    form.addEventListener('submit', function(e) {
        const RIB = document.getElementById('RIB').value.replace(/\s/g, '');
        const solde = document.getElementById('solde').value;
        const clientId = document.getElementById('client_id').value;

        // Validation RIB
        if (RIB.length !== 20 || !/^\d+$/.test(RIB)) {
            e.preventDefault();
            alert('Le RIB doit contenir exactement 20 chiffres.');
            return;
        }

        // Validation solde
        if (parseFloat(solde) < 0) {
            e.preventDefault();
            alert('Le solde ne peut pas être négatif.');
            return;
        }

        // Validation client
        if (!clientId) {
            e.preventDefault();
            alert('Veuillez sélectionner un client.');
            return;
        }
    });

    // Afficher les infos du client si déjà sélectionné (en cas d'erreur de validation)
    if (clientSelect.value) {
        clientSelect.dispatchEvent(new Event('change'));
    }
});
</script>
@endsection

<style>
.card {
    box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
    border: 1px solid rgba(0, 0, 0, 0.125);
}

.card-header {
    border-bottom: 1px solid rgba(255, 255, 255, 0.2);
}

.form-control-lg, .form-select-lg {
    border-radius: 0.5rem;
}

.border {
    border-color: #e9ecef !important;
}

.input-group-text {
    background-color: #f8f9fa;
    border-color: #ced4da;
}

#clientInfo {
    transition: all 0.3s ease;
}
</style>
@endsection