@extends('layouts.app')

@section('title', 'Connexion')

@section('content')
<div class="container">
    <div class="row justify-content-center min-vh-100 align-items-center">
        <div class="col-md-5">
            <div class="card shadow-lg border-0 rounded-lg">
                <div class="card-header bg-primary text-white text-center py-4">
                    <h3 class="font-weight-light my-2">Connexion</h3>
                </div>
                <div class="card-body p-5">
                    <form action="{{ route('login.post') }}" method="POST">
                        @csrf
                        <div class="form-floating mb-3">
                            <input class="form-control" id="email" name="email" type="email" placeholder="name@example.com" required />
                            <label for="email">Adresse Email</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input class="form-control" id="password" name="password" type="password" placeholder="Password" required />
                            <label for="password">Mot de passe</label>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                            <button class="btn btn-primary w-100" type="submit">Se connecter</button>
                        </div>
                    </form>
                </div>
                <div class="card-footer text-center py-3">
                    <div class="small"><a href="#" class="text-muted">Mot de passe oublié ?</a></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
