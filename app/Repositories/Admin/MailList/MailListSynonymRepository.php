<?php

namespace App\Repositories\Admin\MailList;

use App\Models\Alert\ShopProfileAlertSynonym as Model;
use App\Repositories\CoreRepository;

/**
 * Class MailListSynonymRepository
 *
 * @package App\Repositories
 */
class MailListSynonymRepository extends CoreRepository
{

    /**
     * @return string
     */
    protected function getModelClass()
    {
        return Model::class;
    }

    public function getById($id)
    {
        return $this->startConditions()->find($id);
    }

    public function store($data)
    {
        $synonym = $this->startConditions()->where('user_id', $data['user_id'])->where('name', $data['name']);

        if ($synonym->count() > 0)
        {
            $synonym = $synonym->first();
            $synonym->select = 1;
            $synonym->save();
        }else{
            $synonym = $this->startConditions()->create($data);
            $synonym->select = 1;
            $synonym->save();
        }

        return $synonym;
    }

    public function destroy($id)
    {
        $synonym = $this->getById($id);
        $synonym->select = 0;
        $synonym->save();
    }

    public function destroyAll()
    {
        return $this->startConditions()->where('user_id', auth()->id())->delete();
    }

    public function storeCollection($data)
    {
        foreach ($data as $synonym)
        {
            $this->startConditions()->create([
                'user_id' => auth()->id(),
                'name' => $synonym
            ]);
        }
    }

}