@extends('layouts.admin.dashboard')

@section('content')
<div class="row">
  <div class="col-sm-3"> <a class="btn btn-wide btn-success" >Pickup Date: {{ date_format(date_create($order[0]->pickup_date), 'g:s A, dS M, Y') }}</a> </div>
  <div class="col-sm-3">
    <?php

		$date = date_create($order[0]->pickup_date);
		date_add($date, date_interval_create_from_date_string($order[0]->shipping_time.' hours'));
          $estimated_delivery_time = date_format($date, 'g:s A, dS M, Y');
	?>

      <a class="btn btn-wide btn-warning" >Estamated Delivery: {{ $estimated_delivery_time }}</a>
  </div>
  <div class="col-sm-4 text-right">

    <?php
    if($order[0]->flag == 9)
    {
          $actual_delivery_date = date_format(date_create($order[0]->delivery_time), 'g:s A, dS M, Y');
          if(strtotime($order[0]->delivery_time) < strtotime(date_format($date, 'Y-m-d H:i:s')))
            $class = "btn-primary";
          else
            $class = "btn-danger";
    ?>
    <a class="btn btn-wide {{ $class }}" >Actual Delivery: {{ $actual_delivery_date }}</a>
    <?php
      }

      ?>
  </div>
  <div class="col-sm-2 text-right"> <strong>Status:</strong>
    <a class="text-primary" data-toggle="modal" href="" data-target="#success-modal">
      @if($order[0]->flag == 0)
        <strong class="badge x-danger">Pending</strong>
      @elseif($order[0]->flag == 1)
        <strong class="badge x-success">Approved</strong>
      @elseif($order[0]->flag == 2)
        <strong class="badge x-warning">Picked Up</strong>
      @elseif($order[0]->flag == 3)
        <strong class="badge x-warning">Dropped Off To {{ findLocationDetails($order[0]->location_id)[0]->location_name }}</strong>
      @elseif($order[0]->flag == 4)
        <strong class="badge x-warning">Transferred To {{ findLocationDetails($order[0]->location_id)[0]->location_name }}</strong>
      @elseif($order[0]->flag == 5)
        <strong class="badge x-warning">Courier Assigned</strong>
      @elseif($order[0]->flag == 18)
        <strong class="badge x-warning">Went for delivery</strong>
      @elseif($order[0]->flag == 19)
        <strong class="badge x-warning">Arrived at hub</strong>
      @elseif($order[0]->flag == 11)
        <strong class="badge x-warning">On Hold</strong>
      @elseif($order[0]->flag == 9)
        <strong class="badge x-warning">Delivered</strong>
      @elseif($order[0]->flag == 10)
        <strong class="badge x-warning">Returned</strong>
      @elseif($order[0]->flag == 14)
        <strong class="badge x-warning">Order Accepted</strong>
      @elseif($order[0]->flag == 15)
        <strong class="badge x-warning">Order Denied</strong>
      @endif
    </a>
  </div>
  <div class="col-sm-3 text-right">

    <?php
    //echo DNS1D::getBarcodeSVG($order[0]->id, "PHARMA2T",3,33,"black");
    //echo "<br>";
    //echo "<code>Barcode: </code><strong>".$order[0]->id."</strong>";
    ?>
  </div>


