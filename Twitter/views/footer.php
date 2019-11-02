<footer class="footer">
      <div class="container">
        <span class="text-muted">&copy; My website 2018</span>
      </div>
</footer>


<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

    <!-- Modal -->
    <div class="modal fade" id="my-modal" tabindex="-1" role="dialog" aria-labelledby="loginModal" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="loginModal">Login</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            
            <div class="alert alert-danger" id="loginAlert" role="alert"></div>

            <form>
                <input type="hidden" name="loginActive" id="loginActive" value="1">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" placeholder="Enter your email here" class="form-control">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" placeholder="Password" class="form-control">
                </div>
              
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-link" id="signup">Sign Up</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-success" id="login">Login</button>
            
          </div>
        </div>
      </div>
    </div>
    
    <script type="text/javascript">
        
        if($("#signup").html()=="Sign Up"){
            $("#loginActive").val("1");
        }
        else{
            $("#loginActive").val("0");
        }

        $("#signup").click(function(){
            //alert("l");
           
            if($("#loginActive").val()==1){
                
                $("#loginModal").html("Sign Up");
                $("#login").html("Sign Up");
                $("#loginActive").val("0");
                $("#signup").html("Login");
            }
            else{
                
                $("#loginModal").html("Login");
                $("#login").html("Login");
                $("#loginActive").val("1");
                $("#signup").html("Sign Up");
            }
            
        });
        
        $("#login").click(function(){
            
            $.ajax({
                
                type: "POST",
                url: "actions.php?action=loginSignup",
                data: "email="+ $("#email").val() + "&password=" + $("#password").val() + "&loginActive=" + $("#loginActive").val(),
                success: function(result){
                    
                    if(result==1){
                        window.location.assign("http://priyanshuntesthosting23-com.stackstaging.com/web/Twitter/index.php");
                    }
                    else{
                        
                        if(result != ""){
                            $("#loginAlert").html(result).show();
                        }
                        else{
                            $("#loginAlert").html(result).hide();
                        }
                    }
                }
                
            })
            
        });
        
        /*$(".toggleFollow").click(function(){
           
            //alert($(this).attr("data-userId"));
            var id = $(this).attr("data-userId");
            
            $.ajax({
                
                type: "POST",
                url: "actions.php?action=toggleFollow",
                data: "userId=" + id,
                success: function(result){
                    
                    //alert(result);
                    
                    if(result == 1){
                        
                        alert(result);

                        //$("a[data-userId='"$(this).attr("data-userId")"']").html("Follow");

                    }
                    else if(result == "2"){
                        
                        alert(result); 
                
                        $("a[data-userId='" + id + "']").html("Unfollow");
                    }
                   
                }
                
            })
            
        });*/
        
        $(".toggleFollow").click(function() {
        
        var id = $(this).attr("data-userId");
        
        $.ajax({
            type: "POST",
            url: "actions.php?action=toggleFollow",
            data: "userId=" + id,
            success: function(result) {
                
                if (result == "1") {
                    
                    $("a[data-userId='" + id + "']").val("Follow");
                    
                } else if (result == "2") {
                    
                    $("a[data-userId='" + id + "']").val("Unfollow");
                    
                }
            }
            
        })
        
    });
        
        $("#postTweetButton").click(function(){
            
            //alert("hi");
            
            //alert($("#tweetContent").val());
            
             $.ajax({
                type: "POST",
                url: "actions.php?action=postTweet",
                data: "tweetContent=" + $("#tweetContent").val(),
                success: function(result) {
                    //alert(result);
                    if(result == "1"){
                        alert(result);
                        $("#success").show();
                        $("#failure").hide();
                    }
                    
                    else if(result == "2"){
                        alert(result);
                        $("#success").hide();
                        $("#failure").show();
                    }
                },
                 error: function(xhr, error){
                    console.debug(xhr); console.debug(error);
                }

            })
            
        });
        
    
    </script>

  </body>
</html>