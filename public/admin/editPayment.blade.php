@extends('admin.index')
@section('admin.main')

    <div class="row">
        <div class="col-lg-12">
            <h4 class="page-header">
                <i class="fa fa-fw fa-columns"></i> Edit Payment
            </h4>

            <ol class="breadcrumb">
                <li class="active">
                    <i class="fa fa-dashboard"></i> Dashboard
                </li>
                <li >
                    <i class="fa fa-dollar"></i> Edit Payment
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
                            Payment has been updated.
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
                {{ Form::label( 'Name','Name') }}

                {{ Form::text('name', $data['payment']->name ,array(
                'class'=>'form-control',
                'tabindex'   => '1',
                'placeholder'=> 'Name',

                )) }}
            </div>


            <div class="form-group">
                {{ Form::label( 'Email','Email') }}

                {{ Form::text('email', $data['payment']->email ,array(
                'class'=>'form-control',
                'tabindex'   => '1',
                'placeholder'=> 'Email',

                )) }}
            </div>


            <div class="form-group">
                {{ Form::button('<i class="fa fa-fw fa-save"></i> Save', array(
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