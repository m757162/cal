@extends('app.app')
@section('title','Add New User')
@section('content')
<div class="container-fluid position-relative" style="margin-top:6rem">
    <button class="btn btn-info my-2 addcata">Add User</button>          
    <div class="row justify-content-center">
       <div class="col-10 text-center d-flex justify-content-center">
           <center class="table_and_header mb-4 table-responsive">
               <h1 class="text-uppercase mt-5 catal" style="">user list</h1>
                <table class="table mt-3  table-striped table-hover  text-center ">
                    <thead>
                        <tr class="thead">
                            <th class="text-uppercase  text-center  ">#</th>  
                            <th class="text-uppercase  text-center  ">User</th> 
                            <th class="text-uppercase  text-center  ">user type</th>  

                            <th class="text-uppercase  text-center ">edit</th>  
                             <th class="text-uppercase  text-center ">delete</th>                                
                        </tr>
                    </thead>          
                    <tbody class="tbody">
                        <tr class="">                                    
                        </tr>
                    </tbody>
                </table>
                <div class="h4 text-center waitmsg">wait please</div>
                <div class="h4 text-center emptymsg ">No data available</div>
            </center>
        </div>
    </div>   
</div> 
   {{--  //////////// add modal/////////////  --}}
<div class="modal fade addAdminModal" id="addAdminModal"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
	    <form>
        <div class="modal-content">
		    <div class="modal-header">
		        <h5 class="modal-title" id="addModalLabel">Add User</h5>
		        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		    </div>
		    <div class="modal-body">   
                <input type="text" class="form-control mt-2 addAdminEmail" placeholder="Email" required>
                <span class="wrongcata text-danger"></span>
                <input type="password" class="form-control mt-2 addAdminPsw" placeholder="Password" required>
                <select name="" class="usertype form-control mt-2">
                    <option value="General_user">General_user</option>
                    <option value="Admin">Admin</option>
                </select>
		    </div>
		    <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
		        <button type="button" class="btn btn-info addAdminEmailIcon" id="confirmedit">Add User</button>
		    </div>
	    </div>
        </form>
	</div>
</div>
{{--  //////////// end add modal/////////////  --}}

{{--  //////////// edit modal/////////////  --}}
<div class="modal fade adminEditModal" id="adminEditModal"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
	    <div class="modal-content">
		    <div class="modal-header">
		        <h5 class="modal-title" id="addModalLabel">update User</h5>
		        <h5 class="modal-title adminID"  id="adminId"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		    </div>
		    <div class="modal-body">   
                <input type="text" class="form-control mt-2 adminEmail" placeholder="update Admin">
                <span class="wrongcata text-danger"></span>
                <input type="text" class="form-control mt-2 adminPsw" placeholder="update Password">
                <select name="" class="edit_usertype form-control mt-2">
                    <option value="General_user">General_user</option>
                    <option value="Admin">Admin</option>
                </select>
		    </div>
		    <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
		        <button type="button"    class="btn btn-info adminEditIcon" id="confirmedit">update User</button>
		    </div>
	    </div>
	</div>
</div>
{{--  //////////// end edit modal/////////////  --}}
   
   {{--  //////////// delete modal/////////////  --}}
   <div class="modal fade admindelmodal" id="admindelmodal"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
	    <div class="modal-content">
		    <div class="modal-header">
		        <h5 class="modal-title" id="addModalLabel">delete User</h5>
		        <h5 class="modal-title adminDeleteModalId"  id=""></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		    </div>
		    <div class="modal-body">  
            <div class="h5 admindelmodalemail"></div>   
		    </div>
		    <div class="modal-footer">	       
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
		        <button type="button" class="btn btn-info deletecon" id="confirmedit">delete User</button>
            </div>
	  </div>
	</div>
</div>
{{--  //////////// end delete modal/////////////  --}}

@endsection

@section('editmodalscript')
<script>
    getdata();
    function getdata(){
        $('.emptymsg').addClass('d-none');
        $('.tbody').html('')
        axios.get('/getAdmin')
        .then(function (response){
            if(response.status == 200){
                $('.waitmsg').addClass('d-none');
                if(response.data.length >= 1){                   
                    var getdatavar=response.data;          
                    $.each(getdatavar,function (i){
                        var count=i+1;
                        $('<tr>').html(
                            "<td class='border-bottom'>"+count+"</td>"+
                            "<td class='border-bottom'>"+getdatavar[i].email+"</td>"+
                            "<td class='border-bottom'>"+getdatavar[i].user_type+"</td>"+
                            "<td class=' editadmin border-bottom' data-user="+getdatavar[i].user_type+" data-email="+getdatavar[i].email+" data-id="+getdatavar[i].id+"><i class='fas fa-edit'></i></td>"+
                            "<td class='deleteadmin border-bottom'data-email="+getdatavar[i].email+" data-id="+getdatavar[i].id+"><i class='fas fa-trash-alt'></i></td>"
                        ).appendTo('.tbody')
                    })
                    $('.editadmin').click(function (){
                        // $('.adminEditIcon').html('update data')
                        $('.adminEditModal').modal('show')
                        $('.adminPsw').val('')
                        var user=$(this).data("user")
                        
                        $('.edit_usertype').val(user)
                        id= $(this).data("id");
                        admin_email= $(this).data("email");
                        $('.adminEmail').val(admin_email)
                        $('#adminId').html(id)  
                    
                    });
                    $('.deleteadmin').click(function (){
                        $('.admindelmodal').modal('show')
                        var id= $(this).data("id");
                        var email= $(this).data("email");
                        $('.adminDeleteModalId').html(id)
                        $('.admindelmodalemail').html(email)
                    
                    })
                }else{
                    $(".emptymsg").removeClass("d-none")
                }
            }else{           
                $(".waitmsg").removeClass("d-none")
            }
        }).catch(function (error){
           
           alert("data loded not success");
           if(error.response.status == 401){
                Swal.fire({
                    title: 'Unauthorize!',
                    text: 'Only Admin want to Access this page',
                    icon: 'error',
                    confirmButtonText: 'Okey'
                }) 
            }
            $(".waitmsg").html("somthing wrong")
        })
    }
    ////////add admin///////////
    $('.addAdminEmailIcon').click(function (){
        var admin_email_value=$('.addAdminEmail').val();
        var admin_psw_value=$('.addAdminPsw').val();
        var user_type=$('.usertype').val()
        if(admin_email_value.length == 0){
            // $('.wrongcata').html('input catagory name')  
            Swal.fire({
                title: 'Empty!',
                text: "The email field is required",
                icon: 'error',
                confirmButtonText: 'Okey'
            })
        }
        else if(admin_psw_value.length < 5){        
            Swal.fire({
                title: 'Error!',
                text: "The password field must be at least 5 characters.",
                icon: 'error',
                confirmButtonText: 'Okey'
            })
        }
        else{
            $(this).html('<div class="spinner spinner-border spinner-border-sm"></div>');
            axios.post('/addAdmin',{email:admin_email_value,password:admin_psw_value,user_type})
            .then(function (response){
                if(response.data == 1){
                    getdata()
                    $('.addAdminEmail').val('');
                    $('.addAdminModal').modal('hide')
                    $('.addAdminEmailIcon').html('Add Admin');
                    Swal.fire({
                        title: 'Success!',
                        text: "Admin Added Successfully",
                        icon: 'success',
                        confirmButtonText: 'Okey'
                    })
                }
                else{
                    $('.addAdminEmailIcon').html('Add Admin');
                    Swal.fire({
                        title: 'Error!',
                        text: response.data.toString(),
                        icon: 'error',
                        confirmButtonText: 'Okey'
                    })  
                }
            }).catch(function (error){
            
                if(error.response.status == 401){   
                    Swal.fire({
                        title: 'Unauthorize!',
                        text: 'Only Admin want to Access this page',
                        icon: 'error',
                        confirmButtonText: 'Okey'
                    }) 
                }else{
                    Swal.fire({
                        title: 'Error!',
                        text: "Somthing wrong. please try again",
                        icon: 'error',
                        confirmButtonText: 'Okey'
                    })
                }
                
                $('.addAdminEmailIcon').html('Add Admin');
            })
        }
    });
    ////////end add admin///////

    ///////edit user ///////
    
    $('.adminEditIcon').click(function (){
        var admin_id=$('#adminId').html();
        var admin_email=$('.adminEmail').val();
        var admin_psw=$('.adminPsw').val();
        var edit_usertype=$('.edit_usertype').val()
        if(admin_email.length == 0){            
            Swal.fire({
                title: 'Error!',
                text: "Email is required",
                icon: 'error',
                confirmButtonText: 'Okey'
            })
        }
        else{
            $(this).html('<div class="spinner spinner-border spinner-border-sm"></div>');
            axios.post('/editAdmin',{adminId:admin_id,adminEmail:admin_email,adminPsw:admin_psw,edit_usertype})
            .then(function (response){               
              if(response.data){
                getdata() 
                 $('.adminEditIcon').html('update Data')
                    $('.adminEditModal').modal('hide') 
                                  
                    Swal.fire({
                        title: 'Success!',
                        text: 'User Updated successfully',
                        icon: 'success',
                        confirmButtonText: 'Okey'
                    })                   
                }else{
                    Swal.fire({
                        title: 'Error!',
                        text: response.data.toString(),
                        icon: 'error',
                        confirmButtonText: 'Okey'
                    })
                    $('.adminEditModal').modal('hide')
                    $('.adminEditIcon').html('update data')
                }
            }).catch(function (error){
                $('.adminEditIcon').html('update Data')
                Swal.fire({
                    title: 'Error!',
                    text: 'Somthing wrong.please Try again',
                    icon: 'error',
                    confirmButtonText: 'Okey'
                })
            })
        }
    })
    ///////end edit user////

    ///////delete////
   $('.deletecon').click(function (){
        $(this).html('<div class="spinner spinner-border spinner-border-sm"></div>');
        var delid= $('.adminDeleteModalId').html()

       axios.post('/deleteAdmin1',{deleteid:delid})
       .then(function (response){
           if(response.data == 1){
                $(".waitmsg").removeClass("d-none")
                $('.deletecon').html('delete data')
                getdata() 
                $('.admindelmodal').modal('hide')
                Swal.fire({
                    title: 'Success!',
                    text: "User delete Successfully",
                    icon: 'success',
                    confirmButtonText: 'Okey'
                })
           }else{
                $('.admindelmodal').modal('hide')
                $('.deletecon').html('delete data')
                Swal.fire({
                    title: 'Error!',
                    text: "Server Problem",
                    icon: 'error',
                    confirmButtonText: 'Okey'
                })
            }
       }).catch(function (error){
            $('.admindelmodal').modal('hide')
            $('.deletecon').html('delete Admin')
            Swal.fire({
                title: 'Error!',
                text: "Server Problem",
                icon: 'error',
                confirmButtonText: 'Okey'
            })
        })
   })
    ///////end delete////


    $('.addAdminEmail').keydown(function (){
        $('.wrongcata').html('')    
    })
    $('.addcata').click(function (){
        $('.wrongcata').html('')        
        $('.addAdminModal').modal('show')
        
    })
    $('.fa-edit').click(function (){
        $('.adminEditModal').modal('show')
    });
    $('.fa-trash-alt').click(function (){
        $('.admindelmodal').modal('show')
    }) 
</script>
@endsection