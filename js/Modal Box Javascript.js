var $global_units_row;
var $Package_ID;

var Myapp = {

    Global_variables : [{

    global_units_row  : 0,
    Package_ID : 0

}]

};  //End global variable object

$('.modalAlert').on('click', function () {

//Dialog for setting the confirmation box when deleting units
    $("#dialog").dialog({
          autoOpen: false,
          modal: true,
          buttons : {
               "Yes" : function() {
                   //alert("You have confirmed!");   
                  
                   //get the total_units_ID that is going to be deleted
                   var $Total_Units_ID = $("#dialog").attr("data-value");

                   //set the delete UR
                   var url = "http://localhost/product-catalogue/REST/delete-unites/" + $Total_Units_ID;
                   
                   $.get(url, function(data){
                       console.log(data);
                       if (data == "1")
                       {
                           //remove the full row that is being deleted
                           Myapp.Global_variables.global_units_row.remove();
                           
                           alert("The record has been deleted successfully!");     
                       }
                       else
                       {
                           alert("Error occured, try again later");
                       }
                   }).fail(function() {
                       alert( "fatal error. Die Infidal !" )
                   
                   });//close the AJAX request
                   
                  
                   //close the dialog once done
                   $( this ).dialog( "close" );
                   
               },
               "No" : function() {
                 $(this).dialog("close");
               }
             }//close the buttons options brackets
           });//close the dialog request brackets

 

 //set the id of the package
    Myapp.Global_variables.Package_ID = $(this).attr("value");
  $(".ajax-input").remove();

//Extract the name of the package, and add it to the top of the modal box name label
  var $Package_Name = $(this).parent().parent().children(".modal-name-label").text();
  $("#modal-name-label").text($Package_Name);
  
  //this variable is used for the ajax call
  var url = "http://localhost/product-catalogue/REST/unites/" + Myapp.Global_variables.Package_ID;
  
  //the ajax get call
  $.get(url, function(response){
  
  //created element which will be inserted into the Modal
  var insertedHTML;
  
  //loop used to traverse the json response of the URL - JSON parse is used on the data in order to ensure that the object is JSON to be looped correctly 
  $.each(JSON.parse(response), function(index, unit){
    
      insertedHTML += "<tr class = 'ajax-input'>"
      insertedHTML += "<td class = 'Total_units center-cell'>" + unit.Total_Units + "</td>";
      insertedHTML += "<td class = 'DA_ID center-cell'>" + unit.DA_ID + "</td>";
      insertedHTML += "<td class = 'edit-button center-cell'><a class = 'glyphicon glyphicon-edit modal-edit-button' data-value = '" + unit.Total_Units_ID + "'></td>";
      insertedHTML += "<td class='center-cell'><a class ='glyphicon glyphicon-remove-circle modal-delete-button delete-button' data-value = '" + unit.Total_Units_ID + "'/></td>";
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
    var Total_Units_value = $Total_Units.text().trim();
    var DA_ID_value = $DA_ID.text().trim();
    var Total_Units_ID = $Edit_Button.attr("data-value");
    
    
    //define the new parameters with the value from the previous parmaters
    var $Total_Units_Textbox = "<td class = 'center-cell Total_Units_Textbox'><input type = 'text' class = 'Total_Units center-cell reduced-width' value = '" + Total_Units_value + "'></td>";
    var $DA_ID_Textbox = "<td class = 'center-cell DA_ID_Textbox'><input type = 'text' class = 'DA_ID center-cell reduced-width' value ='" + DA_ID_value + "'  ></td>"
    var $Save_Button = "<td class = 'center-cell Save_Button'><a class = 'glyphicon glyphicon-plus modal-save-button' data-value = '" + Total_Units_ID + " '></td>";
    
    //Replace the elements with the required values from the previous elements
    $( $Total_Units, ".Total_units" ).replaceWith( $( $Total_Units_Textbox ) );
    $( $DA_ID, ".DA_ID" ).replaceWith( $( $DA_ID_Textbox ) );
    $( $Edit_Button.parent(), ".edit-button").replaceWith( $( $Save_Button ) );
    
});//End on click event for the modal edit button



$(document).on("click", ".modal-delete-button", function() {
    
    var Total_Units_ID = $(this).attr("data-value");

    Myapp.Global_variables.global_units_row = $(this).parent().parent();
   
   //set the value of the deleted Total_units_ID to the dialog box
    $("#dialog").attr("data-value",Total_Units_ID);
   
    //opens the actual dialog box
    $( "#dialog" ).dialog( "open" );
    
    //sets the position of the confirmation dialog box upon deletion to the center of the table
    $( "#dialog" ).dialog( "option", "position", { my: "center", at: "center", of: "#modal-table" } );
   

});//End on click event for the modal edit button


$(document).on("click", ".modal-save-button", function() {

    //retrieve the ID of the total units record
    var Total_Units_ID = $(this).attr("data-value");
    
    //retrieve the row that contains the data
    var $parent = $(this).parent().parent();
    
    //alert($parent.prop("tagName")); // This is used just to check if I am replacing the correct element by checking the HTML Tag name
    
    //retrieve the old elements that are going to be replaced
    var $Total_Units = $parent.children(".Total_Units_Textbox").children(".Total_Units");
    //alert($Total_Units.prop("tagName"));
    var $DA_ID = $parent.children(".DA_ID_Textbox").children(".DA_ID");
    var $Save_Button = $parent.children(".Save_Button").children(".modal-save-button");
    
    alert($Save_Button.prop("tagName"));
    
    //Retrieve the values from the text boxes and keep this cached
    var Total_Units = $Total_Units.val().trim(); 
    var DA_ID = $DA_ID.val().trim();
    
    //The new elements that are gong to be replaced
    var $Total_Units_Cell = "<td class = 'Total_units center-cell'>" + Total_Units + "</td>";
    var $DA_ID_Cell = "<td class = 'DA_ID center-cell'>" + DA_ID + "</td>";
    var $Edit_Button = "<td class = 'edit-button center-cell'><a class = 'glyphicon glyphicon-edit modal-edit-button' data-value = '" + Total_Units_ID + "'></td>";
   
    //Replace the new elements
    $( $Total_Units.parent(), ".Total_Units_Textbox").replaceWith( $( $Total_Units_Cell ) );
    $( $DA_ID.parent(), ".DA_ID_Textbox").replaceWith( $( $DA_ID_Cell ) );    
    $( $Save_Button.parent(), ".modal-save-button").replaceWith( $( $Edit_Button ) );

});//End on click event for the modal edit button



//ensure the dialog box is always centered when changing the size of the screen
$( window ).resize(function() {
      $( "#dialog" ).dialog( "option", "position", { my: "center", at: "center", of: "#modal-table" } );
});

