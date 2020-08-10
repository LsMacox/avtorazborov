<?php

namespace App\Repositories\Admin\Synonym;

use App\Models\Synonym\SynonymTransportName as Model;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\CoreRepository;

/**
 * Class SynonymTransportWordRepository
 *
 * @package App\Repositories
 */
class SynonymTransportNameRepository extends CoreRepository
{

    /**
     * @return string
     */
    protected function getModelClass()
    {
        return Model::class;
    }

    /**
     * Получить все слова
     */
    public function getAll()
    {
        return $this->startConditions()->with('synonym_transport_synonyms')->get();
    }

    public function getPaginateByPage($pageSize)
    {
        return $this->startConditions()->with('synonym_transport_synonyms')->paginate($pageSize);
    }

    /**
     * Получить все синонимы с пагинацией
     *
     * @return Collection
     */
    public function getForComboPaginate(int $count)
    {
        return $this->startConditions()->with('synonym_transport_synonyms')->paginate($count);
    }

    /**
     * Получить синоним по Id
     *
     * @param int $id
     * @return mixed
     */
    public function getById(int $id)
    {
        return $this->startConditions()->where('id', $id)->with('synonym_transport_synonyms')->first();
    }

    /**
     * Создание синонима
     *
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        return $this->startConditions()->create($data);
    }

    /**
     * Обновление синонима
     *
     * @param $id
     * @return mixed
     */
    public function update($data, int $id)
    {
        $word = $this->startConditions()->find($id);

        $word->update(['name' => $data['name']]);

        foreach ($word->synonym_transport_synonyms as $synonym) {
            $synonym->update(['name' => $data['SYNONYM_'.$synonym->id]['name']]);
        }
    }

    public function destroy($id)
    {
        $word = $this->startConditions()->find($id);

        foreach ($word->synonym_transport_synonyms as $synonym) {
            $synonym->delete();
        }

        $word->delete();
    }

}