<?php
namespace mcanan\framework\libraries;

require_once dirname(__FILE__).'/facebookapi/facebook.php';
use \Facebook;

class facebookapi
{
    private $fbClient;
    private $access_token;

    public function __construct()
    {
    }

    public function init($appId, $secret, $access_token)
    {
        $this->fbClient = new Facebook(array(
            'appId'  => $appId,
            'secret' => $secret,
            'cookie' => true
        ));
        $this->access_token = $access_token;
    }

    public function postLink($id, $link, $message, $picture)
    {
        $params = array(
            'access_token' => $this->access_token,
            'link' => $link,
            'message' => $message,
            'picture' => $picture
        );

        return $this->fbClient->api('/'.$id.'/links', 'POST', $params);
    }

    public function postPhoto($id, $message, $picture)
    {
        $picture='@'.realpath($picture);
        $params = array(
            'access_token' => $this->access_token,
            'message' => $message,
            'image' => $picture
        );
        $this->fbClient->setFileUploadSupport(true);
        return $this->fbClient->api('/'.$id.'/photos', 'POST', $params);
    }

    public function getLikesById($id)
    {
        $params = array('fields' => 'likes');

        return $this->fbClient->api('/'.$id, 'GET', $params);
    }

    public function getPostsById($id)
    {
        $params = array(
            'fields' => 'message,
            link, shares,
            comments.limit(1).summary(true),
            likes.limit(1).summary(true),
            type, picture'
        );

        return $this->fbClient->api('/'.$id.'/posts', 'GET', $params);
    }
}
