@extends('backend.layout.app')
@section('content')
@section('custom-styles')
    <style type="text/css">
    .errors { color: red; display: inline;}
    .custom-switch { display: inline; }
    .frequency { display: none; }
    .requirements { display: none; }
    </style>
@endsection
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Add New Service</h1>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <section id="content">
                    <div class="container" style="width: 70%;">
                        <form method="post" action="{{ route('storeSahulatService') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label>Service Title</label>  @error('title') <p class="errors"> {{ $message }} </p> @enderror
                                <input name="title" type="text" value="{{old('title')}}" class="form-control" placeholder="Service Title" required="true">
                            </div>
                            <div class="form-group">
                                <label>Is subscription available for this service ?</label>
                                <div class="custom-control custom-switch">
                                  <input type="checkbox" class="custom-control-input" id="subscription-switch">
                                  <label class="custom-control-label" id="subscription-switch-label" for="subscription-switch">No</label>
                                </div>
                            </div>
                            <div class="form-group frequency">
                                @error('frequency') <p class="errors"> {{ $message }} @enderror
                                <input name="frequency" type="text" value="{{old('frequency')}}" class="form-control" placeholder="Subscription frequency in days. e.g. 1, 7, 30, 180, 365 etc">
                            </div>
                            <div class="form-group">
                                <label>Service Charges (Rs)</label> @error('charges') <p class="errors"> {{ $message }} @enderror
                                <input name="charges" type="text" value="{{old('charges')}}" class="form-control"  placeholder="Service Charges (Rs)" required="true">
                            </div>
                            <div class="form-group">
                                <button class="btn btn-common">Add Service image</button>
                                <input name="service_image" type="file"> @error('service_image') <p class="errors"> {{ $message }} @enderror
                            </div>
                            <div class="form-group"> 
                                <label>Description (Max: 255 Characters)</label> @error('description') <p class="errors"> {{ $message }} @enderror
                                <textarea name="description" class="form-control" rows="5" required="true">{{old('description')}}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Are there any docuements required from the customer ?</label>
                                <div class="custom-control custom-switch">
                                  <input type="checkbox" class="custom-control-input" id="requirements-switch">
                                  <label class="custom-control-label" id="requirements-switch-label" for="requirements-switch">No</label>
                                </div>
                            </div>
                            <div class="form-group requirements">
                                @error('requirements') <p class="errors"> {{ $message }} @enderror
                                <input name="requirements" type="text" placeholder="Enter Requirements (e.g. CNIC, Passport etc)" value="{{old('requirements')}}" class="form-control">
                            </div>
                            <div class="form-group">
                                <input name="submit" class="btn btn-primary" type="submit" value="Add Service" style="width: 100%;">
                            </div>
                        </form>
                    </div>
                </section>
            </div>
        </section>
    </div>

@section('custom-scripts')
    <script type="text/javascript">
        $('#subscription-switch').change(function(){
            if($('#subscription-switch').is(':checked') == true){
                $('#subscription-switch-label').html('Yes');
                $('.frequency').show();
            }else{
                $('#subscription-switch-label').html('No');
                $('.frequency').hide();
            }
        });

        $('#requirements-switch').change(function(){
            if($('#requirements-switch').is(':checked') == true){
                $('#requirements-switch-label').html('Yes');
                $('.requirements').show();
            }else{
                $('#requirements-switch-label').html('No');
                $('.requirements').hide();
            }
        });
    </script>
@endsection
@endsection
