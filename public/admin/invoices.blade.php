@extends('admin.index')
@section('admin.main')

    <div class="row">
        <div class="col-lg-12">
            <h4 class="page-header">
                <i class="fa fa-fw fa-users"></i> Show Invoices
            </h4>
            <ol class="breadcrumb">
                <li class="active">
                    <i class="fa fa-dashboard"></i> Dashboard

                </li>

                <li class="active">
                    <i class="fa fa-fw fa-users"></i> Invoices
                </li>

                <li >
                    <i class="fa fa-fw fa-users"></i> Show Invoices
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
                    <a href="{{ url('admin/invoice/deleteAll') }}"
                       class="confirm btn btn-danger btn-md">
                        <i class="fa fa-trash"></i> Delete All Invoices
                    </a>
                </p>
            </div>

        <div class="col-md-12">

            <div class="panel panel-default">
                <div class="panel-heading">

                    All Invoices

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

                            <th data-search="false" data-field="PaypalEmail">
                                <i class="fa fa-hdd-o"></i> Paypal Email
                            </th>

                            <th data-search="false" data-field="plan">
                                <i class="fa fa-columns"></i> Profit
                            </th>

                            <th data-search="false" data-field="size">
                                <i class="fa fa-hdd-o"></i> Date
                            </th>

                            <th data-search="false" data-field="ReferralLink">
                                <i class="fa fa-link"></i> Status
                            </th>

                            <th data-search="false" data-field="Op">
                                <i class="fa fa-cog"></i> Option
                            </th>



                        </tr>

                        </thead>





                        <tbody style="text-align:left;">

                        @foreach($data['invoices'] as $key => $invoice )






                            <tr id="tr-{{ $key+1 }}" >
                                <td style="display:none;" data-field="id">
                                    {{ ((($data['invoices']->getCurrentPage() - 1)* $data['invoices']->getPerPage()) + $key+1) }}
                                </td>

                                <td data-field="name">
                                    {{ User::find($invoice->user_id)->username }}
                                </td>

                                <td data-field="PaypalEmail">
                                    {{ User::find($invoice->user_id)->paypal_email }}
                                </td>

                                <td data-field="plan">
                                    {{ $invoice->profit . ' $' }}
                                </td>

                                <td data-field="size">
                                    {{ $invoice->pay_date }}
                                </td>

                                <td data-field="ReferralLink">
                                   {{ $invoice->pay_status == 0 ? 'Fail' : 'Success' }}
                                </td>

                                <td data-field="Op">

                                    <a class="confirm" style="font-size:18px;" href="{{ url('admin/invoice/delete/' . $invoice->id) }}">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </td>


                            </tr>

                        @endforeach
                        </tbody>

                    </table>

                    {{ $data['invoices']->links()  }}

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