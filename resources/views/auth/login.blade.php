<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Login | Rekon Merchant</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A premium admin dashboard template by Mannatthemes" name="description" />
        <meta content="Mannatthemes" name="author" />

        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ asset('assets') }}/images/favicon.ico">

        <!-- App css -->
        <link href="{{ asset('assets') }}/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets') }}/css/icons.css" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets') }}/css/metisMenu.min.css" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets') }}/css/style.css" rel="stylesheet" type="text/css" />

    </head>

    <body class="account-body accountbg">

        <!-- Log In page -->
        <div class="row vh-100 ">
            <div class="col-12 align-self-center">
                <div class="auth-page">
                    <div class="card auth-card shadow-lg">
                        <div class="card-body">
                            <div class="px-3">
                                <div class="auth-logo-box">
                                    <a href="{{ route('loginPage') }}" class="logo logo-admin"><img src="{{ asset('assets') }}/images/logo-sm.png" height="55" alt="logo" class="auth-logo"></a>
                                </div><!--end auth-logo-box-->
                                <div class="text-center auth-logo-text">
                                    <h4 class="mt-0 mb-3 mt-5">Let's Get Started Rekon Merchant</h4>
                                    <p class="text-muted mb-0">Sign in to continue to Rekon Merchant.</p>  
                                </div> <!--end auth-logo-text-->
                                <?= $alert ?>
                                <form class="form-horizontal auth-form my-4" action="{{ route('loginProcess') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="username">Email</label>
                                        <div class="input-group mb-3">
                                            <span class="auth-form-icon">
                                                <i class="dripicons-user"></i> 
                                            </span>
                                            <input type="text" class="form-control" id="email" placeholder="Enter Email" name="email">
                                        </div>
                                    </div><!--end form-group-->
        
                                    <div class="form-group">
                                        <label for="userpassword">Password</label>
                                        <div class="input-group mb-3"> 
                                            <span class="auth-form-icon">
                                                <i class="dripicons-lock"></i> 
                                            </span>
                                            <input type="password" class="form-control" id="password" placeholder="Enter password" name="password">
                                        </div>    
                                    </div><!--end form-group-->
        
                                    <div class="form-group mt-4 mb-0 row">
                                        <div class="col-12 mt-2">
                                            <button class="btn btn-primary btn-round btn-block waves-effect waves-light" type="submit">Log In <i class="fas fa-sign-in-alt ml-1"></i></button>
                                        </div><!--end col--> 
                                    </div> <!--end form-group-->
                                </form><!--end form-->
                            </div><!--end /div-->
                            
                        </div><!--end card-body-->
                    </div><!--end card-->
                </div><!--end auth-page-->
            </div><!--end col-->
        </div><!--end row-->
        <!-- End Log In page -->
    

        <!-- jQuery  -->
        <script src="{{ asset('assets') }}/js/jquery.min.js"></script>
        <script src="{{ asset('assets') }}/js/bootstrap.bundle.min.js"></script>
        <script src="{{ asset('assets') }}/js/metisMenu.min.js"></script>
        <script src="{{ asset('assets') }}/js/waves.min.js"></script>
        <script src="{{ asset('assets') }}/js/jquery.slimscroll.min.js"></script>

        <!-- App js -->
        <script src="{{ asset('assets') }}/js/app.js"></script>

    </body>
</html>