<?php
namespace App\Modules\Instagram\Service\Contract;

/**
 * Interface InstagramServiceInterface
 * @package App\Modules\Instagram\Service\Contract
 */
interface InstagramServiceInterface {

    /**
     * @param $tag
     * @return mixed
     */
    public function getRecentMediaByTag($tag);

    /**
     * @param $userId
     * @return mixed
     */
    public function getUserInfoById($userId);

    /**
     * @param $limit
     * @return mixed
     */
    public function limit($limit);

    /**
     * @param $userId
     * @return mixed
     */
    public function getUserMediaByUserId($userId);
}
