$('.modalAlert').on('click', function () {
  //extract the name of the package, and add it to the top of the modal  
  var name_of_package = $(this).attr("value"); //extract the attribute value
  $("#exampleModalLabel").text(name_of_package);
  });
