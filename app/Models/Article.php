<?php

namespace App\Models;

use App\Models\Commande;
use App\Models\Fournisseur;
use App\Models\Intervention;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Article extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $fillable = [
        'nom',
        'reference',
        'fournisseur_id',
        'marque',
        'prixAchat',
        'prixVente',
        'emplacement',
        'type',
        'designation',
        'unite',
        'quantite',
        'stockMin',
        'vente',
        'location',
    ];

    public function interventions(): BelongsToMany
    {
        return $this->belongsToMany(Intervention::class);
    }
    public function commandes(): HasMany  //
    {
        return $this->hasMany(Commande::class);
    }


    public function fournisseur() : BelongsTo
    {
        return $this->belongsTo(Fournisseur::class );
    }

    public function media():MorphMany {
        return $this->morphMany(Media::class, 'model');
    }

}
