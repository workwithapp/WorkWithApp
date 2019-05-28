
<html>
    <head>
        <title>workwith API's</title>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    </head>

  <body>
  <style type="text/css">
    
    h4 {
      background: blue;
      color:white;
    }
    table tr td,table tr th{
      padding:5px;
    }
  </style>
  <div class="row webservices">

    <div class="container">
      <header>
        <h2>Workwith API's</h2>
       <!--  <h5>URL : <a href="http://142.4.10.93/~vooap/workwith/api/webservice">http://142.4.10.93/~vooap/workwith/api/v1/</a></h5> -->

      </header>
      
      <div class="row">
        <div class="col-md-2" style="position: fixed;overflow-x:hidden;max-height: 700px;">
          <div class="sidebar-nav">
            <div class="nav-canvas">
              <ul class="nav nav-pills nav-stacked main-menu">
                        
                <li> <a href= "#"><h5>API's</h5></a></li>
                <li><a href= "#login">1) Login</a></li>
                <li><a href= "#signup">2) Signup</a></li>
                <li><a href= "#social_signup">3) Social signup (not yet checked)</a></li>
                <li><a href= "#logout">4) Logout</a></li>
                <li><a href= "#forgotPassword">5) Forgot_password</a></li>
                <li><a href= "#contact_us">6) contact us</a></li>
                <li><a href= "#getInterest">7) Get Interest</a></li>
                <li><a href= "#getWorkplace">8) Get Workplace</a></li>
              
                <li><a href= "#getDays">9) Get Days</a></li>
                <li><a href= "#getTimes">10) Get Times</a></li>
                <li><a href= "#createProfile">11) Create Profile</a></li>

                <li><a href= "#updateProfile">12) Update Profile </a></li>
                <li><a href= "#myProfile">13) Get My Profile </a></li>
                <li><a href= "#otherProfile">14) Get other user Profile </a></li>
                <li><a href= "#changePassword">15) Change password </a></li>
                <li><a href= "#disableAccount">16) Disable Account </a></li>
                <li><a href= "#deleteAccount">17) Delete Account </a></li>

                <li><a href= "#suggestions">18)Suggestions </a></li> 
                <li><a href= "#matchUser">19) Match user </a></li>
                <li><a href= "#myMatches">20) my Matched</a></li>
                <li><a href= "#sendMessage">21)Send messages</a></li>
                <li><a href= "#GetMessage">23)receive/get single user chat messages</a></li>
                <li><a href= "#lastreceivemessage">23)list of last received users messages</a></li>

                <li><a href= "#articleList">24) Article list </a></li>
                <li><a href= "#articleDetails">25) Article Details </a></li>
                <!--
                <li><a href= "#match">14) Match User </a></li>
                <li><a href= "#reportUser">15) Report User </a></li>
                <li><a href= "#getProfile">16) Get Profile </a></li>
                <li><a href= "#getOtherProfile">17) Get Other Profile </a></li>
                <li><a href= "#deleteAccount">18) Delete Account </a></li>
                <li><a href= "#articleList">21) Article list </a></li>
                <li><a href= "#articleDetails">22) Article Details </a></li> -->
                
              </ul>
            </div>
          </div>
        </div>

        <div class="col-md-10 web_container" style="overflow: auto;height:700px;margin-left:20%;">  
          <!-- ***********************************-->
          <!--                Login               -->
          <!--************************************-->
          <div id="login" class="margintop">
           <h4>Signin/Login API</h4> 
            <table class="blog-comparison table table-striped table-bordered">
                
                <tr>
                  <th valign="top"> URL</th>
                  <td><span class="caption">The URL structure (path only, no root url)</span> <br>
                    <b><code>/login</code> </b>
                  </td>
                </tr>       
                
                <tr>
                  <th valign="top"> Method</th>
                  <td>
                    <span class="caption">The request type</span><br><b><code>POST</code></b>
                  </td>
                </tr>       
                <tr>
                  <th valign="top">Data Params</th>

                    <td>
                      <table border="1" width="400">
                      <tr>
              <th colspan="2" style="text-align: center;background:skyblue">Header</th>
            </tr>
            <tr>
              <th>version</th>
              <td>float</td>
            </tr>
            <tr>
              <th colspan="2" style="text-align: center;background: green">Input</th>
            </tr>
                      <tr>
                        <th>parameter</th>
                        <th>type</th>
                      </tr>
                      <tr>
                        <td>email</td>
                        <td>string</td>
                      </tr>
                      <tr>
                        <td>password</td>
                        <td>string</td>
                      </tr>
                      <tr>
                        <td>device_id</td>
                        <td>string</td>
                      </tr>
                      <tr>
                        <td>device_type(A = Android, I = IOS)</td>
                        <td>string</td>
                      </tr>
                    </table>
                  </td>
                </tr>
                
                <tr>
                  <th valign="top">
                        Success Response
                  </th>
                  <td>
                  <pre>{
    "data": {
        "id": 26,
        "social_id": "",
        "email": "admin4@gmail.com",
        "name": "",
        "gender": "",
        "dob": "",
        "profile_pic": "",
        "job_title": "",
        "bio": "",
        "project": "",
        "work_place": "",
        "address": "",
        "latitude": "",
        "longitude": "",
        "day": "",
        "time": "",
        "register_type": "O",
        "device_id": "125814",
        "device_type": "A",
        "notification_status": 1,
        "version": 1,
        "token": "YHNU0C5SSG5ac262",
        "updated_at": "2019-03-15 09:59:59",
        "created_at": "2019-03-15 09:59:59",
        "status": 1
    }
}
                  </pre>
                </td>
              </tr>       
            <tr>
          <th valign="top">Error Response</th>
          <td>
            <pre>
            Can Get four errors like this one by one
            {
    "error": "The email field is required."
}

</pre>
            <pre>{
              "message": "Email or password is incorrect"
      }</pre> 
          </td>
        </tr>   
      </table>
    </div>  

      <!-- ***********************************-->
      <!--              Signup              -->
      <!--************************************-->

    <div id="signup" class="margintop">
      <table class="blog-comparison table table-striped table-bordered">
        <h4>Signup API</h4>     
          <tr>
            <th valign="top"> URL</th>
            <td><span class="caption">The URL structure (path only, no root url)</span><br><b><code>/signup</code> </b></td>
          </tr>       
          <tr>
            <th valign="top"> Method</th>
            <td>
              <span class="caption">The request type</span> <br><b><code>POST</code></b>
            </td>
          </tr>       
          <tr>
            <th valign="top">Data Params</th>
          <td>
          <table border="1" width="400">
          <tr>
              <th colspan="2" style="text-align: center;background:orange">Header</th>
            </tr>
            <tr>
              <th>version</th>
              <th>float</th>
            </tr>
            <tr>
              <th colspan="2" style="text-align: center;background: green">Input</th>
            </tr>
            <tr>
              <th>parameter</th>
              <th>type</th>
            </tr>
            <tr>
              <td>email</td>
              <td>string</td>
            </tr>
            <tr>
              <td>password</td>
              <td>string</td>
            </tr>
            <tr>
              <td>device_id</td>
              <td>string</td>
            </tr>
            <tr>
              <td>device_type(A=Andriod, I= IOS)</td>
              <td>string</td>
            </tr>
            
          </table>
        </td>
      </tr>
      <tr>
        <th valign="top">
          Success Response
        </th>
        <td>
        <pre> 
{
    "message": "Registration successfully",
    "data": {
        "id": 28,
        "email": "johnson@gmail.com",
        "token": "I7C6EWKFYAbd9262",
        "device_id": "465465445",
        "device_type": "A"
    }
}
       </pre>
    </td>
  </tr>       
  <tr>
    <th valign="top">Error Response</th>
    <td>
      <pre>
        {
    "error": "The email field is required."
}
Confliction == >
      {
    "message": "Email has already been taken."
}</pre> 
    </td>
  </tr> 
</table>
</div>  


<!-- ***********************************-->
      <!--              Signup              -->
      <!--************************************-->

    <div id="social_signup" class="margintop">
      <table class="blog-comparison table table-striped table-bordered">
        <h4>Social Signup API (Current not working properly) </h4>     
          <tr>
            <th valign="top"> URL</th>
            <td><span class="caption">The URL structure (path only, no root url)</span><br><b><code>/socialSignup</code> </b></td>
          </tr>       
          <tr>
            <th valign="top"> Method</th>
            <td>
              <span class="caption">The request type</span> <br><b><code>POST</code></b>
            </td>
          </tr>       
          <tr>
            <th valign="top">Data Params</th>
          <td>
          <table border="1" width="400">
            <tr>
              <th>parameter</th>
              <th>type</th>
            </tr>
            <tr>
              <td>email</td>
              <td>string</td>
            </tr>
            <tr>
              <td>social_id</td>
              <td>string</td>
            </tr>
            <tr>
              <td>device_id</td>
              <td>string</td>
            </tr>
            <tr>
              <td>register_type(F=Facebook, L=LinkedIn)</td>
              <td>string</td>
            </tr>
            <tr>
              <td>devicet_ype(A=Andriod,I= IOS)</td>
              <td>string</td>
            </tr>
            <tr>
              <td>version</td>
              <td>string</td>
            </tr>
          </table>
        </td>
      </tr>
      <tr>
        <th valign="top">
          Success Response
        </th>
        <td>
        <pre> 
{
    "status": 200,
    "message": "Registration Successfully",
    "data": {
        "result": {
            "id": 1,
            "token": "A92WU7MFZ4295909",
        }
    }
}
       </pre>
    </td>
  </tr>       
  <tr>
    <th valign="top">Error Response</th>
    <td>
      <pre>{"status":"204","message":"Email has already been taken"}</pre>
      <pre>{"status":"204","message":"Password and confirm password is mismatched."}</pre>
      <pre>{"status":"204","message":"Please fill email fields"}</pre> 
    </td>
  </tr> 
</table>
</div>

            <!-- *******************-->
            <!--  logout  -->
            <!--*******************-->
        <div id="logout"  class="margintop">
                <table class="blog-comparison table table-striped table-bordered">
                    <h4>Logout</h4>    
                  <tr>
                    <th valign="top"> URL</th>
                    <td><span class="caption">The URL structure (path only, no root url)</span> <br>
                        <b><code>/logout</code> </b></td>
                  </tr>       
                  <tr><th valign="top"> Method</th>
                    <td><span class="caption">The request type</span> <br>
                        <b><code>POST/GET</code></b>
                    </td>
                  </tr>       
                  <tr><th valign="top">Data Params</th>
                    <td>
                        <table border="1" width="400">
                       <tr>
                            <th colspan="2" style="text-align: center;background:orange">Header</th>
                          </tr>
                          <tr>
                            <th>version</th>
                            <th>float</th>
                          </tr>
                          <tr>
                            <th>token</th>
                            <th>string</th>
                          </tr>
                        </table>
                    </td>
                  </tr>
                    <tr><th valign="top">
                        Success Response
                      </th>
                      <td>
                <pre> {
    "message": "You are logged out successfully"
}</pre>
                      </td>
                    </tr>       
                    <tr>
                      <th valign="top">Error Response</th>
                      <td>
                         
                          <pre></pre>
                      </td>
                    </tr>
            
        </table>
        </div>  
<!-- ***********************************-->
<!--           Forgot Password          -->
<!--************************************-->

        <div id="forgotPassword"  class="margintop">
            <table class="blog-comparison table table-striped table-bordered">
               <h4>forgot password API</h4>      
                  <tr>
                    <th valign="top"> URL</th>
                     <td><span class="caption">The URL structure (path only, no root url)</span> <br>
                       <b><code>/forgotPassword</code> </b></td>
                        </tr>       
                           <tr><th valign="top"> Method</th>
                            <td><span class="caption">The request type</span> <br>
                             <b><code>POST</code></b>
                             </td>
                            </tr>       
                           <tr><th valign="top">Data Params</th>
                          <td>
                         <table border="1" width="400">
                         <tr>
                            <th colspan="2" style="text-align: center;background:orange">Header</th>
                          </tr>
                          <tr>
                            <th>version</th>
                            <th>float</th>
                          </tr>
                          <tr>
                            <th>token</th>
                            <th>string</th>
                          </tr>
                          <tr>
                            <th colspan="2" style="text-align: center;background:green">Input</th>
                          </tr>
                       <tr><th>parameter</th>
                      <th>type</th>
                    </tr>
                   <tr><td>email</td><td>string</td></tr>
                 </table>
                </td>
                </tr>
              <tr><th valign="top">
              Success Response
            </th>
          <td>
    <pre> {
            
            "message": "Please check your mail address to reset your password"
           }</pre>
              </td>
                </tr>       
                  <tr>
                <th valign="top">Error Response</th>
               <td>                    
                <pre>{"error":"Please fill email field"}</pre>           
                </td>
                </tr>
                </table>
                </div>


<!-- ***********************************-->
<!--          Contact us       -->
<!--************************************-->
        <div id="contact_us"  class="margintop">
                <table class="blog-comparison table table-striped table-bordered">
                    <h4>Contact Us</h4>    
                  <tr>
                    <th valign="top"> URL</th>
                    <td><span class="caption">The URL structure (path only, no root url)</span> <br>
                        <b><code>/contact_us</code> </b></td>
                  </tr>       
                  <tr><th valign="top"> Method</th>
                    <td><span class="caption">The request type</span> <br>
                        <b><code>POST</code></b>
                    </td>
                  </tr>       
                  <tr><th valign="top">Data Params</th>
                    <td>
                        <table border="1" width="400">
                            <tr><th>parameter</th>
                            <th>type</th>
                            </tr>
                            <tr><td>user_name </td><td>string</td></tr>
                            <tr><td>message </td><td>string</td></tr>
                            <tr><td>subject </td><td>string</td></tr>
                            <tr><td>email </td><td>String</td></tr>
                            <tr><td>devicetype(A = Android, I = IOS)</td><td>string</td></tr>
                        </table>
                    </td>
                  </tr>
                    <tr><th valign="top">
                        Success Response
                      </th>
                      <td>
                <pre>{
    "message": "Profile create Successfully"
}</pre>
                      </td>
                    </tr>       
                    <tr>
                      <th valign="top">Error Response</th>
                      <td>
                          <pre>{"error": "Please fill all fields!"}</pre>
                          <pre>{"error": "Failed to create profile"}</pre>
                         
                      </td>
                    </tr>
            
        </table>
        </div>  
        





