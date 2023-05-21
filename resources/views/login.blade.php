@extends('app.app')
@section('content')

    <div class="container-fluid ">
    <div class="moon mt-2" style=" float:right">  <i class="fa-solid fa-moon"></i> </div>
    <div class="sun mt-2" style="display:none; float:right"> <i class="fa-solid fa-sun"></i> </div>
        <div class="row justify-content-center d-flex align-items-center"style="height:100vh">
            <div class="col-md-7 admin_login">
            <div class="h3 text-center">Admin Login</div>
                <label>Email</label>
                <input type="email" name="email" class="form-control email" placeholder="Enter your Email" require/>
                <label class="mt-2">Password</label>
                <input type="password " name="password" class="form-control  psw" placeholder="Enter your Password" required/>
                <button type="submit" class="btn btn-info mt-2 adminLogin">Login</button>
            </div>
        </div>
    </div>

    <script>
        $('.adminLogin').click(function(){           
            const email=$('.email').val()
            const psw=$('.psw').val()
            if(email.length == 0){
                Swal.fire({
                    title: 'Empty!',
                    text: "The email field is required",
                    icon: 'error',
                    confirmButtonText: 'Okey'
                })
            }
            else if(psw.length < 5){
                Swal.fire({
                    title: 'Error!',
                    text: "The password field must be at least 5 characters.",
                    icon: 'error',
                    confirmButtonText: 'Okey'
                })
            }
           
            else{
                $(".adminLogin").html("Loading...")
                axios.post('/admin/login',{email:email,password:psw})
                .then(function(response){  
                    $(".adminLogin").html("login")             
                    if(response.data == 1){
                        $('.email').val('')
                        $('.psw').val('')
                        Swal.fire({
                            title: 'Success',
                            text: "Login Success",
                            icon: 'success',
                            confirmButtonText: 'Okey'
                        })
                        window.location = '/'
                        // window.location.href('/adminecom')
                    }else{
                        Swal.fire({
                            title: 'Error!',
                            text: "Your Email or Password is wrong",
                            icon: 'error',
                            confirmButtonText: 'Okey'
                        })
                    }
                })
                .catch(function(response){
                    $(".adminLogin").html("login")  
                    Swal.fire({
                        title: 'Error!',
                        text: "Server error",
                        icon: 'error',
                        confirmButtonText: 'Okey'
                    })
                })
            }
        })
    </script>
@endsection