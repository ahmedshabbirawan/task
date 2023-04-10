<div class="album py-5 bg-light">
  <div class="container">


    <div class="row" style="margin-bottom:10px;">

      <?php foreach($products as $row): ?>

      <div class="col-sm-6">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">{{ $row->name }}</h5>
            <p class="card-text">With Price : {{ $row->price }}</p>
            <a href="javascript:void(0);" class="btn btn-primary" onclick="placeOrder({{ $row->id }}, {{ $business->id }});" >Place Order</a>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>


    <div class="row">
      <table class="table">
        <thead class="thead-dark">
          <tr>
            <th scope="col" colspan="5" >Yours Order</th>
            <th scope="col" colspan="5" ><a href="javascript:void(0);" onclick="getOrders();">Refersh</a></th>
          </tr>
        </thead>
        <thead class="thead-dark">
          <tr>
            <th scope="col">#</th>
            <th scope="col" width="40%" >Product</th>
            <th scope="col">Business</th>
            <th scope="col">Order Time</th>
            <th scope="col">Dispatch</th>
            <th scope="col">Arrived</th>
            
          </tr>
        </thead>
        <tbody id="order_body">
        </tbody>
      </table>     
    </div>
  </div>
</div>

@section('customer_script')
<script>
    function getOrders(){

      sendGetRequest("{{ route('order.get_customer_order') }}?res=html", function(res, textStatus, jqXHR){
          $('#order_body').html(res);
      });


      /*
      $.ajax({
          cache: false,
          contentType: false,
          processData: false,
          async: false,
          type: 'GET',
          // dataType: "JSON",
          headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          url: "{{ route('order.get_customer_order') }}?res=html",
          success: function(res, textStatus, jqXHR) {
            //if (jqXHR.status == 200) {
              $('#order_body').html(res);
            //}
          },
          error: ajaxFailBlock
      });
      */
    }



    function placeOrder(productID, businessID){
      const formData = new FormData();
      formData.append("product_id", productID);
      formData.append("business_id", businessID); 



      sendPostRequest("{{ route('order.place_order') }}", formData, function(res, textStatus, jqXHR){
        if (jqXHR.status == 200) {
                alert(res.message);
                getOrders();
              }
      });

      /*
      $.ajax({
          data: formData,
          cache: false,
          contentType: false,
          processData: false,
          async: false,
          type: 'POST',
          dataType: "JSON",
          headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
          url: "{{ route('order.place_order') }}",
          success: function(res, textStatus, jqXHR) {
              if (jqXHR.status == 200) {
                alert(res.message);
                getOrders();
              }
          },
          error: ajaxFailBlock
      });
      */
    }


    $(document).ready(function() {
        console.log('I am customer!');
        getOrders();
    });
</script>
@endsection