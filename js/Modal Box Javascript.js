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
  
  //loop used to traverse the json response of the URL
  $.each(JSON.parse(response), function(index, unit){
      
      insertedHTML += "<tr class = 'ajax-input'>"
      insertedHTML += "<td>"+unit.Total_Units+"</td>";
      insertedHTML += "<td>"+unit.DA_ID+"</td>";
      insertedHTML += "</td>";
      
  });//end .each loop
  
  //add the HTML needed to the modal table
  $("#modal-table").append(insertedHTML);
  
  });//end ajax get request
  
  
});//end on click event
