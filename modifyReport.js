//-------------------------- modifyReport.js -----------------------------
// These functions dictate the utility of mouse clicks to perform specific 
// tasks depending on whether the cancel, edit, or save button is selected.
// 
//  **The functionality of this script is heavily dependent on the
//    id attributes within the <td> tags in each table row.
//
//
// CANCEL FUNCTION - Reloads the webpage
// EDIT FUNCTION - (1) Displays the hidden Save and Cancel button
//				   (2) Creates editable boxes around text
// SAVE FUNCTION - Execute functions in save.php to store records in database
//
// Only the first functions are documented in detail. The following 
// functions have the same logic with different variables.
//------------------------------------------------------------------------


//-----------SLEEP FUNCTION------------
// Suspends execution of the function
//	 1 second = 1000 milliseconds
//-------------------------------------
function sleep(milliseconds) {
  var start = new Date().getTime();
  for (var i = 0; i < 1e7; i++) {
    if ((new Date().getTime() - start) > milliseconds){
      break;
    }
  }
}

//---CANCEL FUNCTION---
function cancel(id) {
 location['reload']();
}

//---------------------EDIT AND SAVE ACCOMPLISHMENT FUNCTIONS--------------------------
function edit_accomp(id) { //EDITS PRESENT ACCOMPLISHMENT VALUE
 var text=document.getElementById("text_val"+id).innerHTML;	  //Grabs text value 
 
 document.getElementById("text_val"+id).innerHTML="<textarea style='font-family:Arial' rows='4' cols='115' id='text_text"+id+"'>" + text + "</textarea>";	//Creates editable box, pre-fills textarea with text value

 //DEFAULT DISPLAYS - Edit & Delete buttons
 //EDIT BUTTON DISPLAYS - Save & Cancel buttons
 document.getElementById("edit_button_accomp"+id).style.display="none";
 document.getElementById("delete_button_accomp"+id).style.display="none";
 document.getElementById("save_button_accomp"+id).setAttribute("type", "image");
 document.getElementById("cancel_button_accomp"+id).setAttribute("type", "image");
}

function save_accomp(id) { //UPDATES EDITED ACCOMPLISHMENT VALUE
	var text = document.getElementById("text_text"+id).value;	//Grabs text in editable box
	
	var result = confirm("Are you done editing?");	//Confirmation textbox
	if(result == true) {
	  $.ajax
	  ({
		 type:'post',	//POST method
		 url:'save.php',	//php file
		 data: {
	        edit_accomp:'edit_accomp',	//POST method name
			row_id: id,		//id in MySQL database
			text_val: text,		//text value
		 },
      Success:function(response) {
        if(response=="Success") {	//Resets webpage layout if Successful execution
       	 document.getElementById("text_val"+id).innerHTML=text;
	
         document.getElementById("edit_button_accomp"+id).style.display="compact";
         document.getElementById("save_button_accomp"+id).style.display="none";
       }
	  }
	 });
	}
	sleep(500);	//Suspends execution of function
	location.reload();	//Refreshes page to display new values
}
//-----------------------------------------------------------------------------------

//-----------------------EDIT AND SAVE CONCERN FUNCTIONS-----------------------------
function edit_con(id) { //EDITS PRESENT CONCERN VALUE
 var con=document.getElementById("con_val"+id).innerHTML;
 
 document.getElementById("con_val"+id).innerHTML="<textarea style='font-family:Arial' rows='4' cols='115' id='con_text"+id+"'>" + con + "</textarea>";

 document.getElementById("edit_button_con"+id).style.display="none";
 document.getElementById("delete_button_con"+id).style.display="none";
 document.getElementById("save_button_con"+id).setAttribute("type", "image");
 document.getElementById("cancel_button_con"+id).setAttribute("type", "image");
}

