@extends('frontend.layouts.app')

@section('title')
  SAHULAT | Update Task
@endsection
@section('custom-styles')
	<style type="text/css">
	.update-task-container{
		width: 85%;
		margin: auto;
		margin-top: 10%;
		margin-bottom: 10%;
	}
	.update-task-row{
		margin-top: 2%;
	}
	.chat-link{
    color: green; font-size: 120%;
  }
	</style>
@endsection
@section('content')
  <form method="POST" action="{{route('saveChanges', $task->id)}}">
    @csrf
   <!-- <input type="hidden" name="_method" value="PUT"> -->
   <!-- <input type="hidden" name="user_id" value="$task->user_id">
   <input type="hidden" name="service_id" value="$task->service_id">
   <input type="hidden" name="vendor_id" value="$task->vendor_id">
   <input type="hidden" name="employee_id" value="$task->employee_id"> -->
   


	<div class="applications-content update-task-container">
             	<div class="row update-task-row">
                    <div class="col-md-1 col-sm-2 col-xs-2">
                      <div class="thums">
                        <img src="assets/img/car-wash.jpg" class="img-circle" style="width: 70px; height: 70px; padding-top: 15%">
                      </div>
                    </div>
                    <div class="col-md-2 col-sm-3 col-xs-3">
                      <h3>{{ $task->service->title }}</h3>
                      <span>{{ $task->service->description }}</span>
                      <br>
                      <a>&nbsp</a>
                    </div>
                    <div class="col-md-1 col-sm-2 col-xs-2">
                      <div class="thums">
                        <img src="assets/img/testimonial/img1.jpg" class="img-circle" style="width: 70px; height: 70px; padding-top: 15%">
                      </div>
                    </div>
                    <div class="col-md-1 col-sm-3 col-xs-3">
                      <h3>Customer</h3>
                      <span>{{ $task->user->name }}</span>
                      <br>
                      <a href="chat" class="chat-link">Chat</a>
                    </div>
                    <div class="col-md-2 col-sm-2 col-xs-2">
                      <h3>Deadline</h3>
                      <input type="date" class="form-control" name="deadline" value="{{$task->deadline}}">
                    </div>
                    <div class="col-md-2 col-sm-6 col-xs-12">
                    	<div class="form-group">
                        <label>Budget</label>
    						<input type="number" name="budget" class="form-control" placeholder="$ Enter Budget Here"
                value="{{$task->budget}}">
  						</div>
                    </div>
                    <div class="col-md-2 col-sm-6 col-xs-12">
                      <div class="form-group">
                        <label>Budget</label>
                      	<select class="form-control" name="status">
						    <option value="pending">Pending</option>
						    <option value="In Progress">In Progress</option>
						    <option value="complete">Complete</option>
						 </select>
						</div>
                    </div>
                </div>
                <div class="row update-task-row">
                    <div class="col-md-6 col-sm-6 col-xs-6">
                      <a href="route('saveChanges')">
                        <button class="btn btn-primary" style="float: right;">Update</button>
                      </a>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-6">
                      <button class="btn btn-danger">Cancel</button>
                    </div>
                </div>
     </div>
</form>
@endsection
