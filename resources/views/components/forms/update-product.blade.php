<div class='modal fade' id="update-form">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Update</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
            <form method="POST" id="updateForm">
            <div class="form-group">
                <label for="prod_name">Product Name</label>
                <input type="hidden" id="pid" name='pid' value=''>
                <input type="text" id="u_prod_name" name="u_prod_name" class="form-control">
            </div>
            <div class="form-group mt-3">
                <label for="unit">Unit</label>
                <input type="text" id="u_unit" name="u_unit" class="form-control">
            </div>
            <div class="form-group  mt-3">
                <label for="price">price</label>
                <input type="number" id="u_price" name="u_price" step="0.01" class="form-control">
            </div>
            <div class="form-group  mt-3">
                <label for="expiration">Expiration Date</label>
                <input type="date" id="u_exp" name="u_exp" class="form-control">
            </div>
            <div class="form-group  mt-3">
                <label for="ai">Available Inventory</label>
                <input type="number" id="u_ai" name="u_ai" class="form-control">
            </div>
         
            <div class="form-group mt-3">
                <button type="submit" id="update" name="update" class="form-control btn btn-primary">Create
                    Product</button>
            </div>
        </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(function()
    {
        
        $("#updateForm").validate({
        rules: {
            u_prod_name: {
                required: true
            },
            u_unit: {
                required: true,
            },
            u_price: {
                required: true
            },
            u_exp: {
                required: true
            },
            u_ai: {
                required: true
            },
           
        },
        submitHandler: function() {
            let pid = $("#pid").val();
            $.ajax({
                url:"{{url('api/Products')}}/"+pid,
                type:"PUT",
                data:$("#updateForm").serialize(),
                success:function(data,status,xhr)
                {
                   if(xhr.status == 200)
                   {
                    Swal.fire({
                        title:"Updated!",
                        text:data.Message,
                        icon:"success"
                    }).then(res => {
                        location.reload();
                    });
                   }
                }
            })
        }
    });
    })
    </script>