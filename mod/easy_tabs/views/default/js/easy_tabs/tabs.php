<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>

  // <script>
$(document).ready(function(){
        
$('#easy-tabs').easytabs();


$('#easy-tabs')
    .bind('easytabs:ajax:complete', function(e, clicked, panel, response, status, xhr) {
             
      //hide ajax loader
      $(".elgg-ajax-loader").hide(); 
      
      var $this = $(clicked);
 
      $(panel.selector).append(response);

      $this.html($this.data('label'));
      
      if (status == "error") {
        var msg = "Sorry but there was an error: ";
        $("#error").html(msg + xhr.status + " " + xhr.statusText);
      }
    });


  });
  

