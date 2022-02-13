@extends('admin.layouts.admin')
@section('title', 'Admin Dashboard')
@section('content')
    <div style="margin-left:-40px;" class="row layout-top-spacing mt-2">



        <div class="col-lg-4 col-md-4 col-xs-12">
            <div class="boxs blue">
                <h3>
                    <span class="person_counter">
                        {{ $on_going_production }}
                    </span>
                    On Going Production
                </h3>
                <h4>&#2547; {{ $on_going_production_amount }}</h4>
                <a href="" class="boxs-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                <img class="d_img_icon" src="{{ asset('storage/project_files/basic_img/hard-work.png') }}" />
            </div>
        </div>

        <div class="col-lg-4 col-md-4 col-xs-12">
            <div class="boxs red">
                <h3>
                    <span class="person_counter">
                        {{ $pending_production }}
                    </span>
                    Pending Production
                </h3>
                <h4>&#2547; {{ $pending_production_amount }}</h4>
                <a href="#" class="boxs-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                <img class="d_img_icon" src="{{ asset('storage/project_files/basic_img/schedule.png') }}" />
            </div>
        </div>


        <div class="col-lg-4 col-md-4 col-xs-12">
            <div class="boxs green">
                <h3>
                    <span class="person_counter">
                        {{ $completed_production }}
                    </span>
                    Completed Production
                </h3>
                <h4>&#2547; {{ $completed_production_amount }}</h4>
                <a href="#" class="boxs-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                <img class="d_img_icon" src="{{ asset('storage/project_files/basic_img/completed-task.png') }}" />
            </div>
        </div>

        <div class="col-lg-4 col-md-4 col-xs-12">
            <div class="boxs green">
                <h3>
                    <span class="person_counter">
                        {{ $completed_production }}
                    </span>
                    Completed Production
                </h3>
                <h4>&#2547; {{ $completed_production_amount }}</h4>
                <a href="#" class="boxs-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                <img class="d_img_icon" src="{{ asset('storage/project_files/basic_img/completed-task.png') }}" />
            </div>
        </div>


          <div class="col-lg-4 col-md-4 col-xs-12">
            <div class="boxs green">
                <h3>
                    <span class="person_counter">
                        {{ $total_supplier }}
                    </span>
                    Total Suppliers & Due
                </h3>
                <h4>&#2547; {{ $total_supplier_due_amount->due_amount }}</h4>
                <a href="#" class="boxs-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                <img class="d_img_icon" src="{{ asset('storage/project_files/basic_img/target.png') }}" />
            </div>
        </div>


        <div class="col-lg-4 col-md-4 col-xs-12">
            <div class="boxs blue">
                <h3>
                    <span class="person_counter">
                        {{ $total_client }}
                    </span>
                    Total Clients & Due
                </h3>
                <h4>&#2547;{{ $total_client_due_amount->due_amount }}</h4>
                <a href="#" class="boxs-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                <img class="d_img_icon" src="{{ asset('storage/project_files/basic_img/contact.png') }}" />
            </div>
        </div>


        <div class="col-lg-4 col-md-4 col-xs-12">
            <div class="boxs green">
                <h3>

                    Current Balance
                </h3>
                <h4>&#2547; {{ $current_balance }}</h4>
                <a href="#" class="boxs-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                <img class="d_img_icon" src="{{ asset('storage/project_files/basic_img/cash.png') }}" />
            </div>
        </div>



    </div>

    <div class="row  layout-top-spacing mt-5">


        <div class="col-lg-4">
            <div class="custom-box">
                <div class="custom-box-body">
                    <h4>
                        In BKash :
                        <strong>22</strong>
                    </h4>
                    <h4>
                        In Total : <strong>55 </strong>
                    </h4>
                </div>

                <div class="custom-box-footer">
                    <h3 class="text-center text-uppercase">today credit</h3>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="custom-box">
                <div class="custom-box-body">
                    <h4>
                        In BKASH :
                        <strong>777</strong>
                    </h4>

                    <h4>
                        In Total : <strong>777 </strong>
                    </h4>
                </div>

                <div class="custom-box-footer">
                    <h3 class="text-center text-uppercase">today debit</h3>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="custom-box">
                <div class="custom-box-body">
                    <h4>
                        In Nagad :
                        <strong>888</strong>
                    </h4>
                    <h4>
                        In Total <strong> 77777 </strong>
                    </h4>
                </div>

                <div class="custom-box-footer">
                    <h3 class="text-center text-uppercase">total balance</h3>
                </div>
            </div>
        </div>

    </div>
@endsection



@section('css')

    <style>
        .person_counter {
            padding-right: 5%;
            color: #1d2671;
        }

        .box-gradiant {
            background: -webkit-linear-gradient(to right, #c33764, #1d2671);
            background: linear-gradient(to right, #c33764, #1d2671);
        }

        .sub_info {
            font-size: 24px;
            color: #fff;
            margin-top: 0px;
            position: absolute;
            margin-left: 20px;
        }

        .money_icon {
            font-size: 26px;
        }

        h3 {
            font-size: 20px;
            font-weight: 500;
            font-family: 'Poppins';
        }

        :root {
            --red: hsl(0, 78%, 62%);
            --cyan: hsl(180, 62%, 55%);
            --orange: hsl(34, 97%, 64%);
            --blue: hsl(212, 86%, 64%);
            --varyDarkBlue: hsl(234, 12%, 34%);
            --grayishBlue: hsl(229, 6%, 66%);
            --veryLightGray: hsl(0, 0%, 98%);
            --weight1: 200;
            --weight2: 400;
            --weight3: 600;
        }


        .attribution {
            font-size: 11px;
            text-align: center;
        }

        .attribution a {
            color: hsl(228, 45%, 44%);
        }

        h1:first-of-type {
            font-weight: var(--weight1);
            color: var(--varyDarkBlue);
        }

        h1:last-of-type {
            color: var(--varyDarkBlue);
        }

        @media (max-width: 400px) {
            h1 {
                font-size: 1.5rem;
            }
        }

        .boxs p {
            color: var(--grayishBlue);
        }

        .boxs {
            border-radius: 5px;
            box-shadow: 0px 30px 40px -20px var(--grayishBlue);
            padding: 30px;
            margin: 20px;
        }

        .d_img_icon {
            margin-top: -75px;
            float: right;
            width: 60px;
        }

        @media (max-width: 450px) {
            .boxs {
                height: 200px;
            }
        }

        @media (max-width: 950px) and (min-width: 450px) {
            .boxs {
                text-align: center;
                height: 180px;
            }
        }

        .cyan {
            border-top: 3px solid var(--cyan);
        }

        .red {
            border-top: 3px solid var(--red);
        }

        .blue {
            border-top: 3px solid var(--blue);
        }

        .green {
            border-top: 3px solid #1abc9c;
        }

        .orange {
            border-top: 3px solid var(--orange);
        }

        @media (min-width: 950px) {
            .row1-container {
                display: flex;
                justify-content: center;
                align-items: center;
            }

            .row2-container {
                display: flex;
                justify-content: center;
                align-items: center;
            }

            .boxs-down {
                position: relative;
                top: 150px;
            }

            .boxs {
                width: 100%;
                height: 150px;
            }

        }

        .boxs {
            border-radius: 5px;
            box-shadow: 0px 30px 40px -20px var(--grayishBlue);
            padding: 30px;
            margin: 20px;
        }

    </style>
@endsection
