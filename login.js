/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


$(function(){
   
   $('#formRegister').submit(function(){
      $('#formRegister').load('?r=ajax/register');
   });    
   
});