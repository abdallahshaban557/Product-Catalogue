$('.modalAlert').on('click', function () {
 
 //extract the id of the package
  var $Package_ID = $(this).attr("value"); 
  $(".ajax-input").remove();

//Extract the name of the package, and add it to the top of the modal box name label
  var $Package_Name = $(this).parent().parent().children(".modal-name-label").text();
  $("#modal-name-label").text($Package_Name);
  
  //this variable is used for the ajax call
  var url = "http://localhost/product-catalogue/REST/unites/" + $Package_ID;
  
  //the ajax get call
  $.get(url, function(response){
  
  //created element which will be inserted into the Modal
  var insertedHTML;
  
  //loop used to traverse the json response of the URL - JSON parse is used on the data in order to ensure that the object is JSON to be looped correctly 
  $.each(JSON.parse(response), function(index, unit){
    
      insertedHTML += "<tr class = 'ajax-input'>"
      insertedHTML += "<td>"+unit.Total_Units+"</td>";
      insertedHTML += "<td>"+unit.DA_ID+"</td>";
      insertedHTML += "<td><a class = 'glyphicon glyphicon-edit modal-edit-button' data-value = '" + unit.Total_Units_ID + "'></td>";
      insertedHTML += "<td><a class ='glyphicon glyphicon-remove-circle modal-delete-button' data-value = '" + unit.Total_Units_ID + "'/></td>";
      insertedHTML += "</td>";
      
  });//end .each loop
  //add the HTML needed to the modal table
  $("#modal-table").append(insertedHTML);
  
  });//end ajax get request  
  
});//end on click event for the main packages page units view


//need to use this format for the button click because of the AJAX Call
$(document).on("click", ".modal-edit-button", function() {

    alert($(this).attr("data-value"));
    
});//End on click event for the modal edit button



$(document).on("click", ".modal-delete-button", function() {

    alert($(this).attr("data-value"));
    
});//End on click event for the modal edit button