function save_con(id) { //UPDATES EDITED CONCERN VALUE
	var con = document.getElementById("con_text"+id).value;
	
	var result = confirm("Are you done editing?");
	if(result == true) {
	  $.ajax
	  ({
		 type:'post',
		 url:'save.php',
		 data: {
	        edit_con:'edit_con',
			row_id: id,
			con_val: con,
		 },
      Success:function(response) {
        if(response=="Success") {
       	 document.getElementById("con_val"+id).innerHTML=con;
	
         document.getElementById("edit_button_con"+id).style.display="compact";
         document.getElementById("save_button_con"+id).style.display="none";
       }
	  }
	 });
	}
	sleep(500);
	location.reload();
}
//-----------------------------------------------------------------------------------

//--------------------------EDIT AND SAVE GOALS--------------------------------------
function edit_goals(id) { //EDITS PRESENT GOAL VALUE
 var goal=document.getElementById("goal_val"+id).innerHTML;
 var tier=document.getElementById("tier_val"+id).innerHTML;
 var dateAssign=document.getElementById("dateAssign_val"+id).innerHTML;
 var dateDue=document.getElementById("dateDue_val"+id).innerHTML;
 var status=document.getElementById("status_val"+id).innerHTML;
 var comments=document.getElementById("comments_val"+id).innerHTML;

 document.getElementById("goal_val"+id).innerHTML="<textarea style='font-family:Arial' rows='3' cols='32' id='goal_text"+id+"'>" + goal + "</textarea>";
 document.getElementById("tier_val"+id).innerHTML="<textarea style='font-family:Arial' rows='3' cols='1' id='tier_text"+id+"'>" + tier + "</textarea>";
 document.getElementById("dateAssign_val"+id).innerHTML="<textarea style='font-family:Arial' rows='3' cols='6' id='dateAssign_text"+id+"'>" + dateAssign + "</textarea>";
 document.getElementById("dateDue_val"+id).innerHTML="<textarea style='font-family:Arial' rows='3' cols='6' id='dateDue_text"+id+"'>" + dateDue + "</textarea>";
 document.getElementById("status_val"+id).innerHTML="<textarea style='font-family:Arial' rows='3' cols='5' id='status_text"+id+"'>" + status + "</textarea>";
 document.getElementById("comments_val"+id).innerHTML="<textarea style='font-family:Arial' rows='3' cols='40' id='comments_text"+id+"'>" + comments + "</textarea>";

 document.getElementById("edit_button_goal"+id).style.display="none";
 document.getElementById("delete_button_goal"+id).style.display="none";
 document.getElementById("save_button_goal"+id).setAttribute("type", "image");
 document.getElementById("cancel_button_goal"+id).setAttribute("type", "image");
}

function save_goals(id) { //UPDATES EDITED GOAL VALUE
  var goal = document.getElementById("goal_text"+id).value;
  var tier = document.getElementById("tier_text"+id).value;
  var dateAssign= document.getElementById("dateAssign_text"+id).value;
  var dateDue= document.getElementById("dateDue_text"+id).value;
  var status = document.getElementById("status_text"+id).value;
  var comment= document.getElementById("comments_text"+id).value;

  var result = confirm("Are you done editing?");

   if(result == true) {
	 $.ajax
	 ({
	   type:'post',
	   url:'save.php',
	   data:{
	    edit_goals: 'edit_goals',
	    row_id: id,
	    goal_val: goal,
	    tier_val: tier,
	    dateAssign_val: dateAssign,
	    dateDue_val: dateDue,
	    status_val: status,
	    comment_val: comment,
	   },
     Success:function(response) {
      if(response=="Success") {
        document.getElementById("goal_val"+id).innerHTML=goals;
        document.getElementById("tier_val"+id).innerHTML=tier;
	    document.getElementById("dateAssign_val"+id).innerHTML=dateAssign;
	    document.getElementById("dateDate_val"+id).innerHTML=dateDate;
      	document.getElementById("status_val"+id).innerHTML=status;
      	document.getElementById("comments_val"+id).innerHTML=comments;
	
        document.getElementById("edit_button_goal"+id).style.display="compact";
        document.getElementById("save_button_goal"+id).style.display="none";
      }
     }
	});
   }
   sleep(500);
   location.reload();
}
//----------------------------------------------------------------------------------

//-----------------EDIT AND SAVE MONTHLY ACTIVITY FUNCTIONS--------------------------