</div>
<div class="row">
  <div class="row col-sm-9">
    <div class="col-sm-6">
      <div class="panel">
        <div class="panel-header panel-warning">
          <h3 class="panel-title">Sender Information</h3>

        </div>
        <div class="panel-content">
          <ul class="user-contact-info ph-sm">
            <li> <b><i class="color-primary mr-sm fa fa-user"></i></b> <strong>Name:</strong> {{ $order[0]->name  }} </li>
            <li><b><i class="color-primary mr-sm fa fa-envelope"></i></b> <strong>Email:</strong> {{ $order[0]->email  }}</li>
            <li> <b><i class="color-primary mr-sm fa fa-phone"></i></b> <strong>Phone:</strong> @if(false) <a href="#" class="editable_element" id="sender_phone" data-type="text" data-pk="{{ $order[0]->id }}">{{ $order[0]->sender_phone  }}</a> @else

                {{ $order[0]->sender_phone  }}

              @endif </li>
            <li> <b><i class="color-primary mr-sm fa fa-map-marker"></i></b> <strong>Address:</strong> @if(false) <a href="#" class="editable_element" id="sender_street" data-type="text" data-pk="{{ $order[0]->id }}">{{ $order[0]->sender_street  }}</a> @else

                {{ $order[0]->sender_street  }}

              @endif </li>
            <li><b><i class="color-primary mr-sm fa fa-map-marker"></i></b> <strong>District:</strong> {{ $order[0]->sender_district  }}</li>
            <li><b><i class="color-primary mr-sm fa fa-map-marker"></i></b> <strong>Upazilla:</strong> {{ $order[0]->sender_upazilla_name  }}</li>
            <li> <b><i class="color-primary mr-sm fa fa-map-marker"></i></b> <strong>Post Code:</strong> @if(false) <a href="#" class="editable_element" id="sender_zipcode" data-type="text" data-pk="{{ $order[0]->id }}">{{ $order[0]->sender_zipcode  }}</a> @else

                {{ $order[0]->sender_zipcode  }}

              @endif </li>
          </ul>
        </div>
      </div>
    </div>
    <div class="col-sm-6">
      <div class="panel">
        <div class="panel-header  panel-warning">
          <h3 class="panel-title">Receiver Information</h3>
        </div>
        <div class="panel-content">
          <ul class="user-contact-info ph-sm">
            <li> <b><i class="color-primary mr-sm fa fa-user"></i></b> <strong>Name:</strong> @if(false) <a href="#" class="editable_element" id="reciever_name" data-type="text" data-pk="{{ $order[0]->id }}">{{ $order[0]->reciever_name  }}</a> @else

                {{ $order[0]->reciever_name  }}

              @endif </li>
            <li> <b><i class="color-primary mr-sm fa fa-envelope"></i></b> <strong>Email:</strong> @if(false) <a href="#" class="editable_element" id="reciever_email" data-type="text" data-pk="{{ $order[0]->id }}">{{ $order[0]->reciever_email  }}</a> @else

                {{ $order[0]->reciever_email  }}

              @endif </li>
            <li> <b><i class="color-primary mr-sm fa fa-phone"></i></b> <strong>Phone:</strong> @if(false) <a href="#" class="editable_element" id="reciever_phone" data-type="text" data-pk="{{ $order[0]->id }}">{{ $order[0]->reciever_phone  }}</a> @else

                {{ $order[0]->reciever_phone  }}

              @endif </li>
            <li> <b><i class="color-primary mr-sm fa fa-map-marker"></i></b> <strong>Address:</strong> @if(false) <a href="#" class="editable_element" id="reciever_street" data-type="text" data-pk="{{ $order[0]->id }}">{{ $order[0]->reciever_street  }}</a> @else

                {{ $order[0]->reciever_street  }}

              @endif </li>
            <li><b><i class="color-primary mr-sm fa fa-map-marker"></i></b> <strong>District:</strong> {{ $order[0]->receiver_district  }}</li>
            <li><b><i class="color-primary mr-sm fa fa-map-marker"></i></b> <strong>Upazilla:</strong> {{ $order[0]->receiver_upazilla  }}</li>
            <li> <b><i class="color-primary mr-sm fa fa-map-marker"></i></b> <strong>Post Code:</strong> @if(false) <a href="#" class="editable_element" id="reciever_zipcode" data-type="text" data-pk="{{ $order[0]->id }}">{{ $order[0]->reciever_zipcode  }}</a> @else

                {{ $order[0]->reciever_zipcode  }}

              @endif </li>
          </ul>
        </div>
      </div>
    </div>
    <div class="col-sm-12">
      <div class="panel">
        <div class="panel-header panel-success">
          <h3 class="panel-title">Product Information</h3>
        </div>
        <div class="panel-content">
          <?php
          $total_weight = 0;

          ?>
          <div class="table-responsive">
            <form id="itemForm">
              {{ csrf_field() }}
              <input type="hidden" name="order_id" value="{{ $order[0]->id }}">
              <table class="table table-striped table-hover table-bordered" >
                <thead>
                <tr style="background-color: rgb(236,236,236)">
                  <th>Item Name</th>
                  @if($order[0]->payment_method == "Cash on Delivery")
                    <th>SKU</th>
                  @endif
                  <th>Weight</th>
                  <th>Height</th>
                  <th>Width</th>
                  <th>Length</th>
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

                @foreach($items as $item)
                  <?php
                    $total_weight += $item->weight;
                    $total_qty += $item->qty;
                  $total_item_price += $item->item_price;
                  $total_grand_cost += $item->subtotal;
                  ?>
                  <tr>
                    <td>{{ $item->item_name }}</td>
                    @if($order[0]->payment_method == "Cash on Delivery")
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
                    </td>
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
                    <th class="text-right" colspan="9">Net Total</th>
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
                    <th class="text-right" colspan="9">Shipping Cost</th>
                    <th class="text-right">{{ $order[0]->shipping_cost }}</th>
                  </tr>
                  <tr style="background-color: rgb(236,236,236)">
                    <th  class="text-right" colspan="9">Grand Total</th>
                    <th class="text-right">{{ $total_grand_cost+$order[0]->shipping_cost  }}</th>
                  </tr>

                  </tfoot>
                  @endif
              </table>
            </form>
            @if(Auth::user()->role == 1)
              <div class="col-sm-3">
                <!--input class="form-control btn btn-primary" type="submit" value="Edit"-->
              </div>
            @endif </div>
        </div>
      </div>
    </div>

    <div class="col-md-12">
      <div class="panel">
        <div class="panel-header  panel-info">
          <h3 class="panel-title">Location map View</h3>
        </div>
        <div class="panel-content">

          <div id="map"></div>
        </div>
      </div>
    </div>
    <div class="col-md-12">
      <div class="panel">
        <div class="panel-header  panel-info">
          <h3 class="panel-title">Distance and Driving Instruction</h3>
        </div>
        <div class="panel-content">
          <div id="right-panel">
            <p><strong>Total Distance: <span id="total"></span></strong></p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-3">
    <div class="panel">
      <div class="panel-header panel-success">
        <h3 class="panel-title">Order Summary</h3>
      </div>
      <div class="panel-content">
        <ul class="user-contact-info ph-sm">
            <li><b>Tracking Number: </b> {{ $order[0]->id }} </li>
          @if($total_weight != 0)
            <li><b>Total Wight: </b> {{ $total_weight }} Kg</li>
          @endif
          <li><b>Total Items: </b> {{ count($items) }} Item(s)</li>
          <li><b>Payment Method: </b> {{ $order[0]->payment_method  }}</li>
          <li><b>Estimated Delimery Time </b> {{ $order[0]->shipping_time  }} Hour</li>
            @if($order[0]->payment_method != "Cash on Delivery")
              <li><b>Delivery Charge: </b> <code>{{ $order[0]->price  }} Tk.</code></li>
            @endif

        </ul>
        <a class="btn btn-wide btn-danger" href="{{ url('print/receipt/'.$order[0]->id) }}" target="_blank" ><span class="fa fa-print"></span> Print</a>
      </div>
    </div>
  </div>
  <div class="row col-sm-3">
    <div class="timeline">
      <?php
        $icons = [
                'fa-adjust',
                'fa-anchor',
                'fa-archive',
                'fa-arrows',
                'fa-barcode',
                'fa-phone',
                'fa-asterisk',
                'fa-at',
                'fa-automobile',
                'fa-ban',
                'fa-bed',
                'fa-beer',
                'fa-bell',
                'fa-bicycle',
                'fa-binoculars',
                'fa-blind',
                'fa-bolt',
        ];
      ?>
      @foreach($order_statuses as $key=>$status)
        <div class="timeline-box">
        <div class="timeline-icon bg-primary">
          <i class="fa {{ $icons[$key] }}"></i>
        </div>
        <div class="timeline-content">
          <strong>{{ $status->status_title }}</strong>
          @if($status->status_type == 15)
            <br><code>Reason: {{ $status->description }}</code>
          @endif
        </div>
        <div class="timeline-footer">
          <span>{{ date_format(date_create($status->created_at), 'dS M, Y g:s A') }}</span>
        </div>
      </div>
      @endforeach
    </div>

  </div>
  @if(count($complains) > 0)
    <div class="col-md-3">
    <div class="panel">
      <div class="panel-header panel-success">
        <h3 class="panel-title">Customer Complains</h3>
      </div>
      <div class="panel-content">
        <ol class="user-contact-info ph-sm">
          
          @foreach($complains as $complain)
            <li>
              {{ $complain->details }} 
              @if($complain->flag == '0')
                <strong class="badge x-danger">Unresolved</strong>
              @elseif($complain->flag == '1')
                <strong class="badge x-success">Resolved</strong>
              @endif
            </li>
          @endforeach

        </ul>
      </div>
    </div>
  </div>
  @endif
