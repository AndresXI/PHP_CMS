$(document).ready(function() {

  //wysiwig editor
  $('#summernote').summernote();
  //jquery selector
  $("#selectAllBoxes").click(function(event) {
    //if this.cheked is cheked, refers to "#selectAllBoxes"
    if(this.checked) {
      $(".checkBoxes").each(function(){
        //this refers to ".chekedBoxes"
        this.checked = true;
      });

    } else {

      $(".checkBoxes").each(function(){
        //this refers to ".chekedBoxes"
        this.checked = false;
      });

    }

  });

//adding the loader animation
  var div_box = "<div id='load-screen'><div id='loading'></div></div>";
  $("body").prepend(div_box);

  $('#load-screen').delay(700).fadeOut(600, function(){

    this.remove();

  })

//this function has some AJAX
  function loadUsersOnline() {

    // this sends a GET request to functions.php
    //we send in a varible onlineusers
      $.get("functions.php?onlineusers=result", function(data){

        $(".users_online").text(data);

      });

  }

//this function calls loadUsersOnline(); every half second (500)
  setInterval(function(){

    loadUsersOnline();

  }, 5);


});
