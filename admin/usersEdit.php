<?php
include('header.php');
?>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h2><i class="fa fa-users"></i>Edit Users</h2>


                    </div>
                </div>
                <!-- /. ROW  -->
                <hr />
                <div class="row">
                    <div class="col-md-8">
                        <!-- Form Elements -->
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <i class="fa fa-plus-circle"></i> Edit User
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <?php
                           if(isset($_POST['submit']))
                           {
                              $name=$_POST['name'];
                              $username=$_POST['username'];
                              $email=$_POST['email'];
                              $password=$_POST['password'];
                              $conpassword=$_POST['conpassword'];
                              $type=$_POST['type'];
                              $id=$_POST["id"];
                               if(!preg_match('/^[a-zA-Z]+$/',$name))
                            {
                                $errors["name"] ="<p> الاسم الاول يجب ان يكون احرف فقط </p>".$name;
                            }
                            if(!preg_match('/^[a-zA-Z0-9]+$/',$username)){
        
                                   $errors["username"] ="<p>لايكون اسم المستخدم  الا احرف كبيرة او صغيرة او ارقام <p>";
                                }
                              $query="select id, username from user where username=?";
                                $stm=$con->prepare($query);
                                 $stm->execute(array($username));
                                if($stm->rowCount()>0)
                                {
                                    foreach($stm->fetchAll() as $row)
                                    {
                                       $uid=$row['id'];
                                       if($id!=$uid)
                                    $errors["rusername"] = "يوجد مستخدم بهذا الاسم";
                                    }
                                }
                                if(empty($errors))
                                {
                              
                           $getUsers=$con->prepare("update user set username=? ,email=?,password=?,fullname=?,prv_id=? where id=?;");
                            $getUsers->execute(array($username,$email,$password,$name,$type,$id));
                            if($getUsers->rowCount())
                            {
                            echo "<div class='alert alert-success'>One Row Updated </div>";
                             echo "<script>
                                   alert('one row updated');
                                     window.open('users.php', '_self');
                                     </script>";
                            }
                            else
                            echo "<div class='alert alert-danger'>No Row Updated </div>";
                                }
                           }
                          
                            ?>
                      
                           
                           
                                        <form role="form" method="post">
                                            <div class="form-group">
                                             <?php
                                               if(isset($_GET['action'],$_GET['id']))
                                        {
                                          if($_GET['action']=='edit')
                                          {
                                             $id=$_GET['id'];
                                             $stm=$con->prepare("select * from user where id=?");
                                             $stm->execute(array($id));
                                             if($stm->rowCount())
                                             {
                                                foreach($stm->fetchAll() as $row)
                                                {
                                                   $prv_id=$row['prv_id'];
                                             ?>
                                              <input type="hidden" name="id" placeholder="Please Enter your Name "
                                                    class="form-control" value="<?php echo $row['id']; ?>" required />
                                                <label>Name</label>
                                                <input type="text" name="name" placeholder="Please Enter your Name "
                                                    class="form-control" value="<?php echo $row['fullname']; ?>" required />
                                                    <div style="color: red" ><?php if(isset($errors['name'])) echo $errors['name']; ?></div>
                                            </div>
                                             <div class="form-group">
                                                <label>Username</label>
                                                <input type="text" name="username" placeholder="Please Enter your Name "
                                                    class="form-control" value="<?php echo $row['username']; ?>" required />
                                                       <div style="color: red" ><?php if(isset($errors['username'])) echo $errors['username']; ?></div>
                                                <div style="color: red" ><?php if(isset($errors['rusername'])) echo $errors['rusername']; ?></div>
                                            </div>
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input type="email" name="email" class="form-control"
                                                    placeholder="PLease Enter Eamil" value="<?php echo $row['email']; ?>" />
                                            </div>
                                            <div class="form-group">
                                                <label>Password</label>
                                                <input type="password" name="password" id="password" class="form-control"
                                                    placeholder="Please Enter password" value="<?php echo $row['password']; ?>" required>
                                            </div>
                                            <div id="message_pass" style="color:red;"></div>
                                            <div class="form-group">
                                                <label>Confirm Password</label>
                                                <input type="password" name="conpassword" id="conpassword" class="form-control"
                                                    placeholder="Please Enter confirm password" required>
                                            </div>
                                            <div id="message_con" style="color:red;"></div>
                                            <div class="form-group">
                                                <label>User Type</label>
                                                 <select  name="type" class="form-control">
                                                   <?php
                                                }}
                                          }}
                                                   $stm=$con->prepare("select * from privilages");
                                                   $stm->execute();
                                                   if($stm->rowCount())
                                                   {
                                                      foreach($stm->fetchAll() as $rows)
                                                      {
                                                      
                                                   if($prv_id==$rows["id"])
                                                   {
                                                   ?>
                                                    <option selected value="<?php echo $rows['id']; ?>"</option><?php echo $rows['type']; ?></option>
                                                    <?php
                                                    }
                                                    else
                                                    {
                                                    ?>
                                                    <option value="<?php echo $rows['id']; ?>"</option><?php echo $rows['type'] ?></option>
                                                   <?php }}} ?>
                                                </select>
                                            </div>
                                            <div style="float:right;">
                                                <button   type="submit" name="submit" class="btn btn-primary" id="submit">Update User</button>
                                                <button type="reset" class="btn btn-danger">Cancel</button>
                                            </div>
                                       
                                    </div>
                                    <script src="assets/js/check_information.js"></script>
                                    </form>

                                </div>

                            </div>
                        </div>
                    </div>

                </div>                    <hr />

                <!-- /. PAGE INNER  -->
            </div>
            <!-- /. PAGE WRAPPER  -->
        </div>
   </div>
   
   <?php
   include('footer.php');
   ?>