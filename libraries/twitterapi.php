<?php
namespace mcanan\framework\libraries;

require dirname(__FILE__)."/twitterapi/autoload.php";
use Abraham\TwitterOAuth\TwitterOAuth;

class twitterapi
{
    private $twitterClient;

    public function __construct()
    {
    }

    public function init($ck, $cs, $oat, $oas)
    {
        $this->twitterClient = new TwitterOAuth($ck, $cs, $oat, $oas);
        $this->twitterClient->host = "https://api.twitter.com/1.1/";
    }

    public function getUserByScreenName($screen_name)
    {
        return $this->twitterClient->get('users/show', array('screen_name' => $screen_name));
    }

    public function getUserById($id)
    {
        return $this->twitterClient->get('users/show', array('user_id' => $id));
    }

    public function getFollowersById($id, $count, $cursor)
    {
        return $this->twitterClient->get(
            'followers/ids',
            array('user_id' => $id, 'count' => $count, 'cursor' => $cursor)
        );
    }

    public function getFriendsById($id, $count, $cursor)
    {
        return $this->twitterClient->get(
            'friends/ids',
            array('user_id' => $id, 'count' => $count, 'cursor' => $cursor)
        );
    }

    public function getFriendsByScreenName($screen_name, $count, $cursor)
    {
        return $this->twitterClient->get(
            'friends/ids',
            array('screen_name' => $screen_name, 'count' => $count, 'cursor' => $cursor)
        );
    }

    public function getTweetsById($id, $count, $exclude_replies, $include_rts, $since_id, $max_id)
    {
        if ($max_id>0) {
            return $this->twitterClient->get(
                'statuses/user_timeline',
                array('user_id' => $id,
                'count' => $count,
                'trim_user' => true,
                'exclude_replies' => $exclude_replies,
                'include_rts' => $include_rts,
                'since_id' => $since_id,
                'max_id' => $max_id)
            );
        } else {
            return $this->twitterClient->get(
                'statuses/user_timeline',
                array('user_id' => $id,
                'count' => $count,
                'trim_user' => true,
                'exclude_replies' => $exclude_replies,
                'include_rts' => $include_rts,
                'since_id' => $since_id)
            );
        }
    }

    public function getUsers($users)
    {
        return $this->twitterClient->get('users/lookup', array('user_id' => $users));
    }

    public function getTweets($ids, $include_entities = false)
    {
        return $this->twitterClient->get(
            'statuses/lookup',
            array('id' => $ids, 'map' => true, 'include_entities' => $include_entities)
        );
    }

    public function update($mensaje)
    {
        return $this->twitterClient->post('statuses/update', array('status' => "$mensaje" ), false);
    }

    public function update_with_media($mensaje, $imagen)
    {
        $media = $this->twitterClient->upload('media/upload', array('media' => $imagen));
        $parameters = array('status' => $mensaje, 'media_ids' => $media->media_id_string);
        return $this->twitterClient->post('statuses/update', $parameters);
    }
}
