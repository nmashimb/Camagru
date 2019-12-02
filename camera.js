
var baseImage = null;
var sticker = "";
(function() {
        var video = document.getElementById('video'),
            canvas = document.getElementById('canvas'),
            context = canvas.getContext('2d'), 
            vendorUrl = window.URL || window.webkitURL;

        navigator.getMedia = navigator.getUserMedia ||
                             navigator.webkitGetUserMedia ||
                             navigator.mozGetUserMedia ||
                             navigator.msGetUserMedia;

        navigator.getMedia({
            video: true,
            audio: false
        }, function(stream) {
            video.srcObject=stream;
            video.play();
        }, function(error) {
             //error code
        });

        document.getElementById('capture').addEventListener('click', function(){
            context.drawImage(video, 0, 0, 400, 300);
        baseImage = canvas.toDataURL('image/png');
        });
        
})();
/////////////   ADD STICKERS /////////
canvas = document.getElementById('canvas');
context = canvas.getContext('2d');
document.getElementById('wow').addEventListener('click', function stickeruno(){
    context.drawImage(document.getElementById('wow'),50, 50, 60, 60);
});
document.getElementById('ok').addEventListener('click', function stickertwo(){
    context.drawImage(document.getElementById('ok'),50, 150, 60, 60);
});
function withSticker(){
var ajx_obj = new XMLHttpRequest();
ajx_obj.onreadystatechange = function()
    {
        if (ajx_obj.readyState === 4) { 
            if (ajx_obj.status === 200) 
            {
                if(ajx_obj.responseText == "image success"){
                    alert("image saved!");
                    console.log(ajx_obj.responseText);
                }
                else
                    alert("image not saved!");
                     console.log(ajx_obj.responseText);
            }
        }
    };
ajx_obj.open('POST', "camera.php", true);
ajx_obj.setRequestHeader("Content-type","application/x-www-form-urlencoded");
ajx_obj.send("image="+canvas.toDataURL('image/png'));
}
//////////////////////////////////////////////////////////////////////////////    
