<?php

namespace App\Models\Synonym;

use Illuminate\Database\Eloquent\Model;

use App\Models\Synonym\SynonymTransportSynonym;

class SynonymTransportName extends Model
{

    public function synonym_transport_synonyms()
    {
        return $this->hasMany(SynonymTransportSynonym::class);
    }

    protected $fillable = ['user_id', 'name'];

}
