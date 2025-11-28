<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Reçu de Virement</title>
    <style>
        body {
            font-family: 'Helvetica', sans-serif;
            color: #333;
        }
        .container {
            width: 100%;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #eee;
            padding-bottom: 10px;
        }
        .logo {
            font-size: 24px;
            font-weight: bold;
            color: #0d6efd;
        }
        .details {
            margin-bottom: 30px;
        }
        .row {
            margin-bottom: 10px;
        }
        .label {
            font-weight: bold;
            width: 150px;
            display: inline-block;
        }
        .amount {
            font-size: 20px;
            font-weight: bold;
            color: #198754;
        }
        .footer {
            margin-top: 50px;
            text-align: center;
            font-size: 12px;
            color: #777;
            border-top: 1px solid #eee;
            padding-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="logo">BanqueApp</div>
            <p>Reçu de Transaction Électronique</p>
        </div>

        <div class="details">
            <div class="row">
                <span class="label">Date:</span>
                <span>{{ $date }}</span>
            </div>
            <div class="row">
                <span class="label">Référence:</span>
                <span>VIR-{{ time() }}</span>
            </div>
        </div>

        <div class="details" style="background-color: #f8f9fa; padding: 15px; border-radius: 5px;">
            <h3 style="margin-top: 0;">Détails du Virement</h3>
            <div class="row">
                <span class="label">Compte Source:</span>
                <span>{{ $source->RIB }}</span>
            </div>
            <div class="row">
                <span class="label">Émetteur:</span>
                <span>{{ $source->client->nom }} {{ $source->client->prenom }}</span>
            </div>
            <hr style="border: 0; border-top: 1px dashed #ccc; margin: 10px 0;">
            <div class="row">
                <span class="label">Compte Destinataire:</span>
                <span>{{ $destination->RIB }}</span>
            </div>
            <div class="row">
                <span class="label">Bénéficiaire:</span>
                <span>{{ $destination->client->nom }} {{ $destination->client->prenom }}</span>
            </div>
        </div>

        <div class="details" style="text-align: center; margin-top: 30px;">
            <p>Montant Transféré</p>
            <div class="amount">{{ number_format($montant, 2, ',', ' ') }} DH</div>
        </div>

        <div class="footer">
            <p>Ce document est généré électroniquement et ne nécessite pas de signature.</p>
            <p>BanqueApp - Gestion Bancaire Sécurisée</p>
        </div>
    </div>
</body>
</html>
