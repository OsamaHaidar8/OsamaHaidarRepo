<footer>
    <div class="footer" id="about">
        <div class="footer-content">
            <div class="container">
                <div class="row " >
                    <br>
                    <div class="col-md-4 " style="float:right">   
                        <div class="footer-section about">
                            <h1 class=logo>الـتـ<span>ـعـ</span>ـلـم</h1>
                            <p class="lead p-lead" id="con">
                            يوفر موقع التعلم الذاتي للراغبين في تعلم لغات البرمجة روابط لافضل الكورسات المتوفره على اليوتيوب مع شرح مميزات كل كورس بالاضافة الي روابط لاهم الكتب العالمية الخاصة بالبرمجة
                            وايضا يحتوى الموقع على منتدى يساعد المتعلمين في طرح استفساراتهم ومنافشة مشاكلهم البرمجية.
                            </p>
                            <div class="contact">
                            <?php
                                require "admin/dbconnect.php"; 
                                if(isset($_SESSION['userinfo']))
                                {?>
                                <a href="useredit.php?action=edit&&id=<?php echo $_SESSION['userinfo']['id']; ?>" ><img class="img-responsive center-block img1" src="images/find_user.png"></a>
                                <?php }
                                else{ ?>
                                <a href="created account.php"><img class="img-responsive center-block img1" src="images/find_user.png"></a>
                            <?php } ?>
                                <a href="www.whatsApp.com"><img class="img-responsive center-block img1" src="images/5.png"></a>
                                <a href="www.facebook.com"><img class="img-responsive center-block img1" src="images/6.png"></a>
                                <a href="www.youtube.com"><img class="img-responsive center-block img1" src="images/4.png"></a>  
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-4" style="float:right">
                        <div class="footer-section links"><br>
                            <h1>روابط سريعة</h1><br>
                            <ul>
                                <a href="#"><li>الرئيسية</li></a>
                                <a href="#"><li>المنتدى</li></a>
                                <a href="#" class="button2" id="modelbtn2"><li>تسجيل الدخول</li></a>
                                <a href="created account.php"><li>إنشاء حساب</li></a>
                                <?php if(isset($_SESSION['userinfo']))
                                {?>
                                <a href="useredit.php?action=edit&&id=<?php echo $_SESSION['userinfo']['id']; ?>" >الملف الشخصي</a>
                                <a href="logout.php" >تسجيبل الخروج</a>
                                <?php } ?>
                                <a href="#about"><li>نبذة عنا</li></a>
                                <?php 
                                    include "login.php";
                                ?>
                            </ul>
                        </div>
                    </div>
                    
                    <div class="col-md-4" style="float:right">
                        <div class="footer-section contact-form">
                            <h1>تواصل معنا</h1><br>
                            <div class="contact">
                                <form>
                                    <fieldset>
                                        <input class="email" type="text" placeholder="الإيميل" name="email" required><br><br>
                                        <textarea class="massage" type="text" placeholder="محتوى الرسالة" 
                                        rows="3" cols="40" name="message"  required></textarea><br><br>
                                        <div class="div-btn">
                                        <input class="btn btn-danger footer-btn2" type="reset"  value="إلغاء">
                                            <input class="btn btn-primary footer-btn1" mailto="osamadaif.7755@gmail.com" type="submit" value="إرسال" >  
                                        </div>
                                    </fieldset>
                                </form>
                            </div>          
                        </div>
                    </div>
                </div>
                <br><br>
            </div>
            <div class="footer-bottom">
                alta7lum.com | Designed by alta7lum &copy;
            </div>
        </div>
    </div>
</footer>
</html>