<!-- ***********************************-->
<!--           getInterest    -->
<!--************************************-->


<div id="getInterest" class="margintop">
                <table class="blog-comparison table table-striped table-bordered">
                    <h4>Get Interest</h4>    
                  <tr>
                    <th valign="top"> URL</th>
                    <td><span class="caption">The URL structure (path only, no root url)</span> <br>
                        <b><code>/getInterest</code> </b></td>
                  </tr>       
                  <tr><th valign="top"> Method</th>
                    <td><span class="caption">The request type</span> <br>
                        <b><code>GET</code></b>
                    </td>
                  </tr>       
                  <tr><th valign="top">Data Params</th>
                    <td>
                        <table border="1" width="400">
                        <tr>
                            <th colspan="2" style="text-align: center;background:orange">Header</th>
                          </tr>
                            <tr><td>token </td><td>string</td></tr>

                            <tr><td>version</td><td>float</td></tr>
                        </table>
                    </td>
                  </tr>
                    <tr><th valign="top">
                        Success Response
                      </th>
                      <td>
                <pre>{
    "data": [
        {
            "id": 1,
            "name": "Friendship",
            "status": 1,
            "updated_at": "2018-08-09 12:18:00",
            "created_at": "2018-08-09 12:18:00"
        },
        {
            "id": 2,
            "name": "Collaborators",
            "status": 1,
            "updated_at": "2018-04-19 12:18:00",
            "created_at": "2018-04-19 12:18:00"
        },
        {
            "id": 3,
            "name": "Input/inspiration",
            "status": 1,
            "updated_at": "2018-08-09 12:18:00",
            "created_at": "2018-08-09 12:18:00"
        },
        {
            "id": 4,
            "name": "Work/Study Partner",
            "status": 1,
            "updated_at": "2018-08-09 12:18:00",
            "created_at": "2018-08-09 12:18:00"
        }
    ]
}</pre>
                      </td>
                    </tr>       
                    <tr>
                      <th valign="top">Error Response</th>
                      <td>
                          <pre>{"data": []}</pre>
                          
                         
                      </td>
                    </tr>
            
        </table>
        </div> 




<!-- ***********************************-->
<!--           getWorkplace    -->
<!--************************************-->


<div id="getWorkplace" class="margintop">
                <table class="blog-comparison table table-striped table-bordered">
                    <h4>Get Interest</h4>    
                  <tr>
                    <th valign="top"> URL</th>
                    <td><span class="caption">The URL structure (path only, no root url)</span> <br>
                        <b><code>/getWorkplace</code> </b></td>
                  </tr>       
                  <tr><th valign="top"> Method</th>
                    <td><span class="caption">The request type</span> <br>
                        <b><code>GET</code></b>
                    </td>
                  </tr>       
                  <tr><th valign="top">Data Params</th>
                    <td>
                        <table border="1" width="400">
                        <tr>
                            <th colspan="2" style="text-align: center;background:orange">Header</th>
                          </tr>
                            <tr><td>token </td><td>string</td></tr>

                            <tr><td>version</td><td>float</td></tr>
                        </table>
                    </td>
                  </tr>
                    <tr><th valign="top">
                        Success Response
                      </th>
                      <td>
                <pre>{
    "data": [
        {
            "id": 1,
            "name": "Home",
            "status": 1,
            "created_at": "2019-02-20 16:25:02",
            "updated_at": "2019-02-20 10:55:02"
        },
        {
            "id": 2,
            "name": "College",
            "status": 1,
            "created_at": "2019-02-20 16:25:02",
            "updated_at": "2019-02-20 10:55:02"
        }
    ]
}</pre>
                      </td>
                    </tr>       
                    <tr>
                      <th valign="top">Error Response</th>
                      <td>
                          <pre>{"data": []}</pre>
                          
                         
                      </td>
                    </tr>
            
        </table>
        </div> 





<!-- ***********************************-->
<!--           getDays    -->
<!--************************************-->


<div id="getDays" class="margintop">
                <table class="blog-comparison table table-striped table-bordered">
                    <h4>Get Interest</h4>    
                  <tr>
                    <th valign="top"> URL</th>
                    <td><span class="caption">The URL structure (path only, no root url)</span> <br>
                        <b><code>/getDays</code> </b></td>
                  </tr>       
                  <tr><th valign="top"> Method</th>
                    <td><span class="caption">The request type</span> <br>
                        <b><code>GET</code></b>
                    </td>
                  </tr>       
                  <tr><th valign="top">Data Params</th>
                    <td>
                        <table border="1" width="400">
                        <tr>
                            <th colspan="2" style="text-align: center;background:orange">Header</th>
                          </tr>
                            <tr><td>token </td><td>string</td></tr>

                            <tr><td>version</td><td>float</td></tr>
                        </table>
                    </td>
                  </tr>
                    <tr><th valign="top">
                        Success Response
                      </th>
                      <td>
                <pre>{
    "data": [
        {
            "id": 1,
            "name": "Weekdays",
            "days": "Monday,Tuesday,Wednesday,Thursday,Friday",
            "status": 1,
            "updated_at": "2018-08-09 12:18:00",
            "created_at": "2018-08-09 12:18:00"
        },
        {
            "id": 2,
            "name": "Weekends",
            "days": "Saturday,Sunday",
            "status": 1,
            "updated_at": "2018-04-19 12:18:00",
            "created_at": "2018-04-19 12:18:00"
        },
        {
            "id": 3,
            "name": "Both",
            "days": "Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday",
            "status": 1,
            "updated_at": "2018-08-09 12:18:00",
            "created_at": "2018-08-09 12:18:00"
        }
    ]
}</pre>
                      </td>
                    </tr>       
                    <tr>
                      <th valign="top">Error Response</th>
                      <td>
                          <pre>{"data":[]}</pre>
                          
                         
                      </td>
                    </tr>
            
        </table>
        </div> 




<div id="getTimes" class="margintop">
                <table class="blog-comparison table table-striped table-bordered">
                    <h4>Get Interest</h4>    
                  <tr>
                    <th valign="top"> URL</th>
                    <td><span class="caption">The URL structure (path only, no root url)</span> <br>
                        <b><code>/getDays</code> </b></td>
                  </tr>       
                  <tr><th valign="top"> Method</th>
                    <td><span class="caption">The request type</span> <br>
                        <b><code>GET</code></b>
                    </td>
                  </tr>       
                  <tr><th valign="top">Data Params</th>
                    <td>
                        <table border="1" width="400">
                        <tr>
                            <th colspan="2" style="text-align: center;background:orange">Header</th>
                          </tr>
                            <tr><td>token </td><td>string</td></tr>

                            <tr><td>version</td><td>float</td></tr>
                        </table>
                    </td>
                  </tr>
                    <tr><th valign="top">
                        Success Response
                      </th>
                      <td>
                <pre>{
    "data": [
        {
            "id": 1,
            "name": "Friendship",
            "status": 1,
            "updated_at": "2018-08-09 12:18:00",
            "created_at": "2018-08-09 12:18:00"
        },
        {
            "id": 2,
            "name": "Collaborators",
            "status": 1,
            "updated_at": "2018-04-19 12:18:00",
            "created_at": "2018-04-19 12:18:00"
        },
        {
            "id": 3,
            "name": "Input/inspiration",
            "status": 1,
            "updated_at": "2018-08-09 12:18:00",
            "created_at": "2018-08-09 12:18:00"
        },
        {
            "id": 4,
            "name": "Work/Study Partner",
            "status": 1,
            "updated_at": "2018-08-09 12:18:00",
            "created_at": "2018-08-09 12:18:00"
        }
    ]
}</pre>
                      </td>
                    </tr>       
                    <tr>
                      <th valign="top">Error Response</th>
                      <td>
                          <pre>{"data":[]}</pre>
                          
                         
                      </td>
                    </tr>
            
        </table>
        </div> 



<!-- ***********************************-->
<!--           createProfile         -->
<!--************************************-->
        <div id="createProfile"  class="margintop">
                <table class="blog-comparison table table-striped table-bordered">
                    <h4>create Profile</h4>    
                  <tr>
                    <th valign="top"> URL</th>
                    <td><span class="caption">The URL structure (path only, no root url)</span> <br>
                        <b><code>/createProfile</code> </b></td>
                  </tr>       
                  <tr><th valign="top"> Method</th>
                    <td><span class="caption">The request type</span> <br>
                        <b><code>POST</code></b>
                    </td>
                  </tr>       
                  <tr><th valign="top">Data Params</th>
                    <td>
                        <table border="1" width="400">
                        <tr>
                            <th colspan="2" style="text-align: center;background:orange">Header</th>
                          </tr>
                            <tr><td>token </td><td>string</td></tr>

                            <tr><td>version</td><td>float</td></tr>
                          <tr>
                            <th colspan="2" style="text-align: center;background:green">Input</th>
                          </tr>
                            <tr>
                                <th>parameter</th>
                                <th>type</th>
                            </tr>
                            <tr>
                              <td>name(required)</td>
                              <td>string</td>
                            </tr>
                            <tr>
                              <td>dob(required)</td>
                              <td>string</td>
                            </tr>
                            <tr>
                              <td>interest(required)</td>
                              <td>string(comma separated integer values)</td>
                            </tr>

                            <tr>
                                <td>profile_pic</td>
                                <td>file</td>
                            </tr>
                            <tr>
                                <td>gender(M=male,F=femail,O=other)</td>
                                <td>string</td>
                            </tr>
                            <tr>
                                <td>dob</td>
                                <td>string(Y-m-d)</td>
                            </tr>
                            <tr>
                                <td>bio</td>
                                <td>String</td>
                            </tr>
                            <tr>
                                <td>job_title</td>
                                <td>string</td>
                            </tr>
                            <tr>
                                <td>project</td>
                                <td>string</td>
                            </tr>
                            <tr>
                                <td>work_place</td>
                                <td>integer</td>
                            </tr>
                            <tr>
                                <td>day</td>
                                <td>integer</td>
                            </tr>
                            <tr>
                                <td>time</td>
                                <td>integer</td>
                            </tr>
                            <tr>
                                <td>latitude (required)</td>
                                <td>string</td>
                            </tr>
                            <tr>
                                <td>longitude (required)</td>
                                <td>string</td>
                            </tr>
                            <tr>
                                <td>goal</td>
                                <td>string</td>
                            </tr>
                        </table>
                    </td>
                  </tr>
                    <tr><th valign="top">
                        Success Response
                      </th>
                      <td>
                <pre>{
    "message": "Profile create Successfully"
}</pre>
                      </td>
                    </tr>       
                    <tr>
                      <th valign="top">Error Response</th>
                      <td>
                          <pre>{
    "error": "The name field is required."
}
{
    "error": "Failed to create profile"
}

</pre>
                          
                         
                      </td>
                    </tr>
            
        </table>
        </div> 

<!-- Update profile -->
<div id="updateProfile"  class="margintop">
                <table class="blog-comparison table table-striped table-bordered">
                    <h4>update Profile</h4>    
                  <tr>
                    <th valign="top"> URL</th>
                    <td><span class="caption">The URL structure (path only, no root url)</span> <br>
                        <b><code>/updateProfile</code> </b></td>
                  </tr>       
                  <tr><th valign="top"> Method</th>
                    <td><span class="caption">The request type</span> <br>
                        <b><code>POST</code></b>
                    </td>
                  </tr>       
                  <tr><th valign="top">Data Params</th>
                    <td>
                        <table border="1" width="400">
                        <tr>
                            <th colspan="2" style="text-align: center;background:orange">Header</th>
                          </tr>
                            <tr><td>token </td><td>string</td></tr>

                            <tr><td>version</td><td>float</td></tr>
                          <tr>
                            <th colspan="2" style="text-align: center;background:green">Input</th>
                          </tr>
                            <tr>
                                <th>parameter</th>
                                <th>type</th>
                            </tr>
                            <tr>
                              <td>name(required)</td>
                              <td>string</td>
                            </tr>
                            <tr>
                              <td>dob(required)</td>
                              <td>string</td>
                            </tr>
                            <tr>
                              <td>interest(required)</td>
                              <td>string(comma separated integer values)</td>
                            </tr>

                            <tr>
                                <td>profile_pic</td>
                                <td>file</td>
                            </tr>
                            <tr>
                                <td>gender(M=male,F=femail,O=other)</td>
                                <td>string</td>
                            </tr>
                            <tr>
                                <td>dob</td>
                                <td>string(Y-m-d)</td>
                            </tr>
                            <tr>
                                <td>bio</td>
                                <td>String</td>
                            </tr>
                            <tr>
                                <td>job_title</td>
                                <td>string</td>
                            </tr>
                            <tr>
                                <td>project</td>
                                <td>string</td>
                            </tr>
                            <tr>
                                <td>work_place</td>
                                <td>integer</td>
                            </tr>
                            <tr>
                                <td>day</td>
                                <td>integer</td>
                            </tr>
                            <tr>
                                <td>time</td>
                                <td>integer</td>
                            </tr>
                            <tr>
                                <td>latitude (required)</td>
                                <td>string</td>
                            </tr>
                            <tr>
                                <td>longitude (required)</td>
                                <td>string</td>
                            </tr>
                            <tr>
                                <td>goal</td>
                                <td>string</td>
                            </tr>
                        </table>
                    </td>
                  </tr>
                    <tr><th valign="top">
                        Success Response
                      </th>
                      <td>
                <pre>{
    "message": "Profile updated Successfully"
}</pre>
                      </td>
                    </tr>       
                    <tr>
                      <th valign="top">Error Response</th>
                      <td>
                          <pre>{
    "error": "The name field is required."
}
{
    "error": "Failed to update profile"
}

