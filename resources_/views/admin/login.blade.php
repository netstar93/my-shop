<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <!-- Basic page needs -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Login - Admin Panel</title>
        <!-- fevicon -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @include('admin.components.head')      
        <link rel="stylesheet" type="text/css" href="{{asset('/css/admin/login.css')}}">  
    </head>
<div class="admin-login-index" >
	
<div id="loginModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Login</h3>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form class="form" role="form" autocomplete="on" id="formLogin" novalidate="" method="POST">
                    <div class="form-group">
                        
                        <label for="uname1">Username</label>
                        <input type="text" class="form-control form-control-lg" name="uname1" id="uname1" required="">
                        <div class="invalid-feedback">Oops, you missed this one.</div>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control form-control-lg" id="pwd1" required="" autocomplete="new-password">
                        <div class="invalid-feedback">Enter your password too!</div>
                    </div>
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" class="custom-control-input" id="rememberMe">
                      <label class="custom-control-label" for="rememberMe">Remember me on this computer</label>
                    </div>
                    <div class="form-group py-4">
                        <button class="btn btn-outline-secondary btn-lg" data-dismiss="modal" aria-hidden="true">Cancel</button>
                        <button type="submit" class="btn btn-success btn-lg float-right" id="btnLogin">Login</button>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-outline-secondary btn-sm" data-dismiss="modal" id="btnForgot" aria-hidden="true">Forgot Password</button>
                        <button class="btn btn-success btn-sm float-right" id="btnSignup">Sign Up</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="registerModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Sign Up</h3>
                <button type="button" class="close cancel" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form class="form" role="form" autocomplete="off" id="formLogin2" novalidate="" method="POST">
                    <div class="form-group">                        
                        <label for="uname1">Name</label>
                        <input type="text" class="form-control form-control-lg" name="name" required="">
                        <div class="invalid-feedback">Oops, you missed this one.</div>
                    </div>
                    <div class="form-group">                        
                        <label for="uname1">Username</label>
                        <input type="text" class="form-control form-control-lg" name="username" required="">
                        <div class="invalid-feedback">Oops, you missed this one.</div>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control form-control-lg" required="" autocomplete="new-password">
                        <div class="invalid-feedback">Enter your password too!</div>
                    </div>
                    <div class="form-group">
                        <label>Confirm Password</label>
                        <input type="password" class="form-control form-control-lg" required="" autocomplete="new-password">
                        <div class="invalid-feedback">Enter your password too!</div>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control form-control-lg" name ="email" required="" >
                        <div class="invalid-feedback">Enter your email too!</div>
                    </div>
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" class="custom-control-input" id="rememberMe2">
                      <label class="custom-control-label" for="rememberMe">Remember me on this computer</label>
                    </div>
                    <div class="form-group py-4">
                        <button class="btn btn-outline-secondary btn-lg cancel" data-dismiss="modal" aria-hidden="true">Cancel</button>          
                        <button type="submit" class="btn btn-success btn-lg float-right" id="btnRegisterSubmit">Submit</button>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>
</div>


</div>

<script type="text/javascript">
	$(window).on('load',function(){
        $('#loginModal').modal('show');
    });

    $('.cancel').click(function(e){
    	e.preventDefault();
    	$('#registerModal').modal('hide');
    	$('#loginModal').modal('show');
    });

    $('#btnSignup').click(function(e){
    	e.preventDefault();
    	$('#loginModal').modal('hide');
    	$('#registerModal').modal('show');
    });

	$("#btnLogin").click(function(event) {    

    //Fetch form to apply custom Bootstrap validation
    var form = $("#formLogin")

    if (form[0].checkValidity() === false) {
      event.preventDefault()
      event.stopPropagation()
    }
    form.addClass('was-validated');
    var form = $("#formLogin2")

    if (form[0].checkValidity() === false) {
      event.preventDefault()
      event.stopPropagation()
    }
    form.addClass('was-validated');

  });
</script>
<style>
.modal{
	overflow: scroll;
}
</style>
	
