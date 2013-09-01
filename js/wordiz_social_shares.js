//jQuery(document).ready(function(){
//    alert("Hello"); 
//});


var $ = jQuery;
  //http://www.upgradedtutorials.info/php/getting-facebook-likes-shares-and-comment-counts-using-php-function/
  function getfbcount(url,iddivFb){
    var fblikes;
	fql = "SELECT url, normalized_url, share_count, like_count, comment_count, total_count, commentsbox_count, comments_fbid, click_count FROM link_stat WHERE url = '"+url+"'";
	apifql="https://api.facebook.com/method/fql.query?format=json&query="+encodeURIComponent(fql);
	fblikes = 0;
	$(iddivFb).text(fblikes);	 
     $.getJSON(apifql, function(data){;
        fblikes = data[0].total_count;
        $(iddivFb).text(fblikes);
     });
  }
	  // Get Number of Tweet Count From Topsy
	 function gettwcount(url,iddiv){
	 var tweets;
	 tweets=0;
	 $(iddiv).text(tweets);
	// $.getJSON('http://otter.topsy.com/stats.js?url='+url+'&callback=?&apikey=GGSRY5WZOG5ZPJOY34JAAAAAADE5IKL2CVI', function(data){
	$.getJSON('http://urls.api.twitter.com/1/urls/count.json?url='+url+"&callback=?", function(data){
		tweets=data.count;
		 $(iddiv).text(tweets);
     });
  } 

  // Get Number of +1 Count From SharedCount
	 function getgpcount(url,iddivGp){
	 var plusones;
	 plusones=0;
	 $(iddivGp).text(plusones);
	// $.getJSON('http://otter.topsy.com/stats.js?url='+url+'&callback=?&apikey=GGSRY5WZOG5ZPJOY34JAAAAAADE5IKL2CVI', function(data){
	$.getJSON('http://api.sharedcount.com/?url='+url, function(data){
		plusones=data.GooglePlusOne;
		 $(iddivGp).text(plusones);
     });
  }
