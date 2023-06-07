function signup() {
    let email = document.getElementById("EMAIL").value;
    let password = document.getElementById("PW").value;
    let confirmpassword = document.getElementById("CPW").value;
  
    let dataObject = {
      email: email,
      password: password,
      retypepassword: confirmpassword
    };
  
    let jsonData = JSON.stringify(dataObject);
  
    let form = new FormData();
    form.append("jsonobj", jsonData);
  
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
  