/**
 * ownCloud - Aadhaar plugin
 * 
 * @author Alok Ranjan
 * @copyright 2015 Alok Ranjan ranjanalok011[at]gmail[dot]com
 * 
 * This file is licensed under the Affero General Public License version 3 or
 * later.
 */
function aadhaarSubmit(){
	elementId=document.getElementById('AadhaarNumber');
			var uid = elementId.value;
			if (uid.length < 12  )
			{ 		$('#AadhaarNumber').val('');
					$('#msg').text("Please enter a valid Aadhaar no.");
					$('#msg').show();
					elementId.value='';
					return false;
			}
			if ($('#captchacode').attr("required") == 'required' && $('#captchacode').val().length<=0)
			{ 		$('#captcha').val('');
					$('#msg').text("Please enter confirmation code.");
					$('#msg').show();
					return false;
			}
	if($('#ATypeFMR').is(':checked') || $('#ATypeOTP').is(':checked')) { 
	
		$('#msg').hide();
		$('#AadhaarNumber').addClass('loadinggif');
		$('#AadhaarNumber').attr("readonly","readonly");
		var token_name=$("#token").attr("name");
		var token_value=$("#token").attr("value");
		var AadhaarNumber=$("#AadhaarNumber").val();
		var data = {
			'authService' : 'aadhaar',
			'action': 'validateaadhaar',
			'AadhaarNumber': AadhaarNumber,
			'aadhaar_token':$('#token').val(),
			'captcha':$('#captchacode').val()
		};
									if($('#ATypeOTP').is(':checked')){
									$('#generate_otp').hide();
									$('#captchabox').hide();
									$('#AType_div').hide();
									$('#AadhaarNumber').removeClass('loadinggif');
									
									$('#OTP').show();
									$('#labelforotp').show();
									$('#verify_otp').show();	
									}
			$.ajax({
				  type: 'POST',
				  url: OC.filePath('user_aadhaar', '', 'index.php'),
				  data: data,
				  async:false,
				  success: function(aadhaarStatus){
					if(aadhaarStatus.status=='success'){
									
									
						if($('#ATypeFMR').is(':checked')){$('#aadhaarForm').submit();
						}else{
						
						/* Send OTP*/
						$.ajax({
							  type: 'POST',
							  url: OC.filePath('user_aadhaar', 'ajax', 'sendotp.php'),
							  data: {AadhaarNumber: String(AadhaarNumber),captcha:$('#captchacode').val()},
							  success: function(otpresponse){
								  if(otpresponse.status!='success'){
									 
									  $('#captchabox').hide();
									  $('#captchabox').val('');
									   $('#msg').html(otpresponse.msg);
									$('#msg').show();
									$('#OTP').hide();
									
									$('#labelforotp').hide();
									$('#generate_otp').hide();
									$('#verify_otp').hide();
									$('#AadhaarNumber').hide();
									$('#labelforaadhaar').hide();
									  
									  }
									  else{
									$('#OTP').show();
									$('#labelforotp').show();
									$('#generate_otp').hide();
									$('#verify_otp').show();
									$('#captchabox').hide();
									}
								  },
							  error:function(){
								  
									$('#AadhaarNumber').hide();
									$('#labelforaadhaar').hide();
									$('#generate_otp').hide();
									$('#AType_div').hide();
									$('#OTP').hide();
									$('#labelforotp').hide();
									$('#verify_otp').hide();
								  	$('#msg').html("Something went wrong. <a href='"+window.location.origin+"/index.php' style='color:blue;'> Click here for regenerate OTP.</a>");
									$('#msg').show();
									$('#captchabox').hide();
							  }
							  
							});
						/* OTP Sending END*/
						
						
						}
						
						}
					else{
						$('#captchabox').val('');
						$('#captchabox').show();
						$('#AadhaarNumber').removeClass('loadinggif');
						$('#AadhaarNumber').removeAttr("readonly");
						$('#msg').text(aadhaarStatus.msg);
						$('#msg').show();
						$('#OTP').hide();
						$('#labelforotp').hide();
						$('#generate_otp').show();
						$('#AType_div').show();
						$('#verify_otp').hide();
						
						}
					  },
				  
				});
		return false;
	}else{
		$('#msg').text('Please select Fingerprint or OTP ');
		$('#msg').show();
		return false;
		}
	}
