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
      insertedHTML += "<td class = 'Total_units'>" + unit.Total_Units + "</td>";
      insertedHTML += "<td class = 'DA_ID'>" + unit.DA_ID + "</td>";
      insertedHTML += "<td class = 'edit-button'><a class = 'glyphicon glyphicon-edit modal-edit-button' data-value = '" + unit.Total_Units_ID + "'></td>";
      insertedHTML += "<td><a class ='glyphicon glyphicon-remove-circle modal-delete-button delete-button' data-value = '" + unit.Total_Units_ID + "'/></td>";
      insertedHTML += "</tr>";
      
  });//end each loop
  
  //add the HTML needed to the modal table, right before the closing tag
  $("#modal-table").append(insertedHTML);
  
  });//end ajax get request  
  
});//end on click event for the main packages page units view


//need to use this format for the button click because of the AJAX Call
$(document).on("click", ".modal-edit-button", function() {
    
    //get the value of the Total_units ID
    var Total_Units_ID = $(this).attr("data-value");
    
    //get the parent <tr> element of the table
    var $parent = $(this).parent().parent();
    
    //get the actual children tags
    var $Total_Units = $parent.children(".Total_units");
    var $DA_ID = $parent.children(".DA_ID");
    var $Edit_Button = $parent.children(".edit-button").children(".modal-edit-button");
    
    //store value of the total units and DA ID
    var Total_Units_value = $Total_Units.text();
    var DA_ID_value = $DA_ID.text();
    var Total_Units_ID = $Edit_Button.attr("data-value");
    
    
    //define the new parameters with the value from the previous parmaters
    var $Total_Units_Textbox = "<td><input type = 'text' class = 'Total_units' value = '"+ Total_Units_value +"'></td>";
    var $DA_ID_Textbox = "<td><input type = 'text' class = 'DA_ID' value ='" + DA_ID_value + "' ></td>"
    var $Save_Button = "<a class = 'glyphicon glyphicon-plus modal-save-button' data-value = '" + Total_Units_ID + "'></td>";
    
    //Replace the elements with the required values from the previous elements
    $( $Total_Units, ".Total_units" ).replaceWith( $( $Total_Units_Textbox ) );
    $( $DA_ID, ".DA_ID" ).replaceWith( $( $DA_ID_Textbox ) );
    $( $Edit_Button, ".modal-save-button").replaceWith( $( $Save_Button ) );
    
});//End on click event for the modal edit button



$(document).on("click", ".modal-delete-button", function() {

    alert($(this).attr("data-value"));
    
});//End on click event for the modal edit button
