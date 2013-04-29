/* 
 * Скрипты диалоговых окон
 */
function test(jqXRH, textStatus) {alert(textStatus);
//    $('#dialog_register').append(jqXRH.responseText);
alert(jqXRH.responseText);
};

var dialogStack = new Array();

dialogStack.closeAll = function() {
    var element;
    while((element = dialogStack.pop()) != null)    
    {
        element.dialog("close");
    }    
};

$(function(){
       $("#login_dialog").dialog({
           'autoOpen' : false,
           'modal'  : true,
           'resizable' : true,
           'draggable' : true,
           'dialogClass' : 'ui-dialog-custom',
           'closeText' : 'Close',
           'title' : 'Sign in Quisc!'
       });          
       
       $("#login_button").click(function() {
           dialogStack.closeAll();
           dialogStack.push( $("#login_dialog"));
            $("#login_dialog").dialog("open");
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
           'width' : '220px'
       });   
       
       $("#button_register").click(function() {
           dialogStack.closeAll();
           dialogStack.push( $("#dialog_register"));
           $("#dialog_register").dialog("open");}
       ); 
  }); 