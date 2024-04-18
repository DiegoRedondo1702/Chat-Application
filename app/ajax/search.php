<?php

session_start();

# check if the user is logged in
if (isset($_SESSION['username'])) {
    # check if the key is submitted
    if(isset($_POST['key'])){
       # database connection file
	   include '../db.conn.php';

	   # creating simple search algorithm :) 
	   $key = "%{$_POST['key']}%";
     
	   $sql = "SELECT * FROM users
	           WHERE username
	           LIKE ? OR name LIKE ?";
       $stmt = $conn->prepare($sql);
       $stmt->execute([$key, $key]);

       if($stmt->rowCount() > 0){ 
         $users = $stmt->fetchAll();

         foreach ($users as $user) {
         	if ($user['user_id'] == $_SESSION['user_id']) continue;
       ?>
       <li style="  border: 2px solid #FF00FF; background-color:#00FFFF; border-radius: 10px;" class="list-group-item">
		<a href="chat.php?user=<?=$user['username']?>"
		   class="d-flex
		          justify-content-between
		          align-items-center p-2">
			<div class="d-flex
			            align-items-center">

			    <img src="uploads/<?=$user['p_p']?>"
			         class="w-10 rounded-circle">

			    <h3 class="fs-xs m-2">
			    	<?=$user['name']?>
			    </h3>            	
			</div>
		 </a>
	   </li>
       <?php } }else { ?>
         <div style="background-color:#00FFFF; border: 2px solid #d300e7;" class="alert alert-info 
    				 text-center">
		   <i style=" color:#d300e7;" class="fa fa-user-times d-block fs-big"></i>
           El usuario "<?=htmlspecialchars($_POST['key'])?>"
           No ha sido encontrado.
		</div>
    <?php }
    }

}else {
	header("Location: ../../index.php");
	exit;
}