</pre>
                          
                         
                      </td>
                    </tr>
            
        </table>
        </div> 

        <!-- get profile -->
<div id="myProfile"  class="margintop">
                <table class="blog-comparison table table-striped table-bordered">
                    <h4>Get My Profile</h4>    
                  <tr>
                    <th valign="top"> URL</th>
                    <td><span class="caption">The URL structure (path only, no root url)</span> <br>
                        <b><code>/getProfile</code> </b></td>
                  </tr>       
                  <tr><th valign="top"> Method</th>
                    <td><span class="caption">The request type</span> <br>
                        <b><code>GET</code></b>
                    </td>
                  </tr>       
                  <tr><th valign="top">Data Params</th>
                    <td>
                        <table border="1" width="400">
                        <tr>
                            <th colspan="2" style="text-align: center;background:orange">Header</th>
                          </tr>
                            <tr><td>token </td><td>string</td></tr>

                            <tr><td>version</td><td>float</td></tr>
                          
                        </table>
                    </td>
                  </tr>
                    <tr><th valign="top">
                        Success Response
                      </th>
                      <td>
                <pre>{
    "data": {
        "id": 29,
        "social_id": "",
        "email": "johnson1@gmail.com",
        "name": "johnson",
        "gender": "M",
        "dob": "2019-03-15",
        "profile_pic": "http://192.168.2.19/workwith/public/uploads/profile/15c8b48db4f2e3.png",
        "job_title": "Web developer",
        "bio": "2019-10-10",
        "project": "Workwith",
        "work_place": "2",
        "address": "Netset",
        "latitude": "33.44",
        "longitude": "77.22",
        "day": "1",
        "time": "2",
        "register_type": "O",
        "device_id": "",
        "device_type": "",
        "notification_status": 1,
        "version": 1,
        "token": "123456789",
        "updated_at": "2019-03-15 12:10:27",
        "created_at": "2019-03-15 11:04:48",
        "status": 1,
        "interest": [
            1,
            2
        ],
        "distance": "12"
    }
}</pre>
                      </td>
                    </tr>       
                    <tr>
                      <th valign="top">Error Response</th>
                      <td>
                          
                          
                         
                      </td>
                    </tr>
            
        </table>
        </div> 

  <!-- Get other user profile -->

<div id="otherProfile"  class="margintop">
                <table class="blog-comparison table table-striped table-bordered">
                    <h4>Get Other User Profile</h4>    
                  <tr>
                    <th valign="top"> URL</th>
                    <td><span class="caption">The URL structure (path only, no root url)</span> <br>
                        <b><code>otherUserProfile/{other_user_id}</code> </b></td>
                  </tr>       
                  <tr><th valign="top"> Method</th>
                    <td><span class="caption">The request type</span> <br>
                        <b><code>POST</code></b>
                    </td>
                  </tr>       
                  <tr><th valign="top">Data Params</th>
                    <td>
                        <table border="1" width="400">
                        <tr>
                            <th colspan="2" style="text-align: center;background:orange">Header</th>
                          </tr>
                            <tr><td>token </td><td>string</td></tr>

                            <tr><td>version</td><td>float</td></tr>
                          
                        </table>
                    </td>
                  </tr>
                    <tr><th valign="top">
                        Success Response
                      </th>
                      <td>
                <pre>{
    "data": {
        "id": 3,
        "name": "Satish",
        "profile_pic": "http://192.168.2.19/workwith/public/uploads/profile/1552280481.png",
        "job_title": "Web developer",
        "bio": "I am alone",
        "project": "workwith",
        "work_place": "Netset",
        "address": "Mohali",
        "latitude": "30.768180",
        "longitude": "76.714160",
        "day": "1",
        "time": "2",
        "interest": [
            5
        ],
        "distance": "25"
    }
}</pre>
                      </td>
                    </tr>       
                    <tr>
                      <th valign="top">Error Response</th>
                      <td>
                         {
    "error": "User not exists"
}                        
                         
                      </td>
                    </tr>
            
        </table>
        </div> 
 <!-- Get Change profile -->

<div id="changePassword"  class="margintop">
                <table class="blog-comparison table table-striped table-bordered">
                    <h4>Change password</h4>    
                  <tr>
                    <th valign="top"> URL</th>
                    <td><span class="caption">The URL structure (path only, no root url)</span> <br>
                        <b><code>changePassword</code> </b></td>
                  </tr>       
                  <tr><th valign="top"> Method</th>
                    <td><span class="caption">The request type</span> <br>
                        <b><code>POST</code></b>
                    </td>
                  </tr>       
                  <tr><th valign="top">Data Params</th>
                    <td>
                        <table border="1" width="400">
                        <tr>
                            <th colspan="2" style="text-align: center;background:orange">Header</th>
                          </tr>
                            <tr><td>token </td><td>string</td></tr>

                            <tr><td>version</td><td>float</td></tr>
                          <tr>
                            <th colspan="2" style="text-align: center;background:green">Input</th>
                          </tr>
                            <tr>
                                <th>parameter</th>
                                <th>type</th>
                            </tr>
                            <tr>
                              <td>oldPassword(required)</td>
                              <td>string</td>
                            </tr>
                            <tr>
                              <td>newPassword(required)</td>
                              <td>string</td>
                            </tr>
                        </table>
                    </td>
                  </tr>
                    <tr><th valign="top">
                        Success Response
                      </th>
                      <td>
                <pre>{
    "message": "password update Successfully"
}</pre>
                      </td>
                    </tr>       
                    <tr>
                      <th valign="top">Error Response</th>
                      <td>
                        {
    "error": "The old password field is required."
}                      
{
    "message": "Old password is not matched"
}
                         
                      </td>
                    </tr>
            
        </table>
        </div> 

<!-- Disable account -->

<div id="disableAccount"  class="margintop">
                <table class="blog-comparison table table-striped table-bordered">
                    <h4>Disable Account</h4>    
                  <tr>
                    <th valign="top"> URL</th>
                    <td><span class="caption">The URL structure (path only, no root url)</span> <br>
                        <b><code>/disable-account</code> </b></td>
                  </tr>       
                  <tr><th valign="top"> Method</th>
                    <td><span class="caption">The request type</span> <br>
                        <b><code>GET</code></b>
                    </td>
                  </tr>       
                  <tr><th valign="top">Data Params</th>
                    <td>
                        <table border="1" width="400">
                        <tr>
                            <th colspan="2" style="text-align: center;background:orange">Header</th>
                          </tr>
                            <tr><td>token </td><td>string</td></tr>

                            <tr><td>version</td><td>float</td></tr>
                          <tr>
                            <th colspan="2" style="text-align: center;background:green">Input</th>
                          </tr>
                        </table>
                    </td>
                  </tr>
                    <tr><th valign="top">
                        Success Response
                      </th>
                      <td>
                <pre>{
    "message": "Your account has been disabled"
}</pre>
                      </td>
                    </tr>       
                    <tr>
                      <th valign="top">Error Response</th>
                      <td>
                        {
    "error": "Unable to disable account"
}
                         
                      </td>
                    </tr>
            
        </table>
        </div> 


        <!-- Delete account -->

<div id="deleteAccount"  class="margintop">
                <table class="blog-comparison table table-striped table-bordered">
                    <h4>Delete Account</h4>    
                  <tr>
                    <th valign="top"> URL</th>
                    <td><span class="caption">The URL structure (path only, no root url)</span> <br>
                        <b><code>/delete-account</code> </b></td>
                  </tr>       
                  <tr><th valign="top"> Method</th>
                    <td><span class="caption">The request type</span> <br>
                        <b><code>POST</code></b>
                    </td>
                  </tr>       
                  <tr><th valign="top">Data Params</th>
                    <td>
                        <table border="1" width="400">
                        <tr>
                            <th colspan="2" style="text-align: center;background:orange">Header</th>
                          </tr>
                            <tr><td>token </td><td>string</td></tr>

                            <tr><td>version</td><td>float</td></tr>
                          <tr>
                            <th colspan="2" style="text-align: center;background:green">Input</th>
                          </tr>
                          <tr>
                            <td>message</td>
                            <td>string</td>
                          </tr>
                        </table>
                    </td>
                  </tr>
                    <tr><th valign="top">
                        Success Response
                      </th>
                      <td>
                <pre>{
    "message": "Account deleted succcessfully"
}</pre>
                      </td>
                    </tr>       
                    <tr>
                      <th valign="top">Error Response</th>
                      <td>
                        {
    "error": "Unable to disable account"
}
                         
                      </td>
                    </tr>
            
        </table>
        </div> 
<!-- ***********************************-->
<!--           Suggesions         -->
<!--************************************-->
        <div id="suggestions"  class="margintop">
                <table class="blog-comparison table table-striped table-bordered">
                    <h4>Suggestions</h4>    
                  <tr>
                    <th valign="top"> URL</th>
                    <td><span class="caption">The URL structure (path only, no root url)</span> <br>
                        <b><code>users/suggestions</code> </b></td>
                  </tr>       
                  <tr><th valign="top"> Method</th>
                    <td><span class="caption">The request type</span> <br>
                        <b><code>GET</code></b>
                    </td>
                  </tr>       
                  <tr><th valign="top">Data Params</th>
                    <td>
                        <table border="1" width="400">
                            <tr>
                            <th colspan="2" style="text-align: center;background:orange">Header</th>
                          </tr>
                            <tr><td>token </td><td>string</td></tr>

                            <tr><td>version</td><td>float</td></tr>
                        </table>
                    </td>
                  </tr>
                    <tr><th valign="top">
                        Success Response
                      </th>
                      <td>
                <pre>{
    "data": [
        {
            "user_id": 6,
            "social_id": "",
            "email": "h@g.com",
            "name": "Sample",
            "gender": "",
            "job_title": "",
            "bio": "",
            "project": "",
            "work_place": "",
            "longitude": "76.714160",
            "latitude": "30.768180",
            "day": "",
            "time": "",
            "distance": 0,
            "matchedInterest": "5",
            "profile_pic": "http://192.168.2.19/workwith/public/uploads/profile/dummyprofile.jpg"
        },
        {
            "user_id": 12,
            "social_id": "",
            "email": "johnson@gmail.com",
            "name": "Php teams",
            "gender": "M",
            "job_title": "Programming",
            "bio": "php dev",
            "project": "1",
            "work_place": "Mohali",
            "longitude": "76.734160",
            "latitude": "30.788180",
            "day": "1",
            "time": "2",
            "distance": 2,
            "matchedInterest": "1",
            "profile_pic": "http://192.168.2.19/workwith/public/uploads/profile/dummyprofile.jpg"
        },
        {
            "user_id": 4,
            "social_id": "",
            "email": "ravi@yopmail.com",
            "name": "",
            "gender": "",
            "job_title": "",
            "bio": "",
            "project": "",
            "work_place": "",
            "longitude": "76.714160",
            "latitude": "30.768180",
            "day": "",
            "time": "",
            "distance": "25",
            "matchedInterest": null,
            "profile_pic": "http://192.168.2.19/workwith/public/uploads/profile/dummyprofile.jpg"
        },
        {
            "user_id": 8,
            "social_id": "",
            "email": "yahoo@gmail.com",
            "name": "",
            "gender": "",
            "job_title": "",
            "bio": "",
            "project": "",
            "work_place": "",
            "longitude": "",
            "latitude": "",
            "day": "",
            "time": "",
            "distance": 5432,
            "matchedInterest": null,
            "profile_pic": "http://192.168.2.19/workwith/public/uploads/profile/dummyprofile.jpg"
        }
    ]
}</pre>
                      </td>
                    </tr>       
                    <tr>
                      <th valign="top">Error Response</th>
                      <td>
                          <pre>{
    "data" => []
}



</pre>
                          
                         
                      </td>
                    </tr>
            
        </table>
        </div> 





<!-- <div style="height:30px;width:100%;background-color: red;color:white;text-align: center;">Below api are not checked</div> -->

        <!-- ***********************************-->
<!--          match User         -->
<!--************************************-->
        <div id="matchUser"  class="margintop">
                <table class="blog-comparison table table-striped table-bordered">
                    <h4>match User</h4>    
                  <tr>
                    <th valign="top"> URL</th>
                    <td><span class="caption">The URL structure (path only, no root url)</span> <br>
                        <b><code>users/match/{other_user_id}</code> </b></td>
                  </tr>       
                  <tr><th valign="top"> Method</th>
                    <td><span class="caption">The request type</span> <br>
                        <b><code>POST</code></b>
                    </td>
                  </tr>       
                  <tr>
                      <th valign="top">Data Params</th>
                      <th>
                        <table border="1" width="400">
                           <tr><th valign="top" colspan="2">Data Params</th></tr>

                        
                            <tr>
                                <th colspan="2" style="text-align: center;background:orange">Header</th>
                              </tr>
                            <tr><td>token </td><td>string</td></tr>

                            <tr><td>version</td><td>float</td></tr>
                             <tr>
                                <th colspan="2" style="text-align: center;background:green">Input</th>

                              </tr>
                              <tr>
                                <td>status</td>
                                <td>0 => first time send to other user
                                <br/>
                                    1 (internally set if other side user also send match request)
                                    2 => for match cancel
                                    3 => match unmatch
                                </td>
                              </tr>
                        </table>
                    </th>
                  </tr>
                    <tr><th valign="top">
                        Success Response
                      </th>
                      <td>
                <pre>
                when first time user send match request to other user
                {
    "message": "Match request sent"
}
if current user send again match request
{
    "message": "Matched request already sent"
}

