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






});
