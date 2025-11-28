@extends('layouts.app')

@section('title', 'À propos du développeur')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg border-0">
                <div class="card-header bg-primary text-white text-center py-4">
                    <h2 class="mb-0"><i class="fas fa-code me-2"></i>À propos du projet</h2>
                </div>
                <div class="card-body p-5">
                    <div class="text-center mb-5">
                        <div class="avatar mb-3">
                            <i class="fas fa-user-circle fa-5x text-primary"></i>
                        </div>
                        <h3 class="fw-bold">Développeur Full Stack</h3>
                        <p class="text-muted">Passionné par le développement web et les technologies modernes.</p>
                    </div>

                    <div class="mb-5">
                        <h4 class="border-bottom pb-2 mb-3 text-primary">Description du Projet</h4>
                        <p class="lead">
                            Cette application de gestion bancaire a été réalisée dans le cadre d'un mini-projet universitaire.
                            Elle vise à démontrer la maîtrise du framework <strong>Laravel</strong> et des concepts de programmation orientée objet.
                        </p>
                        <p>
                            L'application permet de gérer les clients, les comptes bancaires et d'effectuer des virements sécurisés avec génération de reçus PDF.
                        </p>
                    </div>

                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="p-3 border rounded bg-light h-100">
                                <h5 class="text-primary"><i class="fas fa-tools me-2"></i>Technologies</h5>
                                <ul class="list-unstyled mt-3">
                                    <li><i class="fab fa-laravel text-danger me-2"></i>Laravel 10</li>
                                    <li><i class="fab fa-php text-primary me-2"></i>PHP 8.1+</li>
                                    <li><i class="fab fa-bootstrap text-purple me-2"></i>Bootstrap 5</li>
                                    <li><i class="fas fa-database text-warning me-2"></i>MySQL / SQLite</li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="p-3 border rounded bg-light h-100">
                                <h5 class="text-primary"><i class="fas fa-check-circle me-2"></i>Fonctionnalités</h5>
                                <ul class="list-unstyled mt-3">
                                    <li><i class="fas fa-lock text-success me-2"></i>Authentification</li>
                                    <li><i class="fas fa-users text-info me-2"></i>Gestion Clients & Comptes</li>
                                    <li><i class="fas fa-exchange-alt text-warning me-2"></i>Virements Sécurisés</li>
                                    <li><i class="fas fa-file-pdf text-danger me-2"></i>Reçus PDF</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-light text-center py-3">
                    <small class="text-muted">&copy; {{ date('Y') }} - Tous droits réservés</small>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .text-purple { color: #6f42c1; }
</style>
@endsection