{
    "message": "Match request accepted"
}
            </pre>
                      </td>
                    </tr>       
                    <tr>
                      <th valign="top">Error Response</th>
                      <td>
                          <pre>

                          </pre>
                          
                         
                      </td>
                    </tr>
            
        </table>
        </div> 

            <!-- ***********************************-->
<!--        my matches         -->
<!--************************************-->
        <div id="myMatches"  class="margintop">
                <table class="blog-comparison table table-striped table-bordered">
                    <h4>match User</h4>    
                  <tr>
                    <th valign="top"> URL</th>
                    <td><span class="caption">The URL structure (path only, no root url)</span> <br>
                        <b><code>users/my-matches</code> </b></td>
                  </tr>       
                  <tr><th valign="top"> Method</th>
                    <td><span class="caption">The request type</span> <br>
                        <b><code>GET</code></b>
                    </td>
                  </tr>       
                  <tr>
                      <th valign="top">Data Params</th>
                      <th>
                        <table border="1" width="400">
                           <tr><th valign="top" colspan="2">Data Params</th></tr>

                        
                            <tr>
                                <th colspan="2" style="text-align: center;background:orange">Header</th>
                              </tr>
                            <tr><td>token </td><td>string</td></tr>

                            <tr><td>version</td><td>float</td></tr>
                             
                        </table>
                    </th>
                  </tr>
                    <tr><th valign="top">
                        Success Response
                      </th>
                      <td>
                <pre>
               {
    "data": [
        {
            "created_at": "2019-03-18 03:11:57",
            "job_title": "Web developer",
            "usename": "Aman",
            "profile_pic": "http://192.168.2.50/workwith/public/uploads/profile/1552280481.png"
        },
        {
            "created_at": "2019-03-18 03:11:57",
            "job_title": "Web dev",
            "usename": "fsdfsdfsdfsdf",
            "profile_pic": "http://192.168.2.50/workwith/public/uploads/profile/1552633923.jpeg"
        }
    ]
}
            </pre>
                      </td>
                    </tr>       
                    <tr>
                      <th valign="top">Error Response</th>
                      <td>
                          <pre>

                          </pre>
                          
                         
                      </td>
                    </tr>
            
        </table>
        </div> 


            <!-- ***********************************-->
<!--        my matches         -->
<!--************************************-->
        <div id="myMatches"  class="margintop">
                <table class="blog-comparison table table-striped table-bordered">
                    <h4>match User</h4>    
                  <tr>
                    <th valign="top"> URL</th>
                    <td><span class="caption">The URL structure (path only, no root url)</span> <br>
                        <b><code>users/my-matches</code> </b></td>
                  </tr>       
                  <tr><th valign="top"> Method</th>
                    <td><span class="caption">The request type</span> <br>
                        <b><code>GET</code></b>
                    </td>
                  </tr>       
                  <tr>
                      <th valign="top">Data Params</th>
                      <th>
                        <table border="1" width="400">
                           <tr><th valign="top" colspan="2">Data Params</th></tr>

                        
                            <tr>
                                <th colspan="2" style="text-align: center;background:orange">Header</th>
                              </tr>
                            <tr><td>token </td><td>string</td></tr>

                            <tr><td>version</td><td>float</td></tr>
                             
                        </table>
                    </th>
                  </tr>
                    <tr><th valign="top">
                        Success Response
                      </th>
                      <td>
                <pre>
               {
    "data": [
        {
            "created_at": "2019-03-18 03:11:57",
            "job_title": "Web developer",
            "usename": "Aman",
            "profile_pic": "http://192.168.2.50/workwith/public/uploads/profile/1552280481.png"
        },
        {
            "created_at": "2019-03-18 03:11:57",
            "job_title": "Web dev",
            "usename": "fsdfsdfsdfsdf",
            "profile_pic": "http://192.168.2.50/workwith/public/uploads/profile/1552633923.jpeg"
        }
    ]
}
            </pre>
                      </td>
                    </tr>       
                    <tr>
                      <th valign="top">Error Response</th>
                      <td>
                          <pre>

                          </pre>
                          
                         
                      </td>
                    </tr>
            
        </table>
        </div>  
<!-- Send messages -->

        <div id="sendMessage"  class="margintop">
                <table class="blog-comparison table table-striped table-bordered">
                    <h4>send message</h4>    
                  <tr>
                    <th valign="top"> URL</th>
                    <td><span class="caption">The URL structure (path only, no root url)</span> <br>
                        <b><code>users/send-message/{receiver_user_id}</code> </b></td>
                  </tr>       
                  <tr><th valign="top"> Method</th>
                    <td><span class="caption">The request type</span> <br>
                        <b><code>POST</code></b>
                    </td>
                  </tr>       
                  <tr>
                      <th valign="top">Data Params</th>
                      <th>
                        <table border="1" width="400">
                           <tr><th valign="top" colspan="2">Data Params</th></tr>

                        
                            <tr>
                                <th colspan="2" style="text-align: center;background:orange">Header</th>
                              </tr>
                            <tr><td>token </td><td>string</td></tr>

                            <tr><td>version</td><td>float</td></tr>
                            <tr>
                                <th colspan="2" style="text-align: center;background:green">Input</th>
                              </tr>
                              <tr><td>message </td><td>string</td></tr>
                        </table>
                    </th>
                  </tr>
                    <tr><th valign="top">
                        Success Response
                      </th>
                      <td>
                <pre>
     {
    "message": "message send successfully"
}
     {
    "message": "User blocked"
}

            </pre>
                      </td>
                    </tr>       
                    <tr>
                      <th valign="top">Error Response</th>
                      <td>
                          <pre>
                             {
    "message": "Failed to send message"
}
                          </pre>
                          
                         
                      </td>
                    </tr>
            
        </table>
        </div> 

        <!-- Send messages -->

        <div id="GetMessage"  class="margintop">
                <table class="blog-comparison table table-striped table-bordered">
                    <h4>receive/get single user chat message</h4>    
                  <tr>
                    <th valign="top"> URL</th>
                    <td><span class="caption">The URL structure (path only, no root url)</span> <br>
                        <b><code>/users/get-message/{receiver_user_id}</code> </b></td>
                  </tr>       
                  <tr><th valign="top"> Method</th>
                    <td><span class="caption">The request type</span> <br>
                        <b><code>GET</code></b>
                    </td>
                  </tr>       
                  <tr>
                      <th valign="top">Data Params</th>
                      <th>
                        <table border="1" width="400">
                           <tr><th valign="top" colspan="2">Data Params</th></tr>

                        
                            <tr>
                                <th colspan="2" style="text-align: center;background:orange">Header</th>
                              </tr>
                            <tr><td>token </td><td>string</td></tr>

                            <tr><td>version</td><td>float</td></tr>
                            
                        </table>
                    </th>
                  </tr>
                    <tr><th valign="top">
                        Success Response
                      </th>
                      <td>
                <pre>
     {
    "data": [
        {
            "id": 6,
            "sender_id": 30,
            "receiver_id": 29,
            "message": "Hello test",
            "sender_status": 1,
            "receiver_status": 1,
            "created_at": "2019-03-18 15:31:30",
            "updated_at": null,
            "currentUser_name": "Aman",
            "currentUser_profile": "http://192.168.2.50/workwith/public/uploads/profile/1552280481.png"
        },
        {
            "id": 5,
            "sender_id": 30,
            "receiver_id": 29,
            "message": "I have another account in this appds",
            "sender_status": 1,
            "receiver_status": 1,
            "created_at": "2019-02-28 07:41:04",
            "updated_at": null,
            "currentUser_name": "Aman",
            "currentUser_profile": "http://192.168.2.50/workwith/public/uploads/profile/1552280481.png"
        }
    ]
}

            </pre>
                      </td>
                    </tr>       
                    <tr>
                      <th valign="top">Error Response</th>
                      <td>
                          <pre>
                             
                          </pre>
                          
                         
                      </td>
                    </tr>
            
        </table>
        </div>

        <!-- last receive messages -->

        <div id="lastreceivemessage"  class="margintop">
                <table class="blog-comparison table table-striped table-bordered">
                    <h4>last receive message</h4>    
                  <tr>
                    <th valign="top"> URL</th>
                    <td><span class="caption">The URL structure (path only, no root url)</span> <br>
                        <b><code>/users/last-messages-list</code> </b></td>
                  </tr>       
                  <tr><th valign="top"> Method</th>
                    <td><span class="caption">The request type</span> <br>
                        <b><code>GET</code></b>
                    </td>
                  </tr>       
                  <tr>
                      <th valign="top">Data Params</th>
                      <th>
                        <table border="1" width="400">
                           <tr><th valign="top" colspan="2">Data Params</th></tr>

                        
                            <tr>
                                <th colspan="2" style="text-align: center;background:orange">Header</th>
                              </tr>
                            <tr><td>token </td><td>string</td></tr>

                            <tr><td>version</td><td>float</td></tr>
                            
                        </table>
                    </th>
                  </tr>
                    <tr><th valign="top">
                        Success Response
                      </th>
                      <td>
                <pre>
    {
    "data": [
        {
            "id": 2,
            "sender_id": 4,
            "receiver_id": 30,
            "message": "I have another account in this appds",
            "sender_status": 1,
            "receiver_status": 1,
            "created_at": "2019-02-28 06:34:52",
            "updated_at": null,
            "senderName": "",
            "profile_pic": "http://192.168.2.50/workwith/public/uploads/profile/dummyprofile.jpg"
        },
        {
            "id": 1,
            "sender_id": 3,
            "receiver_id": 30,
            "message": " test",
            "sender_status": 1,
            "receiver_status": 1,
            "created_at": null,
            "updated_at": null,
            "senderName": null,
            "profile_pic": "http://192.168.2.50/workwith/public/uploads/profile/dummyprofile.jpg"
        }
    ]
}

            </pre>
                      </td>
                    </tr>       
                    <tr>
                      <th valign="top">Error Response</th>
                      <td>
                          <pre>
                             {
    "data": "no message found"
        }
                          </pre>
                          
                         
                      </td>
                    </tr>
            
        </table>
        </div> 

<!--************************************-->
<!--  Report user                 -->
<!--*************************************-->

   <div id="reportUser"  class="margintop">
                <table class="blog-comparison table table-striped table-bordered">
                    <h4>Report User</h4>    
                  <tr>
                    <th valign="top"> URL</th>
                    <td><span class="caption">The URL structure (path only, no root url)</span> <br>
                        <b><code>/users/{userId}/reports</code> </b></td>
                  </tr>       
                  <tr><th valign="top"> Method</th>
                    <td><span class="caption">The request type</span> <br>
                        <b><code>POST</code></b>
                    </td>
                  </tr>       
                  <tr><th valign="top">Data Params</th>
                    <td>
                        <table border="1" width="400">
                            <tr><th>parameter</th>
                            <th>type</th>
                            </tr>
                            <tr><td>token </td><td>header(String)</td></tr>
                            <tr><td>other_user_id </td><td>number</td></tr>
                            <tr><td>status </td><td>number(0=>Match Request)</td></tr>
                        </table>
                    </td>
                  </tr>
                    <tr><th valign="top">
                        Success Response
                      </th>
                      <td>
                <pre>{
"status": 200,
"message": "Match request sent"
}
            </pre>
                      </td>
                    </tr>       
                    <tr>
                      <th valign="top">Error Response</th>
                      <td>
                          <pre>
{
"status": 409,
    "message": "Matched request already sent"
}

{
    "status": 400,
    "error": "The other user id field is required."
}

                          </pre>
                          
                         
                      </td>
                    </tr>
            
        </table>
        </div> 

<!-- ***********************************-->
<!--           addcard    -->
<!--************************************-->
        <div id="addcard"  class="margintop">
                <table class="blog-comparison table table-striped table-bordered">
                    <h4>add card</h4>    
                  <tr>
                    <th valign="top"> URL</th>
                    <td><span class="caption">The URL structure (path only, no root url)</span> <br>
                        <b><code>/card_save</code> </b></td>
                  </tr>       
                  <tr><th valign="top"> Method</th>
                    <td><span class="caption">The request type</span> <br>
                        <b><code>POST</code></b>
                    </td>
                  </tr>       
                  <tr><th valign="top">Data Params</th>
                    <td>
                        <table border="1" width="400">
                            <tr><th>parameter</th>
                            <th>type</th>
                            </tr>
                            <tr><td>user_id </td><td>number</td></tr>
                            <tr><td>usert_ype(U = user type) </td><td>string</td></tr>
                            <tr><td>card_number </td><td>number</td></tr>
                            <tr><td>cardholder_name</td><td>string</td></tr>
                            <tr><td>expiry_date(01/2021) </td><td>String</td></tr>
                            <tr><td>cvv_number </td><td>String</td></tr>
                            <tr><td>token </td><td>String</td></tr>
                            <tr><td>appversion</td><td>string</td></tr>
                            <tr><td>devicetype(A = Android, I = IOS)</td><td>string</td></tr>
                        </table>
                    </td>
                  </tr>
                    <tr><th valign="top">
                        Success Response
                      </th>
                      <td>
                <pre>{
                    "status": 200,
                    "message": "Card add Successfully"
                }</pre>
                      </td>
                    </tr>       
                    <tr>
                      <th valign="top">Error Response</th>
                      <td>
                          <pre>{"status": 204,"message": "Please fill all fields!"}</pre>
                        
                       
                         
                      </td>
                    </tr>
            
        </table>
        </div> 

