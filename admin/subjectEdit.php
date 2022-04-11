<?php
include('header.php');
require('dbconnect.php');
?>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h2><i class="fa fa-tasks"></i> Edit Subject </h2>
                    </div>
                </div>
                <!-- /. ROW  -->
                <hr />
                <div class="row">
                    <div class="col-md-8">
                        <!-- Form Elements -->
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <i class="fa fa-plus-circle"></i> Edit Subject
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <?php
                                    if(isset($_GET['action'],$_GET['id']) && $_GET['action']=='edit'){
                                        $id=$_GET['id'];
                                        $query = "select * from subjects where id=?";
                                        $stm = $con -> prepare($query);                                                
                                        $stm -> execute(array($id));
                                        
                                        
                                        if($stm -> rowCount()){
                                            foreach($stm -> fetchAll() as $row){
                                                $id=$row['id'];
                                                $name=$row['name'];
                                                $photo=$row['image'];
                                                $description=$row['description'];
                                                
                                                // for updating
                                                if(isset($_POST['submit'])){
                                                  

                                                    $id = $_POST['id'];
                                                    $name = trim($_POST['name']);
                                                    $description = trim($_POST['description']);
                                                    $errors = array();
                                                    
                                                    if(empty($name)){
                                                        $errors['wrongName'] = "<div class='alert-danger'>Enter the name of the book..!</div>";
                                                    }
                                                    
                                                    elseif(is_numeric($name)){
                                                        $errors['numberName'] = "<div class='alert-danger'>Name must be string..!</div>";
                                                    }
        
                                                    if(empty($description)){
                                                        $errors['wrongdes'] = "<div class='alert-danger'>Enter the description of the book..!</div>";
                                                    }
                                                    
                                                    //checking if there is an image or not..!
                                                    if(isset($_FILES['file'])){
                                                          //dealing with files..
                                                        $file=$_FILES["file"];
                                                        $file_name=$file["name"];
                                                        if(!empty($file_name))
                                                        {
                                                        $file_error=$file["error"];
                                                        $file_tmp=$file["tmp_name"];
                                                        $extination = explode('.',$file_name);// فصل الاسم عن الامتداد
                                                        $extination_id = strtolower(end($extination));//to catche the extination
                                                        $extinations = array("jpg","img","png");

                                                        if(!in_array($extination_id,$extinations)){// == false
                                                            $errors['error_extination']="<div class='alert-danger'> File should be image (img-png-jpg)..!</div>";
                                                        }
                                                        // if($file_error===4){//4 --> is an error if the file isn't uploadede
                                                        //     echo "<div class='alert-danger'> File not uploaded..!</div>";
                                                        // }

                                                        //updating with image
                                                        $query = "update subjects set name=? , image=? , description=? where id=?";
                                                        $stm = $con -> prepare($query);                                                
                                                        $stm -> execute(array($name,$file_name,$description,$id));
        
                                                        if($stm -> rowCount()){
                                                            echo "<script>
                                                                alert('One row updated successfully ^_^');
                                                                window.open('subject.php','_self');
                                                            </script>";

                                                            move_uploaded_file($file_tmp,"upload/".$file_name);
                                                        }
                                                        
                                                        else{
                                                            echo "<div class='alert-danger'>Not updated..!</dive>";
                                                           
                                                        }
                                                    }//end of checking & updating first -> with image
                                                    
                                                    //update without image
                                                    else{
        
                                                        $query = "update subject set name=? , description=? where id=?";
                                                        $stm = $con -> prepare($query);                                                
                                                        $stm -> execute(array($name,$description,$id));
        
                                                        if($stm -> rowCount()){
                                                            echo "<script>
                                                                alert('One row updated successfully ^_^');
                                                                window.open('subject.php','_self');
                                                            </script>";
                                                        }
                                                        else{
                                                            echo "<div class='alert-danger'>Not updated..!</dive>";
                                                        }
                                                    }
        
                                                    }//end of checking & updating second -> no image
                                                }//end of inserting
                                        
                                    ?>
                                    <div class="col-md-12">
                                        <form role="form" method="post" enctype="multipart/form-data">
                                        <input type="hidden" name="id" value="<?php echo $id?>">
                                            <div class="form-group">
                                                <label>Name</label>
                                                <input type="text" placeholder="Please Enter Curse's Name "
                                                    class="form-control" value="<?php echo $name?>" name="name" />

                                                    <?php
                                                        if(isset($errors['wrongName'])){
                                                            echo $errors['wrongName'];
                                                        }
                                                        if(isset($errors['numberName'])){
                                                            echo $errors['numberName'];
                                                        }
                                                    ?>
                                            </div>
                                            <div class="form-group">
                                                <label>Photo</label>
                                                <input type="file" value="<?php echo $photo?>" name="file" placeholder="Please Enter Course's Photo"
                                                class="form-control">

                                                    <?php
                                                        if(isset($errors['error_extination'])){
                                                            echo $errors['error_extination'];
                                                        }
                                                    ?>
                                            </div>
                                            <div class="form-group">
                                                <label>Description</label>

                                                <textarea placeholder="Please Enter Description" 
                                                class="form-control" cols="30" rows="3" name="description"><?php echo $description?></textarea>

                                                <?php
                                                        if(isset($errors['wrongdes'])){
                                                            echo $errors['wrongdes'];
                                                        }
                                                    ?>
                                            </div>
                                            
                                            <div style="float:right;">
                                                <button type="submit" class="btn btn-primary" name="submit" >Update Courses</button>
                                                <button type="reset" class="btn btn-danger">Cancel</button>
                                            </div>

                                    </div>
                                    </form>
                                    <?php
                                        }}}
                                    ?>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>                    <hr />

                    
                    <!-- /. ROW  -->
                </div>
                <!-- /. PAGE INNER  -->
            </div>
            <!-- /. PAGE WRAPPER  -->
        </div>
   </div>
   
   <?php
   include('footer.php');
   ?>