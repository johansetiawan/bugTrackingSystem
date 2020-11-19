			<?php 	 include('include/content/user_list_controller.php');
                     include('config.php');
					
					class user_list_page{
						public function delete_user($base,$user_id){
						$user_list_controller = new user_list_controller();
						$user_list_controller->find_and_delete_user($base,$user_id);
						}	
					}
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
                                       header('Location: user_list_page.php'); 
                                }else{
                                    header('Location: user_list_page.php');
                                }
                        }else{
                          header('Location:index.php');
                        }   
                      }else{  
                          header('Location:login_page.php');
                      } 

            ?> 