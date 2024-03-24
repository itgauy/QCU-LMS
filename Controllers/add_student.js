window.onload = function() {
    var inputs = document.getElementsByTagName('input'); //CAPSLOCK LAHAT NG TEXT EWAN COPY PASTE LANG TO JK
    for(var i = 0; i < inputs.length; i++) {
        if(inputs[i].type.toLowerCase() == 'text') {
            inputs[i].addEventListener('input', function() {
                this.value = this.value.toUpperCase();
            });
        }
    }


    var sn = document.getElementById('sn');
    sn.addEventListener('input', function(e) {
        var target = e.target;
        var value = target.value.replace(/[^\d]/g, ''); //remove non-digits
        if (value.length > 6) value = value.slice(0, 6); //limit to 6 digits
        if (value.length > 2) value = value.slice(0, 2) + '-' + value.slice(2); //insert ng dash after second digit
        target.value = value;
    });

    
    var dobField = document.getElementById('dob');
    var snField = document.getElementById('sn');
    var userField = document.getElementById('user');
    var passField = document.getElementById('pass');

    dobField.addEventListener('input', generateUsername);
    snField.addEventListener('input', generateUsername);
    snField.addEventListener('input', generatePassword);

    //forda auto-generation ng username based sa dob and sn
    function generateUsername() {
        if (dobField.value && snField.value) {
            var dob = dobField.value.split('-').join('');
            var snStr = snField.value.replace(/\D/g, '');
            userField.value = dob + snStr;
        } else {
            userField.value = '';
        }
    }

    //eto naman forda temporary password (current date tsaka sn naman gamit)
    function generatePassword() {
        if (snField.value) {
            var currentDate = new Date();
            var dateStr = currentDate.getFullYear() + ('0' + (currentDate.getMonth() + 1)).slice(-2) + ('0' + currentDate.getDate()).slice(-2);
            var snStr = snField.value.replace(/\D/g, '');
            passField.value = dateStr + snStr;
        } else {
            passField.value = '';
        }
    }

    //pang validate lang ng date para may error message (CV lang hehe)
    function isValidDate(dateString) {
        var regEx = /^\d{4}-\d{2}-\d{2}$/;
        if(!dateString.match(regEx)) return false;  // Invalid format
        var d = new Date(dateString);
        var dNum = d.getTime();
        if(!dNum && dNum !== 0) return false; // NaN value, Invalid date
        return d.toISOString().slice(0,10) === dateString;
    }


    //eto naman forda letters lang only
    var fnameField = document.getElementById('fname');
    var mnameField = document.getElementById('mname');
    var lnameField = document.getElementById('lname');

    fnameField.addEventListener('input', validateName); //eventlistener dapat eto nalang ginamit ko instead oninput sa taas
    mnameField.addEventListener('input', validateName);
    lnameField.addEventListener('input', validateName);

    function validateName(event) {
        event.target.value = event.target.value.replace(/[^A-Za-z\s]/g, '');
    }

    // var fnameField = document.getElementById('fname');
    // var mnameField = document.getElementById('mname');
    // var lnameField = document.getElementById('lname');
    var sectionField = document.getElementById('section');
    var emailField = document.getElementById('email');

    // Set the maximum length
    fnameField.maxLength = 50;
    mnameField.maxLength = 50;
    lnameField.maxLength = 50;
    sectionField.maxLength = 10;
    emailField.maxLength = 254;

}

//pang toggle ng readonly kapag regular or irregular yung classification
function toggleSectionReadonly(isReadonly) {
    var sectionInput = document.getElementById('section');
    sectionInput.readOnly = isReadonly;
}

//Adding and removing of required label depende sa class
function addRequiredLabel() {
    document.getElementById('sectionRequired').innerHTML = '<b> *</b>';
}

function removeRequiredLabel() {
    document.getElementById('sectionRequired').innerHTML = '';
    document.getElementById('section').value = '';
}


function addStudent(form) {
  var xhr = new XMLHttpRequest();
  xhr.open(form.method, form.action);
  xhr.onreadystatechange = function() {
    if (xhr.readyState === 4 && xhr.status === 200) {       //AJAX temp lang for alert pag successful (SUKO NA KO)
      if (xhr.responseText === 'success') {
        alert('Student account added successfully!');
        form.reset(); // Reset the form fields
        window.scrollTo(0, 0); // Scroll to the top of the page
      } else {
        alert('An error occurred: ' + xhr.responseText);
      }
    }
  };
  xhr.send(new FormData(form));
}