function edit_acts(id) { //EDITS PRESENT MONTHLY ACTIVITY VALUE
  var activity=document.getElementById("act_val"+id).innerHTML;
  var dateAssign=document.getElementById("dateAssign_val"+id).innerHTML;
  var dateDue=document.getElementById("dateDue_val"+id).innerHTML;
  var status=document.getElementById("status_val"+id).innerHTML;
  var comments=document.getElementById("comments_val"+id).innerHTML;
 
  document.getElementById("act_val"+id).innerHTML="<textarea style='font-family:Arial' rows='3' cols='38' id='act_text"+id+"'>" + activity + "</textarea>";
  document.getElementById("dateAssign_val"+id).innerHTML="<textarea style='font-family:Arial' rows='3' cols='6' id='dateAssign_text"+id+"'>" + dateAssign + "</textarea>";
  document.getElementById("dateDue_val"+id).innerHTML="<textarea style='font-family:Arial' rows='3' cols='6' id='dateDue_text"+id+"'>" + dateDue + "</textarea>";
  document.getElementById("status_val"+id).innerHTML="<textarea style='font-family:Arial' rows='3' cols='5' id='status_text"+id+"'>" + status + "</textarea>";
  document.getElementById("comments_val"+id).innerHTML="<textarea style='font-family:Arial' rows='3' cols='35' id='comments_text"+id+"'>" + comments + "</textarea>";
	
  document.getElementById("edit_button_act"+id).style.display="none";
  document.getElementById("delete_button_act"+id).style.display="none";
  document.getElementById("save_button_act"+id).setAttribute("type", "image");
  document.getElementById("cancel_button_act"+id).setAttribute("type", "image");
}

function save_acts(id) { //UPDATES EDITED MONTHLY ACTIVITY VALUE
  var act = document.getElementById("act_text"+id).value;
  var dateAssign= document.getElementById("dateAssign_text"+id).value;
  var dateDue= document.getElementById("dateDue_text"+id).value;
  var status = document.getElementById("status_text"+id).value;
  var comment= document.getElementById("comments_text"+id).value;

  var result = confirm("Are you done editing?");

   if(result == true) {
	 $.ajax
	 ({
	   type:'post',
	   url:'save.php',
	   data:{
	    edit_acts: 'edit_acts',
	    row_id: id,
	    act_val: act,
	    dateAssign_val: dateAssign,
	    dateDue_val: dateDue,
	    status_val: status,
	    comment_val: comment,
	   },
     Success:function(response) {
      if(response=="Success") {
        document.getElementById("act_val"+id).innerHTML=goals;
	    document.getElementById("dateAssign_val"+id).innerHTML=dateAssign;
	    document.getElementById("dateDate_val"+id).innerHTML=dateDate;
      	document.getElementById("status_val"+id).innerHTML=status;
      	document.getElementById("comments_val"+id).innerHTML=comments;
	
        document.getElementById("edit_button_act"+id).style.display="compact";
        document.getElementById("save_button_act"+id).style.display="none";
      }
     }
	});
   }
   sleep(500);
   location.reload();
}
//----------------------------------------------------------------------------------

//------------------EDIT AND SAVE MAJOR ACCOMPLISHMENT FUNCTIONS--------------------
function insert_majoracc() { //1ST TIME ENTERING MAJOR ACCOMPLISHMENT VALUE
 var majoracc=document.getElementById("new_majoraccomp").value;
 var groupName=document.getElementById("groupName").value;
 var monthName=document.getElementById("monthName").value;
 var yearNum=document.getElementById("yearNum").value;
 
 var result=confirm("Are you done editing?");
 if(result == true) {
 $.ajax
 ({
  type:'post',
  url:'save.php',
  data:{
   insert_majoracc:'insert_majoracc',
   major_acc_val:majoracc,
   groupName_val:groupName,
   monthName_val:monthName,
   yearNum_val:yearNum
  },
  Success:function(response) {
   if(response!="")
   {
    location.reload();
    
   }
  }
 });
	}
 sleep(500);
 location.reload();
}

