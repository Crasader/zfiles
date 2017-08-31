@extends('admin.index')
@section('admin.main')

    <div class="row">
        <div class="col-lg-12">
            <h4 class="page-header">
                <i class="fa fa-fw fa-columns"></i> Transactions
            </h4>
            <ol class="breadcrumb">
                <li class="active">
                    <i class="fa fa-dashboard"></i> Dashboard

                </li>

                <li class="active">
                    <i class="fa fa-fw fa-columns"></i> Payments
                </li>

                <li >
                    <i class="fa fa-fw fa-columns"></i> Show Payments
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

            <div class="col-md-6 ">
                <p class="align-right">
                    <a href="{{ url('admin/transactions/deleteAll') }}"
                       class="confirm btn btn-danger btn-md">
                        <i class="fa fa-trash"></i> Delete All Payments
                    </a>
                </p>
            </div>


        <div class="col-md-12">

            <div class="panel panel-default">
                <div class="panel-heading">

                    All Payments

                </div>

                <div class="panel-body">

                    <table id="table-pagination" data-toggle="table" data-classes="table table-bordered table-striped table-hover"
                           data-classes="table table-bordered table-striped table-hover"
               data-search="true"
               data-search-align="left"
                           >

                        <thead>
                        <tr >

                            <th data-search="true" data-field="username"><i class="fa fa-columns"></i> Username</th>


                            <th data-search="false" data-field="payment_method">
                                <i class="fa fa-link"></i> Payment Method
                            </th>

                            <th data-search="false" data-field="txnId">
                                <i class="fa fa-openid"></i> Transaction ID
                            </th>

                            <th data-search="false" data-field="content">
                                <i class="fa fa-link"></i> Content
                            </th>


                            <th data-search="false" data-field="date">
                                <i class="fa fa-link"></i> Date
                            </th>

                            <th data-search="false" data-field="pay_status">Pay Status</th>
                            <th data-search="false" data-field="Status">Status</th>


                            <th data-search="false" data-field="Reject">Op</th>

                            <th data-search="false" data-field="Approve">Op</th>


                        </tr>

                        </thead>
                        <tbody style="text-align:left;">

                        @foreach($data['transactions'] as $key => $transaction)


                            <tr id="tr-{{ $key+1 }}" >

                                <td data-field="username">
                                    {{ User::find($transaction->user_id)->username }}
                                </td>

                                <td data-field="payment_method">
                                    {{ $transaction->payment_method_id == 1 ? "Paypal" : "Payoneer"  }}
                                </td>

                                <td data-field="txnId">
                                    {{ $transaction->txnId  }}
                                </td>

                                <td data-field="content">
                                    {{ $transaction->content }}
                                </td>

                                <td data-field="date">
                                    {{ $transaction->transactionDate }}
                                </td>

                                <td data-field="pay_status">
                                    @if($transaction->pay_status == 0)
                                        {{ 'Error'}}
                                    @elseif($transaction->pay_status == 1)
                                        {{ 'Success' }}
                                    @endif

                                </td>

                                <td data-field="status">
                                    @if($transaction->status == 0)
                                      {{ 'Pending'}}
                                    @elseif($transaction->status == 1)
                                        {{ 'Rejected' }}
                                    @elseif($transaction->status == 2)
                                        {{ 'Approved' }}
                                    @endif

                                </td>



                                @if($transaction->status == 0)
                                    <td data-field="Reject">
                                        <a class="confirm" style="font-size:18px;"
                                           href="{{ url('admin/transactions/reject/'.$transaction->id) }}"> Reject
                                            <i class="fa fa-edit"></i>
                                        </a>

                                    </td>

                                    <td data-field="Approve">
                                        <a class="confirm" style="font-size:18px;"
                                           href="{{ url('admin/transactions/approve/'.$transaction->id) }}"> Approve
                                            <i class="fa fa-edit"></i>
                                        </a>

                                    </td>
                                @endif



                            </tr>

                        @endforeach
                        </tbody>

                    </table>
                    {{ $data['transactions']->links()  }}


                </div>

            </div>

        </div>






    </div>




@endsection
@stop