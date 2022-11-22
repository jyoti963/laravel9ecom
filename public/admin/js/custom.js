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

    //Update Brand Status
    $(document).on("click",".updatebrandStatus",function(){
        let status = $(this).children("input").attr("status");
        let brand_id = $(this).attr("brand_id");
        // alert(admin_id);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
           type:'post',
           url:'/admin/brand-update-status',
           data:{status:status,brand_id:brand_id},
           success:function(resp){
            // alert(resp);
            if(resp['status']==0){
                $("#brand-"+brand_id).html("<input class='form-check-input' type='checkbox' id='flexSwitchCheckDefault' status='Inactive'><label class='form-check-label' for='flexSwitchCheckDefault'>Inactive</label>")
            }else if(resp['status']==1){
                $("#brand-"+brand_id).html("<input class='form-check-input' type='checkbox' id='flexSwitchCheckDefault' status='Active' checked><label class='form-check-label' for='flexSwitchCheckDefault'>Active</label>")
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

    //Update Product Status
    $(document).on("click",".updateproductStatus",function(){
        let status = $(this).children("input").attr("status");
        let product_id = $(this).attr("product_id");
        // alert(admin_id);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
           type:'post',
           url:'/admin/product-update-status',
           data:{status:status,product_id:product_id},
           success:function(resp){
            // alert(resp);
            if(resp['status']==0){
                $("#product-"+product_id).html("<input class='form-check-input' type='checkbox' id='flexSwitchCheckDefault' status='Inactive'><label class='form-check-label' for='flexSwitchCheckDefault'>Inactive</label>")
            }else if(resp['status']==1){
                $("#product-"+product_id).html("<input class='form-check-input' type='checkbox' id='flexSwitchCheckDefault' status='Active' checked><label class='form-check-label' for='flexSwitchCheckDefault'>Active</label>")
            }
           },
           error:function(){
            alert("Error");
           }
        })
    });

    //Add Product Attributes input field
    var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_button'); //Add button selector
    var wrapper = $('.field_wrapper'); //Input field wrapper
    var fieldHTML = '<div class="mt-2"><input type="text" name="size[]" style="width: 120px;" placeholder="Size"/>&nbsp;<input type="text" name="sku[]" style="width: 120px;" placeholder="SKU"/>&nbsp;<input type="text" name="price[]" style="width: 120px;" placeholder="Price"/>&nbsp;<input type="text" name="stock[]" style="width: 120px;" placeholder="Stock"/>&nbsp;<a href="javascript:void(0);" class="remove_button">Remove</a></div>'; //New input field html
    var x = 1; //Initial field counter is 1

    //Once add button is clicked
    $(addButton).click(function(){
        //Check maximum number of input fields
        if(x < maxField){
            x++; //Increment field counter
            $(wrapper).append(fieldHTML); //Add field html
        }
    });

    //Once remove button is clicked
    $(wrapper).on('click', '.remove_button', function(e){
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrement field counter
    });

    //Update Product Attributes Status
    $(document).on("click",".updateattributeStatus",function(){
        let status = $(this).children("input").attr("status");
        let attribute_id = $(this).attr("attribute_id");
        // alert(admin_id);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
           type:'post',
           url:'/admin/attribute-update-status',
           data:{status:status,attribute_id:attribute_id},
           success:function(resp){
            // alert(resp);
            if(resp['status']==0){
                $("#attribute-"+attribute_id).html("<input class='form-check-input' type='checkbox' id='flexSwitchCheckDefault' status='Inactive'><label class='form-check-label' for='flexSwitchCheckDefault'>Inactive</label>")
            }else if(resp['status']==1){
                $("#attribute-"+attribute_id).html("<input class='form-check-input' type='checkbox' id='flexSwitchCheckDefault' status='Active' checked><label class='form-check-label' for='flexSwitchCheckDefault'>Active</label>")
            }
           },
           error:function(){
            alert("Error");
           }
        })
    });

    //Update Product Image Status
    $(document).on("click",".updateimageStatus",function(){
        let status = $(this).children("input").attr("status");
        let image_id = $(this).attr("image_id");
        // alert(admin_id);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
           type:'post',
           url:'/admin/image-update-status',
           data:{status:status,image_id:image_id},
           success:function(resp){
            // alert(resp);
            if(resp['status']==0){
                $("#image-"+image_id).html("<input class='form-check-input' type='checkbox' id='flexSwitchCheckDefault' status='Inactive'><label class='form-check-label' for='flexSwitchCheckDefault'>Inactive</label>")
            }else if(resp['status']==1){
                $("#image-"+image_id).html("<input class='form-check-input' type='checkbox' id='flexSwitchCheckDefault' status='Active' checked><label class='form-check-label' for='flexSwitchCheckDefault'>Active</label>")
            }
           },
           error:function(){
            alert("Error");
           }
        })
    });

});
