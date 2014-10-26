<html>
<head>

</head>
<body>
<div id="fb-root"></div>
<a href="#" onclick="postToWall();return false;">Click Here！</a>
<script type="text/javascript">
window.fbAsyncInit = function() {  
    FB.init({appId: '220348348164863', status: true, cookie: true, oauth: true, xfbml: true});  
};  
(function(d){  
    var js, id = 'facebook-jssdk'; if (d.getElementById(id)) {return;}  
    js = d.createElement('script'); js.id = id; js.async = true;  
    js.src = "//connect.facebook.net/zh_TW/all.js";  
    d.getElementsByTagName('head')[0].appendChild(js);  
}(document)); 
function postToWall(id) {  
        var args = {  
            method: 'feed',  
            name: 'Facebook App',  
            message: document.getElementById('Textarea_Msg').value,  
            link: 'https://developers.facebook.com/docs/reference/dialogs/',  
            picture: 'http://www.fbrell.com/f8.jpg',  
            caption: 'Facebook Test',  
            description: 'description'  
        };  
        FB.api('/' + id + '/feed', 'post', args, onPostToWallCompleted);  
        document.getElementById('msg').innerHTML = "waiting...";  
    }  
       
    function onPostToWallCompleted(response) {  
        if (!response || response.error) {  
            document.getElementById('msg').innerHTML = 'Error occured: ' + response.error.message;  
            $('#msg').slideDown();  
        } else {  
            document.getElementById('msg').innerHTML = '發佈成功，訊息ID:' + response.id + "。<a href="%5C%22javascript:deleteWall%28%27%22" response.id="">刪除此訊息</a>";  
            $('#msg').slideDown();  
        }  
    }  
</script>
</body>
</html>