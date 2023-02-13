window.onload=function(){

    //跳转mobile--------------------------------
    var mobileAgent = new Array( "android", "mobile", "blackberry", "webos", "incognito", "webmate", "bada", "nokia","iphone", "ipod", "ipad", "lg", "ucweb", "skyfire");
    var browser = navigator.userAgent.toLowerCase();
    var pcLink = false;
    //判断是否是强制访问电脑版链接  ?webpage=1--------------------------------
    var query = window.location.search.substring(1);
    var vars = query.split("&");
    for (var i=0;i<vars.length;i++) {
            var pair = vars[i].split("=");
            if(pair[0] == 'webpage'){
                if(pair[1]==1){
                    pcLink=true;
                }
            }
    }

    for (var i=0; i<mobileAgent.length; i++){ 
    if (browser.indexOf(mobileAgent[i])!=-1 && !pcLink){ 
        break;
        }
    }

    //经过显示详情--------------------------------
    var oMovieInformation=document.getElementById('movie-information');
    var oMovieName=document.getElementById('movie-name');
    var oMovieImgA=document.getElementById('movie-img-a');
    var oMovieImgFixed=document.getElementById('movie-img-fixed');

    oMovieInformation.onmouseover=oMovieName.onmouseover=oMovieImgA.onmouseover=function(){
        oMovieImgFixed.style.display='block';
    }
    oMovieInformation.onmouseleave=oMovieName.onmouseleave=oMovieImgA.onmouseleave=function(){
        oMovieImgFixed.style.display='none';
    }















}//end