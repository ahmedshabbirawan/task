<?php foreach($orders as $order): ?>
  <tr>
    <td>{{ $order->id }}</td>
    <td>{{ optional($order->product)->name }}</td>
    <td>{{ optional($order->customer)->name }}</td>
    <td>{{ $order->order_time; }}</td>
    <td>
      <?php if($order->dispatch_time){ ?>
        {{$order->dispatch_time}}
      <?php }else{ ?>
        <a href="javascript:void();" onclick="disatch_order({{ $order->id }})" >Dispatch</a>
      <?php } ?>
      
    </td>
    <td>{{ $order->arrived_time; }}</td>
  </tr>
<?php endforeach; ?>