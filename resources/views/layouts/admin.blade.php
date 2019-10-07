<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}>
  <head>
    <meta charset="utf-8">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="keyword" content="">
    <link rel="shortcut icon" href="img/favicon.png">

    <title>Acccounts Management</title>
	<!--      laravel app.blade file style start -->
	<!-- <script src="{{ asset('js/app.js') }}" defer></script> -->

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
	<!--   <link href="{{ asset('css/app.css') }}" rel="stylesheet"> -->

	<!--      laravel app.blade file style start end -->
    <!-- Bootstrap core CSS -->
    <link href="{{ url('/') }}/public/admin/css/bootstrap.min.css" rel="stylesheet">
    {{--<link href="{{ url('/') }}/public/admin/customs.css" rel="stylesheet">--}}
<link rel="stylesheet" type="text/css" href="{{ URL::to('public/admin/customs.css') }}">
    <link href="{{ url('/') }}/public/admin/css/bootstrap-reset.css" rel="stylesheet">
    <!--external css-->
    <link href="{{ url('/') }}/public/admin/assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="{{ url('/') }}/public/admin/assets/jquery-easy-pie-chart/jquery.easy-pie-chart.css" rel="stylesheet" type="text/css" media="screen"/>
    <link rel="stylesheet" href="{{ url('/') }}/public/admin/css/owl.carousel.css" type="text/css">

    <!--right slidebar-->
    <link href="{{ url('/') }}/public/admin/css/slidebars.css" rel="stylesheet">
    <link href="{{ url('/') }}/public/admin/css/datatable.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="{{ url('/') }}/public/admin/css/style.css" rel="stylesheet">
    <link href="{{ url('/') }}/public/admin/css/style-responsive.css" rel="stylesheet" />
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
    <!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
      <script src="js/respond.min.js"></script>
    <![endif]-->
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
  </head>

    <style>
		.table th{ text-align:center }
	</style>

  <body>

    <section id="container" >
      <!--header start-->
      <header class="header white-bg">
              <div class="sidebar-toggle-box">
                  <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
              </div>


            <a href="{{ url('/') }}" class="logo" style="color: #000;text-shadow: 0px 0px 12px #fff;"><span>National Development Co.</span></a>



            <div class="top-nav ">
                <!--search & user info start-->
                <ul class="nav pull-right top-menu">

                    <!-- user login dropdown start-->
                    <li class="dropdown">

                            <li>
                               <!--  <a href="login.html"><i class="fa fa-key"></i> Log Out</a> -->

                                <div class="">
                                    @guest
                                         <div class="user-panel">

                                        <a href="{{url('/')}}/loginuser/home"><i class="fa fa-sign-in"></i> Login</a>
                                         </div>
                                     @else
                                      <div class="user-panel">


                                            <a class="dropdownitem" href="{{ route('logout') }}" style="color:#fff"
                                               onclick="event.preventDefault();
                                                             document.getElementById('logout-form').submit();">
                                                 {{ Auth::user()->name }} ( {{ __('Logout') }} )
                                            </a>

                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                @csrf
                                            </form>
                                      </div>
                                    @endguest
                               </div>

                            </li>
                        </ul>
                    </li>

                    <!-- user login dropdown end -->
                </ul>
                <!--search & user info end-->
            </div>
        </header>



       @php
    	  $submenu = Request::segment(1).'/'.Request::segment(2);
    	  $urole = Auth::user()->role_id;

    	  if($urole==5){

        	  $menu = array(

    				'Administrator' => array(

    					'Add Department ' => 'addDepertment/',
    					'Add Designation ' => 'addDesignation/'
    				),

    				'HR Module' => array(
    					'Add Employee ' => 'add_user/',
    					'View Employee' => 'employee/',
    					'Add Leaving' => 'getemployee_leave/',
    					'Loan type' => 'loan-type/',
    					'Employee Loan ' => 'employeloan/',
    					//'Region Employee ' => 'addDepertment/'
    					'Employee  Activity'=>'employee_activity/',
    				'Adjunct Faculty Payment ' => 'temporaray_teacher_list/',
					'Adjunct  Management ' => 'temporaray_teacher_list_payment/',
					//'Region Employee ' => 'temporaray_teacher_list/',
					'Employee  Activity'=>'employee_activity/',
					'Leave Management'=>'employee_leave_management/',
    				),

    				'PayRoll' => array(

    					'Salary Update' => 'salaryp_update/',
    					'Salary Progress ' => 'SalaryProgress/',
    					'Salary sheet' => 'employesalaryshet/',
    					'Salary Order Bank ' => 'SalaryOrderbank/',
    				),
    				'Subject' => array(
    					'Add Subject ' => 'addSubject/'
    				),
    				'Courses' => array(
    					'Add Course' => 'courses/',
    					//'view Course' => 'viewcourse/'

    				),
    				'Configure Billing' => array(

    					'Billing Configuration' => 'billingconfigure/',
    				 ),

    				'Admission' => array(

    					'Add Admission Test ' => 'addmissiontest/',
    					'Admission Slip' => 'admissionSlip/',
    					'View Admission Slip' => 'viewAmissionSlip/',
    					'Add Admission' => 'addmission/',
    					'Student Billing' => 'admissiondue/',
    					'Admission Payment' => 'get_student_print/',
    				),


    				'Student' => array(
    					'Student List' => 'students/',
    				     // 'Student Billing' => 'admissiondue/'
    				),

    				'Semester Billing' => array(
    					'Semester Billing Process' => 'semester-billing/',
    					//'All Billing' => 'add_khat/'
    				 ),

    				'Bank' => array(

						'Add Bank' => 'bank/',
						'Add Branch' => 'branch/',
						'Add bank Details' => 'bankdetails/'
    				),

    				'Accounts' => array(

    				    'Student Bill Type' => 'student_bill_type/',
    					'Add  Student Billing' => 'billingofstudenttype/',
    					'Expense Type ' => 'expenseType/',
    					'Yearly Expense Type' => 'yearlyExpenseType/',
    					'Yearly Expense' => 'yearlyExpense/',
    					'Expense' => 'expense/',
    					'Balance Transfer' => 'balanceTransfer/',
    					'Income Type' => 'income_type/',
    					'Income' => 'income/',


    				 ),
    				'Inventory' => array(
    	             	'Create Supplier' => 'add_supplier/',
    					'Inventory  Category' => 'inventorycategory/',
    					'Inventory Sub Category' => 'subcategory/',
    					'Product Purchase' => 'addproduct/',
    					'Print  Purchase order ' => 'print_product/',
    					'Product Distribution' => 'product_distribution/',
    					'Damage product ' => 'damageproduct/',
    					'Product Report ' => 'product_report/',
    				 ),

    				'Report' => array(

    					'Balance Sheet' => 'balanceSheet/',
    					'Student Payment report ' => 'studentpaymentreport/',
    					'Salary Report' => 'salary_report/',
    					'Cashbook' => 'cashbook/',
    					'Ledger' => 'ledger/',
    					'Depreciation' => 'cost_depreciation/',
    					'Receipts & Payments' => 'receipts_payments/',
    					'Income & Expenditure' => 'income_expenditure/',
    					'Financial Position' => 'financial/',
    					'Registration Report' => 'studentRegistrationReport/',

    				),

        		);

    		}if($urole==4){

    		    $menu = array(

    		        'Add Configuration' => array(

    					'Add Department ' => 'addDepertment/',
    					'Add Designation ' => 'addDesignation/'
    				),

    		        'HR Module' => array(

    					'Add Employee ' => 'add_user/',
    					'View Employee' => 'employee/',
    					'Add Leaving' => 'getemployee_leave/',
    					'Loan type' => 'loan-type/',
    					'Employee Loan ' => 'employeloan/',
    					'Employee  Activity'=>'employee_activity/'
    				),

    		        'PayRoll' => array(

    					'Salary Update' => 'salaryp_update/',
    					'Salary Progress ' => 'SalaryProgress/',
    					'Salary sheet' => 'employesalaryshet/',
    					'Salary Order Bank ' => 'SalaryOrderbank/',

    				),

                    'Bank' => array(

    					'Add Bank' => 'bank/',
    					'Add Branch' => 'branch/',
    					'Add bank Details' => 'bankdetails/'
    				),

    			    'Accounts' => array(

    				    'Student Bill Type' => 'student_bill_type/',
    					'Add  Student Billing' => 'billingofstudenttype/',
    					'Expense Type ' => 'expenseType/',
    					'Yearly Expense Type' => 'yearlyExpenseType/',
    					'Yearly Expense' => 'yearlyExpense/',
    					'Expense' => 'expense/',
    					'Balance Transfer' => 'balanceTransfer/',
    					'Income Type' => 'income_type/',
    					'Income' => 'income/',
    				),

    				'Report' => array(

    					'Bank Balance' => 'balanceSheet/',
    					'Salary Report' => 'salary_report/',
    					'Cashbook' => 'cashbook/',
    					'Ledger' => 'ledger/',
    					'Depreciation' => 'cost_depreciation/',
    					'Financial Position' => 'financial/'
    				),
        		);

    		}if($urole==3){

    		    $menu = array(

                   'Inventory' => array(
    					'Create Supplier' => 'add_supplier/',
    					'Inventory  Category' => 'inventorycategory/',
    					'Inventory Sub Category' => 'subcategory/',
    					'Product Purchase' => 'addproduct/',
    					'Damage product ' => 'damageproduct/',
    				 ),

        		);
    		}

    		if($urole==2){

    		     $menu = array(



        			'Subject' => array(
    					'Add Subject ' => 'addSubject/'
    				),
                    'Courses' => array(
    					'Add Course' => 'courses/',
    					//'view Course' => 'viewcourse/'
    				),
                   'Configure Billing' => array(
    					'Billing Configuration' => 'billingconfigure/',

    				),

                    'Admission' => array(
    					'Add Admission Test ' => 'addmissiontest/',
    					'Admission Slip' => 'admissionSlip/',
    					'View Admission Slip' => 'viewAmissionSlip/',
    					'Add Admission' => 'addmission/',
    					'Student Billing' => 'admissiondue/',
    					'Admission Payment' => 'get_student_print/',
    				 ),
                     'Student' => array(
    					'Student List' => 'students/',
    				   // 'Student Billing' => 'admissiondue/'
    				 ),
                    'Semester Billing' => array(
    					'Semester Billing Process' => 'semester-billing/',

    				 ),
    				'Report' => array(

    					'Student Payment report ' => 'studentpaymentreport/',
    					'Registration Report' => 'studentRegistrationReport/'
    				),

    			);

    		}if($urole==1){
    		    $menu = array(

        		   'Administrator' => array(
    					'Add Department ' => 'addDepertment/',
    					'Add Designation ' => 'addDesignation/'
    				),

    				'HR Module' => array(
					'Add Employee ' => 'add_user/',
					'View Employee' => 'employee/',
					'Add Leaving' => 'getemployee_leave/',
					'Loan type' => 'loan-type/',
					'Employee Loan ' => 'employeloan/',
					'Adjunct Faculty Payment ' => 'temporaray_teacher_list/',
					'Adjunct  Management ' => 'temporaray_teacher_list_payment/',
					//'Region Employee ' => 'temporaray_teacher_list/',
					'Employee  Activity'=>'employee_activity/',
					'Leave Management'=>'employee_leave_management/',
				),

    			'Report' => array(

					'Admission Test Report' => 'preadmissiontestresult_show/',
					'Student Payment report ' => 'studentpaymentreport/',
					'Registration Report' => 'studentRegistrationReport/'

				),

        		);
    		}

       @endphp

      <aside>


          <div id="sidebar" >

              <ul class="sidebar-menu bac" id="nav-accordion">

				  @foreach($menu as $mn=>$smn)
					  <li class="sub-menu">
						  <a  class="@if($menuname==$mn){{ 'active' }}@endif" href="javascript:void(0)">
							  <i class="fa fa-cogs"></i>
							  <span>{{ $mn }}</span>
						  </a>
						  <ul class="sub">
						  @foreach($smn as $k=>$sm)
								 <li>
									<a href="{{ url('/') }}/{{ $sm }}" style="color:@if($submenu == $sm){{ 'red' }}@endif">{{ $k }}</a>
								 </li>
						  @endforeach
						  </ul>
					  </li>
				  @endforeach

              </ul>
              <!-- sidebar menu end-->
          </div>
      </aside>

      <section id="main-content">

            @if(session()->has('message'))

                <div class="alert alert-success">

                	{{ session()->get('message') }}
                </div>
            @endif

            <section class="panel">
                @yield('content')
            </section>



      </section>
      <!--main content end-->

      <!-- Right Slidebar start -->

      <!-- Right Slidebar end -->

      <!--footer start-->
      <footer >

            <p style="text-align:center; font-size:16px"><a href="http://2aitbd.com"><strong ><span style="text-align:center; font-size:16px;color:blue;">Design & Developed by</span></strong> <strong><span style="text-align:center; font-size:20px;color:red;">2A IT</span></strong></a></p>

      </footer>
      <!--footer end-->
  </section>
    <!-- js placed at the end of the document so the pages load faster -->
    <script src="{{ url('/') }}/public/admin/js/jquery.js"></script>
    <script src="{{ url('/') }}/public/admin/js/datatable.js"></script>
    <script src="{{ url('/') }}/public/admin/js/bootstrap.min.js"></script>
    <script class="include" type="text/javascript" src="{{ url('/') }}/public/admin/js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="{{ url('/') }}/public/admin/js/jquery.scrollTo.min.js"></script>
    <script src="{{ url('/') }}/public/admin/js/jquery.nicescroll.js" type="text/javascript"></script>
    <script src="{{ url('/') }}/public/admin/js/jquery.sparkline.js" type="text/javascript"></script>
    <script src="{{ url('/') }}/public/admin/assets/jquery-easy-pie-chart/jquery.easy-pie-chart.js"></script>
    <script src="{{ url('/') }}/public/admin/js/owl.carousel.js" ></script>
    <script src="{{ url('/') }}/public/admin/js/jquery.customSelect.min.js" ></script>
    <script src="{{ url('/') }}/public/admin/js/respond.min.js" ></script>

    <!--right slidebar-->
    <script src="{{ url('/') }}/public/admin/js/slidebars.min.js"></script>

    <!--common script for all pages-->
    <script src="{{ url('/') }}/public/admin/js/common-scripts.js"></script>

    <!--script for this page-->
    <script src="{{ url('/') }}/public/admin/js/sparkline-chart.js"></script>
    <script src="{{ url('/') }}/public/admin/js/easy-pie-chart.js"></script>
    <script src="{{ url('/') }}/public/admin/js/count.js"></script>

  <script>

      //owl carousel

      $(document).ready(function() {
          $("#owl-demo").owlCarousel({
              navigation : true,
              slideSpeed : 300,
              paginationSpeed : 400,
              singleItem : true,
              autoPlay:true

          });
      });

      //custom select box

      $(function(){
          $('select.styled').customSelect();
          $('#myTable').DataTable();
      });



  </script>

  </body>
</html>

