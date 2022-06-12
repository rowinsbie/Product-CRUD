<div>
    <h3>Product List </h3>
    <hr>

    <div class="row" id="products">


    </div>

</div>
<script>
$(function() {


    $.ajax({
        url: "{{url('api/Products')}}",
        type: "GET",
        dataType: "JSON",
        success: function(data, status, xhr) {
            $.each(data, function(key, value) {
                $("#products").append(`
                <div class='col-lg-4 mb-4'>
                <div class='card '>
             
                    <img class='card-img-top' src=` + `{{asset('storage/products/')}}/` + value.image + ` width='100%' />
               <form method='POST' id='product` + value.id + `' >
                <div class='card-body'>
                    <div class='row'>
                        <div class='col-lg-8'>
                        <h3 class='text-danger'>` + (value.price).toFixed(2) + `</h3>
                    <h5 >` + value.product_name + ` / <span class='text-warning'>` + value.unit + `</span></h5>
                    <p>Inventory: ` + value.available_inventory + `</p>
                    <p>Inventory Cost: ` + (value.available_inventory + value.price) + `</p>

                        </div>
                        <div class='col-lg-4 text-end'>
                        <a href='#' class='text-primary'><i class="fa fa-edit"></i></a>
                        <input type='hidden' name='prodid' class='prodid' value='` + value.id + `' />
     
                        <a href='#' class='text-danger delete'><i class="fa fa-trash"></i></a>

                            </div>
                    </div>
                    
                </div>
                <div class='card-footer'>
                    <span>Exp. Date: ` + value.expiration_date + `</span>
                </div>
                </form>
                </div>
               
                </div>`);
            });
        },
        error: function(xhr, txtStatus, errMsg) {

        }
    });

    $("body").on("click", 'a.delete', function() {
        let formID = $("#" + $(this).closest("form").attr('id')).serialize();
        let ProductID = $(this).parent().find("input[type='hidden']").val();
        Swal.fire({
            title: 'Do you want to delete this product?',
            showCancelButton: true,
            confirmButtonText: 'Delete',
            icon: "question"
        }).then((result) => {
            if (result.isConfirmed) {
                // api call here
                $.ajax({
                    url: "{{url('api/Products/')}}/" + ProductID,
                    type: "DELETE",
                    data: formID,
                    success: function(res, status, xhr) {
                        if (xhr.status === 200) {
                            Swal.fire({
                                title: "Deleted",
                                text: res.Message,
                                icon: "success"
                            }).then(res => {
                                location.reload();
                            });
                        }
                    },
                    error: function(xhr, txtsTatus, errMsg) {
                        if (xhr.status === 500) {
                            Swal.fire({
                                title: "Error",
                                text: xhr.responseJSON.Message,
                                icon: "error"
                            });
                        }
                    }
                })
            }
        })
    });


});
</script>