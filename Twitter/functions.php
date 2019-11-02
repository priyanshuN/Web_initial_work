<?php

    session_start();
    
    //$id = isset($_SESSION['id']) ?: null;

    $link=mysqli_connect("shareddb-k.hosting.stackcp.net","twitter-3937927a","hwrbv9inzb","twitter-3937927a");

    if(mysqli_connect_errno()){
       print_r(mysqli_connect_error());
        exit();
    }

    if( $_GET['status'] == "logout"){
        
        session_unset();
    }

    function time_since($since) {
        $chunks = array(
            array(60 * 60 * 24 * 365 , 'year'),
            array(60 * 60 * 24 * 30 , 'month'),
            array(60 * 60 * 24 * 7, 'week'),
            array(60 * 60 * 24 , 'day'),
            array(60 * 60 , 'hour'),
            array(60 , 'min'),
            array(1 , 's')
        );

        for ($i = 0, $j = count($chunks); $i < $j; $i++) {
            $seconds = $chunks[$i][0];
            $name = $chunks[$i][1];
            if (($count = floor($since / $seconds)) != 0) {
                break;
            }
        }

        $print = ($count == 1) ? '1 '.$name : "$count {$name}s";
        return $print;
    }

    function displayTweets($type){
        
        global $link;
        
        if($type=='public') {
        
            $whereClause="";
            
        }
        
        else if($type=='isFollowing'){
            
            $query = "SELECT * FROM isFollowing WHERE follower = '".mysqli_real_escape_string($link,$_SESSION['value'])."' ";
            
            $result = mysqli_query($link,$query);
            
            $whereClause="";
            
            while($row = mysqli_fetch_assoc($result)){
                
                if($whereClause == ""){
                    
                    $whereClause = "WHERE";
                    
                }
                else{
                    
                    $whereClause .= " OR";
                }
                
                $whereClause .= " userid = ".$row['isFollowing'];
            }
            
        }
        
        else if($type == 'yourtweets'){
            
            $whereClause = "WHERE userid =".$_SESSION['value'];
            
        }
        
        else if($type == 'search'){
            
            echo "<p>Showing results for <strong>'".mysqli_real_escape_string($link,$_GET['q'])."'</strong></p>";

            $whereClause = "WHERE tweet LIKE '%".mysqli_real_escape_string($link,$_GET['q'])."%'";
        }
        
        else if(is_numeric($type)){
            
            $whereClause = "WHERE userid = '".mysqli_real_escape_string($link,$type)."'";
            
        }
        
        $query = "SELECT * FROM tweets ".$whereClause." ORDER BY datetime DESC LIMIT 10";
        
        $result = mysqli_query($link,$query);
        
        if(mysqli_num_rows($result)==0){
            
            echo "There are no tweets.";
        }
        else{
            
            while($row = mysqli_fetch_assoc($result)){
                
                $queryTweet = "SELECT * FROM users WHERE id= ".mysqli_real_escape_string($link,$row['userid'])." LIMIT 1";
                
                $queryTweetResult=mysqli_query($link,$queryTweet);
                
                $user = mysqli_fetch_assoc($queryTweetResult);
                
                echo "<div class='tweet'><p><a href='?page=publicProfiles&userid=".$user['id']."'>".$user['email']." </a><span class = 'timeStyle'>".time_since(time()-strtotime($row['datetime']))." ago</span></p>";
                
                echo "<p>".$row['tweet']."</p>";
                
                echo "<p><a class='toggleFollow' data-userId='".$row['userid']."'>";
                
                $queryIsFollowing = "SELECT * FROM isFollowing WHERE follower = '".mysqli_real_escape_string($link,$_SESSION['value'])."' AND isFollowing = '".mysqli_real_escape_string($link,$row['userid'])."' LIMIT 1 ";
                
                $queryIsFollowingResult = mysqli_query($link,$queryIsFollowing);
                
                if(mysqli_num_rows($queryIsFollowingResult)>0){
                    
                    echo "Follow";
                }
                else{
                    
                    echo "Unfollow";
                }
                
                echo "</a></p></div>";
            }
        }
    }

    function displaySearch(){
        
        echo '<form class="form-inline">

                  <div class="form-group">
                  
                    <input type="hidden" name="page" value="search">
                  
                    <input type="text" class="form-control" name="q" id="search" placeholder="Search">
                    
                </div>

                <button type="submit" class="btn btn-primary" id="search">Search Tweets</button>
                
            </form>';
         //echo $_SESSION['value'];
        
    }

    function displayTweetBox(){
        
        if(isset($_SESSION['value'])>0){
            
            echo '<div class="form">
                    
                    <div class="form-group alert alert-success" id="success">
                    Tweet posted successfullly!</div>
                    
                    <div class="form-group alert alert-danger" id="failure">
                    Please try again later!</div>

                  <div class="form-group">

                    <textarea class="form-control" id="tweetContent" placeholder="Enter Tweet"></textarea>
                    
                </div>

                <button type="submit" class="btn btn-primary" id="postTweetButton">Post Tweet</button>
                
            </div>';
        }
    }

    function displayUsers(){
        
        global $link;
        
        $query = "SELECT * FROM users LIMIT 10";
        
        $result = mysqli_query($link,$query);
        
        while($row = mysqli_fetch_assoc($result)){
            
            echo "<p><a href='?page=publicProfiles&userid=".$row['id']."'>".$row['email']."</a></p>";
        }
        
    }

?>


