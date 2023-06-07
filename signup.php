<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css"/>
    <link rel="stylesheet" href="css/bootstrap.css"/>
    <title>SignUp Page</title>

    <script src="js/script.js" ></script>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 bg-black">
                <div class="row signUpContainer">
                    <div class="col-8 p-5 rounded-5 shadow" style="background-color:gray;">
                      <div class="row d-flex align-items-center justify-content-center">
                        <div class="col-12">
                            <h3 class="text-center fw-bold text-white"> Sign Up Page</h3>
                            <div class="mt-4 pb-2"><input class="form-control" type="email" placeholder="email" id="email"/></div>
                            <div class="pb-2"><input class="form-control" type="password" placeholder="passowrd" id="password"/></div>
                            <div class="pb-2"><input class="form-control" type="password" placeholder="confirm-password" id="rePassword"/></div>
                            <hr class="text-white"/>
                            <div class="d-grid pb-2"><button class="btn btn-primary" id="signUp">Sign Up</button></div>
                            <div class="d-grid"><button class="btn btn-primary" id="signIn">Sign In</button></div>
                        </div>
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>