@extends('layouts.app')

@section('title', 'Accueil')

@section('content')
<div class="content-container">
    <h1 class="welcome-title">Bienvenue sur l'application de gestion bancaire</h1>
    <p class="welcome-text">Utilisez le menu pour naviguer entre les Clients, Comptes et Virements.</p>
    <a href="/comptes" class="welcome-btn">Explorer l'application</a>
</div>

<style>
.content-container {
    position: relative;
    z-index: 10;
    text-align: center;
    max-width: 600px;
    padding: 2rem;
}

.welcome-title {
    font-size: 3.5rem;
    font-weight: 800;
    margin-bottom: 1.5rem;
    background: linear-gradient(to right, #fff, #acacac);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    text-shadow: 0 0 20px rgba(255, 255, 255, 0.1);
}

.welcome-text {
    font-size: 1.2rem;
    line-height: 1.6;
    color: rgba(255, 255, 255, 0.8);
    margin-bottom: 2rem;
}

.welcome-btn {
    background: linear-gradient(90deg, #ff3a82, #5233ff);
    color: white;
    font-weight: 600;
    font-size: 1rem;
    padding: 0.8rem 2rem;
    border: none;
    border-radius: 50px;
    cursor: pointer;
    transition: all 0.3s ease;
    text-transform: uppercase;
    letter-spacing: 1px;
    box-shadow: 0 4px 20px rgba(255, 58, 130, 0.3);
    text-decoration: none;
    display: inline-block;
}

.welcome-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 25px rgba(255, 58, 130, 0.4);
    color: white;
}
#dev{
    position: fixed;
    bottom: 10px;
    right: 10px;
    justify-content: center;
    background-color: rgba(0, 0, 0, 0.5);
    color: white;
    padding: 5px 10px;
    border-radius: 5px;
    font-size: 12px;
    z-index: 1000;
    margin-left:50% ;
}
</style>
<nav id="dev">developer : Yassine and Mouad</nav>

@endsection