<?php

namespace App\Observers;

use App\Models\Compte;

class CompteObserver
{
    /**
     * Handle the Compte "created" event.
     */
    public function created(Compte $compte): void
    {
        //
    }

    /**
     * Handle the Compte "updated" event.
     */
    public function updated(Compte $compte): void
    {
        if ($compte->isDirty('solde')) {
            $originalSolde = $compte->getOriginal('solde');
            $newSolde = $compte->solde;
            \Illuminate\Support\Facades\Log::info("Compte {$compte->RIB} solde updated: {$originalSolde} -> {$newSolde}");
        }
    }

    /**
     * Handle the Compte "deleted" event.
     */
    public function deleted(Compte $compte): void
    {
        //
    }

    /**
     * Handle the Compte "restored" event.
     */
    public function restored(Compte $compte): void
    {
        //
    }

    /**
     * Handle the Compte "force deleted" event.
     */
    public function forceDeleted(Compte $compte): void
    {
        //
    }
}
