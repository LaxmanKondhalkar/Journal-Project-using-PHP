
    function checkValues(){
        var firstName = document.getElementById('userFName').value;
        var lastName = document.getElementById('userLName').value;
        var phone = document.getElementById('userPhone').value;
        var email = document.getElementById('userEmail').value;
        var pass = document.getElementById('userPass').value;        
    

        if(firstName == '' || lastName == '' || phone == '' || email == '' || password == ''){
            alert('Please fill complete form.');
            return false;
        }

        var re = /^(?=.*\d)(?=.*[!@#$%^&*])(?=.*[a-z])(?=.*[A-Z]).{8,}$/;
        if(!re.test(password)){
            alert('Your password must be of at least 8 characters, must contain a capital letter, a small letter, a number, a symbol and should not contain space');
            return false;
        }
        var emailpatt = /^[a-zA-Z0-9\.\_\-]+\@+[a-zA-Z0-9]+\.+[a-zA-Z]{2,3}$/;
        if(!emailpatt.test(email)){
            alert('Enter Valid Email');
            return false;
        }

        var contactpatt = /^[6-9]{1}[0-9]{9}$/;
        if(!contactpatt.test(contact)){
            alert('Enter Valid Phone Number without code.');
            return false;
        }
    }