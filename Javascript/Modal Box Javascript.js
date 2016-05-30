var selectedValue;

$('.modalAlert').on('click', function (event) {
  var button = $(event.target) // Button that triggered the modal
  var recipient = button.attr('value') // Extract info from data-* attributes
  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
  $("#recipient-name").val(recipient)

})



//functon fillReciepant(event)