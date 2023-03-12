<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Technicien extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'technicien_id',
        'nom',
        'email',
        'adresse',
        'tel',
        'observation',
    ]; /**
    * Get all of the comment for the site
    *
    * @return \Illuminate\Database\Eloquent\Relations\HasMany
    */

   public function interventions(): HasMany
   {
       return $this->hasMany(Intervention::class);
   }}
