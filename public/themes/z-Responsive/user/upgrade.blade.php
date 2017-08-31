@extends('user.--index')

@section('upgrade')

    <div style=" padding: 30px 15px;" class="header-content">
        <div class="header-content-inner" style="color: #fefefe;">
            <h1>You need to pay {{ Plans::find(3)->price }} $ for {{ Plans::find(3)->name }} plan !</h1>
        </div>
    </div>

    <div class="tab-content">
        <!-- Tab Content -->


        <div class="header-content">

            <div class="col-md-12" style="margin: auto">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <i style="font-size:18px;" class="fa fa-bar-chart"></i> Payments
                    </div>
                    <div class="panel-body">
                        @if( Payments::find(1)->status == 1 )
                            <div class="col-lg-6 col-md-6" id="paypalClick" style="cursor: pointer">
                                <div class="panel panel-success">
                                    <div class="panel-heading">

                                        <div class="row">
                                            <div class="col-xs-3">
                                                <i style="font-size:45px" class="fa fa-cc-paypal fa-stack-2x"></i>
                                            </div>
                                            <div class="col-xs-9 ">
                                                <div class="huge">1</div>
                                                <div>{{ Payments::find(1)->name }}</div>

                                                <form id="paypalMethod" action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
                                                    <!-- Identify your business so that you can collect the payments. -->
                                                    <input type="hidden" name="business" value="{{ Payments::find(1)->email }}">

                                                    <!-- Specify a Buy Now button. -->
                                                    <input type="hidden" name="cmd" value="_xclick">

                                                    <!-- Specify details about the item that buyers will purchase. -->
                                                    <input type="hidden" name="item_name" value="{{ Plans::find(3)->name . ' Plan'}}">
                                                    <input type="hidden" name="item_number" value="1">
                                                    <input type="hidden" name="amount" value="{{ Plans::find(3)->price }}">
                                                    <input type="hidden" name="currency_code" value="USD">

                                                    <!-- Specify URLs -->
                                                    <input type="hidden" name="cancel_return" value="{{ url('user/' . Auth::user()->username ) . '/' . 'upgrade' }}">


                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if( Payments::find(2)->status == 1 )
                            <div class="col-lg-6 col-md-6" >
                                <div class="panel panel-red">
                                    <div class="panel-heading">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <i style="font-size:45px;" class="fa fa-dollar fa-stack-2x"></i>
                                            </div>
                                            <div class="col-xs-9">
                                                <div class="huge">2</div>
                                                <div>{{ Payments::find(2)->name }}</div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        @endif


                    </div>
                </div>
            </div>

        </div>
        <!-- /#Tab Content -->

        <div class="clearfix"></div>
    </div>

    <script>

        $("#paypalClick").click(function () {
            $.ajax({
                url : '{{ url('user/' . Auth::user()->username . '/create_transaction' ) }}',
                data: {

                },
                type : 'get',

                success : function (result) {
                    $("#paypalMethod").append("<input type='hidden' name='return' value='" + "{{ url('user/' . Auth::user()->username . '/' .'pay_success' . '?id=' ) }}" + result + "'" + ">" ).submit();
                }
            });


        });



    </script>

@endsection