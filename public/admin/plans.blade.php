@extends('admin.index')
@section('admin.main')

    <div class="row">
        <div class="col-lg-12">
            <h4 class="page-header">
                <i class="fa fa-fw fa-columns"></i> Show Plans
            </h4>
            <ol class="breadcrumb">
                <li class="active">
                    <i class="fa fa-dashboard"></i> Dashboard

                </li>

                <li class="active">
                    <i class="fa fa-fw fa-columns"></i> Plans Settings
                </li>

                <li >
                    <i class="fa fa-fw fa-columns"></i> Show Plans
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

                    All Plans

                </div>

                <div class="panel-body">

                    <table id="table-pagination" data-toggle="table"

                           data-classes="table table-bordered table-striped table-hover"

                           data-search-align="left"

                    >
                        <thead>
                        <tr >

                            <th data-search="true" data-field="name"><i class="fa fa-columns"></i> Name</th>

                            <th data-search="false" data-field="price">
                                <i class="fa fa-clock-o"></i> Price
                            </th>


                            <th data-search="false" data-field="profit">
                                <i class="fa fa-link"></i> Profit
                            </th>

                            <th data-search="false" data-field="refferal_profit">
                                <i class="fa fa-link"></i> Referral Profit
                            </th>

                            <th data-search="false" data-field="uploadSettings">Upload Settings</th>


                            <th data-search="false" data-field="Op"> Op</th>


                        </tr>

                        </thead>
                        <tbody style="text-align:left;">

                        @foreach($data['plans'] as $key => $plan)


                            <tr id="tr-{{ $key+1 }}" >

                                <td data-field="name">
                                    {{ $plan->name }}
                                </td>

                                <td data-field="price">
                                    {{ $plan->price }} $
                                </td>


                                <td data-field="profit">
                                    {{ $plan->profit }} $
                                </td>

                                <td data-field="refferal_profit">
                                    {{ $plan->referral_profit }} $
                                </td>

                                <td data-field="uploadSettings">
                                    <a class="confirm" style="font-size:18px;"
                                       href="{{ url('admin/plan/uploadSettings/'.$plan->id) }}">
                                        <i class="fa fa-cog"></i>
                                    </a>

                                </td>

                                <td data-field="Op">
                                    <a class="confirm" style="font-size:18px;"
                                       href="{{ url('admin/plan/edit/'.$plan->id) }}">
                                        <i class="fa fa-edit"></i>
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