<?php
namespace App\models\repositories;

use App\models\entities\User;

/**
 * Class UserRepository
 * @package App\models\repositories
 *
 * @method User getOne($id)
 */
class UserRepository extends Repository
{
    /**
     * @return string
     */
    protected function getTableName()
    {
        return 'users';
    }

    /**
     * @return string
     */
    protected function getEntityName()
    {
        return User::class;
    }
}
