<?php if (!empty($_SESSION['id'])): ?>
<?php
$conn = mysqli_connect("localhost","root","","blog") or die('Database connection error: ' . $conn->connect_error);

$user_id=$_SESSION['id'];
$member_query = mysqli_query($conn,"select * from users where id = '$user_id'")or die($conn -> mysqli_error);
$member_row = mysqli_fetch_array($member_query);


if (isset($_POST['comment'])){
$comment = $_POST['content'];

?>
<script>
window.location = 'home.php';
</script>

<?php
}
?>
<?php endif ?>


<br>       
					<form method="post">
					<hr>
					<h2>Commenti:</h2><br>
                    <?php if (!empty($_SESSION['id'])): ?>
					<input type="hidden" name="id" value="<?php echo $id; ?>">
					<textarea name="comment_content" rows="2" cols="44" style="" placeholder=".........Type your comment here........" required></textarea><br>
					<input type="submit" name="comment">
					</form>
                 
					</br>
                    <?php endif ?>
							<?php 
								$comment_query = mysqli_query($conn,"SELECT * ,UNIX_TIMESTAMP() - date_posted AS TimeSpent FROM comment LEFT JOIN users on users.id = comment.user_id where post_id = '$id'") or die ($conn -> mysqli_error);
								while ($comment_row=mysqli_fetch_array($comment_query)){
								$comment_id = $comment_row['comment_id'];
								$comment_by = $comment_row['username'];
							?>
					<br><a href="#"><?php echo $comment_by; ?></a> - <?php echo $comment_row['content']; ?>
					<br>
							<?php				
								$days = floor($comment_row['TimeSpent'] / (60 * 60 * 24));
								$remainder = $comment_row['TimeSpent'] % (60 * 60 * 24);
								$hours = floor($remainder / (60 * 60));
								$remainder = $remainder % (60 * 60);
								$minutes = floor($remainder / 60);
								$seconds = $remainder % 60;
								if($days > 0)
								echo date('F d, Y - H:i:sa', $comment_row['date_posted']);
								elseif($days == 0 && $hours == 0 && $minutes == 0)
								echo "A few seconds ago";		
								elseif($days == 0 && $hours == 0)
								echo $minutes.' minutes ago';
							?>
					
                    <br>
  <?php if(!empty($_SESSION['id'])): ?>      
<form class="edit-btn" method="POST">
<input type="hidden" name="cid" value="<?php echo $comment_row['comment_id']; ?>">
<input type="hidden" name="uid" value="<?php echo $id; ?>">
<input type="hidden" name="date" value="<?php echo $comment_row['date_posted']; ?>">
<input type="hidden" name="message" value="<?php echo $comment_row['content']; ?>">

<?php if(!empty($_SESSION['id']) && $_SESSION['username']== $comment_by): ?>    
<button name="delete">Delete Comment</button>
<?php endif ?>
</form>
<?php
							
                            if (isset($_POST['delete'])){
                                $comment_content = $_POST['comment_content'];
                                $cid = $_POST['cid'];
                                $post_id=$_POST['id'];
                                
                                mysqli_query($conn,"DELETE FROM comment WHERE $cid = comment_id") or die ($conn -> mysqli_error);
                                header('location: index.php');  
                                }
                      
                        ?>  
                         <?php elseif (empty($_SESSION['admin']) && empty($_SESSION['id'])): ?>


                        <?php elseif (empty($_SESSION['admin']) && empty($_SESSION['id'])): ?>
       
                     <?php endif ?>

							<?php
							}
							?>
					
                    <hr>
					&nbsp;

             


					<?php 
					if ($u_id = $id){
					?>
					
				
					
					<?php }else{ ?>
						
					<?php
					} ?>
							
							<?php
							
								if (isset($_POST['comment'])){
								$comment_content = $_POST['comment_content'];
								$post_id=$_POST['id'];
								
								mysqli_query($conn,"insert into comment (content,date_posted,user_id,post_id) values ('$comment_content','".strtotime(date("Y-m-d h:i:sa"))."','$user_id','$post_id')") or die ($conn -> mysqli_error);
								header('location: index.php');
								}
							?>

           