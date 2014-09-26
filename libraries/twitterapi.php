<?php
require_once(dirname(__FILE__).'/twitterapi/twitteroauth.php');

class TwitterAPI {

	private $twitterClient;

	function __construct()	{
	}
	
	public function init($ck,$cs,$oat,$oas){
		$this->twitterClient = new TwitterOAuth($ck, $cs, $oat, $oas);
		$this->twitterClient->host = "https://api.twitter.com/1.1/";
	}

	public function getUserByScreenName($screen_name){
		return $this->twitterClient->get('users/show',array('screen_name' => $screen_name));
	}

	public function getUserById($id){
		return $this->twitterClient->get('users/show',array('user_id' => $id));
	}

	public function getFollowersById($id,$count,$cursor){
		return $this->twitterClient->get('followers/ids',array('user_id' => $id,'count' => $count,'cursor' => $cursor));
	}

	public function getFriendsById($id,$count,$cursor){
		return $this->twitterClient->get('friends/ids',array('user_id' => $id,'count' => $count,'cursor' => $cursor));
	}

	public function getTweetsById($id,$count,$exclude_replies,$include_rts,$since_id,$max_id){
		if ($max_id>0){
			return $this->twitterClient->get('statuses/user_timeline',array('user_id' => $id,'count' => $count,'trim_user' => true, 'exclude_replies' => $exclude_replies, 'include_rts' => $include_rts, 'since_id' => $since_id,'max_id' => $max_id));
		} else {
			return $this->twitterClient->get('statuses/user_timeline',array('user_id' => $id,'count' => $count,'trim_user' => true, 'exclude_replies' => $exclude_replies, 'include_rts' => $include_rts, 'since_id' => $since_id));
		}
	}
	
	public function getUsers($users){
		return $this->twitterClient->get('users/lookup',array('user_id' => $users));
	}

	public function getTweets($ids,$include_entities=false){
		return $this->twitterClient->get('statuses/lookup',array('id' => $ids, 'map' => true, 'include_entities' => $include_entities));
	}

	public function update($mensaje){
		return $this->twitterClient->post('statuses/update', array('status' => "$mensaje" ),false);
	}

	public function update_with_media($mensaje,$imagen){
		return $this->twitterClient->post('statuses/update_with_media', array('status' => "$mensaje",'media[]' => "@{$imagen};type=image/jpeg;filename={$imagen}" ),true);
	}
}
?>
