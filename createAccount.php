<?php
            
            
                
                        require "dbconnect.php";
                       if(isset($_POST["submit"]))
                        {
                            $fullname=$_POST["first"]." ".$_POST["last"];
                            $username=$_POST["username"];
                            $email=$_POST["email"];
                            $password=$_POST["password"];
                            $conpassword=$_POST["conpassword"];
                            $passworden=password_hash($password,PASSWORD_DEFAULT);
                            
                     
                            if($password!=$conpassword)
                            echo "not matched password";
                            else
                            {
                            $getUsers=$con->prepare("insert into user(username,email,password,fullname) values(?,?,?,?);");
                            $getUsers->execute(array($username,$email,$passworden,$fullname);
                        echo $passworden;
                            //echo "<script>singed in succssfully <a href='home.php'>go to home page </a></script>";
                            }
                        }
                        
                    
               
            
            
            
            
            ?>