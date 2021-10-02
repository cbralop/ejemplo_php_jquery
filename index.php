<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv='Content-Type' content='text/html;charset=utf-8'>
		<meta name='viewport' content='width=device-width, initial-scale=1'>
        <link rel="stylesheet" href="css/index.css" >
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link href="fontawesome-free-5.15.3-web/css/all.css" rel="stylesheet">

        <script src='js/jquery-3.5.1.min.js'></script>
        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

        <title>Ejemplo Mantenedor</title>
    </head>

    <body>
        <div class="container">
            <div class="row">
                <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
                    <div class="card border-0 shadow rounded-3 my-5">
                        <div class="card-body p-4 p-sm-5">
                            <h4 class="card-title text-center mb-5 fw-light fs-5">Ingresar</h4>
                            <form class="validate-form" action="controller/validator.php" method="POST">
                                <div class="form-floating mb-3">
                                    <input type="email" class="form-control" name="email" placeholder="name@ejemplo.com">
                                    <label for="email">Email</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                                    <label for="password">Password</label>
                                </div>

                                <div class="col-md-12">
                                    <button class="col-md-12 btn btn-primary btn-login text-uppercase fw-bold" type="submit">Ingresar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>