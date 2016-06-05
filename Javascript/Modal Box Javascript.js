$('.modalAlert').on('click', function () {
  var value = $(this).attr("value"); //extract the attribute value
  $("#exampleModalLabel").text(value);
  console.log("is it working ?")
})



//functon fillReciepant(event)