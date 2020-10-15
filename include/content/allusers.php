<?php
	if (isset($_SESSION['user'])) {
        if ($_SESSION['user']['ROLE'] == "Reporter") {
          
		    $allusers = "SELECT * FROM `user`";
		    $users = $base->query($allusers); 

        }else{
          header('Location:index.php');
        }   
      }else{  
          header('Location:login.php');
      }
?>
   
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
		<?php if ($user['ROLE'] == "1") { ?>
		        <tr>
		          <td><?php echo $user['user_id'];?></td>
		          <td><?php echo $user['full_name']; ?></td>
		          <td><?php echo $user['E_MAIL'];?></td>
		          <td><?php echo $user['user_type'];?></td>
		          <td><a href="admin.php" class="option"><i class="ion ion-person"></i></a></td>
		        </tr> 
		<?php }else{?>
		        <tr>
		          <td><?php echo $user['user_id'];?></td>
		          <td><?php echo $user['full_name']; ?></td>
		          <td><?php echo $user['E_MAIL'];?></td>
		          <td><?php echo $user['user_type'];?></td>
		          <td><a href="delete_user.php?id=<?php echo $user['user_id'];?>" class="delete"><i class="ion ion-trash-a"></i></a></td>
		        </tr>  
<?php }}?>
		      </tbody>
		    </table>   
		</div>