function isNumberKey(evt){
var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
        
    return true;
}
function verifyOTP(){
		if ($('#OTP').val().length < 4) {
			$('#msg').text('OTP is required.');
			$('#msg').show();
			return false;
		}
		$('#msg').hide();
		$('#OTP').addClass('loadinggif');
		$('#OTP').attr("readonly","readonly");
		var token_name=$("#token").attr("name");
		var token_value=$("#token").attr("value");
		var AadhaarNumber=$("#AadhaarNumber").val();
		var OTP=$("#OTP").val();
		var data = 	{
			'token_name':token_name,
			'token_value':token_value,
			'aadhaar' : String(AadhaarNumber),
			'authService':'aadhaar',
			'user':'',
			'password':'',
			'OTP':OTP,
			'captcha':$('#captchacode').val()
		};
		$.post('/index.php', data,function(data) {
				//console.log(data);
				if (data && data.msg=='Access granted'){ 
					//login
					window.location.href=''+window.location.origin+'/index.php/apps/dashboard/';
				}
				else if (data && data.code=='102'){
					$('#msg').html("OTP validation service temporarily unavailable. Please try again. If problem persists, check back in some time.");
					$('#msg').show();
					$('#generate_otp').hide();
					$('#AType_div').hide();
					$('#OTP').hide();
					$('#labelforotp').hide();
					$('#verify_otp').hide();
				}
				else if (data  && data.code=='101'){
					$('#msg').html('OTP validation failed. Please enter correct OTP Or retry by <a href="/index.php" style="color:blue;">generating new OTP</a>. ');
					$('#msg').show();
					$('#OTP').val("");
					$('#generate_otp').hide();
					$('#AType_div').hide();
					$('#OTP').hide();
					$('#labelforotp').hide();
					$('#verify_otp').hide();
					$('#OTP').removeClass('loadinggif');
					$('#OTP').removeAttr("readonly","readonly");
				}  else {
					$('#AadhaarNumber').hide();
					$('#labelforaadhaar').hide();
					$('#generate_otp').hide();
					$('#AType_div').hide();
					$('#OTP').hide();
					$('#labelforotp').hide();
					$('#verify_otp').hide();
					$('#msg').html("OTP verification failed. <a href='"+window.location.origin+"/index.php' style='color:blue;'> Click here for regenerate OTP.</a>");
					$('#msg').show();
					}
					})
		return false;
	}	
function clearAadhaarMsg(){$('#msg').hide();}
function checkUID(){
	elementId=document.getElementById('AadhaarNumber');
			var uid = elementId.value;
			if (uid.length < 12  )
			{ 		$('#AadhaarNumber').val('');
					$('#msg').text("Please enter a valid Aadhaar no.");
					$('#msg').show();
					elementId.value='';
					return false;
			}
			
	var Verhoeff = {
		"d":[[0,1,2,3,4,5,6,7,8,9],
			[1,2,3,4,0,6,7,8,9,5],
			[2,3,4,0,1,7,8,9,5,6],
			[3,4,0,1,2,8,9,5,6,7],
			[4,0,1,2,3,9,5,6,7,8],
			[5,9,8,7,6,0,4,3,2,1],
			[6,5,9,8,7,1,0,4,3,2],
			[7,6,5,9,8,2,1,0,4,3],
			[8,7,6,5,9,3,2,1,0,4],
			[9,8,7,6,5,4,3,2,1,0]],
		"p":[[0,1,2,3,4,5,6,7,8,9],
			[1,5,7,6,2,8,3,0,9,4],
			[5,8,0,3,7,9,6,1,4,2],
			[8,9,1,6,0,4,3,5,2,7],
			[9,4,5,3,1,2,6,8,7,0],
			[4,2,8,6,5,7,3,9,0,1],
			[2,7,9,3,8,0,6,4,1,5],
			[7,0,4,6,9,1,3,2,5,8]],
		"j":[0,4,3,2,1,5,6,7,8,9],
		"check":function(str)
		{
			var c = 0;
			str.replace(/\D+/g,"").split("").reverse().join("").replace(/[\d]/g, function(u, i, o){
				c = Verhoeff.d[c][Verhoeff.p[i&7][parseInt(u,10)]];
			});
			return c;
			
		},
		"get":function(str){
		
			var c = 0;
			str.replace(/\D+/g,"").split("").reverse().join("").replace(/[\d]/g, function(u, i, o){
				c = Verhoeff.d[ c ][ Verhoeff.p[(i+1)&7][parseInt(u,10)] ];
			});
			return Verhoeff.j[c];
		}
	};
	
	String.prototype.verhoeffCheck = (function()
	{
		var d = [[0,1,2,3,4,5,6,7,8,9],
				[1,2,3,4,0,6,7,8,9,5],
				[2,3,4,0,1,7,8,9,5,6],
				[3,4,0,1,2,8,9,5,6,7],
				[4,0,1,2,3,9,5,6,7,8],
				[5,9,8,7,6,0,4,3,2,1],
				[6,5,9,8,7,1,0,4,3,2],
				[7,6,5,9,8,2,1,0,4,3],
				[8,7,6,5,9,3,2,1,0,4],
				[9,8,7,6,5,4,3,2,1,0]];
		var p = [[0,1,2,3,4,5,6,7,8,9],
				[1,5,7,6,2,8,3,0,9,4],
				[5,8,0,3,7,9,6,1,4,2],
				[8,9,1,6,0,4,3,5,2,7],
				[9,4,5,3,1,2,6,8,7,0],
				[4,2,8,6,5,7,3,9,0,1],
				[2,7,9,3,8,0,6,4,1,5],
				[7,0,4,6,9,1,3,2,5,8]];
		var j = [0,4,3,2,1,5,6,7,8,9];

		return function()
		{
			var c = 0;
			this.replace(/\D+/g,"").split("").reverse().join("").replace(/[\d]/g, function(u, i, o){
				c = d[c][p[i&7][parseInt(u,10)]];
			});
			return (c === 0);
		};
	})();
	
			if( Verhoeff['check'](uid) == 0 )
			{	$('#msg').hide();
				return true;
				}else{
					$('#AadhaarNumber').val('');
					$('#msg').text("Aadhar number not valid.");
					$('#msg').show();
					return false;
			}
		

}	
