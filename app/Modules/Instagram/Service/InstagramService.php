<?php


namespace App\Modules\Instagram\Service;

use App\Exceptions\NotAllowedTagException;
use App\Generics\GenericService;
use App\Modules\Instagram\Service\Contract\InstagramServiceInterface;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Cache\Repository as CacheRepository;

/**
 * Class InstagramService
 * @package App\Modules\Instagram\Service
 */
class InstagramService extends GenericService implements InstagramServiceInterface
{


    private $accessToken;
    /**
     * @var Client
     */
    private $client;

    private $limit = 100;

    private $apiURL = null;
    /**
     * @var Cache
     */
    private $cache;

    /**
     * @param Client $client
     * @param CacheRepository $cache
     * @param Carbon $carbon
     */
    function __construct(Client $client, CacheRepository $cache, Carbon $carbon)
    {
        $this->apiURL = config('instagram.api_url');
        $this->accessToken = config('instagram.access_token');
        $this->client = $client;
        $this->cache = $cache;
        $this->carbon = $carbon;
    }

    /**
     *
     * Returns media by tag
     *
     * @param $tag
     * @return \Illuminate\Support\Collection
     * @throws NotAllowedTagException
     */
    public function getRecentMediaByTag($tag)
    {
        $cacheKey = "tag_{$tag}";
        if( $this->cache->has($cacheKey)) return $this->cache->get($cacheKey);

        $response = $this->client->get("{$this->apiURL}tags/{$tag}/media/recent", [
            "query" => ['access_token' => $this->accessToken]
        ]);

        if($response->getStatusCode() == 400)
            throw new NotAllowedTagException("Not allowed.", "The tag is not allowed.");

        $media = $this->getCollection($response);

        $this->cache->put($cacheKey,$media,$this->carbon->now()->addMinute(15));
        return $media;
    }

    /**
     *
     * Returns user info
     *
     * @param $userId
     * @return mixed
     */
    public function getUserInfoById($userId)
    {
        $cacheKey = "user_{$userId}";
        if( $this->cache->has($cacheKey) ) return $this->cache->get($cacheKey);

        $response = $this->client->get("{$this->apiURL}users/{$userId}/", [
            "query" => ['access_token' => $this->accessToken]
        ]);

        $user = $this->getCollection($response);

        $this->cache->put($cacheKey,$user,$this->carbon->now()->addMinute(15));
        return $user;
    }

    /**
     *
     * Returns user media
     *
     * @param $userId
     * @return mixed
     */
    public function getUserMediaByUserId($userId)
    {
        $cacheKey = "user_media_{$userId}_{$this->limit}";
        if( $this->cache->has($cacheKey) ) return $this->cache->get($cacheKey);
        $response = $this->client->get("{$this->apiURL}users/{$userId}/media/recent/", [
            "query" => [
                'access_token' => $this->accessToken,
                'count' => $this->limit
            ]
        ]);

        $media = $this->getCollection($response);

        $this->cache->put($cacheKey,$media,$this->carbon->now()->addMinute(15));
        return $media;
    }

    /**
     * @param $limit
     * @return $this
     */
    public function limit($limit)
    {
        $this->limit = $limit;
        return $this;
    }

    /**
     * @param $response
     * @return mixed
     */
    private function getCollection($response)
    {
        $stream = $response->getBody();
        $json = json_decode($stream->getContents());
        return collect($json);
    }
}
