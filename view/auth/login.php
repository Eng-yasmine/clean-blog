<?php 
 include '././inc/nav.php';
  ?>

<main class="mb-4">
            <div class="container px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-md-10 col-lg-8 col-xl-7">
                        <p>LOGIN !</p>
                        <div class="my-5">
                            
                           
                            <form action="index.php?page=auth-login" method="POST" id="registerForm">
                            <div class="form-floating">
                                    
                                    <h2><?php echo successmessage(); ?></h2>
                                    <h2><?php echo errormessage(); ?></h2>
                                </div>
                                <div class="form-floating">
                                    <input class="form-control" name="email" id="email" type="email" placeholder="Enter your email..." />
                                    <label for="email">Email address</label>
                                    <div class="invalid-feedback">An email is required.</div>
                                </div>
                               
                                <div class="form-floating">
                                    <input class="form-control" name="password" id="password" type="password" placeholder="Enter your password..." />
                                    <label for="password">Password</label>
                                    <div class="invalid-feedback">A password is required.</div>
                                </div>
                                <br />
                                <button class="btn btn-primary text-uppercase" id="submitButton" type="submit">LOGIN</button>
                            </form>
                            </div>
                    </div>
                </div>
            </div>
        </main>
        <!-- Footer-->
        