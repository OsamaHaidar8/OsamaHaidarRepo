<?php
include('header.php');
require('dbconnect.php');
?>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h2><i class="fa fa-users"></i> Add Course</h2>


                    </div>
                </div>
                <!-- /. ROW  -->
                <hr />
                <div class="row">
                    <div class="col-md-8">
                        <!-- Form Elements -->
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <i class="fa fa-plus-circle"></i> Add New Course
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                  <?php
                               if(isset($_POST["submit"]))
                                 {
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
                                    
                                    $subject=$_POST["sub_id"];
                                    $name=trim($_POST['CourseName']);
                                    $description=trim(($_POST['Description']));
                                    $level=($_POST['Level_id']);
                                    $link=($_POST['Links']);
                                    $errors=array();
                                    if(empty($name))
                                    {
                                       $errors['cname']="<div style='color:red'>enter name </div>";
                                       
                                    }
                                    elseif(is_numeric($name))
                                    {
                                       $errors['cnameNumber']="<div style='color:red'>enter string name </div>";
                                       
                                    }
                                    else
                                    {
                                       $query="insert into courses (CourseName, Description, Level_id, Links,sub_id,image) value (?,?,?,?,?,?)";
                                        $stm= $con->prepare($query);
                                        $stm->execute(array($name,$description,$level,$link,$subject,$file_name));     
                                        if ($stm->rowCount())
                                        {
                                          echo "<div class='alert-success'>One row inserted successfully ^_^</dive>";
                                        }
                                        else
                                        {
                                          echo "<div class='alert alert-danger'>no row inserted</div>";
                                          
                                        }
                                    }
                                 }
                                 ?>
                                 
                                    <div class="col-md-12">
                                        <form role="form" method="post" enctype="multipart/form-data">
                                          <div class="form-group">
                                                <label>Subject</label>
                                                <select class="form-control" name="sub_id">
                                                   <?php  $query="select * from subjects";
                                                   $stm= $con->prepare($query);
                                                   $stm->execute();
                                                   if($stm->rowCount())
                                                   {
                                                     foreach($stm->fetchAll() as $row)
                                                     {?>
                                                     
                                                     <option value="<?php echo $row['id']; ?>" ><?php  echo $row['name']; ?></option>
                                                    <?php
                                                    }
                                                     }
                                                    ?> 
                                                </select>
                                            </div>
                                         
                                            <div class="form-group">
                                                <label>CourseName</label>
                                                <input type="text" name="CourseName" placeholder="Please Enter The CourseName "
                                                    class="form-control" />
                                                 <?php if(isset($errors['cname'])) echo $errors['cname'] ?>
                                             <?php if(isset($errors['cnameNumber'])) echo $errors['cnameNumber']?>
                                            </div>
                                            <div class="form-group">
                                                <label>Description</label>
                                                <textarea name="Description" placeholder="Please Enter Description" 
                                                class="form-control" cols="15" rows="3"></textarea>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label>Course Level</label>
                                                <select class="form-control" name="Level_id">
                                                   <?php  $query="select * from level";
                                                   $stm= $con->prepare($query);
                                                   $stm->execute();
                                                   if($stm->rowCount())
                                                   {
                                                     foreach($stm->fetchAll() as $row)
                                                     {?>
                                                     
                                                     <option value="<?php echo $row['id']; ?>" ><?php echo $row['name']; ?></option>
                                                    <?php
                                                    }
                                                     }
                                                    ?> 
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Course Link</label>
                                                <input type="text" name="Links" class="form-control"
                                                    placeholder="Please Enter the Link">
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
                                            <div style="float:right;">
                                                <button type="submit" name="submit" class="btn btn-primary">Add Course</button>
                                                <button type="reset" name="cancel" class="btn btn-danger">Cancel</button>
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
                                    <i class="fa fa-users"></i> Courses
                                </div>
                                <?php
                                
                                if(isset($_GET['action'],$_GET['id']))
                                {
                                 $id=$_GET['id'];
                                 $action=$_GET['action'];
                                 switch($action)
                                 {
                                    
                                    case "delete":
                                       $query="delete from courses  where id=:catid";
                                       $stm= $con->prepare($query);
                                       $stm->execute(array('catid'=>$id));
                                       if( $stm->rowCount())
                                       echo "<div class='alert alert-succes'>one row deleted</div>";
                                       break;
                                    default:
                                       echo "error";
                                       break;
                                       
                                 }
                                }
                                
                                
                                ?>
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover"
                                            id="dataTables-example">
                                            <thead>
                                                <tr>
                                                   <th>ID</th>
                                                   <th>Subject</th>
                                                    <th>CourseName</th>
                                                    <th>Description</th>
                                                    <th>Course Level</th>
                                                    <th>Course Link</th>
                                                    <th>Image</th>
                                                    
                                                </tr>
                                            </thead>
                                            <tbody>
                                           <?php
                                           $query="select subjects.name as subject,level.name as level, courses.id,courses.image,courses.CourseName,courses.Description
                                           ,courses.Links from courses join subjects on courses.sub_id=subjects.id join level on courses.level_id=level.id";
                                                   $stm= $con->prepare($query);
                                                   $stm->execute();
                                                   if($stm->rowCount())
                                                   {
                                                     foreach($stm->fetchAll() as $row)
                                                     {
                                                      $subject=$row['subject'];
                                                        $id=$row['id'];
                                                        $name=$row['CourseName'];
                                                        $description=$row['Description'];
                                                         $level=$row['level'];
                                                         $link=$row['Links'];
                                                         $image=$row['image'];
                                             ?>
                                                <tr class="odd gradeX">
                                                  
                                                   <td><?php echo $id ?></td>
                                                    <td><?php echo $subject ?></td>
                                                    <td><?php  echo $name?></td>
                                                    <td><?php  echo $description?></td>
                                                    <td><?php  echo $level?></td>
                                                    <td><?php  echo $link?></td>
                                                     <td><a href="imageView.php?action=image&name=<?php echo $image; ?>"><?php  echo $image?></a></td>
                                                    
                                                

                                                    <td>
                                                      <a href="CourseEdit.php?action=edit&id=<?php echo $id ?>" class='btn btn-success' >Edit</a>
                                                      <!--a href="‏useredit.php?action=edit&id=<?php echo $id ?>" class='btn btn-success' >Edit</a-->
                                                      <a href="?action=delete&id=<?php echo $id ?>" class='btn btn-danger' id="delete">Delete</a>
                                                    </td>
                                                </tr>
                                                           <?php  }
                            } else {?>
                            
                             <div class='alert alert-danger'>No rows</div>
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
   
   <?php
   include('footer.php');
   ?>
   <script>
      $('#delete').click(function(){
         return confirm('Are you sure !');
      });
      </script>
   