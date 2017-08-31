@extends('admin.index')
@section('admin.main')

    <div class="row">
        <div class="col-lg-12">
            <h4 class="page-header">
                <i class="fa fa-fw fa-columns"></i> Payments
            </h4>
            <ol class="breadcrumb">
                <li class="active">
                    <i class="fa fa-dashboard"></i> Dashboard

                </li>

                <li class="active">
                    <i class="fa fa-fw fa-columns"></i> Payments
                </li>

                <li >
                    <i class="fa fa-fw fa-columns"></i> Show Payment Methods
                </li>
            </ol>
        </div>
    </div>
    <!-- /.row -->


    <div class="row">


        @if(Session::has('Message'))
            <div class="col-md-12">
                {{ Session::get('Message') }}
            </div>

        @endif



        <div class="col-md-12">

            <div class="panel panel-default">
                <div class="panel-heading">

                    All Payment Methods

                </div>

                <div class="panel-body">

                    <table id="table-pagination" data-toggle="table"

                          data-classes="table table-bordered table-striped table-hover"
               data-search="true"
               data-search-align="left"

                    >
                        <thead>
                        <tr >

                            <th data-search="true" data-field="name"><i class="fa fa-columns"></i> Name</th>


                            <th data-search="false" data-field="profit">
                                <i class="fa fa-link"></i> Email
                            </th>

                            <th data-search="false" data-field="refferal_profit">
                                <i class="fa fa-link"></i> Status
                            </th>

                            <th data-search="false" data-field="Edit">Edit</th>


                            <th data-search="false" data-field="Op"> Op</th>


                        </tr>

                        </thead>
                        <tbody style="text-align:left;">

                        @foreach($data['payments'] as $key => $payment)


                            <tr id="tr-{{ $key+1 }}" >

                                <td data-field="name">
                                    {{ $payment->name }}
                                </td>

                                <td data-field="price">
                                    {{ $payment->email }}
                                </td>


                                <td data-field="profit">
                                    {{ $payment->status == 1 ? 'actived' : 'disabled' }}
                                </td>


                                <td data-field="Edit">
                                    <a class="confirm" style="font-size:18px;"
                                       href="{{ url('admin/payments/edit/'.$payment->id) }}">Edit
                                        <i class="fa fa-edit"></i>
                                    </a>

                                </td>

                                <td data-field="Op">
                                    <a class="confirm" style="font-size:18px;"
                                       href="{{ url('admin/payments/status/'.$payment->id) }}"> {{ $payment->status == 0 ? 'Active' : 'Disable' }}
                                        <i class="fa fa-cog"></i>
                                    </a>

                                </td>


                            </tr>

                        @endforeach
                        </tbody>

                    </table>


                </div>

            </div>

        </div>






    </div>




@endsection
@stop