<!-- ***********************************-->
<!--          addBank    -->
<!--************************************-->
<!--         <div id="addBank"  class="margintop">
                <table class="blog-comparison table table-striped table-bordered">
                    <h4>add Bank</h4>    
                  <tr>
                    <th valign="top"> URL</th>
                    <td><span class="caption">The URL structure (path only, no root url)</span> <br>
                        <b><code>/addBank</code> </b></td>
                  </tr>       
                  <tr><th valign="top"> Method</th>
                    <td><span class="caption">The request type</span> <br>
                        <b><code>POST</code></b>
                    </td>
                  </tr>       
                  <tr><th valign="top">Data Params</th>
                    <td>
                        <table border="1" width="400">
                            <tr><th>parameter</th>
                            <th>type</th>
                            </tr>
                             <tr><td>user_id </td><td>number</td></tr>
                             <tr><td>user_name </td><td>String</td></tr>
                             <tr><td>bank_name </td><td>String</td></tr>
                             <tr><td>account_number </td><td>String</td></tr>
                             <tr><td>routing_number </td><td>String</td></tr>
                             <tr><td>token </td><td>String</td></tr>
                            <tr><td>appversion</td><td>string</td></tr>
                            <tr><td>devicetype(A = Android, I = IOS)</td><td>string</td></tr>
                  
                        </table>
                    </td>
                  </tr>
                    <tr><th valign="top">
                        Success Response
                      </th>
                      <td>
                <pre>{
                    "status": 200,
                    "message": "Bank add Successfully"
                }</pre>
                      </td>
                    </tr>       
                 
            
        </table>
        </div> --> 
<!-- ***********************************-->
<!--          userHome         -->
<!--************************************-->
        <div id="userHome"  class="margintop">
                <table class="blog-comparison table table-striped table-bordered">
                    <h4>userHome</h4>    
                  <tr>
                    <th valign="top"> URL</th>
                    <td><span class="caption">The URL structure (path only, no root url)</span> <br>
                        <b><code>/userHome</code> </b></td>
                  </tr>       
                  <tr><th valign="top"> Method</th>
                    <td><span class="caption">The request type</span> <br>
                        <b><code>GET</code></b>
                    </td>
                  </tr>       
                  <tr><th valign="top">Data Params</th>
                    <td>
                        <table border="1" width="400">
                            <tr><th>parameter</th>
                            <th>type</th>
                               <tr><td>appversion</td><td>string</td></tr>
                               <tr><td>devicetype(A = Android, I = IOS)</td><td>string</td></tr>
                            </tr>
                       
                        </table>
                    </td>
                  </tr>
                    <tr><th valign="top">
                        Success Response
                      </th>
                      <td>
                <pre>{
    "status": 200,
    "message": "Data found",
    "data": [
        {
            "services_id": 1,
            "title": "Deep Tissue",
            "service_image": "http://142.4.10.93/~vooap/touch_massage/public/uploads/services_images/1537261612.png",
            "description": "At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptate",
            "service_length_time": [
                {
                    "service_length": "75",
                    "price": "120"
                },
                {
                    "service_length": "105",
                    "price": "150"
                },
                {
                    "service_length": "130",
                    "price": "170"
                }
            ]
        },
        {
            "services_id": 2,
            "title": "Sport Massage",
            "service_image": "http://142.4.10.93/~vooap/touch_massage/public/uploads/services_images/1537261681.png",
            "description": "At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptate",
            "service_length_time": [
                {
                    "service_length": "75",
                    "price": "120"
                },
                {
                    "service_length": "105",
                    "price": "150"
                },
                {
                    "service_length": "150",
                    "price": "170"
                }
            ]
        },
        {
            "services_id": 3,
            "title": "Couple Massage",
            "service_image": "http://142.4.10.93/~vooap/touch_massage/public/uploads/services_images/1537261710.png",
            "description": "At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptate",
            "service_length_time": [
                {
                    "service_length": "75",
                    "price": "120"
                },
                {
                    "service_length": "105",
                    "price": "120"
                },
                {
                    "service_length": "150",
                    "price": "170"
                }
            ]
        },
        {
            "services_id": 4,
            "title": "Swedish Massage",
            "service_image": "http://142.4.10.93/~vooap/touch_massage/public/uploads/services_images/1537261741.png",
            "description": "At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptate",
            "service_length_time": [
                {
                    "service_length": "75",
                    "price": "120"
                },
                {
                    "service_length": "105",
                    "price": "150"
                },
                {
                    "service_length": "150",
                    "price": "170"
                }
            ]
        }
    ]
}</pre>
                      </td>
                    </tr>       
                    <tr>
                      <th valign="top">Error Response</th>
                      <td>
                          <pre>{"status": 204,"message": "Please fill all fields!"}</pre>
                  
                          <pre>{"status":401,"message":"Wrong token entered!.Please try again."}</pre>
                       
                         
                      </td>
                    </tr>
            
        </table>
        </div> 
<!-- ***********************************-->
<!--           post_service        -->
<!--************************************-->
        <div id="payment"  class="margintop">
                <table class="blog-comparison table table-striped table-bordered">
                    <h4>payment</h4>    
                  <tr>
                    <th valign="top"> URL</th>
                    <td><span class="caption">The URL structure (path only, no root url)</span> <br>
                        <b><code>/payment</code> </b></td>
                  </tr>       
                  <tr><th valign="top"> Method</th>
                    <td><span class="caption">The request type</span> <br>
                        <b><code>POST</code></b>
                    </td>
                  </tr>       
                  <tr><th valign="top">Data Params</th>
                    <td>
                        <table border="1" width="400">
                            <tr><th>parameter</th>
                            <th>type</th>
                            </tr>
                            <tr><td>user_id </td><td>number</td></tr>
                            <tr><td>card_id </td><td>number</td></tr>
                            <tr><td>service_id </td><td>String</td></tr>
                            <tr><td>therapist_gender </td><td>String</td></tr>
                            <tr><td>massage_length </td><td>String</td></tr>
                            <tr><td>start_date </td><td>String</td></tr>
                            <tr><td>start_time </td><td>String</td></tr>
                            <tr><td>street </td><td>String</td></tr>
                            <tr><td>city </td><td>String</td></tr>
                            <tr><td>zip </td><td>String</td></tr>
                            <tr><td>state </td><td>String</td></tr>
                            <tr><td>price </td><td>String</td></tr>
                            <tr><td>parking_instruction </td><td>String</td></tr>
                            <tr><td>offer_name </td><td>String</td></tr>
                            <tr><td>offer_price </td><td>String</td></tr>
                            <tr><td>token </td><td>String</td></tr>
                            <tr><td>appversion</td><td>string</td></tr>
                            <tr><td>devicetype(A = Android, I = IOS)</td><td>string</td></tr>
                            
                        </table>
                    </td>
                  </tr>
                    <tr><th valign="top">
                        Success Response
                      </th>
                      <td>
                <pre>{
  "status": 200,
  "message": "Post job Successfully",
}</pre>
                      </td>
                    </tr>       
                    <tr>
                      <th valign="top">Error Response</th>
                      <td>
                          <pre>{"status": 204,"message": "Please fill all fields!"}</pre>
                  
                          <pre>{"status":401,"message":"Wrong token entered!.Please try again."}</pre>
                       
                         
                      </td>
                    </tr>
            
        </table>
        </div> 
<!-- ***********************************-->
<!--         send_message        -->
<!--************************************-->
        <div id="send_message"  class="margintop">
                <table class="blog-comparison table table-striped table-bordered">
                    <h4>send_message</h4>    
                  <tr>
                    <th valign="top"> URL</th>
                    <td><span class="caption">The URL structure (path only, no root url)</span> <br>
                        <b><code>/send_message</code> </b></td>
                  </tr>       
                  <tr><th valign="top"> Method</th>
                    <td><span class="caption">The request type</span> <br>
                        <b><code>POST</code></b>
                    </td>
                  </tr>       
                  <tr><th valign="top">Data Params</th>
                    <td>
                        <table border="1" width="400">
                            <tr><th>parameter</th>
                            <th>type</th>
                            </tr>
                            <tr><td>sender_id </td><td>number</td></tr>
                            <tr><td>reciver_id </td><td>number</td></tr>
                            <tr><td>message </td><td>String</td></tr>
                            <tr><td>appversion</td><td>string</td></tr>
                            <tr><td>devicetype(A = Android, I = IOS)</td><td>string</td></tr>
                        </table>
                    </td>
                  </tr>
                    <tr><th valign="top">
                        Success Response
                      </th>
                      <td>
                <pre>{
  "status": 200,
  "message": "Data save succssfully",
}</pre>
                      </td>
                    </tr>       
                    <tr>
                      <th valign="top">Error Response</th>
                      <td>
                          <pre>{"status": 204,"message": "Please fill all fields!"}</pre>
                  
                          <pre>{"status":401,"message":"Wrong token entered!.Please try again."}</pre>
                       
                         
                      </td>
                    </tr>
            
        </table>
        </div> 

<!-- ***********************************-->
<!--         getMyConnection        -->
<!--************************************-->
        <div id="getMyConnection"  class="margintop">
                <table class="blog-comparison table table-striped table-bordered">
                    <h4>getMyConnection</h4>    
                  <tr>
                    <th valign="top"> URL</th>
                    <td><span class="caption">The URL structure (path only, no root url)</span> <br>
                        <b><code>/getMyConnection</code> </b></td>
                  </tr>       
                  <tr><th valign="top"> Method</th>
                    <td><span class="caption">The request type</span> <br>
                        <b><code>GET</code></b>
                    </td>
                  </tr>       
                  <tr><th valign="top">Data Params</th>
                    <td>
                        <table border="1" width="400">
                            <tr><th>parameter</th>
                            <th>type</th>
                            </tr>
                            <tr><td>user_id </td><td>number</td></tr>
                            <tr><td>appversion</td><td>string</td></tr>
                            <tr><td>devicetype(A = Android, I = IOS)</td><td>string</td></tr>
                        </table>
                    </td>
                  </tr>
                    <tr><th valign="top">
                        Success Response
                      </th>
                      <td>
                <pre>{
    "status": 200,
    "data": [
        {
            "connection_id": 1,
            "name": "Sunny",
            "profile_picture": "http://142.4.10.93/~vooap/touch_massage/public/uploads/profile/1537354677.jpeg"
        },
        {
            "connection_id": 2,
            "name": "mike",
            "profile_picture": "http://142.4.10.93/~vooap/touch_massage/public/uploads/profile/1536930638.png"
        }
    ]
}</pre>
                      </td>
                    </tr>       
                    <tr>
                      <th valign="top">Error Response</th>
                      <td>
                          <pre>{"status": 204,"message": "Please fill all fields!"}</pre>
                  
                          <pre>{"status":401,"message":"Wrong token entered!.Please try again."}</pre>
                       
                         
                      </td>
                    </tr>
            
        </table>
        </div>

<!-- ***********************************-->
<!--         deleteSingleThread        -->
<!--************************************-->
        <div id="deleteconnection"  class="margintop">
                <table class="blog-comparison table table-striped table-bordered">
                    <h4>deleteconnection</h4>    
                  <tr>
                    <th valign="top"> URL</th>
                    <td><span class="caption">The URL structure (path only, no root url)</span> <br>
                        <b><code>/deleteconnection</code> </b></td>
                  </tr>       
                  <tr><th valign="top"> Method</th>
                    <td><span class="caption">The request type</span> <br>
                        <b><code>POST</code></b>
                    </td>
                  </tr>       
                  <tr><th valign="top">Data Params</th>
                    <td>
                        <table border="1" width="400">
                            <tr><th>parameter</th>
                            <th>type</th>
                            </tr>
                            <tr><td>user_id </td><td>number</td></tr>
                            <tr><td>connection_id </td><td>number</td></tr>
                            <tr><td>appversion</td><td>string</td></tr>
                            <tr><td>devicetype(A = Android, I = IOS)</td><td>string</td></tr>
                        </table>
                    </td>
                  </tr>
                    <tr><th valign="top">
                        Success Response
                      </th>
                      <td>
                <pre>{
  "status": 200,
  "message": "Connection delete succssfully",
}</pre>
                      </td>
                    </tr>       
                    <tr>
                      <th valign="top">Error Response</th>
                      <td>
                          <pre>{"status": 204,"message": "Please fill all fields!"}</pre>
                  
                          <pre>{"status":401,"message":"Wrong token entered!.Please try again."}</pre>
                       
                         
                      </td>
                    </tr>
            
        </table>
        </div> 

<!-- ***********************************-->
<!--         getMychat        -->
<!--************************************-->
        <div id="getMychat"  class="margintop">
                <table class="blog-comparison table table-striped table-bordered">
                    <h4>getMychat</h4>    
                  <tr>
                    <th valign="top"> URL</th>
                    <td><span class="caption">The URL structure (path only, no root url)</span> <br>
                        <b><code>/getMychat</code> </b></td>
                  </tr>       
                  <tr><th valign="top"> Method</th>
                    <td><span class="caption">The request type</span> <br>
                        <b><code>GET</code></b>
                    </td>
                  </tr>       
                  <tr><th valign="top">Data Params</th>
                    <td>
                        <table border="1" width="400">
                            <tr><th>parameter</th>
                            <th>type</th>
                            </tr>
                            <tr><td>user_id </td><td>number</td></tr>
                            <tr><td>connection_id </td><td>number</td></tr>
                               <tr><td>appversion</td><td>string</td></tr>
                  <tr><td>devicetype(A = Android, I = IOS)</td><td>string</td></tr>
                        </table>
                    </td>
                  </tr>
                    <tr><th valign="top">
                        Success Response
                      </th>
                      <td>
                <pre>{
  "status": 200,
  "message": "Data found",
}</pre>
                      </td>
                    </tr>       
                    <tr>
                      <th valign="top">Error Response</th>
                      <td>
                          <pre>{"status": 204,"message": "Please fill all fields!"}</pre>
                  
                          <pre>{"status":401,"message":"Wrong token entered!.Please try again."}</pre>
                       
                         
                      </td>
                    </tr>
            
        </table>
        </div> 
