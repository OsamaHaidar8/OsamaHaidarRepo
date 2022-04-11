<!DOCTYPE html>
    <html>
        <head>
           
        </head>
        <div class="login">
           
                      
                         <div id="simplemodel1" class="model1">
                        <div class="model-content1">
                       <div class="wrap">
               <span class="closebtn1">&times;</span>
                <h2>تسجيل الدخول</h2>
               <form action="" method="post">
                    <input type="text" name="user" placeholder="اسم المستخدم.." required>
                        <input type="password" name="password" placeholder="كلمة المرور.." required>
                         <input type="submit" value="تسجيل الدخول" name="submit">
                 </form>
                        <script src="js/java.js"></script>
                      
       
        </div>
           <?php
  
                        require "admin/dbconnect.php";
                        if(isset($_POST["submit"]))
                        {
                           $password=$_POST["password"];
                           $username=$_POST["user"];
                            $query="select * from user";
                            $stm=$con->prepare($query);
                            $stm->execute();
                            $result=0;   
                            foreach($stm->fetchAll() as $row)
                           {
                            if($row["username"]==$username&&$row["password"]==$password&&$row['prv_id']==1)
                            {
                            $id=$row['id'];
                              $result=1;
                              $prv_id=$row['prv_id'];
                              break;
                            }
                            else if($row["username"]==$username&&$row["password"]==$password&&$row['prv_id']==2)
                            {
                                $id=$row['id'];
                                $result=2;
                                $prv_id=$row['prv_id'];
                            }
                           }
                            if($result==1||$result==2)
                            {
                                session_start();
                                $_SESSION['userinfo']=['id'=>$id,'username'=>$username,'password'=>$password,'prv_id'=>$prv_id];
                               
                               if(isset($_SESSION['userinfo']))
                               {
                                echo $_SESSION['userinfo']['prv_id'];
                         //  echo "<script>alert('login successfully')</script>";
                           header('location:home.php');
                               }
                                                            
                            }
                           else
                           echo "<script>alert('wrong password or username')</script>";
                        }
                        
                        ?>
        
    </html>