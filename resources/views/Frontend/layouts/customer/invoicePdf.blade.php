<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>{{ $order_no->transaction_id }}</title>
    <style media="screen">
    .clearfix:after {
content: "";
display: table;
clear: both;
}
a {
color: #5D6975;
text-decoration: underline;
}
body {
position: relative;
width: 18cm;
height: 29.7cm;
margin: 0 auto;
color: #001028;
background: #FFFFFF;
font-family: DejaVu Sans;
font-size: 12px;
}
header {
padding: 10px 0;
margin-bottom: 30px;
}
#logo {
text-align: center;
margin-bottom: 10px;
}

h1 {
border-top: 1px solid  #5D6975;
border-bottom: 1px solid  #5D6975;
color: #5D6975;
font-size: 2.4em;
line-height: 1.4em;
font-weight: normal;
text-align: center;
margin: 0 0 20px 0;
background: url(dimension.png);
}
#project {
float: left;
}
#project span {
color: #5D6975;
text-align: left;
width: 70px;
margin-right: 20px;
display: inline-block;
font-size: 0.8em;
}
#project div{
white-space: nowrap;
}
table {
width: 100%;
border-collapse: collapse;
border-spacing: 0;
margin-bottom: 10px;
}
table tr:nth-child(2n-1) td {
background: #F5F5F5;
}
table th,
table td {
text-align: center;
}
table th {
padding: 5px;
color: #5D6975;
border: 1px solid #5D6975;
white-space: nowrap;
font-weight: normal;
}
table .service,
table .desc {
text-align: left;
}
table td {
padding: 20px;
text-align: right;
border: 1px solid #5D6975;
}
table td.service,
table td.desc {
vertical-align: top;
}
table td.unit,
table td.qty,
table td.total {
font-size: 1.2em;
border: 1px solid #5D6975;
}
table td.grand {
border-top: 1px solid #5D6975;;
}
#notices .notice {
color: #5D6975;
font-size: 1.2em;
}
footer {
color: #5D6975;
width: 100%;
height: 30px;
position: absolute;
bottom: 0;
border-top: 1px solid #C1CED9;
padding: 8px 0;
text-align: center;
}
    </style>
  </head>
  <body>

     <a href="{{ url('/') }}" target="_blank"><img src="{{ asset('frontend/assets/images/logo/original.png') }}" alt=""></a>

    <header class="clearfix">
         <h1>ORIGINAL STORE LTD.</h1>
      <div id="logo">
          {{-- <img src="{{ asset('frontend/assets/images/logo/original.png') }}"> --}}
          <pre>Shop# 104 & 113, (Ground Floor) Plot# 10,Taher Tower Shopping Center,
              Gulshan Circle-2, Dhaka-1212
              Call: 01762693585</pre>
        </div>

      <div id="project">
        <div><span>Order No.</span> {{ $order_no->transaction_id }}</div>
        <div><span>Client</span> {{ $order_no->name }}</div>
        <div><span>Delivery Address</span> {{ $order_no->delivery_address }}</div>
        <div><span>Email</span>{{ $order_no->email }}</div>
        <div><span>Mobile</span>{{ $order_no->phone }}</div>
        <div><span>Date</span>{{ $order_no->created_at->translatedFormat('d, F, Y') }}</div>
        <div><span>Status</span>{{ $order_no->status }}</div>
      </div>
    </header>
    <main>
      <table>
        <thead>
          <tr>
            <th class="service">SL.</th>
            <th class="service">Product Name</th>
            <th>QTY</th>
            <th>Unit Price</th>
            <th>Total</th>
          </tr>
        </thead>
        <tbody>
            @php
                $total_price=0;
            @endphp
            @foreach ($order_details as $order_item)
            <tr>
                <td class="service">{{ $loop->index + 1 }}</td>
                <td class="service">{{ App\Product::where('id', $order_item->product_id)->value('product_name') }}</td>
                <td class="qty">{{ $order_item->quantity }}</td>
                <td class="desc">{{ $order_item->price }} Tk</td>
                <td class="total">{{ $order_item->quantity * $order_item->price  }} Tk</td>
            </tr>

            @php
                $total_price = $total_price + ($order_item->quantity * $order_item->price);
            @endphp
          @endforeach


          <tr>
            <td colspan="4">Subtotal</td>
            <td class="total">{{ $total_price }} Tk</td>
          </tr>
          <tr>
            <td colspan="4">Delivery Carge</td>
            @if ($order_no->city == 'in_side_dhaka')
            <td class="total"> 100 Tk</td>
            @else
            <td class="total"> 200 Tk</td>
            @endif
          </tr>

          <tr>
            <td colspan="4" class="grand total">Grand Total</td>
            <td class="grand total">{{ $order_no->amount }} Tk</td>
          </tr>
        </tbody>
      </table>

    @isset($coupon_name)
       <div id="notices">
        <div>Coupon: Your Coupon Code is {{ $coupon_name->coupon }}</div>
        <div class="notice"><p style=" font-size:20px">@isset($coupon_name->product_id)<span style="color:red; font-weight:bold">Congratulations !!</span> You got <span style="font-weight: bold; color:red;"> @isset($coupon_name->percentage) {{ $coupon_name->percentage }} % @else {{ $coupon_name->max_amount  }}Tk @endisset </span> Discount in this {{  App\Product::find($coupon_name->product_id)->product_name   }} product @else <span style="color:red; font-weight:bold">Congratulations !!</span> You got <span style="font-weight: bold; color:red;"> @isset($coupon_name->percentage) {{ $coupon_name->percentage }} % @else {{ $coupon_name->max_amount  }}Tk @endisset </span> Discount on Total @endisset </p></div>
      </div>
      @endisset
      <div id="notices">
        <div>Notice: </div>
        <div class="notice">**Products once sold can not be replaced or returned. Thanks for being with us.</div>
      </div>
    </main>
    <footer>
      Invoice was created on a computer and is valid without the signature and seal.
    </footer>
  </body>
</html>
