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
               
                <div class='card-body'>
                    <div class='row'>
                        <div class='col-lg-8'>
                        <h3 class='text-danger'>` + (value.price).toFixed(2) + `</h3>
                    <h5 >` + value.product_name + ` / <span class='text-warning'>`+value.unit+`</span></h5>
                    <p>Inventory: `+value.available_inventory+`</p>
                    <p>Inventory Cost: `+(value.available_inventory + value.price)+`</p>

                        </div>
                        <div class='col-lg-4 text-end'>
                        <a href='#' class='text-primary'><i class="fa fa-edit"></i></a>
                             <a href='#' class='text-danger'><i class="fa fa-trash"></i></a>

                            </div>
                    </div>
                    
                </div>
                <div class='card-footer'>
                    <span>Exp. Date: `+value.expiration_date+`</span>
                </div>
                </div>
                </div>`);
            });
        },
        error: function(xhr, txtStatus, errMsg) {

        }
    })
});
</script>