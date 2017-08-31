@extends('admin.index')
@section('admin.main')

    <div class="row">
        <div class="col-lg-12">
            <h4 class="page-header">
                <i class="fa fa-fw fa-columns"></i> Edit Plan
            </h4>

            <ol class="breadcrumb">
                <li class="active">
                    <i class="fa fa-dashboard"></i> Dashboard
                </li>
                <li class="active">
                    <i class="fa fa-users"></i> Plans Settings
                </li>
                <li >
                    <i class="fa fa-fw fa-columns"></i> Edit Plan
                </li>
            </ol>
        </div>
    </div>
    <!-- /.row -->

    <div class="row">

        <div class="col-md-12">

            @if($errors->any() )

                <div style="padding:8px;margin-bottom:25px;"
                     class="alert alert-danger text-left" role="alert">
                    <ul style="list-style:none;" >
                        {{ implode('',$errors->all('
                            <li ><i class="fa fa-exclamation-circle"></i> :message</li>
                            '))
                         }}
                    </ul>
                </div>

            @endif

            @if(Session::has('success'))
                <div style="padding:8px;margin-bottom:25px;" class="alert alert-success text-left" role="alert">
                    <ul style="list-style:none;" >
                        <li >
                            <i class="fa fa-check-circle"></i>
                            New Plan has been Created.
                        </li>
                    </ul>

                </div>
            @endif()
        </div>

        <div class="col-md-7">


            {{ Form::open( array(
                'method' => 'post',
                'role' => 'form'
            ) ) }}


            <div class="form-group">
                {{ Form::label( 'name','Name') }}

                {{ Form::text('name',$data['plan']->name ,array(
                'class'=>'form-control',
                'tabindex'   => '1',
                'placeholder'=> 'Name'
                )) }}
            </div>

            <div class="form-group">
                {{ Form::label( 'price','Price') }}

                {{ Form::text('price',$data['plan']->price ,array(
                'class'=>'form-control',
                'tabindex'   => '1',
                'placeholder'=> 'Price',

                )) }}
            </div>


            <div class="form-group">
                {{ Form::label( 'profit','Profit(1000 download)') }}

                {{ Form::text('profit', $data['plan']->profit ,array(
                'class'=>'form-control',
                'tabindex'   => '1',
                'placeholder'=> 'Profit'
                )) }}
            </div>

            <div class="form-group">
                {{ Form::label( 'referral_profit','Referral Profit') }}

                {{ Form::text('referral_profit', $data['plan']->referral_profit ,array(
                'class'=>'form-control',
                'tabindex'   => '1',
                'placeholder'=> 'Referral Profit'
                )) }}
            </div>


            <div class="form-group">
                {{ Form::button('<i class="fa fa-fw fa-save"></i> Save Plan', array(
                   'type' => 'submit',
                                  'tabindex'   => '6',

                   'class' => 'btn btn-success  btn-block'
                   ));
                }}
            </div>


        </div>


    </div>
    {{ Form::close() }}

    </div>


@endsection
@stop