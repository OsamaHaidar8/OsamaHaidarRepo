<?php
include('header.php');
require('dbconnect.php');
?>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h2><i class="fa fa-tasks"></i> Add Subject </h2>
                    </div>
                </div>
                <!-- /. ROW  -->
                <hr />
                <div class="row">
                    <div class="col-md-8">
                        <!-- Form Elements -->
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <i class="fa fa-plus-circle"></i> Add New Subjects
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <?php

                                        if(isset($_POST['submit'])){
                                            //dealing with files..
                                            $file=$_FILES["file"];
                                            $file_name=$file["name"];
                                            $file_error=$file["error"];
                                            $file_tmp=$file["tmp_name"];

                                            $extination = explode('.',$file_name);// فصل الاسم عن الامتداد
                                            $extination_id = strtolower(end($extination));//to catche the extination
                                            $extinations = array("jpg","img","png");

                                            if($file_error===4){//4 --> is an error if the file isn't uploadede
                                                echo "<div class='alert-danger'> File not uploaded..!</div>";
                                            }
                                            else{ 
                                                if(!in_array($extination_id,$extinations)){// == false
                                                 $errors['error_extination']="<div class='alert-danger'> File should be image (img-png-jpg)..!</div>";
                                                }
                                                
                                            }
                                            //end of files

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

                                            if(empty($description)){
                                                $errors['wrongdes'] = "<div class='alert-danger'>Enter the description of the book..!</div>";
                                            }
                                            else{

                                                $query = "insert into subjects (name,description,image) values (?,?,?)";
                                                $stm = $con -> prepare($query);                                                
                                                $stm -> execute(array($name,$description,$file_name));

                                                if($stm -> rowCount()){
                                                    echo "<div class='alert-success'>One row inserted successfully ^_^</dive>";
                                                    
                                                 move_uploaded_file($file_tmp,"upload/".$file_name);
                                                }
                                                else{
                                                   echo $name.$description.$file_name;
                                                   
                                                    echo "<div class='alert-danger'>Not inserted..!</dive>";
                                                }

                                            }
                                        }

                                    ?>
                                    <div class="col-md-12">
                                        <form role="form" method="post" enctype="multipart/form-data">
                                            <div class="form-group">
                                                <label>Name</label>
                                                <input type="text" placeholder="Please Enter Course's Name "
                                                    class="form-control" name="name" />

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
                                                <input type="file" name="file" placeholder="Please Enter Course's Photo"
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
                                                class="form-control" cols="30" rows="3" name="description"></textarea>

                                                <?php
                                                        if(isset($errors['wrongdes'])){
                                                            echo $errors['wrongdes'];
                                                        }
                                                    ?>
                                            </div>
                                            
                                            <div style="float:right;">
                                                <button type="submit" class="btn btn-primary" name="submit" >Add Coures</button>
                                                <button type="reset" class="btn btn-danger">Cancel</button>
                                            </div>

                                    </div>
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
                                    <i class="fa fa-tasks"></i> Courses
                                </div>
                                <?php
                                    if(isset($_GET['action'],$_GET['id'])){
                                        $id = $_GET['id'];
                                        switch($_GET['action']){
                                            
                                            /*case "edit";
                                            في هذا المثال كتبنا كود التعديل في صفحة منفصلة وذلك لأن الكود كبير، وبالإمكان كتابة الكود هنا
                                            break;*/
                                            case "delete";
                                                $query = "delete from subjects where id=?";
                                                $stm = $con->prepare($query);
                                                $stm->execute(array($id));
                        
                                                if($stm->rowCount()){
                                                    echo "<div class='alert-success'>One row deleted successfully ^_^</dive>";
                                                }
                                            break;

                                            default;
                                            echo "<div class='alert-danger'>Error..!</dive>"; 
                                        }
                                    }
                                ?>
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover "
                                            id="dataTables-example">
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Description</th>
                                                    <th>image</th>
                                                    <th>action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                                $query = "select * from subjects";
                                                $stm = $con -> prepare($query);                                                
                                                $stm -> execute();
                                                
                                                if($stm -> rowCount()){
                                                    foreach($stm -> fetchAll() as $row){
                                                        $id=$row['id'];
                                                        $name=$row['name'];
                                                        $photo=$row['image'];
                                                        $description=$row['description'];
                                            ?>
                                                <tr class="odd gradeX">
                                                    <td><?php echo $name ?></td>
                                                    <td><?php echo $description ?></td>
                                                    <td><a href="imageView.php?action=image&name=<?php echo $photo; ?>"><?php echo $photo?></a></td>
                                                    <td>
                                                        <a href="subjectEdit.php?action=edit&id=<?php echo $id ?>" class='btn btn-success'>Edit</a>
                                                        <!-- التعديل يتم في صفحة أخرى لأن الكود طويل  -->
                                                        <a href="?action=delete&id=<?php echo $id ?>" class='btn btn-danger' id="delete">Delete</a>
                                                        <!-- التعديل يتم في نفس الصفحة  -->
                                                    </td>
                                                </tr>
                                                <?php
                                                    } 
                                                }
                                                else{
                                                    echo "<div class='alert-danger'>No items yet..!</dive>";
                                                }
                                                ?>

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
   
   <?php
   include('footer.php');
   ?>
   <script>
        $('#delete').click(function(){
            return confirm("Are you sure you want to delete this item?!");
        });
   </script>