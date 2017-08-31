@extends('user.--index')
@section('style')
    <!-- Confirm Dialog css -->
    {{ HTML::style('public/themes/defualt/assets/css/jquery.frontbox-1.1.css') }}
@endsection

@section('profit')

    <div class="header-content">

        <div class="col-md-12">

            <div class="panel panel-primary">

                <div class="panel-heading">
                    <i style="font-size:18px;" class="fa fa-dropbox">
                    </i> Your Profit
                </div>

                <div class="panel-body">

                    <div class="row">

                        <div class="clearfix"></div>
                        <div class="col-md-6 text-left">
                            <label for="email">Referral Link : </label>

                            <input style="margin-bottom:0px;" class="form-control" type="text" value="{{ url('/signup?referral_link='.Auth::user()->id ) }}" readonly="">
                        </div>

                    </div>

                    <div class="row">

                        <div class="clearfix"></div>
                        <div class="col-md-6 text-left">

                            <label for="email">Profit : </label>
                        </div>

                    </div>

                    <table id="table-pagination" data-toggle="table"

                           data-classes="table table-bordered table-striped table-hover"


                    >
                        <thead>
                        <tr >

                            <th class=" hidden-xs" data-field="type"><i class="fa fa-filter"></i></th>
                            <th data-search="true" data-field="name"><i class="fa fa-sort-numeric-desc"></i> Number</th>
                            <th class=" hidden-xs" data-search="false" data-field="size">
                                <i class="fa fa-dollar"></i> Total
                            </th>


                        </tr>

                        </thead>
                        <tbody style="text-align:left;">
                        <tr>

                            <td>Download</td>

                            <td>{{ $data['number_of_download'] }}</td>
                            <td>{{ $data['number_of_download'] * $data['plan']->profit/1000 }} $</td>
                        </tr>

                        <tr>

                            <td>Referral</td>

                            <td>{{ $data['number_of_referral'] }}</td>
                            <td>{{ $data['number_of_referral'] * $data['plan']->referral_profit  }} $</td>
                        </tr>

                        <tr>
                            <td></td>
                            <td></td>
                            <td>{{ $data['number_of_download'] * $data['plan']->profit/1000 + $data['number_of_referral'] * $data['plan']->referral_profit  }} $</td>
                        </tr>

                        </tbody>

                    </table>

                    @if( $data['number_of_download'] * $data['plan']->profit/1000 + $data['number_of_referral'] * $data['plan']->referral_profit >= 10 )
                    <div class="row">

                        <div class="clearfix"></div>

                        <div class="col-md-4">
                        </div>

                        <div class="col-md-4">
                        </div>

                        <div class="col-md-4 text-left">
                            <form action="{{ url('user/' . Auth::user()->username . '/require_withdraw' ) }}" method="post">
                                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                                <button class="btn btn-primary  btn-block " id="send" type="submit"><i class="fa fa-send"></i> Request Payment</button>
                            </form>

                        </div>

                    </div>
                    @endif

                    <div class="row">

                        <div class="clearfix"></div>
                        <div class="col-md-6 text-left">

                            <label for="email">Payments : </label>
                        </div>

                    </div>

                    <table id="table-pagination" data-toggle="table"

                           data-classes="table table-bordered table-striped table-hover"


                    >
                        <thead>
                        <tr >


                            <th class=" hidden-xs" data-search="false" data-field="profit">
                                <i class="fa fa-dollar"></i> profit
                            </th>

                            <th class=" hidden-xs" data-search="false" data-field="date">
                                <i class="fa fa-clock-o"></i> date
                            </th>

                            <th class=" hidden-xs" data-search="false" data-field="status">
                                <i class="fa fa-cog"></i> status
                            </th>


                        </tr>

                        </thead>
                        <tbody style="text-align:left;">

                        @foreach($data['invoices'] as $invoice)
                        <tr>

                            <td>{{ $invoice->profit }} $</td>
                            <td>{{ $invoice->date }}</td>
                            <td>{{ $invoice->status == 0 ? 'pending' : 'paid' }}</td>


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