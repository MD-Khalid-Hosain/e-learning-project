<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
<style>
table {
  border-collapse: collapse;
  width: 100%;
  border: 1px solid black;
}
.total{
    text-align: right;

}
.right{
    display: inline-block;
    margin-left: 200px;
    padding-bottom: 0;
    margin-bottom:0;
}
.left{
    display: inline-block;
    margin-bottom: 50px;
}
.khalid{
    padding: 50px;
}

th, td {
  text-align: left;
  padding: 8px;
  border: 1px solid black;
}

tr:nth-child(even){background-color: #f2f2f2}

th {
  background-color: #2A2F8C;
  color: white;
  border: 1px solid black;
}
</style>
</head>
<body>
    <div class="left">
        <img src="{{ asset('frontend/assets/images/logo/original.png') }}" alt="">
        <div class="khalid"></div>

    </div>
<div class="right">
    <h2>Original Store Ltd.</h2>
<p>
    Shop# 104 & 113, (Ground Floor)
    Plot# 10,<br>Taher Tower Shopping Center,<br>
    Gulshan Circle-2, Dhaka-1212
    Call: 01762693585
</p>
</div>

<table>
  <tr>
    <th>Component</th>
    <th>Product</th>
    <th>Price</th>
  </tr>
  @php
      $total = 0;
  @endphp
  @foreach ($pcBuildProduct as $item)
    <tr>
      <td>{{ App\PCComponent::where('id',$item->component_id )->value('component_name') }}</td>
      <td>{{ App\Product::where('id',$item->product_id)->value('product_name') }}</td>
      <td>{{ App\Product::where('id',$item->product_id)->value('price') }} Tk</td>
    </tr>
    @php
      $total = $total+ App\Product::where('id',$item->product_id)->value('price');
  @endphp
@endforeach
<tr>
    <td class="total" colspan="2">Total</td>
    <td>{{ $total }} Tk</td>
</tr>

</table>

</body>
</html>
