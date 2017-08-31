@extends('user.--index')
@section('style')
    <!-- Confirm Dialog css -->
    {{ HTML::style('public/themes/defualt/assets/css/jquery.frontbox-1.1.css') }}
@endsection

@section('transaction')

    <div class="header-content">

        <div class="col-md-12">

            <div class="panel panel-primary">

                <div class="panel-heading">
                    <i style="font-size:18px;" class="fa fa-dropbox">
                    </i> Your Transaction
                </div>

                <div class="panel-body">





                    <table id="table-pagination" data-toggle="table"

                           data-classes="table table-bordered table-striped table-hover"


                    >
                        <thead>
                        <tr >

                            <th data-search="true" data-field="name"><i class="fa fa-windows"></i> Content</th>
                            <th class=" hidden-xs" data-search="false" data-field="date">
                                <i class="fa fa-clock-o"></i> Date
                            </th>
                            <th class=" hidden-xs" data-search="false" data-field="status">
                                <i class="fa fa-cog"></i> Status
                            </th>

                            <th class=" hidden-xs" data-search="false" data-field="aor">
                                <i class="fa fa-cog"></i> Approved Or Rejected
                            </th>


                        </tr>

                        </thead>
                        <tbody style="text-align:left;">
                        @foreach(Transactions::where('user_id', $data['user']->id)->get() as $item)
                        <tr>


                            <td>{{ $item->content }}</td>
                            <td>{{ $item->transactionDate }}</td>
                            <td>{{ $item->pay_status  == 0 ? "Error" : "Success"}}</td>
                            <td>{{ $item->status  == 0 ? "Pending" : ($item->status == 1 ? "Approved" : "Rejected") }}</td>

                        </tr>

                        @endforeach



                        </tbody>

                    </table>

                </div>



            </div> <!-- /# END panel default -->

        </div> <!-- /# END col-md 12 -->

    </div> <!-- /# END HEADER CONTETNT -->
@endsection

@section('javascript')
    <!-- Bootstrap Core JavaScript -->
    {{ HTML::script('public/themes/defualt/assets/js/tables.min.js') }}
    {{ HTML::script('public/themes/defualt/assets/js/jquery.frontbox-1.1.js') }}



@endsection
@stop