</div>

<div class="row">
  <div class="col-sm-6">
    <div class="panel">

    </div>
  </div>
  <div class="col-sm-6">

  </div>
</div>
<style>
#map {
	height:400px;
  }
</style>
<script>

      function initMap() {

        var map = new google.maps.Map(document.getElementById('map'), {

          zoom: 6,

          center: {lat: 23.7561, lng: 90.3872}  // Bangladesh.

        });



        var directionsService = new google.maps.DirectionsService;

        var directionsDisplay = new google.maps.DirectionsRenderer({

          draggable: true,

          map: map,

          panel: document.getElementById('right-panel')

        });



        directionsDisplay.addListener('directions_changed', function() {

          computeTotalDistance(directionsDisplay.getDirections());

        });



        displayRoute('{{ $order[0]->sender_street }} {{ $order[0]->sender_upazilla_name }} {{ $order[0]->sender_district }}', '{{ $order[0]->reciever_street  }}, {{ $order[0]->receiver_upazilla }} {{ $order[0]->receiver_district }}', directionsService, directionsDisplay);

      }



      function displayRoute(origin, destination, service, display) {

        service.route({

          origin: origin,

          destination: destination,

          /*waypoints: [{location: 'Adelaide, SA'}, {location: 'Broken Hill, NSW'}],*/

          travelMode: 'DRIVING',

          avoidTolls: true

        }, function(response, status) {

          if (status === 'OK') {

            display.setDirections(response);

          } else {

            alert('Could not display directions due to: ' + status);

          }

        });

      }



      function computeTotalDistance(result) {

        var total = 0;

        var myroute = result.routes[0];

        for (var i = 0; i < myroute.legs.length; i++) {

          total += myroute.legs[i].distance.value;

        }

        total = total / 1000;

        document.getElementById('total').innerHTML = total + ' km';

      }

    </script>
