<!Doctype html>
    <html>
        <head>
           
            <title>Create Account</title>
            <meta charset="Utf-8"/>
            <link rel="stylesheet" href="css/mystyle.css">
        </head>
        <body class="singbody">
            <div class="wrap">
               
                <h2>إنشاء حساب جديد</h2>
                <form method="post" action="">
                    <input type="text" name="first" id="first" placeholder="..الاسم الأول" required>
                     <input type="text" name="last" placeholder="..اسم العائلة" required>
                      <input type="text" name="email" placeholder="..الإيميل" required>
                       <input type="text" name="username" placeholder="..اسم المستخدم" required>
                        <input type="password" name="password" placeholder="..كلمة المرور" required id="password">
                        <input type="password" name="conpassword" placeholder="..تأكيد كلمة المرور" required id="conpassword">
                        <input type="submit" value="إنشاء" name="submit" id="submit">
                </form>
                <?php
                         require "admin/dbconnect.php";
                         if(isset($_POST['submit']))
                         {
                         $name= $_POST['first'];
                         $last= $_POST['last'];
                         $username=$_POST['username'];
                         $errors=array();
                         if(!preg_match('/^[a-zA-Z]+$/',$name))
                            {
                                $errors["fname"] ="<p> الاسم الاول يجب ان يكون احرف فقط </p>";
                            }
                         
                         if(!preg_match('/^[a-zA-Z]+$/',$last))
                            {
                                $errors["lname"] = "<p> الاسم الاخير يجب ان يكون احرف فقط </p>";
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
                                if(!empty($errors))
                                {
                                    foreach($errors as $value)
                                    {
                                        echo $value;
                                    }
                                }
                                else
                                {
                                    $fullname=$_POST["first"]." ".$_POST["last"];
                            $username=$_POST["username"];
                            $email=$_POST["email"];
                            $password=$_POST["password"];
                            $conpassword=$_POST["conpassword"];
                            $passworden=password_hash($password,PASSWORD_DEFAULT);
                            
                     
                        
                            
                            $getUsers=$con->prepare("insert into user(username,email,password,fullname) values(?,?,?,?);");
                            $getUsers->execute(array($username,$email,$passworden,$fullname));
                            echo "<script>
                                alert('^_^تم إنشاء حساب خاض بك بنجاح')
                                window.open('home.php','_self');
                            </script>";
                            
                                }
                                
                         } 
           
            ?>
              <div  id="message"></div>
            </div>
            <script src="js/check_information.js"></script>
        </body>
        
        
        
    </html>