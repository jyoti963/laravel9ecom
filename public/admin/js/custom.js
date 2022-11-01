$(document).ready(function () {
    $('#myTable').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'csv', 'excel', 'pdf', 'print'
        ]
    });
   $('.confirmDelete').click(function(){
    var module = $(this).attr('module');
    var moduleid = $(this).attr('moduleid');
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
            Swal.fire(
                'Deleted!',
                'Your file has been deleted.',
                'success'
            )
            window.location = '/admin/delete-'+module+'/'+moduleid ;
            }
        })
    });

    // Update Admin Status
    $(document).on("click",".updateStatus",function(){
        let status = $(this).children("input").attr("status");
        let admin_id = $(this).attr("admin_id");
        // alert(admin_id);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
           type:'post',
           url:'/admin/update-admin-status',
           data:{status:status,admin_id:admin_id},
           success:function(resp){
            // alert(resp);
            if(resp['status']==0){
                $("#admin-"+admin_id).html("<input class='form-check-input' type='checkbox' id='flexSwitchCheckDefault' status='Inactive'><label class='form-check-label' for='flexSwitchCheckDefault'>Inactive</label>")
            }else if(resp['status']==1){
                $("#admin-"+admin_id).html("<input class='form-check-input' type='checkbox' id='flexSwitchCheckDefault' status='Active' checked><label class='form-check-label' for='flexSwitchCheckDefault'>Active</label>")
            }
           },
           error:function(){
            alert("Error");
           }
        })
    });

    // Update Section Status
    $(document).on("click",".updateSectionStatus",function(){
        let status = $(this).children("input").attr("status");
        let section_id = $(this).attr("section_id");
        // alert(admin_id);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
           type:'post',
           url:'/admin/section-update-status',
           data:{status:status,section_id:section_id},
           success:function(resp){
            // alert(resp);
            if(resp['status']==0){
                $("#section-"+section_id).html("<input class='form-check-input' type='checkbox' id='flexSwitchCheckDefault' status='Inactive'><label class='form-check-label' for='flexSwitchCheckDefault'>Inactive</label>")
            }else if(resp['status']==1){
                $("#section-"+section_id).html("<input class='form-check-input' type='checkbox' id='flexSwitchCheckDefault' status='Active' checked><label class='form-check-label' for='flexSwitchCheckDefault'>Active</label>")
            }
           },
           error:function(){
            alert("Error");
           }
        })
    });

    // Update Category Status
    $(document).on("click",".updateCategoryStatus",function(){
        let status = $(this).children("input").attr("status");
        let category_id = $(this).attr("category_id");
        // alert(admin_id);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
           type:'post',
           url:'/admin/category-update-status',
           data:{status:status,category_id:category_id},
           success:function(resp){
            // alert(resp);
            if(resp['status']==0){
                $("#category-"+category_id).html("<input class='form-check-input' type='checkbox' id='flexSwitchCheckDefault' status='Inactive'><label class='form-check-label' for='flexSwitchCheckDefault'>Inactive</label>")
            }else if(resp['status']==1){
                $("#category-"+category_id).html("<input class='form-check-input' type='checkbox' id='flexSwitchCheckDefault' status='Active' checked><label class='form-check-label' for='flexSwitchCheckDefault'>Active</label>")
            }
           },
           error:function(){
            alert("Error");
           }
        })
    });

    //Append category level
    $('#section_id').change(function(){
        let section_id = $(this).val();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
           type:'get',
           url:'/admin/append-category-level',
           data:{section_id:section_id},
           success:function(resp){
            $("#appendCategoryLevel").html(resp);
           },
           error:function(){
            alert("Error");
           }
        })

    });
});
