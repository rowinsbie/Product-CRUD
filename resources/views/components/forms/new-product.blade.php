<div class="card">

    <div class="card-body">
        <h3>New Product</h3>
        <hr />
        <form method="POST" id="ProductForm">
            <div class="form-group">
                <label for="prod_name">Product Name</label>
                <input type="text" id="prod_name" name="prod_name" class="form-control">
            </div>
            <div class="form-group mt-3">
                <label for="unit">Unit</label>
                <input type="text" id="unit" name="unit" class="form-control">
            </div>
            <div class="form-group  mt-3">
                <label for="price">price</label>
                <input type="number" id="price" name="price" step="0.01" class="form-control">
            </div>
            <div class="form-group  mt-3">
                <label for="expiration">Expiration Date</label>
                <input type="date" id="exp" name="exp" class="form-control">
            </div>
            <div class="form-group  mt-3">
                <label for="ai">Available Inventory</label>
                <input type="number" id="ai" name="ai" class="form-control">
            </div>
            <div class="form-group  mt-3">
                <label for="image">Image</label>
                <input type="file" id="img" name="img" class="form-control">
            </div>
            <div class="form-group mt-3">
                <button type="submit" id="create" name="create" class="form-control btn btn-primary">Create
                    Product</button>
            </div>
        </form>
    </div>
</div>

<script>
$(function() {

    const createNewProduct = (formID) => {
        let formData = new FormData($(formID)[0]);
        let file = $('input[type=file]')[0].files[0];
        let ext =  $("#img").val().replace(/^.*\./,'').toLowerCase();
        let allowedExt = ['jpg','png'];
        if(!allowedExt.includes(ext))
        {
            Swal.fire({
                title:"Oooops!",
                text:"Your file must type of jpg or png",
                icon:"warning"
            });
            return false;
        }
        
        formData.append('img', file); 
        if(file.size > 2000000)
        {
            Swal.fire({
                title:"Too large",
                text:"The image you're uploading is too large",
                icon:"warning"
            });
            return false;
        }
        

        $.ajax({
            url: "{{url('api/Products')}}",
            type: "POST",
            cache: false,
            contentType: false,
            processData: false,
            data: formData,
            success: function(data, status, xhr) {
               if(xhr.status === 200)
               {
                   Swal.fire({
                       title:"Success!",
                       text:data.Message,
                       icon:"success"
                   }).then(res => {
                        location.reload();
                   });
               }

             
              
          

            },
            error: function(xhr, txtsTatus, errMsg) {
                console.log(xhr);
                if(xhr.status === 409)
               {
                Swal.fire({
                       title:"Warning",
                       text:xhr.responseJSON.Message,
                       icon:"warning"
                   });
               }

            }
        });

        return false;
    }


    $("#ProductForm").validate({
        rules: {
            prod_name: {
                required: true
            },
            unit: {
                required: true,
            },
            price: {
                required: true
            },
            exp: {
                required: true
            },
            ai: {
                required: true
            },
            img: {
                required: true
            }
        },
        submitHandler: function() {
            createNewProduct("#ProductForm");

        }
    });
});
</script>