<!-- ***********************************-->
<!--         giveFeedback        -->
<!--************************************-->
        <div id="giveFeedback"  class="margintop">
                <table class="blog-comparison table table-striped table-bordered">
                    <h4>giveFeedback</h4>    
                  <tr>
                    <th valign="top"> URL</th>
                    <td><span class="caption">The URL structure (path only, no root url)</span> <br>
                        <b><code>/giveFeedback</code> </b></td>
                  </tr>       
                  <tr><th valign="top"> Method</th>
                    <td><span class="caption">The request type</span> <br>
                        <b><code>POST</code></b>
                    </td>
                  </tr>       
                  <tr><th valign="top">Data Params</th>
                    <td>
                        <table border="1" width="400">
                            <tr><th>parameter</th>
                            <th>type</th>
                            </tr>
                            <tr><td>user_id </td><td>number</td></tr>
                            <tr><td>job_id </td><td>number</td></tr>
                            <tr><td>ratable_id </td><td>number</td></tr>
                            <tr><td>rating </td><td>number</td></tr>
                            <tr><td>comments </td><td>String</td></tr>
                            <tr><td>user_type(U=client,SP=Service Provider) </td><td>String</td></tr>
                               <tr><td>appversion</td><td>string</td></tr>
                  <tr><td>devicetype(A = Android, I = IOS)</td><td>string</td></tr>
                        </table>
                    </td>
                  </tr>
                    <tr><th valign="top">
                        Success Response
                      </th>
                      <td>
                <pre>{
                "status":200,
                "message":"Your feedback save succssfully"
                }</pre>
                      </td>
                    </tr>       
                    <tr>
                      <th valign="top">Error Response</th>
                      <td>
                          <pre>{"status": 204,"message": "Please fill all fields!"}</pre>
                  
                          <pre>{"status":401,"message":"Wrong token entered!.Please try again."}</pre>
                       
                         
                      </td>
                    </tr>
            
        </table>
        </div>

<!-- ***********************************-->
<!--         getMyProfile        -->
<!--************************************-->
        <div id="getMyProfile"  class="margintop">
                <table class="blog-comparison table table-striped table-bordered">
                    <h4>getMyProfile</h4>    
                  <tr>
                    <th valign="top"> URL</th>
                    <td><span class="caption">The URL structure (path only, no root url)</span> <br>
                        <b><code>/getMyProfile</code> </b></td>
                  </tr>       
                  <tr><th valign="top"> Method</th>
                    <td><span class="caption">The request type</span> <br>
                        <b><code>GET</code></b>
                    </td>
                  </tr>       
                  <tr><th valign="top">Data Params</th>
                    <td>
                        <table border="1" width="400">
                            <tr><th>parameter</th>
                            <th>type</th>
                            </tr>
                            <tr><td>user_id </td><td>number</td></tr>
                            <tr><td>user_type (U=client,SP=Service Provider)</td><td>String</td></tr>
                            <tr><td>token </td><td>String</td></tr>
                              <tr><td>appversion</td><td>string</td></tr>
                  <tr><td>devicetype(A = Android, I = IOS)</td><td>string</td></tr>
                            
                        </table>
                    </td>
                  </tr>
                    <tr><th valign="top">
                        Success Response
                      </th>
                      <td>
                <pre>{
    "status": 200,
    "message": "Data found",
    "data": {
        "first_name": "Mike",
        "last_name": "timmy",
        "address": "Mkoaki street",
        "mobnumber": "9988222545",
        "gender": "M",
        "profile_picture": "http://142.4.10.93/~vooap/touch_massage/public/uploads/profile/1537273137.jpg",
        "user_id": 1,
        "user_rating": "2.3333",
        "reviews": 3
    }
}</pre>
                      </td>
                    </tr>       
                    <tr>
                      <th valign="top">Error Response</th>
                      <td>
                          <pre>{"status": 204,"message": "Please fill all fields!"}</pre>
                  
                          <pre>{"status":401,"message":"Wrong token entered!.Please try again."}</pre>
                       
                         
                      </td>
                    </tr>
            
        </table>
        </div> 
<!-- ***********************************-->
<!--         editMyProfile        -->
<!--************************************-->
<!--         <div id="editMyProfile"  class="margintop">
                <table class="blog-comparison table table-striped table-bordered">
                    <h4>editMyProfile</h4>    
                  <tr>
                    <th valign="top"> URL</th>
                    <td><span class="caption">The URL structure (path only, no root url)</span> <br>
                        <b><code>/editMyProfile</code> </b></td>
                  </tr>       
                  <tr><th valign="top"> Method</th>
                    <td><span class="caption">The request type</span> <br>
                        <b><code>POST</code></b>
                    </td>
                  </tr>       
                  <tr><th valign="top">Data Params</th>
                    <td>
                        <table border="1" width="400">
                            <tr><th>parameter</th>
                            <th>type</th>
                            </tr>
                            <tr><td>user_id </td><td>number</td></tr>
                            <tr><td>user_type (U=client,SP=Service Provider)</td><td>String</td></tr>
                            <tr><td>first_name </td><td>String</td></tr>
                            <tr><td>last_name </td><td>String</td></tr>
                            <tr><td>address </td><td>String</td></tr>
                            <tr><td>mobnumber </td><td>String</td></tr>
                            <tr><td>gender(M=male,F=femail,O=other) </td><td>String</td></tr>
                            <tr><td>profile_picture </td><td>file</td></tr>
                            <tr><td>about_me </td><td>String</td></tr>
                            <tr><td>id_card </td><td>file</td></tr>
                            <tr><td>experience </td><td>String</td></tr>
                            <tr><td>services </td><td>String</td></tr>
                            <tr><td>token </td><td>String</td></tr>
                            <tr><td>appversion </td><td>String</td></tr>          
                        </table>
                    </td>
                  </tr>
                    <tr><th valign="top">
                        Success Response
                      </th>
                      <td>
                <pre>{
    "status": 200,
    "message": "Data found"
}</pre>
                      </td>
                    </tr>       
                    <tr>
                      <th valign="top">Error Response</th>
                      <td>
                          <pre>{"status": 204,"message": "Please fill all fields!"}</pre>
                  
                          <pre>{"status":401,"message":"Wrong token entered!.Please try again."}</pre>
                       
                         
                      </td>
                    </tr>
            
        </table>
        </div>  -->
<!-- ***********************************-->
<!--         getHistory        -->
<!--************************************-->
        <div id="getHistory"  class="margintop">
                <table class="blog-comparison table table-striped table-bordered">
                    <h4>getHistory</h4>    
                  <tr>
                    <th valign="top"> URL</th>
                    <td><span class="caption">The URL structure (path only, no root url)</span> <br>
                        <b><code>/getHistory</code> </b></td>
                  </tr>       
                  <tr><th valign="top"> Method</th>
                    <td><span class="caption">The request type</span> <br>
                        <b><code>GET</code></b>
                    </td>
                  </tr>       
                  <tr><th valign="top">Data Params</th>
                    <td>
                        <table border="1" width="400">
                            <tr><th>parameter</th>
                            <th>type</th>
                            </tr>
                            <tr><td>user_id </td><td>number</td></tr>
                            <tr><td>user_type (U=client,SP=Service Provider)</td><td>String</td></tr>
                            <tr><td>status(U=upcoming,IP=inprogress,Com=complete)</td><td>String</td></tr>
                            <tr><td>token </td><td>String</td></tr>
                               <tr><td>appversion</td><td>string</td></tr>
                  <tr><td>devicetype(A = Android, I = IOS)</td><td>string</td></tr>          
                        </table>
                    </td>
                  </tr>
                    <tr><th valign="top">
                        Success Response
                      </th>
                      <td>
                <pre>{
    "status": 200,
    "message": "Data found",
    "data": [
        {
            "services_id": "3,4",
            "massage_length": "75",
            "start_date": "2018-08-29",
            "start_time": "10:50",
            "job_forword": "2",
            "job_id": 1,
            "user_id": 1,
            "job_forword_status": "true",
            "services_name": [
                "Couple Massage",
                "Swedish Massage"
            ]
        },
        {
            "services_id": "1",
            "massage_length": "75",
            "start_date": "2011-01-07",
            "start_time": "12:50",
            "job_forword": "2",
            "job_id": 2,
            "user_id": 1,
            "job_forword_status": "true",
            "services_name": [
                "Deep Tissue"
            ]
        }
    ]
}</pre>
                      </td>
                    </tr>       
                    <tr>
                      <th valign="top">Error Response</th>
                      <td>
                          <pre>{"status": 204,"message": "Please fill all fields!"}</pre>
                  
                          <pre>{"status":401,"message":"Wrong token entered!.Please try again."}</pre>
                       
                         
                      </td>
                    </tr>
            
        </table>
        </div> 
<!-- ***********************************-->
<!--         spHome        -->
<!--************************************-->
        <div id="spHome"  class="margintop">
                <table class="blog-comparison table table-striped table-bordered">
                    <h4>spHome</h4>    
                  <tr>
                    <th valign="top"> URL</th>
                    <td><span class="caption">The URL structure (path only, no root url)</span> <br>
                        <b><code>/spHome</code> </b></td>
                  </tr>       
                  <tr><th valign="top"> Method</th>
                    <td><span class="caption">The request type</span> <br>
                        <b><code>GET</code></b>
                    </td>
                  </tr>       
                  <tr><th valign="top">Data Params</th>
                    <td>
                        <table border="1" width="400">
                            <tr><th>parameter</th>
                            <th>type</th>
                            </tr>
                            <tr><td>user_id </td><td>number</td></tr>
                            <tr><td>token </td><td>String</td></tr>
                               <tr><td>appversion</td><td>string</td></tr>
                  <tr><td>devicetype(A = Android, I = IOS)</td><td>string</td></tr>        
                        </table>
                    </td>
                  </tr>
                    <tr><th valign="top">
                        Success Response
                      </th>
                      <td>
                <pre>{
    "status": 200,
    "message": "Data found",
    "data": [
        {
            "services_id": "3,4",
            "massage_length": "75",
            "start_date": "2018-08-29",
            "start_time": "10:50",
            "job_forword": "true",
            "job_id": 1,
            "services_name": [
                "Couple Massage",
                "Swedish Massage"
            ]
        }
    ]
}</pre>
                      </td>
                    </tr>       
                    <tr>
                      <th valign="top">Error Response</th>
                      <td>
                          <pre>{"status": 204,"message": "Please fill all fields!"}</pre>
                  
                          <pre>{"status":401,"message":"Wrong token entered!.Please try again."}</pre>
                       
                         
                      </td>
                    </tr>
            
        </table>
        </div>
<!-- ***********************************-->
<!--         updateJobStatus        -->
<!--************************************-->
        <div id="updateJobStatus"  class="margintop">
                <table class="blog-comparison table table-striped table-bordered">
                    <h4>updateJobStatus</h4>    
                  <tr>
                    <th valign="top"> URL</th>
                    <td><span class="caption">The URL structure (path only, no root url)</span> <br>
                        <b><code>/updateJobStatus</code> </b></td>
                  </tr>       
                  <tr><th valign="top"> Method</th>
                    <td><span class="caption">The request type</span> <br>
                        <b><code>POST</code></b>
                    </td>
                  </tr>       
                  <tr><th valign="top">Data Params</th>
                    <td>
                        <table border="1" width="400">
                            <tr><th>parameter</th>
                            <th>type</th>
                            </tr>
                            <tr><td>user_id </td><td>number</td></tr>
                            <tr><td>job_id </td><td>number</td></tr>
                            <tr><td>status(Accept=AC,Reject=R,Cancel=C,Start job=IP,Com=End job) </td><td>String</td></tr>
                            <tr><td>token </td><td>String</td></tr>
                               <tr><td>appversion</td><td>string</td></tr>
                  <tr><td>devicetype(A = Android, I = IOS)</td><td>string</td></tr>        
                        </table>
                    </td>
                  </tr>
                    <tr><th valign="top">
                        Success Response
                      </th>
                      <td>
                <pre>{
    "status": 200,
    "message": "Data update succssfully"
}</pre>
                      </td>
                    </tr>       
                    <tr>
                      <th valign="top">Error Response</th>
                      <td>
                          <pre>{"status": 204,"message": "Please fill all fields!"}</pre>
                  
                          <pre>{"status":401,"message":"Wrong token entered!.Please try again."}</pre>
                       
                         
                      </td>
                    </tr>
            
        </table>
        </div> 
<!-- ***********************************-->
<!--         CancelRejectJob        -->
<!--************************************-->
        <div id="CancelRejectJob"  class="margintop">
                <table class="blog-comparison table table-striped table-bordered">
                    <h4>CancelRejectJob</h4>    
                  <tr>
                    <th valign="top"> URL</th>
                    <td><span class="caption">The URL structure (path only, no root url)</span> <br>
                        <b><code>/CancelRejectJob</code> </b></td>
                  </tr>       
                  <tr><th valign="top"> Method</th>
                    <td><span class="caption">The request type</span> <br>
                        <b><code>POST</code></b>
                    </td>
                  </tr>       
                  <tr><th valign="top">Data Params</th>
                    <td>
                        <table border="1" width="400">
                            <tr><th>parameter</th>
                            <th>type</th>
                            </tr>
                            <tr><td>job_id </td><td>number</td></tr>
                            <tr><td>status(Reject=R,Cancel=C)</td><td>String</td></tr>
                            <tr><td>reason </td><td>String</td></tr>
                            <tr><td>token </td><td>String</td></tr>
                            <tr><td>user_id </td><td>number</td></tr>
                               <tr><td>appversion</td><td>string</td></tr>
                  <tr><td>devicetype(A = Android, I = IOS)</td><td>string</td></tr>         
                        </table>
                    </td>
                  </tr>
                    <tr><th valign="top">
                        Success Response
                      </th>
                      <td>
                <pre>{
    "status": 200,
    "message": "Cancel job succssfully"
}</pre>
                      </td>
                    </tr>       
                    <tr>
                      <th valign="top">Error Response</th>
                      <td>
                          <pre>{"status": 204,"message": "Please fill all fields!"}</pre>
                  
                          <pre>{"status":401,"message":"Wrong token entered!.Please try again."}</pre>
                       
                         
                      </td>
                    </tr>
            
        </table>
        </div> 