<script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCQAuKSPQX1pwWUMf9nZF5xBEoESF41_WQ&callback=initMap">
    </script>
<div class="modal fade" id="success-modal" tabindex="-1" role="dialog" aria-labelledby="modal-success-label" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header state modal-success">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="modal-success-label"><i class="fa fa-anchor"></i>Change Order Status</h4>
      </div>
      <div class="modal-body">
        <form role="form" name="userRegistrationForm" id="userRegistrationForm" novalidate>
          {{ csrf_field() }}
          <div class="form-group-attached">
            <div class="row">
              <div class="col-sm-6">
                <div class="form-group form-group-default">
                  <label>Status<span style="color:red">*</span></label>
                  <select class="form-control" id="order_order_status" order_id="{{ $order[0]->id }}">
                    <option value="-1">Select Order Status</option>
                    @if($order[0]->flag != 1 && isCourier(Auth::user()->email) == 0)
                      <option value="1">Approved</option>
                    @endif

                    @if(isManager(Auth::user()->id) == 1)
                      <option value="19">Arrived at hub</option>
                    @endif
                    @if(isCourier(Auth::user()->email))
                      <option value="2">Picked Up</option>
                      <option value="3">Dropped Off</option>
                      <option value="4">Transferred</option>
                      <option value="9">Delivered</option>
                    @endif


                    <option value="11">On Hold</option>
                    <option value="18">Went for delivery</option>
                    <option value="10">Returned</option>
                  </select>
                  <select class="form-control" id="location_id" order_id="{{ $order[0]->id }}" style="display: none;">
                    <option value="0">Select Branch/Hub</option>

                    @foreach($locations as $location)
                      <option value="{{ $location->id }}">{{ $location->location_name }}</option>
                    @endforeach
                  </select>

                </div>
              </div>
            </div>
          </div>
        </form>
      </div>

      <div class="modal-footer"> <a type="button" class="btn btn-success"  id="order_status">Ok</a> <a type="button" class="btn btn-default" data-dismiss="modal">Close</a> </div>
    </div>
  </div>
</div>
@endsection