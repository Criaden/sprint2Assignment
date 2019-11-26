function checkSubmitted(){
    var formValid = false;
	
	var majorValid = false;
	var gradeValid = false;
	var pizzaValid = false;
	var emailValid = false;
		
	var email = document.getElementById("email");
	if(!email == ""){
		emailValid = true;
	}
	
	radio = document.getElementsByName("userMajor");
	
    var i = 0;
    while (!majorValid && i < radio.length) {
        if (radio[i].checked){
			majorValid = true;
		}
        i++;        
    }
	
	radio = document.getElementsByName("userGrade");
	
	var i = 0;
    while (!gradeValid && i < radio.length) {
        if (radio[i].checked){
			gradeValid = true;
		}
        i++;        
    }
	
	radio = document.getElementsByName("userPizza");
	
	var i = 0;
    while (!pizzaValid && i < radio.length) {
        if (radio[i].checked){
			pizzaValid = true;
		}
        i++;        
    }
	
	if(majorValid === true && gradeValid === true && pizzaValid === true && emailValid === true){
		formValid = true;
	}

    if (!formValid) {
		alert("Must have one selection on each question!");
	}
    
	return formValid;
	
}