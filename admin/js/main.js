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

  })




});
