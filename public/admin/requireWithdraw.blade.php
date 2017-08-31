@extends('admin.index')
@section('admin.main')

    <div class="row">
        <div class="col-lg-12">
            <h4 class="page-header">
                <i class="fa fa-fw fa-users"></i> Show Requires
            </h4>
            <ol class="breadcrumb">
                <li class="active">
                    <i class="fa fa-dashboard"></i> Dashboard

                </li>

                <li class="active">
                    <i class="fa fa-fw fa-users"></i> Requires
                </li>

                <li >
                    <i class="fa fa-fw fa-users"></i> Show Requires
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
                    <a href="{{ url('admin/require/deleteAll') }}"
                       class="confirm btn btn-danger btn-md">
                        <i class="fa fa-trash"></i> Delete All Requires
                    </a>
                </p>
            </div>


        <div class="col-md-12">

            <div class="panel panel-default">
                <div class="panel-heading">

                    All Requires

                </div>

                <div class="panel-body">

                    <table id="table-pagination" data-toggle="table"

                           data-classes="table table-bordered table-striped table-hover"
                           data-search="true"
                           data-search-align="left"
                    >
                        <thead>
                        <tr >
                            <th id="setW" data-sortable="true" data-field="id">
                                <i class="fa fa-list-ol"></i>
                            </th>

                            <th data-search="true" data-field="name"><i class="fa fa-user"></i> Username</th>


                            <th data-search="false" data-field="paypalEmail">
                                <i class="fa fa-mail-forward"></i> Paypal Email
                            </th>

                            <th data-search="false" data-field="profit">
                                <i class="fa fa-dollar"></i> Profit
                            </th>

                            <th data-search="false" data-field="size">
                                <i class="fa fa-hdd-o"></i> Date
                            </th>


                            <th data-search="false" data-field="status">
                                <i class="fa fa-cog"></i> Status
                            </th>

                            <th data-search="false" data-field="Op">
                                <i class="fa fa-cog"></i> Option
                            </th>


                        </tr>

                        </thead>

                        <form id="paypal" action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
                            <!-- Identify your business so that you can collect the payments. -->
                            <input type="hidden" id="business" name="business" value="">


                            <!-- Specify a Buy Now button. -->
                            <input type="hidden" name="cmd" value="_xclick">

                            <!-- Specify details about the item that buyers will purchase. -->
                            <input type="hidden" name="item_name" value="Profit">
                            <input type="hidden" name="item_number" value="1">


                            <input type="hidden" id="amount" name="amount" value="">

                            <input type="hidden" name="currency_code" value="USD">

                            <!-- Specify URLs -->
                            <input type="hidden" name="cancel_return" value="{{ url('/admin/require/index') }}">

                            <input type="hidden" id="return" name="return" value="">


                        </form>





                        <tbody style="text-align:left;">

                        @foreach($data['requires'] as $key => $require )






                            <tr id="tr-{{ $key+1 }}" >
                                <td style="display:none;" data-field="id">
                                    {{ ((($data['requires']->getCurrentPage() - 1)* $data['requires']->getPerPage()) + $key+1) }}
                                </td>




                                <td data-field="plan">
                                    {{ User::find($require->user_id)->username }}
                                </td>

                                <td data-field="paypalEmail">
                                    {{ User::find($require->user_id)->paypal_email }}
                                </td>

                                <td data-field="profit">
                                    {{ $require->profit }} $
                                    @if($require->status == 0)
                                        <button style="float: right; margin-right: 30%" class="PayProfit-<?php echo $require->id; ?>">Pay</button>
                                    @endif

                                </td>

                                <script>

                                    $(document).ready(function () {
                                        $('.PayProfit-<?php echo $require->id; ?>').click(function () {
                                            $.ajax({
                                                url : '{{ url('admin/invoice/create') }}',
                                                type : 'get',
                                                data : {

                                                    'userID' :  {{  $require->user_id }},
                                                    'profit' : {{ $require->profit }}
                                                },
                                                success : function (invoiceID) {
                                                    //alert(invoiceID);
                                                    $('#business').val('{{ User::find($require->user_id)->paypal_email }}');
                                                    $('#amount').val('<?php echo $require->profit; ?>');
                                                    $('#return').val('{{ url('/admin/invoice/success?invoiceID=')}}' + invoiceID + '&requireId=' + '<?php echo $require->id; ?>');

                                                    $('#paypal').submit();
                                                }

                                            });
                                        });
                                    });

                                </script>

                                <td data-field="size">
                                    {{ $require->date }}
                                </td>

                                <td data-field="status">
                                    {{ $require->status == 0 ? 'Pending' : 'Paid' }}
                                </td>

                                <td data-field="Op">

                                    <a class="confirm" style="font-size:18px;" href="{{ url('admin/require/delete/' . $require->id) }}">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </td>


                            </tr>

                        @endforeach
                        </tbody>

                    </table>

                    {{ $data['requires']->links()  }}

                </div>

            </div>

        </div>






    </div>

    <script>

        $(document).ready(function(){
            $("#table-pagination th:first").attr('style', 'width: 30px !important');
        });




        //var v = $("#table-pagination thead tr th div.sortable").css("width", "30px");

        //alert(v);
    </script>




@endsection
@stop