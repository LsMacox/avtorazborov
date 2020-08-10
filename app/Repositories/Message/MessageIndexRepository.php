<?php

namespace App\Repositories\Message;

use App\Models\Message as Model;
use App\Repositories\CoreRepository;

/**
 * Class MessageIndexRepository
 *
 * @package App\Repositories
 */
class MessageIndexRepository extends CoreRepository
{

    /**
     * @return mixed|string
     */
    protected function getModelClass()
    {
        return Model::class;
    }

    /**
     * Сохранить текстовое сообщение
     *
     * @param $contact_id
     * @param $text
     * @param $proposal_id
     * @param bool $admin
     * @param string $admin_id
     * @param string $from_id
     * @return mixed
     */
    public function createText($contact_id, $text, $proposal_id, $admin = false, $admin_id = '', $from_id = '')
    {
        $data = [
            'from' => auth()->id(),
            'to' => $contact_id,
            'text' => $text,
            'proposal_id' => $proposal_id,
            'admin_id' => $admin_id,
            'admin' => $admin
        ];

        if ($admin && !empty($from_id)) $data['from'] = $from_id;

        $message = $this->startConditions()->create($data);

        return $message;
    }

    /**
     * Сохранить файловое сообщение
     *
     * @param $contact_id
     * @param $path
     * @param $proposal_id
     * @param bool $admin
     * @param string $admin_id
     * @param string $from_id
     * @return mixed
     */
    public function createFile($contact_id, $path, $proposal_id, $admin = false, $admin_id = '', $from_id = '')
    {
        $data = [
            'from' => auth()->id(),
            'to' => $contact_id,
            'proposal_id' => $proposal_id,
            'file_status' => true,
            'file_path' => $path,
            'admin_id' => $admin_id,
            'admin' => $admin
        ];

        if ($admin && !empty($from_id)) $data['from'] = $from_id;

        $message = $this->startConditions()->create($data);

        return $message;
    }

}