<?php
	function conn(){
		$conn = new mysqli('localhost', 'root', '', 'social_network');
		if (mysqli_connect_errno()) {
			printf('Connect failed: ', mysqli_connect_error());
			exit();
		}
		$conn->set_charset("utf8");
		return $conn;
	}

	function getPosts(){
		$count = 0;
		$datas = array();
		$mysqli = conn();
		$users_ids = array();
		if($posts = $mysqli->query("SELECT post_id, content, likes FROM posts")){
			while($row = $posts->fetch_object()){
				$userLoged = (int)$_SESSION['user_id'];
				$currentPostId = $row->post_id;
				$checkCurrentLike = $mysqli->query("SELECT like_id FROM likes WHERE user_id = $userLoged AND post_id = $currentPostId");
				$userLiked = $checkCurrentLike->num_rows ? true: false;

				$datas[] = array(
					'post_id' => $row->post_id,
					'content' => $row->content,
					'likes' => $row->likes,
					'user_liked' => $userLiked,
					'users_names' => ''
				);
			}
			$posts->close();
			foreach ($datas as $key) {
				if($likes = $mysqli->query("SELECT user_id FROM likes WHERE post_id = ".$key['post_id'])){
					while($row = $likes->fetch_object()){
						if($users_names = $mysqli->query("SELECT user_name FROM users WHERE id_user = ".$row->user_id)){
							while($row2 = $users_names->fetch_object()){
								$datas[$count]['users_names'] = $row2->user_name;
							}
						}
					}
				}
				$count++;
			}
			return array_reverse($datas);		
		}
		$mysqli->close();
	}

	function getPostLikes(){
			$mysqli = conn();
			$post_id = (int)$post_id;
			$user_id = (int)$user_id;
			if($check = $mysqli->query("SELECT like_id FROM likes WHERE user_id = $user_id AND post_id = $post_id")){
				return $check->num_rows >= 1 ? true : false;
				$check->close();
			}
			$mysqli->close();
	}
	
	function getFriendsDatas($user_id){
		$datas = array();
		$friendData = array();
		$mysqli = conn();
		
		$posts = $mysqli->query("SELECT friends_list FROM users WHERE id_user = $user_id");
		while($row = $posts->fetch_object()){
			$datas = [ 'friends_id' => explode(',' ,$row->friends_list ), 'friends_list' => ''];
		}
		
		foreach($datas['friends_id'] as $friendId){
			if($posts = $mysqli->query("SELECT * FROM users WHERE id_user = $friendId")){
				while($row = $posts->fetch_object()){
					$friendData[] = array(
						'id_user' => $row->id_user,
						'user_name' => $row->user_name,
						'logged' => $row->logged,
						'is_friend' => true
					);
				}
				$posts->close();
			}
		}
		$datas['friends_list'] = $friendData;
		$mysqli->close();
		return $datas;
	}

	function getUserDatas($user_id){
		$userData = array();
		$mysqli = conn();

		if($user = $mysqli->query("SELECT * FROM users WHERE id_user = $user_id")){
			while($row = $user->fetch_object()){
				$userData = array(
					'id_user' => $row->id_user,
					'user_name' => $row->user_name
				);
			}
			$user->close();
			}
		$mysqli->close();
		return $userData;
	}
	
	function checkClicked($post_id, $user_id){
		$mysqli = conn();
		$post_id = (int)$post_id;
		$user_id = (int)$user_id;
		if($check = $mysqli->query("SELECT like_id FROM likes WHERE user_id = $user_id AND post_id = $post_id")){
			return $check->num_rows >= 1 ? true : false;
			$check->close();
		}
		$mysqli->close();
	}
	
	
	function addLike($post_id, $user_id){
		$mysqli = conn();
		$post_id = (int)$post_id;
		$user_id = (int)$user_id;
		if($update_likes = $mysqli->query("UPDATE posts SET likes = likes+1 WHERE post_id = $post_id")){
			$insert_like = $mysqli->query("INSERT INTO likes (user_id, post_id) VALUES ($user_id, $post_id)");
			if($insert_like){
				return true;
				$update_likes->close();
				
			}else{
				return false;
				$update_likes->close();
				
			}
		}
		$mysqli->close();
	}

	function removeLike($post_id, $user_id){
		$mysqli = conn();
		$post_id = (int)$post_id;
		$user_id = (int)$user_id;
		if($update_likes = $mysqli->query("UPDATE posts SET likes = likes-1 WHERE post_id = $post_id")){
			$delete_like = $mysqli->query("DELETE FROM likes WHERE user_id = $user_id AND post_id = $post_id");
			if($delete_like){
				return true;
				$update_likes->close();
				
			}else{
				return false;
				$update_likes->close();
				
			}
		}
		$mysqli->close();
	}
	
	function getLikes($post_id){
		$mysqli = conn();
		$post_id = (int)$post_id;
		$select_num_likes = $mysqli->query("SELECT likes FROM posts WHERE post_id = '$post_id'");
		$fetch_likes = $select_num_likes->fetch_object();
		return $fetch_likes->likes;
		$select_num_likes->close();
		$mysqli->close();
	}
?>