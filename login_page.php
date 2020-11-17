      <?php 
          $title="Roger Bug Tracker - Login";
          include('include/head.php');
include('include/content/login_controller.php');
      ?>

        <!--<div class="divleft"></div>-->
        <div class="content"> 
                <form action="login_page.php" method="post" style="max-width: 100%;">
        <table>
        <tr>
          <td><input type="text" name="login" placeholder="Username / Email"></input></td>
        </tr>
        <tr>
          <td><input type="password" name="password" placeholder="Password"></input></td>
        </tr>
        <tr>
          <td><input type="submit" name="submit" value="login"></td> 
        </tr>
      </table>
</form>
</div>
        <div class="divright"> 
          <?php include('include/divright/user.php');  ?>
        </div> 
        <?php include('include/footer.php'); ?>