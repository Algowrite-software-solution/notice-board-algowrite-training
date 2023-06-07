function signup() {
    let email = document.getElementById("email").value;
    let password = document.getElementById("passowrd").value;
    let confirmpassword = document.getElementById("rePassword").value;
  
    let dataObject = {
      email: email,
      password: password,
      retypepassword: confirmpassword
    };
  
    let jsonData = JSON.stringify(dataObject);
  
    let form = new FormData();
    form.append("SignUpdata", jsonData);
  
    let rq = new XMLHttpRequest();
  
    rq.onreadystatechange = function() {
      if (rq.readyState == 4) {
        var t = rq.responseText;
        alert(t);
      }
    };
  
    rq.open("POST", "signupProcess.php", true);
    rq.send(form);
  }
  