<!-- ***********************************-->
<!--         appoitmentDetails        -->
<!--************************************-->
        <div id="appoitmentDetails"  class="margintop">
                <table class="blog-comparison table table-striped table-bordered">
                    <h4>appoitmentDetails</h4>    
                  <tr>
                    <th valign="top"> URL</th>
                    <td><span class="caption">The URL structure (path only, no root url)</span> <br>
                        <b><code>/appoitmentDetails</code> </b></td>
                  </tr>       
                  <tr><th valign="top"> Method</th>
                    <td><span class="caption">The request type</span> <br>
                        <b><code>POST</code></b>
                    </td>
                  </tr>       
                  <tr><th valign="top">Data Params</th>
                    <td>
                        <table border="1" width="400">
                            <tr><th>parameter</th>
                            <th>type</th>
                            </tr>
                            <tr><td>job_id </td><td>number</td></tr>
                            <tr><td>user_type(U=User,SP=Serviceprovider)</td><td>String</td></tr>
                            <tr><td>token </td><td>String</td></tr>
                            <tr><td>user_id </td><td>number</td></tr>
                              <tr><td>appversion</td><td>string</td></tr>
                  <tr><td>devicetype(A = Android, I = IOS)</td><td>string</td></tr>         
                        </table>
                    </td>
                  </tr>
                    <tr><th valign="top">
                        Success Response
                      </th>
                      <td>
                <pre>{
    "status": 200,
    "message": "Cancel job succssfully"
}</pre>
                      </td>
                    </tr>       
                    <tr>
                      <th valign="top">Error Response</th>
                      <td>
                          <pre>{"status": 204,"message": "Please fill all fields!"}</pre>
                  
                          <pre>{"status":401,"message":"Wrong token entered!.Please try again."}</pre>
                       
                         
                      </td>
                    </tr>
            
        </table>
        </div> 
<!-- ***********************************-->
<!--         Get Cards List        -->
<!--************************************-->
        <div id="getcardslist"  class="margintop">
                <table class="blog-comparison table table-striped table-bordered">
                    <h4>  Get Cards List</h4>    
                  <tr>
                    <th valign="top"> URL</th>
                    <td><span class="caption">The URL structure (path only, no root url)</span> <br>
                        <b><code>/cards_list</code> </b></td>
                  </tr>       
                  <tr><th valign="top"> Method</th>
                    <td><span class="caption">The request type</span> <br>
                        <b><code>GET</code></b>
                    </td>
                  </tr>       
                  <tr><th valign="top">Data Params</th>
                    <td>
                        <table border="1" width="400">
                            <tr><th>parameter</th>
                            <th>type</th>
                            </tr>
                            <!-- <tr><td>token </td><td>String</td></tr> -->
                            <tr><td>user_id </td><td>number</td></tr>         
                        </table>
                    </td>
                  </tr>
                    <tr><th valign="top">
                        Success Response
                      </th>
                      <td>
                <pre>{
    "status": 200,
    "message": "card list",
    "data": [
        {
            "card_id": "card_1DJwRS2eZvKYlo2CTGnAZQEW",
            "customer": "cus_DlTGwp80wehxyF",
            "exp_month": 1,
            "exp_year": 2020,
            "last4": "4242",
            "brand": "Visa"
        },
        {
            "card_id": "card_1DJwsr2eZvKYlo2COFouLgkZ",
            "customer": "cus_DlTGwp80wehxyF",
            "exp_month": 2,
            "exp_year": 2020,
            "last4": "0007",
            "brand": "American Express"
        },
        {
            "card_id": "card_1DJwpK2eZvKYlo2CVpGzSOXX",
            "customer": "cus_DlTGwp80wehxyF",
            "exp_month": 2,
            "exp_year": 2020,
            "last4": "0005",
            "brand": "American Express"
        },
        {
            "card_id": "card_1DJwoj2eZvKYlo2CuMIgW3Dr",
            "customer": "cus_DlTGwp80wehxyF",
            "exp_month": 2,
            "exp_year": 2020,
            "last4": "0005",
            "brand": "American Express"
        },
        {
            "card_id": "card_1DJwgN2eZvKYlo2CJmQNy6Cb",
            "customer": "cus_DlTGwp80wehxyF",
            "exp_month": 2,
            "exp_year": 2020,
            "last4": "0005",
            "brand": "American Express"
        },
        {
            "card_id": "card_1DJwgA2eZvKYlo2C2FAzSSjp",
            "customer": "cus_DlTGwp80wehxyF",
            "exp_month": 1,
            "exp_year": 2020,
            "last4": "0005",
            "brand": "American Express"
        },
        {
            "card_id": "card_1DJwg12eZvKYlo2C5dIOWtdy",
            "customer": "cus_DlTGwp80wehxyF",
            "exp_month": 1,
            "exp_year": 2020,
            "last4": "0005",
            "brand": "American Express"
        },
        {
            "card_id": "card_1DJwfZ2eZvKYlo2CjJEv24X8",
            "customer": "cus_DlTGwp80wehxyF",
            "exp_month": 1,
            "exp_year": 2020,
            "last4": "4444",
            "brand": "MasterCard"
        },
        {
            "card_id": "card_1DJwWg2eZvKYlo2CO8KGDgFW",
            "customer": "cus_DlTGwp80wehxyF",
            "exp_month": 1,
            "exp_year": 2020,
            "last4": "4242",
            "brand": "Visa"
        },
        {
            "card_id": "card_1DJwWM2eZvKYlo2CncyG6Aoz",
            "customer": "cus_DlTGwp80wehxyF",
            "exp_month": 1,
            "exp_year": 2020,
            "last4": "4242",
            "brand": "Visa"
        }
    ]
}</pre>
                      </td>
                    </tr>       
                    <tr>
                      <th valign="top">Error Response</th>
                      <td>
                          <pre>{"status": 204,"message": "Please fill all fields!"}</pre>
                  
                         
                       
                         
                      </td>
                    </tr>
            
        </table>
        </div>


          <!-- ***********************************-->
          <!--    Get Notification list  -->
          <!--************************************-->
        <div id="get_notification_list"  class="margintop">
                <table class="blog-comparison table table-striped table-bordered">
                    <h4>Get notification list</h4>    
                  <tr>
                    <th valign="top"> URL</th>
                    <td><span class="caption">The URL structure (path only, no root url)</span> <br>
                        <b><code>/get_notification_list</code> </b></td>
                  </tr>       
                  <tr><th valign="top"> Method</th>
                    <td><span class="caption">The request type</span> <br>
                        <b><code>GET</code></b>
                    </td>
                  </tr>       
                  <tr><th valign="top">Data Params</th>
                    <td>
                        <table border="1" width="400">
                            <tr><th>parameter</th>
                            <th>type</th>
                            </tr>  
                            <tr><td>user_id </td><td>number</td></tr>         
                            <tr><td>token </td><td>String</td></tr>
                        </table>
                    </td>
                  </tr>
                    <tr><th valign="top">
                        Success Response
                      </th>
                      <td>
                <pre>{
    "status": 200,
    "message": "Data Found",
    "data": [
        {
            "id": 2,
            "sender_id": 1,
            "receiver_id": 6,
            "message": "Your account has been suspended by admin, Please contact admin@gmail.com to approve your account.",
            "label": "account_suspend",
            "user_type": "U",
            "status": "1",
            "created_at": "2018-10-04 15:38:31",
            "updated_at": "2018-10-04 15:38:31",
            "timeago": "2 weeks ago"
        },
        {
            "id": 1,
            "sender_id": 1,
            "receiver_id": 6,
            "message": "Your account has been suspended by admin, Please contact admin@gmail.com to approve your account.",
            "label": "account_suspend",
            "user_type": "U",
            "status": "1",
            "created_at": "2018-10-04 15:35:49",
            "updated_at": "2018-10-04 15:41:40",
            "timeago": "2 weeks ago"
        }
    ]
}</pre>
                      </td>
                    </tr>       
                    <tr>
                      <th valign="top">Error Response</th>
                      <td>
                          <pre>{"status": 204,"message": "Please fill all fields!"}</pre>
                   
                      </td>
                    </tr>
        </table>
        </div> 


<!-- ***********************************-->
<!--    Get Review list  -->
<!--************************************-->
        <div id="get_review_list"  class="margintop">
                <table class="blog-comparison table table-striped table-bordered">
                    <h4>Get review list</h4>    
                  <tr>
                    <th valign="top"> URL</th>
                    <td><span class="caption">The URL structure (path only, no root url)</span> <br>
                        <b><code>/get_review_list</code> </b></td>
                  </tr>       
                  <tr><th valign="top"> Method</th>
                    <td><span class="caption">The request type</span> <br>
                        <b><code>GET</code></b>
                    </td>
                  </tr>       
                  <tr><th valign="top">Data Params</th>
                    <td>
                        <table border="1" width="400">
                            <tr><th>parameter</th>
                            <th>type</th>
                            </tr>  
                            <tr><td>user_id </td><td>number</td></tr>         
                            <tr><td>token </td><td>String</td></tr>
                        </table>
                    </td>
                  </tr>
                    <tr><th valign="top">
                        Success Response
                      </th>
                      <td>
                <pre>{
    "status": 200,
    "message": "Data Found",
    "data": [
        {
            "user_name": "Marnia",
            "profile_picture": "http://192.168.2.252/touch_massage/public/uploads/profile/1537876504.png",
            "id": 5,
            "job_id": 2,
            "rater_id": 4,
            "ratable_id": 6,
            "comments": "good",
            "rating": 2,
            "created_at": "2018-09-19 14:45:49",
            "updated_at": "2018-10-01 17:49:09",
            "timeago": "4 weeks ago"
        },
        {
            "user_name": "Marnia",
            "profile_picture": "http://192.168.2.252/touch_massage/public/uploads/profile/1537876504.png",
            "id": 7,
            "job_id": 3,
            "rater_id": 5,
            "ratable_id": 6,
            "comments": "sdsdads",
            "rating": 5,
            "created_at": "2018-10-04 17:08:55",
            "updated_at": "2018-10-18 14:15:53",
            "timeago": "2 weeks ago"
        }
    ]
}</pre>
                      </td>
                    </tr>       
                    <tr>
                      <th valign="top">Error Response</th>
                      <td>
                          <pre>{"status": 204,"message": "Please fill all fields!"}</pre>
                  
                         
                       
                         
                      </td>
                    </tr>
            
        </table>
        </div> 
<!-- ***********************************-->
<!--    notification_on_off  -->
<!--************************************-->
        <div id="notification_on_off"  class="margintop">
                <table class="blog-comparison table table-striped table-bordered">
                    <h4>Get review list</h4>    
                  <tr>
                    <th valign="top"> URL</th>
                    <td><span class="caption">The URL structure (path only, no root url)</span> <br>
                        <b><code>/notification_on_off</code> </b></td>
                  </tr>       
                  <tr><th valign="top"> Method</th>
                    <td><span class="caption">The request type</span> <br>
                        <b><code>POST</code></b>
                    </td>
                  </tr>       
                  <tr><th valign="top">Data Params</th>
                    <td>
                        <table border="1" width="400">
                            <tr><th>parameter</th>
                            <th>type</th>
                            </tr>  
                            <tr><td>user_id </td><td>number</td></tr>         
                            <tr><td>token </td><td>String</td></tr>
                            <tr><td>notification_status(ON,OFF) </td><td>String</td></tr>
                        </table>
                    </td>
                  </tr>
                    <tr><th valign="top">
                        Success Response
                      </th>
                      <td>
                <pre>{
             "status": 200,
             "message": "Update succefully"
      }</pre>
                      </td>
                    </tr>       
                    <tr>
                      <th valign="top">Error Response</th>
                      <td>
                          <pre>{"status": 204,"message": "Please fill all fields!"}</pre>
                  
                         
                    
                      </td>
                  </tr>      
        </table>
        </div>
 <!-- ***********************************-->
<!--    Card Delete  -->
<!--************************************-->
        <div id="cards_delete"  class="margintop">
                <table class="blog-comparison table table-striped table-bordered">
                    <h4>cards_delete</h4>    
                  <tr>
                    <th valign="top"> URL</th>
                    <td><span class="caption">The URL structure (path only, no root url)</span> <br>
                        <b><code>/cards_delete</code> </b></td>
                  </tr>       
                  <tr><th valign="top"> Method</th>
                    <td><span class="caption">The request type</span> <br>
                        <b><code>POST</code></b>
                    </td>
                  </tr>       
                  <tr><th valign="top">Data Params</th>
                    <td>
                        <table border="1" width="400">
                            <tr><th>parameter</th>
                            <th>type</th>
                            </tr>  
                            <tr><td>user_id </td><td>number</td></tr>         
                     
                            <tr><td>card_id</td><td>String</td></tr>
                        </table>
                    </td>
                  </tr>
                    <tr><th valign="top">
                        Success Response
                      </th>
                      <td>
                <pre>{
             "status": 200,
             "message": "card delete Successfully"
      }</pre>
                      </td>
                    </tr>       
                    <tr>
                      <th valign="top">Error Response</th>
                      <td>
                          <pre>{"status": 204,"message": "Please fill all fields!"}</pre>
                  
                         
                    
                      </td>
                  </tr>      
        </table>
        </div> 

