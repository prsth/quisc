/**
 * Скрипты привязанные управлению профилем гостя
 */

var dialogStack = new Array();

dialogStack.closeAll = function() {
    var element;
    while((element = dialogStack.pop()) != null)
    {
        element.dialog("close");
    }
};

dialogStack.successAjax = function(data, textStatus, jqXHR) {
    //Если верунло null значит юзер залогинен
//    alert(helpers.print_r($.parseJSON(data))); alert(data);
    if(data.code === null)
    {
        dialogStack.closeAll();
        window.location = "";
    }
    //В противном случае надо показать ошибку
    else
    {
        form=$('#'+data.form);
        settings=form.data('settings');
        $.each (settings.attributes, function (i) {
            $.fn.yiiactiveform.updateInput (settings.attributes[i], data.errors, form);
        });
    }
}


$(function(){
    $("#login_dialog").dialog({
        'autoOpen' : false,
        'modal'  : true,
        'resizable' : false,
        'draggable' : false,
        'dialogClass' : 'ui-dialog-custom',
        'closeText' : 'Close',
        'title' : 'Войти в Quisc!',
        'width' : 340
    });

    $("#login_button2").click(function() {
        dialogStack.closeAll();
        dialogStack.push( $("#login_dialog"));
        $("#login_dialog").dialog("open");
    });

    $("#dialog_register").dialog({
        'autoOpen' : false,
        'modal'  : true,
        'resizable' : true,
        'draggable' : true,
        'dialogClass' : 'ui-dialog-custom',
        'closeText' : 'Close',
        'title' : 'Registration',
        'width' : '320px'
    });

    $("#button_register").click(function() {
            dialogStack.closeAll();
            dialogStack.push( $("#dialog_register"));
            $("#dialog_register").dialog("open");}
    );

    $("#btn_signin").click(function() {
        dialogStack.closeAll();
        dialogStack.push( $("#login_dialog"));
        $("#login_dialog").dialog("open");
    });

    $("#btn_signin").hover(function() {
        $(this).attr("src","images/btn_enter_dark.png");
    }, function() {
        $(this).attr("src","images/btn_enter_light.png");
    });

    $("#btn_facebook").hover(function() {
        $(this).attr("src","images/facebook_dark.png");
    }, function() {
        $(this).attr("src","images/facebook_light.png");
    });

    $("#btn_linkedin").hover(function() {
        $(this).attr("src","images/linkedin_dark.png");
    }, function() {
        $(this).attr("src","images/linkedin_light.png");
    });

    $("#btn_google").hover(function() {
        $(this).attr("src","images/google_dark.png");
    }, function() {
        $(this).attr("src","images/google_light.png");
    });



    /*
    * FACEBOOK
     */
    $('#btn_facebook').click(function(){

        FB.getLoginStatus(function(response) {
            if (response.status === 'connected') {
                //Надо просто залогинить
                FB.api('/me?fields=id,first_name,last_name,email',function(response){
                    $.ajax({
                        'url': '?r=guest/loginFacebookAjax',
                        'type' : 'POST',
                        'success': helpers.successAjax,
                        'data': {
                            'r' : 'guest/loginFacebookAjax',
                            'response' : response
                        }
                    })
                });
            }
            else
            {
                //Надо регистрировать
                FB.login(function(response) {
                    if (response.authResponse) {
                        FB.api('/me?fields=id,first_name,last_name,email',function(response){
                            alert(print_r(response));
                        });
                        $.ajax({
//                                'url': '?r=guest/loginAjax',
                            'type' : 'POST',
                            'complete': 'test',
                            'data': {
                                'r' : 'guest/loginFacebookAjax',
                                'response' : response
                            },
                            'success': helpers.successAjax
                        })
                    }
                });
            }
        });
    });

});

window.fbAsyncInit = function() {
    // init the FB JS SDK
    FB.init({
        appId      : '444671505610698',                        // App ID from the app dashboard
        channelUrl : '//yaremchuk.testm40.web.immo/longterm/channel.html', // Channel file for x-domain comms
        status     : true,                                 // Check Facebook Login status
        xfbml      : true                                  // Look for social plugins on the page
    });

    // Additional initialization code such as adding Event Listeners goes here

};


// Load the SDK asynchronously
(function(d, s, id){
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) {return;}
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/all/debug.js";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

