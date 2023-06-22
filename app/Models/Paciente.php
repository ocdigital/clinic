<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Typesense\LaravelTypesense\Interfaces\TypesenseDocument;
use Laravel\Scout\Searchable;

class Paciente extends Model implements TypesenseDocument
{
    use HasFactory;

    use Searchable;


    protected $fillable = [
        'nome',
        'data_nascimento',
        'sexo',
        'endereco',
        'telefone',
        'email',
        'historico_medico'
    ];

     /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray()
    {
        return array_merge(
            $this->toArray(), 
            [
                // Cast id to string and turn created_at into an int32 timestamp
                // in order to maintain compatibility with the Typesense index definition below
                'id' => (string) $this->id,
                'name' => (string) $this->nome,
                'created_at' => $this->created_at->timestamp,
            ]
        );
    }

      /**
     * The Typesense schema to be created.
     *
     * @return array
     */
    public function getCollectionSchema(): array {
        return [
            'nome' => $this->searchableAs(),
            'fields' => [
                [
                    'name' => 'id',
                    'type' => 'string',
                ],
                [
                    'name' => 'nome',
                    'type' => 'string',
                ],
                [
                    'name' => 'created_at',
                    'type' => 'int64',
                ],
            ],
            'default_sorting_field' => 'created_at',
        ];
    }

       /**
     * The fields to be queried against. See https://typesense.org/docs/0.24.0/api/search.html.
     *
     * @return array
     */
    public function typesenseQueryBy(): array {
        return [
            'nome',
        ];
    }    
}

