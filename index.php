<?php
	session_start();
	include_once "functions/functions.php";
	if(!isset($_SESSION['user_id'])){
		$_SESSION['notice'] = "You need to login first.";
        $_SESSION['class-notice'] = "alert alert-warning mb-2";
		header("Location: login.php");
	}

	$userData = getUserDatas($_SESSION['user_id']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<script src="js/handle_like.js"></script>
	<link rel="stylesheet" href="css/style-social-media.css">
	<title>SN</title>
</head>
<body>
	<div class="container">
		<div class="content-area">
			<div class="user-area">
			    <div class="user-photo"></div>
				<div class="user-name"><?php echo $userData['user_name']?></div>
				<div class="user-datas"></div>
				<div class="exit">
					<img src="power-button.svg">
				</div>
			</div>
			<div class="scrollable-area">
				<div class="post-composer">
					<div class="toolbars"></div>
					<div class="post-content">
						<form action="make-post.php">
							<textarea class="user-post" name="user-post" onKeyPress="submitener(this,event)" ></textarea>
							<input type="submit" value="">
						</form>
					</div>
					<div class="footer-post-content"></div>
				</div>
				<?php
					$posts = getPosts();
					$friendsList = getFriendsDatas($_SESSION['user_id']);
					if(count($posts) == 0){
				?>
					<div class="warning-content">
						<div class="warning">Não foram escontrado post em sua timeline</div>
					</div>
					<?php
						}else{
							foreach($posts as $post){
					?>
								<div class="feed">
									<div class="content">
										<?php echo $post['content']?>
									</div>
									<div class="post-data">
										<span class="num-likes <?php echo $post['user_liked']? 'clicked': ''?>" id="post-link<?php echo $post['post_id']?>"><?php echo $post['likes']?></span>
										<ul class="<?php echo empty($post['users_names'])? 'who-like-empty': 'who-like' ?>">
										<li><?php echo $post['users_names']?></li>
											<!--<li>Maria Joaquina</li>
											<li>Carlos Alberto</li>
											<li>João Pedro</li>-->
										</ul>
									</div>
									<div class="interaction-components">
										<div href="" id='like-click<?php echo $post['post_id']?>' class="like" onclick='handleLike(<?php echo $post['post_id']?>)'>
											<?php echo $post['user_liked']? 'Descurtir' : 'Curtir'?>
										</div>
										<div href="" class="coment">Comentar</div>
									</div>
								</div>
								<?php
										}
									}
								?>
			</div>
			<div class="chat-component">
			<?php
				if(count($friendsList) == 0){
			?>
				<div class="friends-list">
				</div>
			<?php
				}else{
					foreach($friendsList['friends_list'] as $friend){
			?>
				<div class="friends-list"> 
					<div class='friend-label'>
						<div class='friend-photo'></div>
						<div class='friend-name'><?php echo $friend['user_name']?></div>
						<div class='status' <?php echo $friend['logged']? '' : 'style=\'background-color:green\'' ?> ></div>
					</div>
			<?php
					}
				}
			?>
				</div>
			</div>
		</div>
	</div>
	<script src="js/generic-functions.js"></script>
</body>
</html>