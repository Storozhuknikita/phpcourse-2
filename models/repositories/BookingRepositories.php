<?php
namespace App\models\repositories;

use App\models\entities\Booking;

/**
 * Class BookingRepository
 * @package App\models\repositories
 *
 * @method Booking getOne($id)
 */
class BookingRepository extends Repository
{
    protected function getTableName()
    {
        return 'booking';
    }

    protected function getEntityName()
    {
        return Booking::class;
    }

    public function getAllBooking($userId)
    {
        $sql = "SELECT b.id, u.fio, b.items FROM booking b
JOIN users u ON u.id = b.user_id WHERE u.id = :id ";
        return $this->queryObjects($sql, [":id" => $userId]);
//        return $this->bd->queryObjects($sql, $this->getEntityName(), [":id" => $userId]);
    }
}