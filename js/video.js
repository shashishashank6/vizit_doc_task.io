var tag = document.createElement('script');
tag.src="https://www.youtube.com/iframe_api";
var firstScriptTag = document.getElementsByTagName('script')[0];
firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
var player;
var video = 'sBzRwzY7G-k'
    video.h = '390' //video iframe height
    video.w = '640' //video iframe width
 
function onYouTubeIframeAPIReady() {
player = new YT.Player('player', {
        height: video.h,
width: video.w,
videoId: video,
        events: {
            'onStateChange': onPlayerStateChange,
            'onError': onPlayerError
        }
     });
}
 function onPlayerReady(event) {
        event.target.playVideo();
      }
var done = false;
      function onPlayerStateChange(event) {
        if (event.data == YT.PlayerState.PLAYING && !done) {
          setTimeout(stopVideo, 6000);
          done = true;
        }
      }
      function stopVideo() {
        player.stopVideo();
      }