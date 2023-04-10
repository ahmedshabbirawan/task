<div class="album py-5 bg-light">
  <div class="container">
    <div class="row">
      <table class="table">
        <thead class="thead-dark">
          <tr>
            <th scope="col" colspan="6" >Customer Order</th>
            
            <th scope="col" colspan="1" ><a href="javascript:void(0);" onclick="getOrders();" > Refersh</a></th>
          </tr>
        </thead>
        <thead class="thead-dark">
          <tr>
            <th scope="col">#</th>
            <th scope="col">Product</th>
            <th scope="col">Customer</th>
            <th scope="col">Order Time</th>
            <th scope="col">Dispatch</th>
            <th scope="col">Arrived</th>
            <th scope="col">Send Alert</th>
          </tr>
        </thead>
        <tbody id="order_body" >
        </tbody>
      </table>     
    </div>
  </div>
</div>

@section('owner_script')
<script>
    function getOrders(){

      sendGetRequest("{{ route('order.get_business_order') }}?res=html", function(res, textStatus, jqXHR){
          $('#order_body').html(res);
      });

 
    }


    function disatch_order(orderID){
      sendGetRequest("{{ route('order.disatch_order') }}?res=html&order_id="+orderID, function(res, textStatus, jqXHR){
        if(res.status){
          var data = res.data;
          if(!(data.event)){
            alert('Order dispatch but notification not');
          }
        }
        getOrders();
      });
    
    }
    $(document).ready(function() {
        getOrders();
    });
  </script>
@endsection