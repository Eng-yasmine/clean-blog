<?php 
include '././inc/nav.php';
?>

        <!-- Main Content-->
        <main class="mb-4">
            <div class="container px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-md-10 col-lg-8 col-xl-7">
                        <p>REGISTRATION FORM!</p>
                        <div class="my-5">
                            
                           
                            <form action="index.php?page=auth_register" method="POST" id="registerForm">
                                <div class="form-floating">
                                    
                                    <h2><?php echo successmessage(); ?></h2>
                                    <h2><?php echo errormessage(); ?></h2>
                                </div>
                                <div class="form-floating">
                                    <input class="form-control" name="name" id="name" type="text" placeholder="Enter your name..." />
                                    <label for="name">Name</label>
                                    <div class="invalid-feedback">A name is required.</div>
                                </div>
                                <div class="form-floating">
                                    <input class="form-control" name="email" id="email" type="email" placeholder="Enter your email..." />
                                    <label for="email">Email address</label>
                                    <div class="invalid-feedback">An email is required.</div>
                                </div>
                                <div class="form-floating">
                                    <input class="form-control" name="phone" id="phone" type="tel" placeholder="Enter your phone number..."  />
                                    <label for="phone">Phone Number</label>
                                    <div class="invalid-feedback">A phone number is required.</div>
                                </div>
                                <div class="form-floating">
                                    <input class="form-control" name="password" id="password" type="password" placeholder="Enter your password..." />
                                    <label for="password">Password</label>
                                    <div class="invalid-feedback">A password is required.</div>
                                </div>
                                <br />
                                <button class="btn btn-primary text-uppercase" id="submitButton" type="submit">REGISTER</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <!-- Footer-->
        