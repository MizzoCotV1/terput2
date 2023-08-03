<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script>
    </script>
</head>
<body>
    <nav class="bg-white dark:bg-gray-900 fixed w-full z-20 top-0 left-0 border-b border-gray-200 dark:border-gray-600">
		<div class="max-w-screen-xl flex flex-wrap items-center mx-auto p-4">
			<img src="https://flowbite.com/docs/images/logo.svg" class="h-8 mr-3" alt="Flowbite Logo">
			<span class="self-center text-2xl font-semibold whitespace-nowrap text-gray-700 dark:text-white">TPG2</span>
        </div>
	</nav>
    <?php 
        // Starts the session
        session_start();

        // Check Login form submitted
        if(isset($_POST['Submit'])){
        
        
        // Define username and associated password array
        $logins = array('Nick' => '123456', 'Stanley' => 'admin', 'administrator' => 'admin1234');

        // Check and assign submitted user_name and password to new variable
        $user_name = isset($_POST['user_name']) ? $_POST['user_name'] : '';
        $password = isset($_POST['password']) ? $_POST['password'] : '';
        // Check user_name and password existence in defined array
        if (isset($logins[$user_name]) && $logins[$user_name] == $password){
        
        // Success: Set session variables and redirect to Protected page
        $_SESSION['UserData']['user_name']=$logins[$user_name];
        header("location:index.php");
        exit;
        } else {
        
        
        // Unsuccessful attempt: Set error message
        $msg="<span style='color:red'>Invalid Login Details</span>";
        }
        }
        ?>
    </div>
    <div class="min-h-screen bg-gray-100 py-6 flex flex-col justify-center sm:py-12">
		<div class="relative py-3 sm:max-w-xl sm:mx-auto">
			<div
				class="absolute inset-0 bg-gradient-to-r from-blue-300 to-blue-600 shadow-lg transform -skew-y-6 sm:skew-y-0 sm:-rotate-6 sm:rounded-3xl">
			</div>
			<div class="relative px-4 py-10 bg-white shadow-lg sm:rounded-3xl sm:p-20">
				<div class="max-w-md mx-auto">
					<div>
						<h1 class="text-2xl font-semibold">Login Form with Floating Labels</h1>
					</div>
					<div class="divide-y divide-gray-200">
						<div class="py-8 text-base leading-6 space-y-4 text-gray-700 sm:text-lg sm:leading-7">
                            <form action="" action="" method="POST" name="Login_Form">
                                <tr>
                                    <div class="relative mb-4">
                                        <td>
                                            <input input name="user_name" type="text" autocomplete="off" id="user" class="Input peer placeholder-transparent h-10 w-full border-b-2 border-gray-300 text-gray-900 focus:outline-none focus:borer-rose-600" placeholder="Email address" />
                                            <label for="user" class="absolute left-0 -top-3.5 text-gray-600 text-sm peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-440 peer-placeholder-shown:top-2 transition-all peer-focus:-top-3.5 peer-focus:text-gray-600 peer-focus:text-sm">Email Address</label>
                                        </td>
                                    </div>
                                </tr>
                                <tr>
                                    <div class="relative mb-4">
                                        <td>
                                            <input autocomplete="off" id="password" name="password" type="password" class="Input peer placeholder-transparent h-10 w-full border-b-2 border-gray-300 text-gray-900 focus:outline-none focus:borer-rose-600" placeholder="Password" />
                                            <label for="password" class="absolute left-0 -top-3.5 text-gray-600 text-sm peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-440 peer-placeholder-shown:top-2 transition-all peer-focus:-top-3.5 peer-focus:text-gray-600 peer-focus:text-sm">Password</label>
                                        </td>
                                    </div>
                                </tr>
                                <tr>
                                    <div class="relative">
                                        <td>
                                            <input name="Submit" type="submit" value="Login" class="button bg-blue-500 text-white rounded-md px-2 py-1">
                                        </td>
                                    </div>
                                </tr>
                            </form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
    <script src="https://cdn.tailwindcss.com"></script>
</body>
</html>
