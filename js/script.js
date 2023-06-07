const ROOT_URL = "http://localhost/notice-board-algowrite-training/";

document.getElementById("signUp").addEventListener("click",signUp);

function signUp(){
    var email = document.getElementById("email").value;
    var password = document.getElementById("password").value;
    var rePassword = document.getElementById("rePassword").value;

    var signUp = {
        email:email,
        password:password,
        rePassword:rePassword,
    };
    
    var form = new FormData();
    form.append("signUpProcess",JSON.stringify(signUp));

    var request = new XMLHttpRequest();
    request.onreadystatechange = function(){
        if(request.readyState==4){
            var response = request.responseText;
            var responseObject = JSON.parse(response);
            if(responseObject.status == "success"){
                alert("OK");
            }else{
                alert(responseObject.error);
            }
        }
    }

    request.open("POST",ROOT_URL + "api/AdminSignUpProcess.php");
    request.send(form);
}