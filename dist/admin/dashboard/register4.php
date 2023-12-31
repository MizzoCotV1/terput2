<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dashboard - SB Admin</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <link href="css/styles.css" rel="stylesheet" />
        <script src="alertsweet.js"></script>
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <?php include 'navbar.php' ?>

        <?php include 'sidenav.php' ?>
        
            <div id="layoutSidenav_content">
            <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Form Registrasi User</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="http://localhost/terput2/dist/admin/dashboard/">Dashboard</a></li>
                            <li class="breadcrumb-item active">Register</li>
                        </ol>
                        <div class="accordion" id="accordionPanelsStayOpenExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                                <button class="accordion-button fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                                    Form Registrasi User
                                </button>
                                </h2>
                                <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-headingOne">
                                    <div class="accordion-body px-5 my-2">
                                        <div class="container px-5">
                                        <?php
                                            require_once("conn.php");

                                            if(isset($_POST['register'])){

                                                $nama = $_POST['nama']; 
                                                $username = $_POST['username']; 
                                                $email = $_POST['email'];   
                                                $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
                                                $password1 = password_hash($_POST["cpassword"], PASSWORD_DEFAULT);
                                                $hakakses = $_POST['hakakses'];
                                                
                                                //Verifcation 
                                                if (empty($nama) || empty($username) || empty($email) || empty($password) || empty($password1) || empty($_POST["hak_akses"])){
                                                    $error = "Complete all fields";
                                                }
                                                
                                                // Password match
                                                if (($_POST["password"]) !== ($_POST["cpassword"])){
                                                    $error = "Passwords don't match";
                                                }
                                                
                                                // Email validation
                                                
                                                if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
                                                    $error = "Enter a  valid email";
                                                }
                                                
                                                // Password length
                                                if (strlen($password) <= 6){
                                                    $error = "Choose a password longer then 6 character";
                                                }
                                                
                                                if(!isset($error)){
                                                //no error
                                                    $sthandler = $conn->prepare("SELECT username FROM user WHERE username = :username");
                                                    $sthandler->bindParam(':username', $username);
                                                    $sthandler->execute();
                                                    
                                                    if($sthandler->rowCount() > 0){
                                                        echo "exists! cannot insert";
                                                    } else {
                                                            //Securly insert into database
                                                            $sql = 'INSERT INTO user (nama ,username, email, password, hak_akses) VALUES (:nama,:username,:email,:password,:hak_akses)';    
                                                            $query = $conn->prepare($sql);
                                                        
                                                            $query->execute(array(
                                                        
                                                            ':nama' => $nama,
                                                            ':username' => $username,
                                                            ':email' => $email,
                                                            ':password' => $password,
                                                            ':hak_akses' => $hakakses
                                                        
                                                            ));
                                                    }
                                                } else {
                                                    echo "error occured: ".$error;
                                                    exit();
                                                }
                                            }
                                            ?>
                                            <form action="" method="POST">
                                                <div class="row">
                                                    <div class="form-floating mb-3">
                                                        <input type="text" name="username" class="form-control" id="username" placeholder="Username">
                                                        <label class="mx-2" for="username">Username</label>
                                                    </div>
                                                    <div class="form-floating mb-3">
                                                        <input type="text" name="nama" class="form-control" id="nm" placeholder="Nama">
                                                        <label class="mx-2" for="nm">Nama</label>
                                                    </div>
                                                    <div class="form-floating mb-3">
                                                        <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password">
                                                        <label class="mx-2" for="floatingPassword">Password</label>
                                                    </div>
                                                    <div class="form-floating mb-3">
                                                        <input type="password" name="cpassword" class="form-control" id="cfloatingPassword" placeholder="Repeat Password">
                                                        <label class="mx-2" for="rfloatingPassword">Repeat Password</label>
                                                    </div>
                                                    <div class="form-floating mb-3">
                                                        <input type="email" name="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                                                        <label class="mx-2" for="floatingInput">Email address</label>
                                                    </div>
                                                    <div>
                                                        <select name="hakakses" class="form-select form-select mb-3" aria-label=".form-select-lg example">
                                                            <option disabled selected value>Hak Akses</option>
                                                            <option value="Admin">Admin</option>
                                                            <option value="Operator">Operator</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-6">
                                                        <input class="btn btn-primary btn-block w-100" type="submit" name="register" value="Daftar">
                                                    </div>
                                                    <div class="col-6">
                                                        <input class="btn btn-danger btn-block w-100" type="reset">
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
                <?php include 'footer.php' ?>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
        <script>
             $('.panel-collapse').on('show.bs.collapse', function () {
                $(this).siblings('.panel-heading').addClass('active');
            });

            $('.panel-collapse').on('hide.bs.collapse', function () {
                $(this).siblings('.panel-heading').removeClass('active');
            });
        </script>
    </body>
</html>
