			<?php 	 include('include/content/classes.php');
                     include('config.php');  
                      if (isset($_SESSION['user'])) {
                        if ($_SESSION['user']['user_type'] == "admin") { 

                                if (isset($_GET['id'])) {
                                    $iduser= $_GET['id'];
                                    $data = "SELECT * FROM `user` WHERE `user_id` LIKE '".$iduser."'";
                                    $datauser = $base->query($data)->fetch_array(MYSQLI_ASSOC);
                                    if ((!empty($datauser))&&($datauser['user_type'] != "admin")) {
										$user_list_page = new user_list_page();
										$user_list_page->delete_user($base,$iduser);                                        
                                        } 
                                       header('Location: listusers.php'); 
                                }else{
                                    header('Location: listusers.php');
                                }
                        }else{
                          header('Location:index.php');
                        }   
                      }else{  
                          header('Location:login_page.php');
                      } 

            ?> 