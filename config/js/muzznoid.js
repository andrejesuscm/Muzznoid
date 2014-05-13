//gamepad options configuration
var sector = 30;
var intensitySteps = 20;
var numButtons = 4;
      
var myAppToken = ''; /* YOUR APP TOKEN */


muzzley.on('error', function(err) {
    console.log("Log | Error: " + err);    
});



muzzley.connectApp(myAppToken, function(err, activity) {
	if (err){
	console.log("Log | Connect error: " + err);
	return;
	}      

	// Usually you'll want to show this Activity's QR code image
	// or its id so that muzzley users can join.
	// They are in the `activity.qrCodeUrl` and `activity.activityId`
	// properties respectively.
	console.log(activity);  
	document.getElementById('qrcodeimage').style.backgroundImage="Url("+activity.qrCodeUrl+"?dotSize=10&margin=2)";
	document.getElementById('scanme').style.visibility="visible";

    	activity.on('participantQuit', function(participant) {
        	// A participant quit
      		console.log('Log | Participant Quit - id:' + participant.id);
	});

	activity.on('participantJoin', function(participant) {
		document.getElementById('scanme').innerHTML="Have Fun!!!";
		console.log('Log | Participant Join - id:' + participant.id + ' name: ' + participant.name);
		document.getElementById('playerstatus').innerHTML="&nbsp;<div id='avatar'></div><div id='playername'></div>";
		document.getElementById('playername').innerHTML=participant.name;
		document.getElementById('avatar').style.backgroundImage="Url("+participant.photoUrl+")";
        
        
		// A participant joined. Tell him to transform into a gamepad.
		participant.changeWidget('webview', {
		    uuid: '', /* YOUR WIDGET UUID */
		    orientation: 'landscape'
		}, function(err) {
			if (err) return console.log('changeWidget error: ' + err);
			console.log('Activity: changeWidget was successful');
		});
        
		participant.on('action', function (action) {
			// The action object represents the participant's interaction.
			// In this case it might be "button 'a' was pressed".
			console.log(action); 
			console.log('Log | Action received - ' +JSON.stringify(action));
		});
        
		participant.on('quit', function (action) {
			// You can also check for participant quit events
			// directly in each participant object.
		    
			console.log('Log | Participant Quit - id:' + participant.id);
			document.getElementById('playername').innerHTML="";
			document.getElementById('avatar').style.backgroundImage="none";
			document.getElementById('playerstatus').innerHTML="?";
			document.getElementById('scanme').innerHTML="Scan Me!";
		});
        
        	participant.on('signalingMessage', function(type, dataReceived, callback) {
			if (callback) {
				document.getElementById("barposx").value=dataReceived.val;
			}
		});
       });            
});
