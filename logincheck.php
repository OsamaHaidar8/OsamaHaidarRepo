  <?php
  
                        require "admin/dbconnect.php";
                        if(isset($_POST["submit"]))
                        {
                           $password=$_POST["password"];
                           $username=$_POST["user"];
                           $query="select username,password from user";
                           $stm=$con->prepare($query);
                           $stm->execute();
                           $result=0;
                          
                           while($stm->fetchAll() as $row)
                           {
                            $passworden=$row["password"];
                            $passworden=password_hash($password,PASSWORD_DEFAULT);
                            if($row["username"]==$username&&/*password_verify($password,$passworden)*/$row["password"]==$password)
                            {
                              $reset=1;
                              break;
                            }
                           }
                           if($reset==1)
                           echo "<script>alert('login successfully')</script>";
                           else
                           echo "<script>alert('wrong password or username $passworden')</script>";
                         
                         
                        }
                        
                        ?>