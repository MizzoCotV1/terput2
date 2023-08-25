 <!DOCTYPE html>  
 <html>  
      <head>  
            <title>Login | Admin</title> 
            <meta charset="utf-8" />
            <meta http-equiv="X-UA-Compatible" content="IE=edge" />
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
            <meta name="description" content="" />
            <meta name="author" content="" />
            <title>Dashboard - Webkolah</title>
            <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
            <link href="dashboard/css/styles.css" rel="stylesheet" />
            <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script>
                function formregkos(){
                    swal.fire({
                    title: "Form login kosong",
                    icon: 'error',
                    text: "Harap diisi",
                    timer: 2000,
                    showConfirmButton: false
                    }, function(){
                        location.reload();
                    });
                }
            </script>
        <body>
        <?php  
            session_start();  
            include 'dashboard/conn.php';
            try {   
                if(isset($_POST["login"])) {  
                    if(empty($_POST["username"]) || empty($_POST["password"])) {  
                        echo '<script>
                            formregkos();
                        </script>';
                    } else {  
                            $query = "SELECT * FROM user WHERE username = :username AND password = :password";  
                            $statement = $conn->prepare($query);  
                            $statement->execute(  
                                array(  
                                    'username'     =>     $_POST["username"],  
                                    'password'     =>     $_POST["password"]  
                                )  
                            );  
                            $count = $statement->rowCount();  
                            if($count > 0)  {  
                                $_SESSION["username"] = $_POST["username"];  
                                header("location:dashboard/");  
                                echo "<script>
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil',
                                    text: 'Berhasil Login',
                                });
                                </script>";
                            } else {  
                                echo "<script>
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Gagal terkirim',
                                    text: 'Username atau Password salah!.',
                                });
                                </script>";
                            }  
                    }  
                }  
            }  
            catch(PDOException $error) {  
                $message = $error->getMessage();  
            }  
        ?>
        <div class="row">
            <div class="container mt-5 px-3 py-3 card col-5">
                <div class="card-body mt-2">
                    <div class="text-center mb-4 fs-3 fw-semibold">
                        Login User
                    </div>
                    <form method="post">
                                <!-- Email input -->
                        <div class="form-outline mb-4">
                            <input name="username" type="text" id="form2Example1" class="form-control" />
                            <label class="form-label" for="form2Example1">Email address</label>
                        </div>
                                <!-- Password input -->
                        <div class="form-outline mb-4">
                            <input name="password" type="password" id="form2Example2" class="form-control" />
                            <label class="form-label" for="form2Example2">Password</label>
                        </div>
                        <button type="submit" name="login" class="btn btn-primary btn-block mb-4">Sign in</button>
                    </form>
                </div>
            </div>
        </div>
        <!-- Section: Design Block -->
           

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="dashboardjs/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
      </body>  
 </html>  