<!-- ***********************************-->
<!--    Upload Work Picture  -->
<!--************************************-->
        <div id="uploadWorkPicture"  class="margintop">
                <table class="blog-comparison table table-striped table-bordered">
                    <h4>Upload Work Picture</h4>    
                  <tr>
                    <th valign="top"> URL</th>
                    <td><span class="caption">The URL structure (path only, no root url)</span> <br>
                        <b><code>/uploadWorkPicture</code> </b></td>
                  </tr>       
                  <tr><th valign="top"> Method</th>
                    <td><span class="caption">The request type</span> <br>
                        <b><code>POST</code></b>
                    </td>
                  </tr>       
                  <tr><th valign="top">Data Params</th>
                    <td>
                        <table border="1" width="400">
                            <tr><th>parameter</th>
                            <th>type</th>
                            </tr>  
                            <tr><td>job_id </td><td>number</td></tr>         
                     
                            <tr><td>work_picture</td><td>file</td></tr>
                        </table>
                    </td>
                  </tr>
                    <tr><th valign="top">
                        Success Response
                      </th>
                      <td>
                <pre>{
             "status": 200,
             "message": "work picture save Successfully"
      }</pre>
                      </td>
                    </tr>       
                    <tr>
                      <th valign="top">Error Response</th>
                      <td>
                          <pre>{"status": 204,"message": "Please fill all fields!"}</pre>
                          <pre>{"status": 204,"message": "faild to save work picture!"}</pre>
                  
                         
                    
                      </td>
                  </tr>      
        </table>
        </div> 

          <!-- ***********************************-->
          <!--    Upload Work Picture  -->
          <!--************************************-->
        <div id="addBankAccount"  class="margintop">
          <table class="blog-comparison table table-striped table-bordered">
            <h4>Add Bank Account</h4>

            <tr>
              <th valign="top"> URL</th>
              <td><span class="caption">The URL structure (path only, no root url)</span> <br>
                  <b><code>/addBankAccount</code> </b></td>
            </tr>

            <tr><th valign="top"> Method</th>
              <td><span class="caption">The request type</span> <br>
                  <b><code>POST</code></b>
              </td>
            </tr>

            <tr><th valign="top">Data Params</th>
              <td>
                  <table border="1" width="400">
                      <tr><th>parameter</th>
                      <th>type</th>
                      </tr>  
                      <tr><td>user_id </td><td>number</td></tr>         
                  </table>
              </td>
            </tr>

            <tr><th valign="top">
                Success Response
              </th>
              <td>
                <pre>{
             "status": 200,
             "message": "Bank Details has been added successfully"
      }</pre>
              </td>
            </tr>       
            <tr>
              <th valign="top">Error Response</th>
              <td>
              </td>
          </tr>      
        </table>
      </div> 
        <!-- ***********************************-->


        <!-- ***********************************-->
          <!--    Upload Work Picture  -->
          <!--************************************-->
        <div id="getProfile"  class="margintop">
          <table class="blog-comparison table table-striped table-bordered">
            <h4>Get Profile Details</h4>

            <tr>
              <th valign="top"> URL</th>
              <td><span class="caption">The URL structure (path only, no root url)</span> <br>
                  <b><code>/getProfile</code> </b></td>
            </tr>

            <tr><th valign="top"> Method</th>
              <td><span class="caption">The request type</span> <br>
                  <b><code>GET</code></b>
              </td>
            </tr>

            <tr><th valign="top">Data Params</th>
              <td>
                  <table border="1" width="400">
                      <tr><th>parameter</th>
                      <th>type</th>
                      </tr>  
                      <tr><td>token </td><td>string</td></tr>         
                  </table>
              </td>
            </tr>

            <tr><th valign="top">
                Success Response
              </th>
              <td>
                <pre>{
    "message": "Get profile successfully.",
    "data": {
        "id": 27,
        "social_id": "",
        "email": "ravi12@yopmail.com",
        "name": "",
        "gender": "",
        "dob": "",
        "profile_pic": "",
        "job_title": "",
        "bio": "",
        "project": "",
        "interest": "",
        "work_place": "",
        "address": "",
        "latitude": "",
        "longitude": "",
        "day": "",
        "time": "",
        "register_type": "O",
        "device_id": "fasdafdas",
        "device_type": "A",
        "notification_status": 1,
        "updated_at": "2019-02-27 12:57:07",
        "created_at": "2019-02-27 12:57:07",
        "interest_name": null,
        "work_name": null,
        "day_name": null,
        "time_name": null
    }
}</pre>
              </td>
            </tr>       
            <tr>
              <th valign="top">Error Response</th>
              <td>
              </td>
          </tr>      
        </table>
      </div> 
        <!-- ***********************************-->


        <!-- ***********************************-->
          <!--    Upload Work Picture  -->
          <!--************************************-->
        <div id="getProfile"  class="margintop">
          <table class="blog-comparison table table-striped table-bordered">
            <h4>Get Other Profile Details</h4>

            <tr>
              <th valign="top"> URL</th>
              <td><span class="caption">The URL structure (path only, no root url)</span> <br>
                  <b><code>/getOtherProfile</code> </b></td>
            </tr>

            <tr><th valign="top"> Method</th>
              <td><span class="caption">The request type</span> <br>
                  <b><code>POST</code></b>
              </td>
            </tr>

            <tr><th valign="top">Data Params</th>
              <td>
                  <table border="1" width="400">
                      <tr><th>parameter</th>
                      <th>type</th>
                      </tr>  
                      <tr><td>token </td><td>string</td></tr>         
                      <tr><td>other_user_id </td><td>int</td></tr>         
                  </table>
              </td>
            </tr>

            <tr><th valign="top">
                Success Response
              </th>
              <td>
                <pre>{
    "message": "Get profile successfully.",
    "data": {
        "id": 27,
        "social_id": "",
        "email": "ravi12@yopmail.com",
        "name": "",
        "gender": "",
        "dob": "",
        "profile_pic": "",
        "job_title": "",
        "bio": "",
        "project": "",
        "interest": "",
        "work_place": "",
        "address": "",
        "latitude": "",
        "longitude": "",
        "day": "",
        "time": "",
        "register_type": "O",
        "device_id": "fasdafdas",
        "device_type": "A",
        "notification_status": 1,
        "updated_at": "2019-02-27 12:57:07",
        "created_at": "2019-02-27 12:57:07",
        "interest_name": null,
        "work_name": null,
        "day_name": null,
        "time_name": null
    }
}</pre>
              </td>
            </tr>       
            <tr>
              <th valign="top">Error Response</th>
              <td>
              </td>
          </tr>      
        </table>
      </div> 
        <!-- ***********************************-->

          <!-- ***********************************-->
          <!--    Upload Work Picture  -->
          <!--************************************-->
        <div id="deleteAccount"  class="margintop">
          <table class="blog-comparison table table-striped table-bordered">
            <h4>Delete Account</h4>

            <tr>
              <th valign="top"> URL</th>
              <td><span class="caption">The URL structure (path only, no root url)</span> <br>
                  <b><code>/deleteAccount</code> </b></td>
            </tr>

            <tr><th valign="top"> Method</th>
              <td><span class="caption">The request type</span> <br>
                  <b><code>GET</code></b>
              </td>
            </tr>

            <tr><th valign="top">Data Params</th>
              <td>
                  <table border="1" width="400">
                      <tr><th>parameter</th>
                      <th>type</th>
                      </tr>  
                      <tr><td>token </td><td>string</td></tr>         
                  </table>
              </td>
            </tr>

            <tr><th valign="top">
                Success Response
              </th>
              <td>
                <pre>{
             "status": 200,
             "message": "Account delete successfully."
      }</pre>
              </td>
            </tr>       
            <tr>
              <th valign="top">Error Response</th>
              <td>
              </td>
          </tr>      
        </table>
      </div> 

        

          <!-- ***********************************-->
          <!--    Upload Work Picture  -->
          <!--************************************-->
        <div id="changePassword"  class="margintop">
          <table class="blog-comparison table table-striped table-bordered">
            <h4>Change Password</h4>

            <tr>
              <th valign="top"> URL</th>
              <td><span class="caption">The URL structure (path only, no root url)</span> <br>
                  <b><code>/changePassword</code> </b></td>
            </tr>

            <tr><th valign="top"> Method</th>
              <td><span class="caption">The request type</span> <br>
                  <b><code>POST</code></b>
              </td>
            </tr>

            <tr><th valign="top">Data Params</th>
              <td>
                  <table border="1" width="400">
                      <tr><th>parameter</th>
                      <th>type</th>
                      </tr>  
                      <tr><td>token </td><td>string</td></tr>         
                      <tr><td>new_password </td><td>string</td></tr>         
                      <tr><td>old_password </td><td>string</td></tr>         
                  </table>
              </td>
            </tr>

            <tr><th valign="top">
                Success Response
              </th>
              <td>
                <pre>{
             "status": 200,
             "message": "Password update successfully."
      }</pre>
              </td>
            </tr>       
            <tr>
              <th valign="top">Error Response</th>
              <td>
              </td>
          </tr>      
        </table>
      </div>

          <!-- ***********************************-->
          <!--    Upload Work Picture  -->
          <!--************************************-->
        <div id="articleList"  class="margintop">
          <table class="blog-comparison table table-striped table-bordered">
            <h4>Change Password</h4>

            <tr>
              <th valign="top"> URL</th>
              <td><span class="caption">The URL structure (path only, no root url)</span> <br>
                  <b><code>/articleList</code> </b></td>
            </tr>

            <tr><th valign="top"> Method</th>
              <td><span class="caption">The request type</span> <br>
                  <b><code>GET</code></b>
              </td>
            </tr>

            <tr><th valign="top">Data Params</th>
              <td>
                  <table border="1" width="400">
                      <tr><th>parameter</th>
                      <th>type</th>
                      </tr>  
                      <tr><td>token </td><td>string</td></tr>           
                  </table>
              </td>
            </tr>

            <tr><th valign="top">
                Success Response
              </th>
              <td>
                <pre>{
             "status": 200,
             "message": "Get articles successfully."
      }</pre>
              </td>
            </tr>       
            <tr>
              <th valign="top">Error Response</th>
              <td>
              </td>
          </tr>      
        </table>
      </div>

      <!-- ***********************************-->
          <!--    Upload Work Picture  -->
          <!--************************************-->
        <div id="articleDetails"  class="margintop">
          <table class="blog-comparison table table-striped table-bordered">
            <h4>Article Details</h4>

            <tr>
              <th valign="top"> URL</th>
              <td><span class="caption">The URL structure (path only, no root url)</span> <br>
                  <b><code>/articleDetails</code> </b></td>
            </tr>

            <tr><th valign="top"> Method</th>
              <td><span class="caption">The request type</span> <br>
                  <b><code>POST</code></b>
              </td>
            </tr>

            <tr><th valign="top">Data Params</th>
              <td>
                  <table border="1" width="400">
                      <tr><th>parameter</th>
                      <th>type</th>
                      </tr>  
                      <tr><td>token </td><td>string</td></tr>           
                      <tr><td>article_id </td><td>int</td></tr>           
                  </table>
              </td>
            </tr>

            <tr><th valign="top">
                Success Response
              </th>
              <td>
                <pre>{
             "status": 200,
             "message": "Get articles successfully."
      }</pre>
              </td>
            </tr>       
            <tr>
              <th valign="top">Error Response</th>
              <td>
              </td>
          </tr>      
        </table>
      </div>
 


 
<div id="articleList"  class="margintop">
          <table class="blog-comparison table table-striped table-bordered">
            <h4>Change Password</h4>

            <tr>
              <th valign="top"> URL</th>
              <td><span class="caption">The URL structure (path only, no root url)</span> <br>
                  <b><code>/articleList</code> </b></td>
            </tr>

            <tr><th valign="top"> Method</th>
              <td><span class="caption">The request type</span> <br>
                  <b><code>GET</code></b>
              </td>
            </tr>

            <tr><th valign="top">Data Params</th>
              <td>
                  <table border="1" width="400">
                      <tr><th>parameter</th>
                      <th>type</th>
                      </tr>  
                      <tr><td>token </td><td>string</td></tr>           
                  </table>
              </td>
            </tr>

            <tr><th valign="top">
                Success Response
              </th>
              <td>
                <pre>{
             "status": 200,
             "message": "Get articles successfully."
      }</pre>
              </td>
            </tr>       
            <tr>
              <th valign="top">Error Response</th>
              <td>
              </td>
          </tr>      
        </table>
      </div>

      <!-- ***********************************-->
          <!--    Upload Work Picture  -->
          <!--************************************-->
        <div id="articleDetails"  class="margintop">
          <table class="blog-comparison table table-striped table-bordered">
            <h4>Article Details</h4>

            <tr>
              <th valign="top"> URL</th>
              <td><span class="caption">The URL structure (path only, no root url)</span> <br>
                  <b><code>/articleDetails</code> </b></td>
            </tr>

            <tr><th valign="top"> Method</th>
              <td><span class="caption">The request type</span> <br>
                  <b><code>POST</code></b>
              </td>
            </tr>

            <tr><th valign="top">Data Params</th>
              <td>
                  <table border="1" width="400">
                      <tr><th>parameter</th>
                      <th>type</th>
                      </tr>  
                      <tr><td>token </td><td>string</td></tr>           
                      <tr><td>article_id </td><td>int</td></tr>           
                  </table>
              </td>
            </tr>

            <tr><th valign="top">
                Success Response
              </th>
              <td>
                <pre>{
             "status": 200,
             "message": "Get articles successfully."
      }</pre>
              </td>
            </tr>       
            <tr>
              <th valign="top">Error Response</th>
              <td>
              </td>
          </tr>      
        </table>
      </div>