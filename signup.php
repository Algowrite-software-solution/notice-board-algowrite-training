<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notice Board | SIGNUP |</title>
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/main.css" />
    <link rel="stylesheet" href="css/bootstrap.css" />
</head>

<body  style="background-color: #5d36cb;background-image: linear-gradient(65deg,#ffffff 50%,#d95cb1 50%);">
    <div class="container-fluid" >
        <div class="row">
            <div class="col-12 ">
                <label class="fs-1 ">The Notice Board</label>
            </div>

            <div class="col-lg-6 offset-lg-3 mt-lg-5 bg-warning box border">
                <div class="col-12 text-center mt-3">
                    <label class="col-12 fs-1">Create a New Account</label>
                </div>

                <div class="col-12 p-5">
                    <!-- <div class="col-12 mt-5">
                        <div class="row">
                            <div class="col-5">
                                <label class="fw-bold">First Name</label>
                                <input type="text" placeholder="Enter First Name" class="form-control d-grid col-12" required>
                            </div>
                            <div class="col-5 offset-2">
                                <label class="fw-bold">Last Name</label>
                                <input type="text" placeholder="Enter Last Name" class="form-control col-12" required>
                            </div>
                        </div>
                    </div> -->

                    <div class="col-6 offset-3 text-center mt-5">
                        <label class="fw-bold ">Email</label>
                        <input type="text" id="EMAIL" placeholder="Enter Email" class="form-control col-12">
                    </div>

                    <div class="col-12 mt-5">
                        <div class="row">
                            <div class="col-5">
                                <label class="fw-bold">Password </label>
                                <input id="PW" type="text" placeholder="Password" class="form-control d-grid col-12" required>
                            </div>
                            <div class="col-5 offset-2">
                                <label class="fw-bold">Confirm Password</label>
                                <input type="text" id="CPW" placeholder="Confirm Password" class="form-control col-12" required>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 mt-5 mb-4">
                        <div class="row">
                            <div class="col-5 d-grid">
                                <button class="btn btn-success">Sign In</button>
                            </div>
                            <div class="col-5  d-grid offset-2">
                                <button class=" btn btn-primary" onclick="signup();">Sign Up</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</body>

</html>