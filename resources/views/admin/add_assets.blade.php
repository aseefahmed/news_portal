@extends('layouts.admin.dashboard')

@section('content')
<style type="text/css">
.item-list-textbox {
    background-color: #fff;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-shadow: 0 1px 1px rgba(0, 0, 0, 0.075) inset;
    height: 34px;
    padding: 6px 12px;
    transition: border-color 0.15s ease-in-out 0s, box-shadow 0.15s ease-in-out 0s;
	width:65%;
}
.item-list-textbox{
	float:right;
}
.add-assets .checkbox-custom{
	width:auto;
	overflow:hidden;
}
</style>

<div class="col-sm-12">
    <div class="panel">
        <div class="panel-content">
            <div class="alert alert-warning m-none">
                <i class="fa fa-exclamation-circle mr-sm text-md"></i> <strong>Courier Assets List Form</strong> 
            </div>
        </div>
    </div>
</div>

<div class="row"> 
    @if(count($errors))
    <div class="alert alert-danger"> <strong>Whoops!</strong> There were some problems with your input. <br/>
      <ul>
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
    @endif
      
  @if(Session::has('status'))
    <div class="row">
        <div class="alert alert-success">
            {{session('status')}}
        </div>
    </div>        
  @endif
    
  @if (session('status'))
    <div class="alert alert-success">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> {{ session('status') }}
    </div>
  @endif
  
  @if(session()->has('status'))
    <div class="alert alert-success">
        {{ session()->get('status') }}
    </div>
  @endif
  
</div>

<form class="form-stripe" method="post" action="">
{{ csrf_field() }}
  <div class="col-md-5">
    <div class="panel  b-primary bt-sm">
      <div class="panel-header">
        <h5 class="panel-title">Basic Information</h5>
      </div>

      <div class="panel-content">
        <div class="form-group">
          <label>Courier <span style="color:red">*</span></label>
          <select class="form-control" name="courier_id" id="courier_id">
            <option value="">Select a courier</option>
            <?php
			$i = 0;
			foreach($couriers as $courier){
				if(isCourierGotCycle($courier->id) == 0){
					$i++;
					echo "<option value=".$courier->id.">$courier->first_name $courier->last_name </option>";
				}
			}
			?>
          </select>
          <span class="text-danger">{{ $errors->first('courier_id') }}</span>
        </div>
        <div class="form-group  {{ $errors->has('courier_id') ? 'has-error' : '' }}">
          <label>Given Date <span style="color:red">*</span></label>
          <div class="input-group"> <span class="input-group-addon x-primary"><i class="fa fa-calendar"></i></span>
            <input class="form-control default_datetimepicker_without_time" name="given_date" id="this_given_date" type="text">
          </div>
           @if ($errors->has('given_date'))
                <span class="help-block">
                    <strong>{{ $errors->first('given_date') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group">
          <label for="textareaMaxLength" class="control-label">Comments</label>
          <textarea class="form-control" rows="3" name="comments" id="textareaMaxLength" placeholder="Write a comment" maxlength="255"></textarea>
          <span class="help-block"><i class="fa fa-info-circle mr-xs"></i>Max characters set to <span class="code">255</span></span> </div>
      </div>
    </div>
  </div>
  <div class="col-md-7">
    <div class="panel b-primary bt-sm  add-assets">
      <div class="panel-header">
        <h5 class="panel-title">Given Assets to a Courier</h5>
      </div>
      <div class="panel-content" style="height:520px">
        <div class="form-group">
          <div class="col-sm-12">
            <div class="form-group">
             <div class="checkbox-custom checkbox-primary">
                <input id="check-h1" name="item_name[]" value="Bycycle" type="checkbox">
                <label class="check" for="check-h1">Bycycle</label>
                <input class="item-list-textbox" id="item_description1" name="item_description[]" placeholder="Bycycle Description" maxlength="255" type="text">
              </div>
            </div>
            <div class="form-group">
              <div class="checkbox-custom checkbox-primary">
                <input id="check-h2" name="item_name[]" value="Mobile Printer" type="checkbox">
                <label class="check" for="check-h2">Mobile Printer</label>
                <input class="item-list-textbox" id="item_description2" name="item_description[]" placeholder="Mobile Printer Description" maxlength="255" type="text">
              </div>
            </div>
            <div class="form-group">            
            <div class="checkbox-custom checkbox-primary">
                <input id="check-h3" name="item_name[]" value="Mobile Phone" type="checkbox">
                <label class="check" for="check-h3">Mobile Phone</label>
                <input class="item-list-textbox" id="item_description3" name="item_description[]" placeholder="Mobile Phone Description" maxlength="255" type="text">
              </div>
            </div>
            <div class="form-group">            
            <div class="checkbox-custom checkbox-primary">
                <input id="check-h4" name="item_name[]" value="Mobile Accessories" type="checkbox">
                <label class="check" for="check-h4">Mobile Accessories</label>
                <input class="item-list-textbox" id="item_description4" name="item_description[]" placeholder="Mobile Accessories Description" maxlength="255" type="text">
              </div>
            </div>
            <div class="form-group">
            <div class="checkbox-custom checkbox-primary">
                <input id="check-h5" name="item_name[]" value="Power Bank" type="checkbox">
                <label class="check" for="check-h5">Power Bank</label>
                <input class="item-list-textbox" id="item_description5" name="item_description[]" placeholder="Power Bank Description" maxlength="255" type="text">
              </div>
            </div>
            <div class="form-group">
            <div class="checkbox-custom checkbox-primary">
                <input id="check-h6" name="item_name[]" value="Uniform" type="checkbox">
                <label class="check" for="check-h6">Uniform</label>
                <input class="item-list-textbox" id="item_description6" name="item_description[]" placeholder="Uniform Description" maxlength="255" type="text">
              </div>
            </div>
            <div class="form-group">
            <div class="checkbox-custom checkbox-primary">
                <input id="check-h7" name="item_name[]" value="Security Money" type="checkbox">
                <label class="check" for="check-h7">Security Money</label>
                <input class="item-list-textbox" id="item_description7" name="item_description[]" placeholder="Security Money Description" maxlength="255" type="text">
              </div>
            </div>
            <div class="form-group">
            <div class="checkbox-custom checkbox-primary">
                <input id="check-h8" name="item_name[]" value="Others" type="checkbox">
                <label class="check" for="check-h8">Others</label>
                <input class="item-list-textbox" id="item_description8" name="item_description[]" placeholder="Others Description" maxlength="255" type="text">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-3 col-sm-9">
      <button type="submit" class="btn btn-primary"> <i class="fa fa-check"></i> Add Assets Information</button>
    </div>
  </div>
</form>
@endsection