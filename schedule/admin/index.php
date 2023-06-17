<!DOCTYPE html>
<html lang="en">

<?php include 'header/header.php'; ?>

<body>
<div class="container-fluid vh-100 py-5">
            <div class="">
                <div class="rounded d-flex justify-content-center">
                    <div class="col-md-4 col-sm-12 shadow-lg p-5 bg-light">
                        <div class="text-center">
                            <h3 class="text-primary">Sign In</h3>
                        </div>
                        <form action="checkpassword.php" method="post">
                            <div class="p-4">
                                <div class="input-group mb-3">
                                    <input type="text" name="username" class="form-control" placeholder="Username">
                                </div>
                                <div class="input-group mb-3">
                                    <input type="password" name="password" class="form-control" placeholder="password">
                                </div>
                                <button class="btn btn-primary text-center mt-2" type="submit">
                                    Login
                                </button>
                                <p class="text-center text-primary">Forgot your password?</p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</body>
</html>