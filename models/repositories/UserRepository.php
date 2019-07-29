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
    protected function getTableName()
    {
        return 'users';
    }

    protected function getEntityName()
    {
        return User::class;
    }
}
