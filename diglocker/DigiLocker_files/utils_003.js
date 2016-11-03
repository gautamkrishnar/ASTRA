/*var data = 	{
			'authService' : 'google',
			'action' : 'getGoogleAppConfig'
		};

$.ajax({
   type: "POST",
   url: OC.filePath('user_google', '', 'index.php'),
   async: true,
   data: data,
   success: function(response) { data = response; }
});
var CLIENTID=data.CLIENTID;	
var REDIRECT=data.REDIRECT;*/
		var CLIENTID	=	'621720315069-vig8d6dhtdk6dj3egra57knvv00o4b8d.apps.googleusercontent.com';	
		var REDIRECT	=	window.location.origin+'/oauth';
		var OAUTHURL    =   'https://accounts.google.com/o/oauth2/auth?';
        var VALIDURL    =   'https://www.googleapis.com/oauth2/v1/tokeninfo?access_token=';
        var SCOPE       =   'https://www.googleapis.com/auth/userinfo.profile https://www.googleapis.com/auth/userinfo.email';
        var LOGOUT      =   'http://accounts.google.com/Logout';
        var TYPE        =   'token';
        var _url        =   OAUTHURL + 'scope=' + SCOPE + '&client_id=' + CLIENTID + '&redirect_uri=' + REDIRECT + '&response_type=' + TYPE;
        var acToken;
        var tokenType;
        var expiresIn;
        var user;
        var loggedIn    =   false;

		/*$.post(OC.filePath('user_google', '', 'index.php'),data,function(data) {
			set_CLIENTID(data.CLIENTID,data.REDIRECT);
			alert('1'+CLIENTID);
				});


		*/
        

        function google_login() {
			$('#refreshmsg').show();
			$('.loginpage').hide();
            var win         =   window.open(_url, "windowname1", 'width=800, height=600'); 

            var pollTimer   =   window.setInterval(function() { 
                try {
                    console.log(win.document.URL);
                    if (win.document.URL.indexOf(REDIRECT) != -1) {
                        window.clearInterval(pollTimer);
                        var url =   win.document.URL;
                        acToken =   gup(url, 'access_token');
                        tokenType = gup(url, 'token_type');
                        expiresIn = gup(url, 'expires_in');
                        win.close();

                        validateToken(acToken);
                    }
                } catch(e) {
                }
            }, 500);
        }

        function validateToken(token) {
            $.ajax({
                url: VALIDURL + token,
                data: null,
                success: function(responseText){  
                    getUserInfo();
                    loggedIn = true;
                    $('#loginText').hide();
                    $('#logoutText').show();
					$('#google_account_unlink').show();
                },  
                dataType: "jsonp"  
            });
        }

        function getUserInfo() {
			
			
			
            $.ajax({
                url: 'https://www.googleapis.com/oauth2/v1/userinfo?access_token=' + acToken,
                data: null,
                success: function(resp) {
                    user    =   resp;
                    //$('#uName').text('Welcome ' + user.name);
                    //$('#imgHolder').attr('src', user.picture);
					/* Saving Google User ID*/
					var token_name=$("#token").attr("name");
					var token_value=$("#token").attr("value");
					var data = {
						'token_name':token_name,
						'token_value':token_value,
						'authService' : 'google',
						'user' : '',
						'password' : '',
						'google_access_token' : acToken,
						sectoken : $('#sectoken').val()
						
					};
					$.post(OC.filePath('user_google', '', 'index.php'), data)
					.done(function( response ) {
						if(response.msg=='Access granted'){
							window.location.href=window.location.origin+'/index.php/apps/dashboard/';
							}
							else if(response && response.msg == 'Not Linked'){
								console.log(response);
							$('<form action="/public/register/linkgoogle" method="post">\n\
				<input type="hidden" required="" value="'+acToken+'" name="accessToken">\n\
				</form>').appendTo('body').submit();
							/*$('#socialmsg').text('Please log in to link your Google account with DigiLocker account');
							$('#socialmsg').show();
							$('#refreshmsg').hide();
							$('.loginpage').show();*/
							}
						});
					
  /* END of Saving Google User ID*/
   
                },
                dataType: "jsonp"
            });
        }

        //credits: http://www.netlobo.com/url_query_string_javascript.html
        function gup(url, name) {
            name = name.replace(/[\[]/,"\\\[").replace(/[\]]/,"\\\]");
            var regexS = "[\\#&]"+name+"=([^&#]*)";
            var regex = new RegExp( regexS );
            var results = regex.exec( url );
            if( results == null )
                return "";
            else
                return results[1];
        }

        function startLogoutPolling() {
            $('#loginText').show();
            $('#logoutText').hide();
			$('#google_account_unlink').hide();
            loggedIn = false;
            $('#uName').text('Welcome ');
            $('#imgHolder').attr('src', 'none.jpg');
        }
