<?php

namespace App\Repositories\Admin\Help;

use App\Models\Help as Model;
use App\Repositories\CoreRepository;

/**
 * Class HelpIndexRepository
 *
 * @package App\Repositories
 */
class HelpIndexRepository extends CoreRepository
{

    /**
     * @return string
     */
    protected function getModelClass()
    {
        return Model::class;
    }

    public function getAll()
    {
        $helps = $this->startConditions()->all();

        return $helps;
    }

    public function getById($id)
    {
        $help = $this->startConditions()->find($id);

        return $help;
    }

    public function getRoutes()
    {
        return $this->startConditions()->getRoutes();
    }

    public function update($data, $id)
    {
        $help = $this->startConditions()->find($id);

        $help->update($data);

        return $help;
    }

    public function create($data)
    {
        $help = $this->startConditions()->create($data);

        return $help;
    }

    public function destroy($id)
    {
        $help = $this->startConditions()->find($id);
        $help->delete();

        return $help;
    }

}