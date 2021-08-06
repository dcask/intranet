(function() {
    var vertoHandle, vertoCallbacks, currentCall;
    //$.verto.init({}, bootstrap);
    document.getElementById("make-call").addEventListener("click", makeCall);
    document.getElementById("transfer-call").addEventListener("click", transferCall);
    function bootstrap(status) {
	vertoHandle = new jQuery.verto({
	    login: '7000',
	    passwd: '!Change1234',
	    socketUrl: 'wss://fs-wc.smng.com:8082',
	    ringFile: 'sounds/bell_ring2.wav',
	    iceServers: false,/*[
    		{
    		    url: 'stun:62.152.66.81',
    		},
	    ],*/
	    deviceParams: {
		useVideo: 'none',
		useMic: 'none',
		useSpeak: 'any',
		useCamera: 'none',
		useAudio: 'any',
	    },
	    tag: "audio-container", 
	    audioParams: {
	      googEchoCancellation: true,
	      googAutoGainControl: true,
	      googNoiseSuppression: true,
	      googHighpassFilter: true,
	      googTypingNoiseDetection: true,
	      googEchoCancellation2: false,
	      googAutoGainControl2: false,
	    },
	    //sessid: sessid,
	}, vertoCallbacks);

  };

    function onWSLogin(verto, success) {
	console.log('onWSLogin', success);
    };
    function onMessage(verto, dialog, message, data) {
	console.log('onMessage: ', message);
	var numToDial = document.getElementById("number").value
	switch (message.name) {
	    case "clientReady":
		currentCall = vertoHandle.newCall({
		    destination_number: numToDial,
		    caller_id_name: 'intranet',
		    caller_id_number: '7000',
		    outgoingBandwidth: 'default',
		    incomingBandwidth: 'default',
		    useStereo: false,
		    useVideo: false,
		    // Вы также можете назначить любую пользовательскую переменную. 
		    // Она будет доступна в диалплане с префиксом 'verto_dvar_'.
		    userVariables: {
		    // Например, приведенная ниже переменная 'email' может быть вызвана в диалплане, как -'verto_dvar_email'.
		        OutName: 'TEST-NAME'
		    },
		    dedEnc: false,
		    // Данные параметры переназначат указанные ранее в vertoHandler .
		    //useMic: 'any',
		    //useSpeak: 'any',
		});
		break;
	    }
    };
    function onWSClose(verto, success) {
	console.log('onWSClose', success);
    };
    function makeCall() {
	$.verto.init({skipDeviceCheck: true, skipPermCheck: true}, bootstrap);
	//console.log('created call...transfering')
	//currentCall.transfer('1002');
    };
    function transferCall() {
        currentCall.transfer('3264');
    };
    function onDialogState(dialog) {
	//console.log(dialog.state.name);
	switch (dialog.state.name) {
	    case "trying":
		console.log('trying');
		//currentCall.transfer('1002');
		break;
	    case "answering":
		console.log('answer');
		break;
	    case "active":
		console.log('active call');
		//if(currentCall)
		//	currentCall.transfer('3264');
		break;
	    case "hangup":
		console.log("Причина завершения: " + dialog.cause);
		break;
	    case "destroy":
		// Что-то по завершению вызова...
		break;
	}
	if(!currentCall){
	    currentCall = dialog;
	}
    }
    vertoCallbacks = {
	onMessage: onMessage,
	onDialogState: onDialogState,
	onWSLogin: onWSLogin,
	onWSClose: onWSClose
    };

})();