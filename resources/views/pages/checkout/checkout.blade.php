<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Home | MyShop</title>
    <link href="{{asset('public/frontend/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/prettyPhoto.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/price-range.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/animate.css')}}" rel="stylesheet">
	<link href="{{asset('public/frontend/css/main.css')}}" rel="stylesheet">
	<link href="{{asset('public/frontend/css/responsive.css')}}" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="{{asset('public/frontend/images/ico/favicon.ico')}}">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="/images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="/images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="/images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="/images/ico/apple-touch-icon-57-precomposed.png">
</head>

<body>
	<header id="header"><!--header-->	
		<div class="header-middle temp"><!--header-middle-->
			<div class="container">
				<div class="row">
					<div class="col-sm-4">
						<div class="logo pull-left">
							<a href="{{URL::to('/trangchu')}}">
								<img class="logo-img" src="{{asset('public/frontend/images/home/logo1.png')}}" alt="" />
							</a>
						</div>
						<div class="btn-group pull-right">
							<div class="btn-group">
								<button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
									Vi???t Nam
									<span class="caret"></span>
								</button>
								<ul class="dropdown-menu">
									<li><a href="#">Vi???t Nam</a></li>
									<li><a href="#">US</a></li>
								</ul>
							</div>
							
							<div class="btn-group">
								<button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
									VN??
									<span class="caret"></span>
								</button>
								<ul class="dropdown-menu">
									<li><a href="#">VN??</a></li>
									<li><a href="#">Dollar</a></li>
								</ul>
							</div>
						</div>
					</div>
					<div class="col-sm-8">
						<div class="shop-menu pull-right">
							<ul class="nav navbar-nav">
								<!-- <li><a href="#"><i class="fa fa-user"></i> Account</a></li>
								<li><a href="#"><i class="fa fa-star"></i> Wishlist</a></li>
								<li><a href="checkout.html"><i class="fa fa-crosshairs"></i> Checkout</a></li> -->
								<li><a href="{{URL::to('/show-cart')}}"><i class="fa fa-shopping-cart"></i>Gi??? h??ng</a></li>
								<?php
									$customer_id = Session::get('customer_id');
									$customer_name = Session::get('customer_name');
									if($customer_id != NULL){
								?>
								<li><a href="{{URL::to('/logout-checkout')}}">Xin ch??o {{$customer_name}}</a></li>
								<?php
									}else{
								?>
								<li><a href="{{URL::to('/login-checkout')}}"><i class="fa fa-lock"></i>????ng nh???p</a></li>
								<?php	
									}
								?>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-middle-->
	
		<div class="header-bottom"><!--header-bottom-->
			<div class="container">
				<div class="row">
					<div class="col-sm-9">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div>
						<div class="mainmenu pull-left">
							<ul class="nav navbar-nav collapse navbar-collapse">
								<li><a href="{{URL::to('/trangchu')}}" class="active">Trang ch???</a></li>

								<li class="dropdown"><a href="#">Tin t???c<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        <li><a href="blog.html">Th??ng b??o m???i</a></li>
										<li><a href="blog-single.html">Th??ng tin gi???m gi??</a></li>
                                    </ul>
                                </li> 
								<!-- <li><a href="404.html">404</a></li> -->
								<li><a href="contact-us.html">Li??n h???</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="search_box pull-right">
							<input type="text" placeholder="Search"/>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-bottom-->
	</header><!--/header-->
	  
    <section id="cart_items" class="form-checkout">
		<div class="container">
			<form action="{{URL::to('/save-checkout-customer')}}" method="POST">
				{{ csrf_field() }}
				<div class="cart-title"><span>Thanh to??n</span></div>

				<div class="shopper-informations">
					<div class="row">
						<div class="col-sm-12">
							<div class="bill-to">
								<p>Th??ng tin</p>
								<div class="signup-form">
									<div class="searchform">
									{{ csrf_field() }}
										<input type="text" name="shipping_name" placeholder="H??? v?? t??n">
										<input type="email" name="shipping_email" placeholder="Email*">
										<input type="text" name="shipping_address" placeholder="?????a ch???">
										<input type="text" name="shipping_phone" placeholder="S??? ??i???n tho???i">
										<div class="payment-options">
											<p>H??nh th???c thanh to??n</p>
											<span>
												<label><input name="payment_option" type="checkbox" value="COD"> Thanh to??n khi nh???n h??ng</label>
											</span>
											<span>
												<label><input name="payment_option" type="checkbox" value="ATM"> Thanh to??n qua th??? ng??n h??ng</label>
											</span>
										</div>
										<div class="order-message">
											<p>Ghi ch?? (Ghi r?? ?????a ch???, ng??, h???m... ????? gi??p shipper t??m d??? h??n)</p>
											<textarea class="note" name="shipping_note"  placeholder="Ghi ch??..." rows="10"></textarea>
										</div>	
									</div>
								</div>
							</div>
						</div>
											
					</div>
				</div>
				<div class="review-payment">
					<h2>S???n ph???m c???a b???n</h2>
				</div>


				<?php
				$content = Cart::content();
				?>
				<div class="table-responsive cart_info">
					<table class="table table-condensed">
						<thead>
							<tr class="cart_menu">
								<td class="image">S???n ph???m</td>
								<td class="description"></td>
								<td class="price">Gi?? ti???n</td>
								<td class="quantity">S??? l?????ng</td>
								<td class="total">Th??nh ti???n</td>
							</tr>
						</thead>

						<tbody>
						@foreach($content as $value_content)
							<tr>
								<td class="cart_product">
									<a href=""><img src="{{URL::to('/public/images/product/'.$value_content -> options -> image)}}" width="100" alt=""></a>
								</td>
								<td class="cart_description">
									<h4><a href="">{{$value_content -> name}}</a></h4>
									<p>ID: {{$value_content -> id}}</p>
								</td>
								<td class="cart_price">
									<p>{{number_format($value_content -> price).' '.'vn??'}}</p>
								</td>
								<td class="cart_quantity">
									<div class="cart_quantity_button">
										<input class="cart_quantity_input qty" type="text" min="1" name="quantity_value" value="{{$value_content -> qty}}">
										<input type="hidden" value="{{$value_content->rowId}}" name="rowId_cart">
									</div>
								</td>
								<td class="cart_total">
									<p class="cart_total_price">
										<?php
											$subtotal = $value_content -> price * $value_content -> qty;
											echo number_format($subtotal).' '.'vn??';
										?>
									</p>
								</td>
							</tr>
						@endforeach

							<tr>
								<td colspan="4">&nbsp;</td>
								<td colspan="2">
									<table class="table table-condensed total-result">
										<tr>
											<td>T???m t??nh</td>
											<td>{{Cart::subtotal(0).' '.'vn??'}}</td>
										</tr>
										<tr class="shipping-cost">
											<td>Ph?? v???n chuy???n</td>
											<td>Mi???n ph??</td>										
										</tr>
										<tr>
											<td>T???ng ti???n</td>
											<td><span>{{Cart::subtotal(0).' '.'vn??'}}</span></td>
										</tr>
									</table>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
				<div class="wrapper">
					<button class="btn-order btn btn-primary" type="submit">?????t h??ng</button>
				</div>
			</form>
		</div>
	</section> <!--/#cart_items-->

    <footer id="footer"><!--Footer-->
		<div class="footer-top">
			<div class="container">
				<div class="row">
					<div class="col-sm-12">
						<div class="companyinfo">
                            <div class="logo pull-left">
                                <a href="{{URL::to('/trangchu')}}">
                                    <img class="logo-img" src="{{asset('public/frontend/images/home/logo1.png')}}" alt="" />
                                </a>
                            </div>
						</div>

						<div class="col-sm-3 col-sm-offset-1">
						<div class="single-widget">
							<h2>Nh???n th??ng tin v??? MY-SHOP</h2>
							<form action="#" class="searchform">
								<input type="text" class="your-email" placeholder="Nh???p Email c???a b???n" />
								<button type="submit" class="btn btn-default btn-footer"><i class="fa fa-arrow-circle-o-right"></i></button>
								<!-- <p>Get the most recent updates from <br />our site and be updated your self...</p> -->
							</form>
						</div>
					</div>	
								
					
				</div>
			</div>
		</div>
		
		
		<div class="footer-bottom">
			<div class="container">
				<div class="row">
					<p class="pull-right">Designed by <span><a target="_blank" href="http://www.themeum.com">Themeum</a></span></p>
				</div>
			</div>
		</div>		
	</footer><!--/Footer-->
	

  
    <script src="{{asset('public/frontend/js/jquery.js')}}"></script>
	<script src="{{asset('public/frontend/js/bootstrap.min.js')}}"></script>
	<script src="{{asset('public/frontend/js/price-range.js')}}"></script>
    <script src="{{asset('public/frontend/js/jquery.prettyPhoto.js')}}"></script>
    <script src="{{asset('public/frontend/js/main.js')}}"></script>
</body>
</html>