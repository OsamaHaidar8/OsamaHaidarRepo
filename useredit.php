<?php
include('header.php');
require('dbconnect.php');
?>
<body>
    

<?php
    if(isset($_GET['action'],$_GET['id']) && $_GET['action']=='edit'){
        $id=$_GET['id'];
        //$id=4;
        $query = "select * from user where id=?";
        $stm = $con -> prepare($query);                                                
        $stm -> execute(array($id));
        if($stm -> rowCount()){
            foreach($stm -> fetchAll() as $row){

                $namef=explode(' ',$row['fullname']);
                $id = $row['id'];
                $first_name=$namef[0];
                if(isset($namef[1]))
                $last_name=$namef[1];
                else
                $last_name=" ";
                $email=$row['email'];
                $password=$row['password'];
                
                
                
                
                if(isset($_POST['submitinfo'])){
                           
                    $id = $_POST['id'];
                    $fullname = trim($_POST['first_name'])." ".trim($_POST['last_name']);
                    $email = trim($_POST['email']);
                    $password = trim($_POST['password']);
                    $errors = array();
                    
                   
                    $query = "update user set fullname=?, email=?, password=?where id=?";
                    $stm = $con -> prepare($query);                                                
                    $stm -> execute(array($fullname,$email,$password,$id));

                    if($stm -> rowCount()){
                            echo "<script>
                                alert('One row updated successfully ^_^');
                                window.open('home.php','_self');
                            </script>";
                        }
                    else{
                        echo "<div class='alert-danger'>Not updated..!</dive>";
                    }
                  
               }                       
?>


<div class="content" >
    <form role="form" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $id?>"/>
        <div class="form-group">
            <label>First Name</label>
            <input type="text" placeholder="Please Enter your first Name"
            class="form-control" value="<?php echo $first_name?>" name="first_name"/>
            <?php
                if(isset($errors['nameNumber'])){
                    echo $errors['phoneString'];
                }
            ?>
        </div>
        <div class="form-group">
            <label>Last Name</label>
            <input type="text" placeholder="Please Enter your first Name"
            class="form-control" value="<?php echo $last_name?>" name="last_name"/>
            <?php
                if(isset($errors['nameNumber'])){
                    echo $errors['phoneString'];
                }
            ?>
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="text" placeholder="Please Enter your email"
            class="form-control" value="<?php echo $email?>" name="email"/>
        </div>
        <div class="form-group">
            <label>Passsword</label>
            <input type="text" placeholder="Please Enter your email"
            class="form-control" value="<?php echo $password?>" name="password"/>
        </div>
        <div style="float:right;">
            <button type="submit" class="btn btn-primary" name="submitinfo" >Update Information</button>
            <button type="reset" class="btn btn-danger">Cancel</button>
        </div>
        
    </form>
    <?php
        }}
        }
    ?>
</div>
</body>
<?php
include('footer.php');
?>