function edit_maj_accomp(id) { //EDITS PRESENT MAJOR ACCOMPLISHMENT VALUE
 var maj_accomp=document.getElementById("maj_accomp_val"+id).innerHTML;
 
 document.getElementById("maj_accomp_val"+id).innerHTML="<textarea style='font-family:Arial' rows='4' cols='115' id='maj_accomp_text"+id+"'>" + maj_accomp + "</textarea>";

 document.getElementById("edit_button_maj_accomp"+id).style.display="none";
 document.getElementById("delete_button_maj_accomp"+id).style.display="none";
 document.getElementById("save_button_maj_accomp"+id).setAttribute("type", "image");
 document.getElementById("cancel_button_maj_accomp"+id).setAttribute("type", "image");
}

function save_maj_accomp(id) { //UPDATES EDITED MAJOR ACCOMPLISHMENT VALUE
	var maj_accomp=document.getElementById("maj_accomp_text"+id).value;
	
	var result=confirm("Are you done editing?");
	if(result == true) {
	  $.ajax
	  ({
		 type:'post',
		 url:'save.php',
		 data: {
	        edit_maj_accomp:'edit_maj_accomp',
			row_id: id,
			maj_accomp_val: maj_accomp,
		 },
      Success:function(response) {
        if(response=="Success") {
       	 document.getElementById("maj_accomp_val"+id).innerHTML=maj_accomp;
	
         document.getElementById("edit_button_maj_accomp"+id).style.display="compact";
         document.getElementById("save_button_maj_accomp"+id).style.display="none";
       }
	  }
	 });
	}
	sleep(500);
	location.reload();
}
//-----------------------------------------------------------------------------------

//---------------------EDIT AND SAVE MAJOR CONCERN FUNCTIONS-------------------------

function insert_majorcon() { //1ST TIME ENTERING MAJOR CONCERN VALUE
 var majorconcern=document.getElementById("new_majorconcern").value;
 var groupName=document.getElementById("groupName").value;
 var monthName=document.getElementById("monthName").value;
 var yearNum=document.getElementById("yearNum").value;
	
 var result=confirm("Are you done editing?");
 if(result == true) {
 $.ajax
 ({
  type:'post',
  url:'save.php',
  data:{
   insert_majorcon:'insert_majorcon',
   major_concern_val:majorconcern,
   groupName_val:groupName,
   monthName_val:monthName,
   yearNum_val:yearNum
  },
  Success:function(response) {
   if(response!="")
   {
    location.reload();
    
   }
  }
 });
	}
 sleep(500);
 location.reload();
}

function edit_maj_con(id) { //EDITS PRESENT MAJOR CONCERN VALUE
 var maj_con=document.getElementById("maj_con_val"+id).innerHTML;
 
 document.getElementById("maj_con_val"+id).innerHTML="<textarea style='font-family:Arial' rows='4' cols='115' id='maj_con_text"+id+"'>" + maj_con + "</textarea>";

 document.getElementById("edit_button_maj_con"+id).style.display="none";
 document.getElementById("delete_button_maj_con"+id).style.display="none";
 document.getElementById("save_button_maj_con"+id).setAttribute("type", "image");
 document.getElementById("cancel_button_maj_con"+id).setAttribute("type", "image");
}

function save_maj_con(id) { //UPDATES PRESENT MAJOR CONCERN VALUE
	var maj_con=document.getElementById("maj_con_text"+id).value;
	
	var result=confirm("Are you done editing?");
	if(result == true) {
	  $.ajax
	  ({
		 type:'post',
		 url:'save.php',
		 data: {
	        edit_maj_con:'edit_maj_con',
			row_id: id,
			maj_con_val: maj_con,
		 },
      Success:function(response) {
        if(response=="Success") {
       	 document.getElementById("maj_con_val"+id).innerHTML=maj_con;
	
         document.getElementById("edit_button_maj_con"+id).style.display="compact";
         document.getElementById("save_button_maj_con"+id).style.display="none";
       }
	  }
	 });
	}
	sleep(500);
	location.reload();
}
//----------------------------------------------------------------------------------