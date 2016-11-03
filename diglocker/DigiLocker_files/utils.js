/**
 * ownCloud - Facebook plugin
 * 
 * @author Alok Ranjan
 * @copyright 2015 Alok Ranjan ranjanalok011[at]gmail[dot]com
 * 
 * This file is licensed under the Affero General Public License version 3 or
 * later.
 */

var FBwrapper = {
	autologin : true,
	
/*	init : function(){
		var data = 	{
			'authService' : 'facebook',
			'action' : 'getFBAppConfig'
		};
		
		$.post(OC.filePath('user_facebook', '', 'index.php'), data, FBwrapper._init);
	},*/
	
	login : function() {
		if (!FB.getUserID()){
		} else {
			
		}
		return false;
	},
	
	/*getProfileData : function(){
		FB.api('/me', FBwrapper.onProfileData);
	},*/
	
	onStatusChange : function(response) {
		if (response && response.status && response.status === 'connected') {
			$('#refreshmsg').show();
			$('.loginpage').hide();
			FBwrapper.onStatusConnected();
		} else if (response.status === 'not_authorized') {
			FBwrapper.onStatusNotConnected();
		} else {
			FBwrapper.onStatusNotConnected();			
		}
	},
	
	onStatusNotConnected : function(){	
	},
	
	onStatusConnected : function(){
		/*FB.api('/me', function(response) { console.log(response)});
		*/var token_name=$("#token").attr("name");
		var token_value=$("#token").attr("value");
		var data = {
			'token_name':token_name,
			'token_value':token_value,
			'authService' : 'facebook',
			'user' : '',
			'password' : '',
			'facebook_access_token' : FB.getAccessToken(),
			sectoken : $('#sectoken').val()
		};
		if (FBwrapper.autologin){
			data.facebook_autologin = '1';
		}

	$.post('index.php', data,
			function(data) {
				if (data && data.msg=='Access granted'){ 
					$('#socialmsg').hide();
					window.location.href=window.location.origin+'/index.php/apps/files/';
				} else if (data && data.msg=='autologin failed'){
					FBwrapper.autologin = false;
					window.location.reload();
				} else if(data && data.msg=='Not Linked'){
					$('<form action="/public/register/linkfacebook" method="post">\n\
				<input type="hidden" required="" value="'+FB.getAccessToken()+'" name="accessToken">\n\
				</form>').appendTo('body').submit();
					/*$('#socialmsg').text('Please log in to link your Facebook account with DigiLocker account');
					$('#socialmsg').show();
					$('#refreshmsg').hide();
					$('.loginpage').show();*/
					} else {
					$('#socialmsg').text('Please log in to link your Facebook account with DigiLocker account');
					$('#socialmsg').show();
					$('#refreshmsg').hide();
					$('.loginpage').show();
				}
			}
			);
		
	},
	
	/*onProfileData : function(data){
		return false;
		},*/
	
	_init : function(){//response){
		FB.init({
			appId      : 1387189761610391,//response.appId, // App ID
			channelUrl : '//'+window.location.hostname+'/channel', // Path to your Channel File
			status     : '',//response.autologin, // check login status
			cookie     : false, // enable cookies to allow the server to access the session
			xfbml      : true  // parse XFBML
		});
		
		var facebook = document.createElement('div');
		facebook.id = 'fb-root';
		document.getElementsByTagName('body')[0].appendChild(facebook);
		
		FBwrapper.onStatusNotConnected();
				
		FB.Event.subscribe('auth.statusChange', FBwrapper.onStatusChange);
	}
};
(function(d){
	var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
	if (d.getElementById(id)) {
		return;
	}
	js = d.createElement('script');
	js.id = id;
	js.async = true;
	js.src = '//'+window.location.hostname+'/apps/user_facebook/js/all.js';
	ref.parentNode.insertBefore(js, ref);
}(document));
window.fbAsyncInit = FBwrapper._init;
