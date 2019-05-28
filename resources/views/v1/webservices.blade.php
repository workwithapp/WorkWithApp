<html>
    <head>
        <title>Workwith (API)</title>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <style>
            input{

                height:30px;
                width:200px;
            }
        </style>
    </head>
    
    <body>  

        <h2>Webservice Workwith</h2>
        <h4>Server Url: http://142.4.10.93/~vooap/workwith/api/v1/</h4>

        <h3>(1)Signup(signup) </h3>
        <form method="post" action="{{url('/api/v1/signup')}}">
            <table>
                <tr>
                    <td>Email:</td>
                    <td><input type="email" name="email" ></td>
                    <td>email</td>
                </tr> 
                <tr>
                    <td>Password:</td>
                    <td><input type="password" name="password"></td>
                    <td>password</td>
                </tr>
                <tr>
                    <td>device_id</td>
                    <td><input type="text" name="device_id"></td>
                    <td>device_id</td>
                </tr>
                <tr>
                    <td>Version</td>
                    <td><input type="text" name="version"></td>
                    <td>version</td>
                </tr>
                
                <tr>
                    <td>device_type</td>
                    <td><input type="text" name="device_type"></td>
                    <td>device_type (A=Android,I=IOS)</td>
                </tr>
                <tr>
                    <td><input type="submit" value="SignUp" name="submit"></td>
                </tr>
            </table>
        </form>

        <h3>(2)Social signup(socialSignup) </h3>
        <form method="post" action="{{url('/api/v1/socialSignup')}}">
            <table>
                <tr>
                    <td>social_id</td>
                    <td><input type="text" name="social_id"></td>
                    <td>social_id </td>
                </tr>
                <tr>
                    <td>Email:</td>
                    <td><input type="email" name="email" ></td>
                    <td>email</td>
                </tr> 
                <tr>
                    <td>device_id</td>
                    <td><input type="text" name="device_id"></td>
                    <td>device_id</td>
                </tr>
                <tr>
                    <td>Version</td>
                    <td><input type="text" name="version"></td>
                    <td>version</td>
                </tr>
                <tr>
                    <td>register_type</td>
                    <td><input type="text" name="register_type"></td>
                    <td>register_type(F=Facebook,L=LinkedIn)</td>
                </tr>
                <tr>
                    <td>device_type</td>
                    <td><input type="text" name="device_type"></td>
                    <td>device_type (A=Android,I=IOS)</td>
                </tr>
                <tr>
                    <td><input type="submit" value="SignUp" name="submit"></td>
                </tr>
            </table>
        </form>

        <br>***************************<br>

        <h3>(3)Login(login)</h3>
        <form method="post" action="{{url('/api/v1/login')}}">
            <table>
                <tr>
                    <td>Email:</td>
                    <td><input type="email" name="email" ></td>
                    <td>email</td>
                </tr> 
                <tr>
                    <td>Password:</td>
                    <td><input type="password" name="password"></td>
                    <td>password</td>
                </tr>
                <tr>
                    <td>device_id</td>
                    <td><input type="text" name="device_id"></td>
                    <td>device_id</td>
                </tr>
                <tr>
                    <td>device_type</td>
                    <td><input type="text" name="device_type"></td>
                    <td>device_type (A=Android,I=IOS)</td>
                </tr>
                <tr>
                    <td>App version</td>
                    <td><input type="text" name="version"></td>
                    <td>version</td>
                </tr>
                <tr>
                    <td><input type="submit" value="Submit" name="submit"></td>
                </tr>
            </table>
        </form>

        <br>***************************<br>

        <h3>(4)Logout(logout)</h3>
        <form method="post" action="{{url('/api/v1/logout')}}">
            <table>
                <tr>
                    <td>User id:</td>
                    <td><input type="text" name="user_id" ></td>
                    <td>user_id</td>
                </tr>
                <tr>
                    <td>Token:</td>
                    <td><input type="text" name="token" ></td>
                    <td>token</td>
                </tr> 
                <tr>
                    <td>device_type</td>
                    <td><input type="text" name="device_type"></td>
                    <td>device_type (A=Android,I=IOS)</td>
                </tr>
                <tr>
                    <td>App version</td>
                    <td><input type="text" name="version"></td>
                    <td>version</td>
                </tr>
                <tr>
                    <td><input type="submit" value="Submit" name="submit"></td>
                </tr>
            </table>
        </form>
        
        <br>*******************************************************************<br>
        <h3>(5)Forgotpassword(forgotPassword) </h3>
        <form method="post" action="{{url('/api/v1/forgotPassword')}}">
            <table>
                <tr>
                    <td>Email:</td>
                    <td><input type="email" name="email" ></td>
                    <td>email</td>
                </tr> 
                <tr>
                    <td>version</td>
                    <td><input type="text" name="version"></td>
                    <td>version</td>
                </tr>
                <tr>
                    <td>Device Type</td>
                    <td><input type="text" name="device_type"></td>
                    <td>device_type(A=Android,I=IOS)</td>
                </tr>
                <tr>
                    <td><input type="submit" value="Submit" name="submit"></td>
                </tr>
            </table>
        </form>

        <br>*******************************************************************<br>
        <h3>(6)Interest list (getInterest) </h3>
        <form method="post" action="{{url('/api/v1/getInterest')}}">
            <table>
                <tr>
                    <td>version</td>
                    <td><input type="text" name="version"></td>
                    <td>version</td>
                </tr>
                <tr>
                    <td>Device Type</td>
                    <td><input type="text" name="device_type"></td>
                    <td>device_type(A=Android,I=IOS)</td>
                </tr>
                <tr>
                    <td><input type="submit" value="Submit" name="submit"></td>
                </tr>
            </table>
        </form>

        <br>*******************************************************************<br>
        <h3>(7)Days list (getDays) </h3>
        <form method="post" action="{{url('/api/v1/getDays')}}">
            <table>
                <tr>
                    <td>version</td>
                    <td><input type="text" name="version"></td>
                    <td>version</td>
                </tr>
                <tr>
                    <td>Device Type</td>
                    <td><input type="text" name="device_type"></td>
                    <td>device_type(A=Android,I=IOS)</td>
                </tr>
                <tr>
                    <td><input type="submit" value="Submit" name="submit"></td>
                </tr>
            </table>
        </form>

        <br>*******************************************************************<br>
        <h3>(8)Time list (getTimes) </h3>
        <form method="post" action="{{url('/api/v1/getTimes')}}">
            <table>
                <tr>
                    <td>version</td>
                    <td><input type="text" name="version"></td>
                    <td>version</td>
                </tr>
                <tr>
                    <td>Device Type</td>
                    <td><input type="text" name="device_type"></td>
                    <td>device_type(A=Android,I=IOS)</td>
                </tr>
                <tr>
                    <td><input type="submit" value="Submit" name="submit"></td>
                </tr>
            </table>
        </form>
            
            <br>*******************************************************************<br>
        <h3>(9)Create Profile(createProfile) </h3>
        <form method="post" action="{{url('/api/v1/createProfile/')}}" enctype="multipart/form-data">
            <table>
                <tr>
                    <td>User id:</td>
                    <td><input type="text" name="user_id" ></td>
                    <td>user_id</td>
                </tr> 
                <tr>
                    <td>Name:</td>
                    <td><input type="text" name="name" ></td>
                    <td>name</td>
                </tr> 
                 
                <tr>
                    <td>Gender:</td>
                    <td><input type="text" name="gender" ></td>
                    <td>gender(M=male,F=femail,O=other)</td>
                </tr>
                <tr>
                    <td>DOB:</td>
                    <td><input type="text" name="dob" placeholder="YYYY-MM-DD"></td>
                    <td>dob</td>
                </tr>
                <tr>
                    <td>About me:</td>
                    <td><input type="text" name="bio" ></td>
                    <td>bio</td>
                </tr>
                <tr>
                    <td>Profile picture:</td>
                    <td><input type="file" name="profile_pic" ></td>
                    <td>profile_pic</td>
                </tr>
                <tr>
                    <td>Job Title:</td>
                    <td><input type="text" name="job_title" ></td>
                    <td>job_title</td>
                </tr>
                <tr>
                    <td>Projects:</td>
                    <td><input type="text" name="project" ></td>
                    <td>project</td>
                </tr>
                <tr>
                    <td>Interest:</td>
                    <td><input type="text" name="interest" ></td>
                    <td>interest(Send id seprated by comma)</td>
                </tr>
                <tr>
                    <td>Work place:</td>
                    <td><input type="text" name="work_place" ></td>
                    <td>work_place</td>
                </tr>
                <tr>
                    <td>Days:</td>
                    <td><input type="text" name="day" ></td>
                    <td>day</td>
                </tr>
                <tr>
                    <td>Time:</td>
                    <td><input type="text" name="time" ></td>
                    <td>time</td>
                </tr> 
                <tr>
                    <td>token:</td>
                    <td><input type="text" name="token" ></td>
                    <td>token</td>
                </tr> 
                <tr>
                    <td>version</td>
                    <td><input type="text" name="version"></td>
                    <td>version</td>
                </tr>
                <tr>
                    <td><input type="submit" value="Submit" name="submit"></td>
                </tr>
            </table>
        </form>
        <br>*******************************************************************<br>


        <br>*******************************************************************<br>
        <h3>(9) Change Password (changePassword) </h3>
        <form method="post" action="{{url('/api/v1/changePassword')}}">
            <table>
                <tr>
                    <td>User id:</td>
                    <td><input type="text" name="user_id" ></td>
                    <td>user_id</td>
                </tr> 
                <tr>
                    <td>Old Password</td>
                    <td><input type="text" name="oldPassword"></td>
                    <td>oldPassword</td>
                </tr>
                <tr>
                    <td>New Password</td>
                    <td><input type="text" name="newPassword"></td>
                    <td>newPassword</td>
                </tr>
                <tr>
                    <td>Confirm Password</td>
                    <td><input type="text" name="confirmPassword"></td>
                    <td>confirmPassword</td>
                </tr>
                <tr>
                    <td><input type="submit" value="Submit" name="submit"></td>
                </tr>
            </table>
        </form>
        <br>*******************************************************************<br>
        <h3>(10) Subscription Plan (subscriptionPlan) </h3>
        <form method="post" action="{{url('/api/v1/subscriptionPlan')}}">
            <table>
                <tr>
                    <td>User id:</td>
                    <td><input type="text" name="user_id" ></td>
                    <td>user_id</td>
                </tr> 
                <tr>
                    <td><input type="submit" value="Submit" name="submit"></td>
                </tr>
            </table>
        </form>

        <br>*******************************************************************<br>
        <h3>(11) Notification (on , off) (notification) </h3>
        <form method="post" action="{{url('/api/v1/notification')}}">
            <table>
                <tr>
                    <td>User id:</td>
                    <td><input type="text" name="user_id" ></td>
                    <td>user_id</td>
                </tr>
                <tr>
                    <td>Notification status :</td>
                    <td><input type="text" name="notification_status" ></td>
                    <td>notification_status   //1 = activate , 0 = deactivate</td>
                </tr> 

                <tr>
                    <td><input type="submit" value="Submit" name="submit"></td>
                </tr>
            </table>
        </form>

        <br>*******************************************************************<br>
        <h3>(12) block User  (blockUser) </h3>
        <form method="post" action="{{url('/api/v1/blockUser')}}">
            <table>
                <tr>
                    <td>User id:</td>
                    <td><input type="text" name="user_id" ></td>
                    <td>user_id</td>
                </tr>
                <tr>
                    <td>Other User Id:</td>
                    <td><input type="text" name="other_user_id" ></td>
                    <td>other_user_id</td>
                </tr>
                <tr>
                    <td>status :</td>
                    <td><input type="text" name="status" ></td>
                    <td>  status  //1 = activate , 0 = block</td>
                </tr> 

                <tr>
                    <td><input type="submit" value="Submit" name="submit"></td>
                </tr>
            </table>
        </form>
        <br>*******************************************************************<br>
        <h3>(13) Contact Us  (contactUs) </h3>
        <form method="post" action="{{url('/api/v1/contactUs')}}">
            <table>
                <tr>
                    <td>User id:</td>
                    <td><input type="text" name="user_id" ></td>
                    <td>user_id</td>
                </tr>
                <tr>
                    <td>email:</td>
                    <td><input type="text" name="email" ></td>
                    <td>email</td>
                </tr>
                <tr>
                    <td>subject :</td>
                    <td><input type="text" name="subject" ></td>
                    <td>   subject </td>
                </tr> 
                <tr>
                    <td>message :</td>
                    <td><input type="text" name="message" ></td>
                    <td>   message </td>
                </tr> 
                <tr>
                    <td><input type="submit" value="Submit" name="submit"></td>
                </tr>
            </table>
        </form>





    </body>
</html>


    </body>
</html>