<?php
	if (isset($_SESSION['user'])) {
        if ($_SESSION['user']['user_type'] == "admin") {
          
		    $allusers = "SELECT * FROM `user`";
		    $users = $base->query($allusers); 

        }else{
          header('Location:index.php');
        }   
      }else{  
          header('Location:login_page.php');
      }
?>
   <h1>Admin Page</h1>
		<div class="table_list"> 
			<table>
		      <thead>
		        <tr>
		          <th>#</th>
		          <th>Name</th>
		          <th>E-mail</th>
		          <th>Role</th>
		          <th></th>
		        </tr>
		      </thead>
		      <tbody>
<?php  while($user = $users->fetch_array()) {?>
		<?php if ($user['user_type'] != "") { ?>
		        <tr>
		          <td><?php echo $user['user_id'];?></td>
		          <td><?php echo $user['full_name']; ?></td>
		          <td><?php echo $user['email'];?></td>
		          <td><?php echo $user['user_type'];?></td>
		          <td><a href="home_page.php" class="option"><i class="ion ion-person"></i></a></td>
                <td><a href="delete_user.php?id=<?php echo $user['user_id'];?>" class="delete"><i class="ion ion-trash-a"></i></a></td>
		        </tr> 
		<?php }else{?>
		        <tr>
		          <td><?php echo $user['user_id'];?></td>
		          <td><?php echo $user['full_name']; ?></td>
		          <td><?php echo $user['email'];?></td>
		          <td><?php echo $user['user_type'];?></td>
		          <td><a href="delete_user.php?id=<?php echo $user['user_id'];?>" class="delete"><i class="ion ion-trash-a"></i></a></td>
		        </tr>  
<?php }}?>
		      </tbody>
		    </table>   
		</div>