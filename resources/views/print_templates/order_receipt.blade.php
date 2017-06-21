
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>A simple, clean, and responsive HTML invoice template</title>
    <style>
        .invoice-box {
            max-width: 400px;
            margin: auto;
            /*padding: 5px;*/
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, .15);
            font-size: 12px;
            line-height: 24px;
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: #555;
        }
        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
        }
        .invoice-box table td {
            padding: 5px;
            vertical-align: top;
        }
        .invoice-box table tr td:nth-child(2) {
            text-align: right;
        }
        .invoice-box table tr.top table td {
            padding-bottom: 20px;
        }
        .invoice-box table tr.top table td.title {
            font-size: 45px;
            line-height: 45px;
            color: #333;
        }
        .invoice-box table tr.information table td {
            padding-bottom: 10px;
        }
        .invoice-box table tr.heading td {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }
        .invoice-box table tr.details td {
            padding-bottom: 20px;
        }
        .invoice-box table tr.item td {
            border-bottom: 1px solid #eee;
        }
        .invoice-box table tr.item.last td {
            border-bottom: none;
        }
        .invoice-box table tr.total td:nth-child(2) {
            border-top: 2px solid #eee;
            font-weight: bold;
        }

        @media only screen and (max-width: 600px) {
            .invoice-box table tr.top table td {
                width: 100%;
                display: block;
                text-align: center;
            }
            .invoice-box table tr.information table td {
                width: 100%;
                display: block;
                text-align: center;
            }
        }
    </style>
</head>

