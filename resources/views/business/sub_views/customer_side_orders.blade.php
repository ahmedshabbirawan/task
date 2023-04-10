<?php foreach($orders as $order): ?>
  <tr>
    <td>{{ $order->id }}</td>
    <td>{{ optional($order->product)->name }}</td>
    <td>{{ optional($order->business)->name }}</td>
    <td>{{ $order->order_time; }}</td>
    <td>{{ $order->dispatch_time; }}</td>
    <td>{{ $order->arrived_time; }}</td>
  </tr>
<?php endforeach; ?>