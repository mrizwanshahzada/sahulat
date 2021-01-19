@extends('frontend.user.layouts.app')

@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Completed Tasks</h1>
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
                 <table class="table table-bordered">
                  @if(count($tasks)>0)
                    <thead class="thead-dark">
                      <tr>
                        <th scope="col">Title</th>
                        <th scope="col">Employee / Vendor</th>
                        <th scope="col">Start Date</th>
                        <th scope="col">Finish Date</th>
                        <th scope="col">Budget</th>
                        <th scope="col">Status</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($tasks as $task)
                        <tr>
                          <th scope="row">{{ $task->service->title }}</th>
                          <td>
                            
                            @if($task->employee_id!=NULL)
                                {{ $task->employee->user->name }}
                            @else
                                {{ $task->vendor->user->name }}
                            @endif
                          </td>
                          <td>{{ $task->start_date }}</td>
                          <td>{{ $task->finish_date }}</td>
                          <td>{{ $task->budget }}</td>
                          <td><span class="badge badge-success">{{ $task->status }}</span></td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                  @endif
                  @if(count($tasks)<=0)
                   <div><h5>You have not completed task</h5></div>
                  @endif
                </div>
            </div>
        </section>

        
        <!-- /.content -->
    </div>

@endsection
