/* Facebook */
(function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/all.js";
     fjs.parentNode.insertBefore(js, fjs);
 }(document, 'script', 'facebook-jssdk'));

window.fbAsyncInit = function() {
    // init the FB JS SDK
    FB.init({
      status     : true,                                 
      xfbml      : true                                  
    });

    FB.Event.subscribe('edge.create', function(href, widget) {
        jQuery.event.trigger({
            type: "pageShared",
            url: href
        });     
    });
};

/* Twitter */
  window.twttr = (function (d,s,id) {
  var t, js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return; js=d.createElement(s); js.id=id;
  js.src="https://platform.twitter.com/widgets.js"; fjs.parentNode.insertBefore(js, fjs);
  return window.twttr || (t = { _e: [], ready: function(f){ t._e.push(f) } });
}(document, "script", "twitter-wjs"));

twttr.ready(function (twttr) {
    twttr.events.bind('tweet', function (event) {
        jQuery.event.trigger({
            type: "pageShared",
            url: event.target.baseURI
        });
    });
});

/* Google Plus */
(function() {
    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
    po.src = 'https://apis.google.com/js/plusone.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
  })();

function plusOned(obj){
	console.log(obj);
	jQuery.event.trigger({
	    type: "pageShared",
	    url: obj.href
	});
}

  
/* Listen for the pageShared event */
jQuery(document).on('pageShared',function(e){
	if(e.url == window.location.href){
		//jQuery(".secret").show();
		jQuery(".secret").slideDown( function() {
			// Animation complete.
		});
	}
});