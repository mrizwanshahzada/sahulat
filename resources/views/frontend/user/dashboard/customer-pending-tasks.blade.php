@extends('frontend.user.layouts.app')

@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Pending Tasks</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Customer Dashboard</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div id="content">
                <div class="container applications-content">
                  @if(count($tasks)>0)
                 <table class="table table-bordered">
                    <thead class="thead-dark">
                      <tr>
                        <th scope="col">Title</th>
                        <th scope="col">Employee / Vendor</th>
                        <th scope="col">Start Date</th>
                        <th scope="col">Deadline</th>
                        <th scope="col">Budget</th>
                        <th scope="col">Status</th>
                        <th scope="col" class="text-center">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($tasks as $task)

                        <tr>
                          <th scope="row">{{ $task->service->title }}</th>
                          <td>
                            @if($task->employee_id != null)
                             {{ $task->employee->user->name }}
                             @else
                             {{ $task->vendor->user->name }}
                             @endif
                          </td>
                          <td>{{ $task->created_at }}</td>
                          <td>{{ $task->deadline }}</td>
                          <td>{{ $task->budget }}</td>
                          <td>{{ $task->status }}</td>
                          <td>
                            <a href="{{route('userDeletePendingTask',$task)}}" class="btn btn-danger btn-sm">Cancel</a>
                          </td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                 @endif
                 @if(count($tasks)<=0)
                   <div> <h5>You have not pending task</h5></div>
                 @endif
               </div>
            </div>
        </section>

        
        <!-- /.content --->
    </div>

@endsection
