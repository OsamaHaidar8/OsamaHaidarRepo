<?php
include('header.php');
?>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h2><i class="fa fa-users"></i> Users</h2>


                    </div>
                </div>
                <!-- /. ROW  -->
                <hr />
                <div class="row">
                    <div class="col-md-8">
                        <!-- Form Elements -->
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <i class="fa fa-plus-circle"></i> Add New User
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
                               $errors=array();
                         if(!preg_match('/^[a-zA-Z]+$/',$name))
                            {
                                $errors["name"] ="<p> الاسم الاول يجب ان يكون احرف فقط </p>";
                            }
                            if(!preg_match('/^[a-zA-Z0-9]+$/',$username)){
        
                                   $errors["username"] ="<p>لايكون اسم المستخدم  الا احرف كبيرة او صغيرة او ارقام <p>";
                                }
                              $query="select username from user where username=?";
                                $stm=$con->prepare($query);
                                 $stm->execute(array($username));
                                if($stm->rowCount()>0)
                                {
                                    $errors["rusername"] = "يوجد مستخدم بهذا الاسم";
                                }
                                if(empty($errors))
                                {
                           $getUsers=$con->prepare("insert into user(username,email,password,fullname,prv_id) values(?,?,?,?,?);");
                            $getUsers->execute(array($username,$email,$password,$name,$type));
                            if($getUsers->rowCount())
                            echo "<div class='alert alert-success'>one row added </div>";
                            else
                            echo "<div class='alert alert-danger'>no row added </div>";
                                }
                            
                           }
                           
                            ?>
                      
                           
                           
                                        <form role="form" method="post">
                                            <div class="form-group">
                                                <label>Name</label>
                                                <input type="text" name="name" placeholder="Please Enter your Name "
                                                    class="form-control" required />
                                                <div style="color: red" ><?php if(isset($errors['name'])) echo $errors['name']; ?></div>
                                            </div>
                                             <div class="form-group">
                                                <label>Username</label>
                                                <input type="text" name="username" placeholder="Please Enter your Name "
                                                    class="form-control" required />
                                                <div style="color: red" ><?php if(isset($errors['username'])) echo $errors['username']; ?></div>
                                                <div style="color: red" ><?php if(isset($errors['rusername'])) echo $errors['rusername']; ?></div>
                                            </div>
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input type="email" name="email" class="form-control"
                                                    placeholder="PLease Enter Eamil" />
                                            </div>
                                            <div class="form-group">
                                                <label>Password</label>
                                                <input type="password" name="password" id="password" class="form-control"
                                                    placeholder="Please Enter password" required>
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
                                                <select name="type" class="form-control">
                                                   <?php
                               
                                                   $stm=$con->prepare("select * from privilages");
                                                   $stm->execute();
                                                   if($stm->rowCount())
                                                   {
                                                      foreach($stm->fetchAll() as $row)
                                                      {
                                                      
                                                   
                                                   ?>
                                                    <option value="<?php echo $row['id']; ?>"</option><?php echo $row['type']; ?></option>
                                                   <?php }} ?>
                                                </select>
                                            </div>
                                            <div style="float:right;">
                                                <button  type="submit" name="submit" class="btn btn-primary" id="submit">Add User</button>
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

                    <div class="row">
                        <div class="col-md-12">
                            <!-- Advanced Tables -->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <i class="fa fa-users"></i> Users
                                </div>
                                <?php
                                if(isset($_GET['action'],$_GET['id']))
                                {
                                 $action=$_GET['action'];
                                 $id=$_GET['id'];
                                 if($action=='delete')
                                 {
                                    $stm=$con->prepare("delete from user where id=?");
                                    $stm->execute(array($id));
                                    if($stm->rowCount())
                                    {
                                      echo "<div class='alert alert-success'>one row deleted succfully </div>"; 
                                    }
                                    else
                                    echo "<div class='alert alert-danger'>something wrong happend </div>";
                                 }
                                 else if($action=='active')
                                 {
                                    if($_GET['activen']==0)
                                    $active=1;
                                    else
                                    $active=0;
                                    $stm=$con->prepare("update user set active=? where id=?");
                                    $stm->execute(array($active,$id));
                                    if($stm->rowCount())
                                    {
                                       if($active==1)
                                      echo "<div class='alert alert-success'>one row  actived succfully </div>";
                                      else
                                      echo "<div class='alert alert-success'>one row  unactived succfully </div>";
                                    }
                                    else
                                    echo "<div class='alert alert-danger'>something wrong happend </div>";
                                 }
                                 
                                }
                                
                                
                                
                                ?>
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover"
                                            id="dataTables-example">
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Username</th>
                                                    <th>Email</th>
                                                    <th>Password</th>
                                                    <th>privilage</th>
                                                   
                                                </tr>
                                            </thead>
                                            <tbody>
                                             <?php
                                             $query="select  privilages.type as prv,user.id,user.fullname,user.email,
                                             user.password,user.username,user.active from user
                                             join privilages on user.prv_id=privilages.id";
                                             $stm=$con->prepare($query);
                                             $stm->execute();
                                             if($stm->rowCount())
                                             {
                                                foreach($stm->fetchAll() as $row)
                                                {
                                                   $id=$row['id'];
                                                   $name=$row["fullname"];
                                                   $email=$row["email"];
                                                   $password=$row['password'];
                                                   $username=$row['username'];
                                                   $active=$row['active'];
                                                   $prv=$row['prv'];
                                             ?>
                                                <tr class="odd gradeX">
                                                    <td><?php echo $name ?></td>
                                                    <td><?php echo $username ?></td>
                                                    <td><?php echo $email ?></td>
                                                    <td><?php echo $password ?></td>
                                                    <td><?php echo $prv ?></td>
                                                   

                                                    <td>
                                                      <a href="?action=active&id=<?php echo $id ?>&activen=<?php echo $active ?>" class='btn btn-primary'><?php if($active==0) echo 'active'; else echo 'unactive'; ?></a>
                                                        <a href="usersEdit.php?action=edit&id=<?php echo $id ?>" class='btn btn-success'>Edit</a>
                                                        <a href="?action=delete&id=<?php echo $id ?>" class='btn btn-danger' id='delete'>Delete</a>
                                                    </td>
                                                </tr>
                                                 <?php
                                                }
                                             }
                                             else{?>
                                                <div class="alert alert-danger">no rows</div>
                                                <?php }?>

                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>
                            <!--End Advanced Tables -->
                        
                    </div>
                    <!-- /. ROW  -->
                </div>
                <!-- /. PAGE INNER  -->
            </div>
            <!-- /. PAGE WRAPPER  -->
        </div>
   </div>
   <script>
      $('#delete').click(function()
                        {
                           confirm("Are you sure");
                        });
   </script>  
   <?php
   include('footer.php');
   ?>
 