<body onload="window.prdint();">
<div class="invoice-box">
    <table cellpadding="0" cellspacing="0" border="0" width="20%">
        <tr class="top">
            <td colspan="2">
                <table cellpadding="0" cellspacing="0">
                    <tr>
                       {{-- <td></td>--}}
                        <td><br>

                        </td>
                        <td align="left">
                            <img src="http://operations.nrbxpress.com/public/img/logo.png"><br>
                            <?php
                            echo DNS1D::getBarcodeSVG($order[0]->id, "PHARMA2T",3,33,"black");
                            ?><br>
                                Invoice #: {{ $order[0]->id }}<br>
                            Created: {{ Date('M d, Y') }}<br>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr class="information">
            <td colspan="2">
                <table>
                    <tr class="heading">
                        {{-- <td>Sender</td>--}}
                        <td>Sender Details</td>
                    </tr>
                    <tr>
                        {{--<td>
                            --}}{{--{{$order[0]->customer_name}}<br>--}}{{--
                            --}}{{--<strong>Mobile:</strong> {{$order[0]->sender_phone}}<br>
                            <strong>Email:</strong> {{$order[0]->customer_email}}--}}{{--
                        </td>--}}
                        <td>
                            {{$order[0]->customer_name}}<br>
                            <strong>Mobile:</strong> {{$order[0]->sender_phone}}<br>
                            <strong>Email:</strong> {{$order[0]->customer_email}}<br>
                            <strong>Address:</strong> {{$order[0]->sender_street}} {{$order[0]->sender_district}}


                        </td>
                    </tr>
                    <tr class="heading">
                        {{-- <td>Sender</td>--}}
                        <td>Receiver Details</td>
                    </tr>
                    <tr>
                        {{--<td>
                            --}}{{--{{$order[0]->customer_name}}<br>--}}{{--
                            --}}{{--<strong>Mobile:</strong> {{$order[0]->sender_phone}}<br>
                            <strong>Email:</strong> {{$order[0]->customer_email}}--}}{{--
                        </td>--}}
                        <td>
                            {{$order[0]->reciever_name}}<br>
                            <strong>Mobile:</strong> {{$order[0]->reciever_phone}}<br>
                            <strong>Email:</strong> {{$order[0]->reciever_email}}<br>
                            <strong>Address:</strong> {{$order[0]->reciever_street}} {{$order[0]->receiver_district}}
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr class="heading">
            {{--<td> Payment Method </td>--}}
            <td> Estimated Delivery Time </td>
            <?php

            $date = date_create($order[0]->pickup_date);
            date_add($date, date_interval_create_from_date_string($order[0]->shipping_time.' hours'));
            $estimated_delivery_time = date_format($date, 'g:s A, dS M, Y');


            ?>
        </tr>
        <tr class="details">
            {{--<td> {{$order[0]->payment_method}} </td>--}}
            <td> {{ $estimated_delivery_time  }}  </td>
        </tr>
        <tr class="heading">
            <td> Item  Details</td>
           {{-- <td></td>--}}
        </tr>
        <tr>
            <td colspan="2">
                <?php
                //$items = unserialize($order[0]->shipment_info);
                $total_weight = 0;
                ?>
                    <table class="table table-striped table-hover table-bordered" >
                        <thead>
                        <tr style="background-color: rgb(236,236,236)">
                            <th>Item Name</th>
                            {{--@if($order[0]->payment_method == "Cash on Delivery")
                                <th>SKU</th>
                            @endif
                            <th>Weight</th>
                            <th>Height</th>
                            <th>Width</th>
                            <th>Length</th>--}}
                            <th>Qty</th>
                            @if($order[0]->payment_method == "Cash on Delivery")

                                <th>Unit Price</th>
                                <th>Discount</th>
                                <th class="text-right">Subtotal(Tk.)</th>
                            @endif
                        </tr>

                        </thead>
                        <tbody>
                        <?php

                        $total_weight = 0;
                        $total_qty = 0;
                        $total_item_price = 0;
                        $total_grand_cost = 0;
                        ?>

                        @foreach($item_details as $key=>$item)
                            <?php
                            $total_weight += $item->weight;
                            $total_qty += $item->qty;
                            $total_item_price += $item->item_price;
                            $total_grand_cost += $item->subtotal;
                            ?>
                            <tr>
                                <td>{{ $item->item_name }}</td>
                                {{--@if($order[0]->payment_method == "Cash on Delivery")
                                    <td>{{ $item->sku }}</td>
                                @endif

                                <td>
                                    @if($item->weight > 0)
                                        {{ $item->weight }}
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>
                                    @if($item->height > 0)
                                        {{ $item->height }}
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>
                                    @if($item->width > 0)
                                        {{ $item->width }}
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>
                                    @if($item->length > 0)
                                        {{ $item->length }}
                                    @else
                                        -
                                    @endif
                                </td>--}}
                                <td>
                                    @if($item->qty > 0)
                                        {{ $item->qty }}
                                    @else
                                        -
                                    @endif
                                </td>
                                @if($order[0]->payment_method == "Cash on Delivery")
                                    <td>
                                        @if($item->item_price > 0)
                                            {{ $item->item_price }}
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>
                                        @if($item->discount > 0)
                                            {{ $item->discount }}
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td class="text-right">
                                        @if($item->subtotal > 0)
                                            {{ $item->subtotal }}
                                        @else
                                            -
                                        @endif
                                    </td>
                                @endif
                                {{--<td>
                                  @if($item->total_cost > 0)
                                    {{ $item->total_cost }}
                                  @else
                                    -
                                  @endif
                                </td>--}}
                            </tr>
                        @endforeach

                        </tbody>
                        @if($order[0]->payment_method == "Cash on Delivery")
                            <tfoot>
                            <tr style="background-color: rgb(236,236,236)">
                                <th class="text-right" colspan="4">Net Total</th>
                                {{--<th>
                                  @if($total_qty > 0)
                                    {{ $total_qty }}
                                  @else
                                    -
                                  @endif
                                </th>
                                <th>
                                  @if($total_weight > 0)
                                    {{ $total_weight }}
                                  @else
                                    -
                                  @endif
                                </th>
                                <th>
                                  @if($total_item_price > 0)
                                    {{ $total_item_price }}
                                  @else
                                    -
                                  @endif
                                </th>--}}
                                <th class="text-right">{{ $total_grand_cost }}</th>
                            </tr>

                            <tr style="background-color: rgb(236,236,236)">
                                <th class="text-right" colspan="4">Shipping Cost</th>
                                <th class="text-right">{{ $order[0]->shipping_cost }}</th>
                            </tr>
                            <tr style="background-color: rgb(236,236,236)">
                                <th  class="text-right" colspan="4">Grand Total</th>
                                <th class="text-right">{{ $total_grand_cost+$order[0]->shipping_cost  }}</th>
                            </tr>

                            </tfoot>
                        @endif
                    </table>
            </td>
        </tr>
        <tr class="heading">
       {{--     <td></td>--}}
            @if($order[0]->payment_method != "Cash on Delivery")
                <td> Total: {{ $order[0]->price  }} Tk. </td>
            @endif

        </tr>
    </table>
</div>
</body>
</html>
