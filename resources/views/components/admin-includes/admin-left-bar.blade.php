<!-- begin:: Aside -->
<button class="kt-aside-close " id="kt_aside_close_btn"><i class="la la-close"></i></button>
				<div class="kt-aside  kt-aside--fixed  kt-grid__item kt-grid kt-grid--desktop kt-grid--hor-desktop" id="kt_aside">

					<!-- begin:: Aside -->
					<div class="kt-aside__brand kt-grid__item " id="kt_aside_brand">
						<div class="kt-aside__brand-logo" style="margin: auto;">
							<a href="{{route('admin.dashboard')}}" class="logo_text_custom">
								<img class="side_logo" alt="Logo" src="{{asset('storage/app/public/'.@$siteSetting->logo) }}" width="100px;" height="80px !important;" />
								<!-- <span>{{ config('app.name', 'Laravel') }}</span> -->
								<!-- <img alt="Logo" src="http://www.w3.org/2000/svg" width="150" /> -->
							</a>
						</div>
						<div class="kt-aside__brand-tools">
							<button class="kt-aside__brand-aside-toggler" id="kt_aside_toggler">
								<span><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
										<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
											<polygon id="Shape" points="0 0 24 0 24 24 0 24" />
											<path d="M5.29288961,6.70710318 C4.90236532,6.31657888 4.90236532,5.68341391 5.29288961,5.29288961 C5.68341391,4.90236532 6.31657888,4.90236532 6.70710318,5.29288961 L12.7071032,11.2928896 C13.0856821,11.6714686 13.0989277,12.281055 12.7371505,12.675721 L7.23715054,18.675721 C6.86395813,19.08284 6.23139076,19.1103429 5.82427177,18.7371505 C5.41715278,18.3639581 5.38964985,17.7313908 5.76284226,17.3242718 L10.6158586,12.0300721 L5.29288961,6.70710318 Z" id="Path-94" fill="#000000" fill-rule="nonzero" transform="translate(8.999997, 11.999999) scale(-1, 1) translate(-8.999997, -11.999999) " />
											<path d="M10.7071009,15.7071068 C10.3165766,16.0976311 9.68341162,16.0976311 9.29288733,15.7071068 C8.90236304,15.3165825 8.90236304,14.6834175 9.29288733,14.2928932 L15.2928873,8.29289322 C15.6714663,7.91431428 16.2810527,7.90106866 16.6757187,8.26284586 L22.6757187,13.7628459 C23.0828377,14.1360383 23.1103407,14.7686056 22.7371482,15.1757246 C22.3639558,15.5828436 21.7313885,15.6103465 21.3242695,15.2371541 L16.0300699,10.3841378 L10.7071009,15.7071068 Z" id="Path-94" fill="#000000" fill-rule="nonzero" opacity="0.3" transform="translate(15.999997, 11.999999) scale(-1, 1) rotate(-270.000000) translate(-15.999997, -11.999999) " />
										</g>
									</svg></span>
								<span><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
										<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
											<polygon id="Shape" points="0 0 24 0 24 24 0 24" />
											<path d="M12.2928955,6.70710318 C11.9023712,6.31657888 11.9023712,5.68341391 12.2928955,5.29288961 C12.6834198,4.90236532 13.3165848,4.90236532 13.7071091,5.29288961 L19.7071091,11.2928896 C20.085688,11.6714686 20.0989336,12.281055 19.7371564,12.675721 L14.2371564,18.675721 C13.863964,19.08284 13.2313966,19.1103429 12.8242777,18.7371505 C12.4171587,18.3639581 12.3896557,17.7313908 12.7628481,17.3242718 L17.6158645,12.0300721 L12.2928955,6.70710318 Z" id="Path-94" fill="#000000" fill-rule="nonzero" />
											<path d="M3.70710678,15.7071068 C3.31658249,16.0976311 2.68341751,16.0976311 2.29289322,15.7071068 C1.90236893,15.3165825 1.90236893,14.6834175 2.29289322,14.2928932 L8.29289322,8.29289322 C8.67147216,7.91431428 9.28105859,7.90106866 9.67572463,8.26284586 L15.6757246,13.7628459 C16.0828436,14.1360383 16.1103465,14.7686056 15.7371541,15.1757246 C15.3639617,15.5828436 14.7313944,15.6103465 14.3242754,15.2371541 L9.03007575,10.3841378 L3.70710678,15.7071068 Z" id="Path-94" fill="#000000" fill-rule="nonzero" opacity="0.3" transform="translate(9.000003, 11.999999) rotate(-270.000000) translate(-9.000003, -11.999999) " />
										</g>
									</svg></span>
							</button>

							<!--
			<button class="kt-aside__brand-aside-toggler kt-aside__brand-aside-toggler--left" id="kt_aside_toggler"><span></span></button>
			-->
						</div>
					</div>

					<!-- end:: Aside -->

					<!-- begin:: Aside Menu -->
					<div class="kt-aside-menu-wrapper kt-grid__item kt-grid__item--fluid" id="kt_aside_menu_wrapper">
						<div id="kt_aside_menu" class="kt-aside-menu " data-ktmenu-vertical="1" data-ktmenu-scroll="1" data-ktmenu-dropdown-timeout="500">
							<ul class="kt-menu__nav ">
								<li class="kt-menu__item  {{ Request::is('admin/dashboard*') ? 'kt-menu__item--active' : '' }}" aria-haspopup="true"><a href="{{route('admin.dashboard')}}" class="kt-menu__link "><i class="kt-menu__link-icon flaticon-home"></i><span class="kt-menu__link-text">Dashboard</span></a></li>
								@if(Auth::user()->hasRole('SUPER-ADMIN'))
								<li class="kt-menu__item  kt-menu__item--submenu {{ Request::is('admin/settings*') ? 'kt-menu__item--open' : '' }} {{ Request::is('admin/social-links*') ? 'kt-menu__item--open' : '' }} {{ Request::is('admin/change-password') ? 'kt-menu__item--open' : '' }} " aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><a href="javascript:;" class="kt-menu__link kt-menu__toggle"><span class="kt-menu__link-icon">
								<i class="kt-menu__link-icon fas fa-cogs"></i>
											</svg></span><span class="kt-menu__link-text">Site Settings</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
									<div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
										<ul class="kt-menu__subnav">
											
											<li class="kt-menu__item  {{ Request::is('admin/settings*') ? 'kt-menu__item--active' : '' }}" aria-haspopup="true"><a href="{{route('settings.edit')}}" class="kt-menu__link "><i class="kt-menu__link-icon fa fa-file-alt"><span></span></i><span class="kt-menu__link-text">Settings </span></a></li>

											<li class="kt-menu__item  {{ Request::is('admin/social-links*') ? 'kt-menu__item--active' : '' }}" aria-haspopup="true"><a href="{{route('social-links.index')}}" class="kt-menu__link "><i class="kt-menu__link-icon fa fa-file-alt"><span></span></i><span class="kt-menu__link-text">Social Links </span></a></li>

											<li class="kt-menu__item  {{ Request::is('admin/change-password') ? 'kt-menu__item--active' : '' }}" aria-haspopup="true"><a href="{{route('change.password')}}" class="kt-menu__link "><i class="kt-menu__link-icon fa fa-file-alt"><span></span></i><span class="kt-menu__link-text">Change Password </span></a></li>
									</div>
								</li>
								
								
								<!-- <li class="kt-menu__item  kt-menu__item--submenu {{ Request::is('admin/users*') ? 'kt-menu__item--open' : '' }} {{ Request::is('admin/users*') ? 'kt-menu__item--open' : '' }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><a href="javascript:;" class="kt-menu__link kt-menu__toggle"><span class="kt-menu__link-icon">
								<i class="kt-menu__link-icon fa fa-users"></i>
											</svg></span><span class="kt-menu__link-text">Users Management</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
									<div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
										<ul class="kt-menu__subnav">
											
											<li class="kt-menu__item  {{ Request::is('admin/users*') ? 'kt-menu__item--active' : '' }}" aria-haspopup="true"><a href="{{route('users.index')}}" class="kt-menu__link "><i class="kt-menu__link-icon fa fa-user"><span></span></i><span class="kt-menu__link-text">Users </span></a></li>
									</div>
								</li> -->


								<li class="kt-menu__item  kt-menu__item--submenu {{ Request::is('admin/cms*') ? 'kt-menu__item--open' : '' }} {{ Request::is('admin/banners*') ? 'kt-menu__item--open' : '' }}{{ Request::is('admin/sliders*') ? 'kt-menu__item--open' : '' }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><a href="javascript:;" class="kt-menu__link kt-menu__toggle"><span class="kt-menu__link-icon">
								<i class="kt-menu__link-icon fas fa-gopuram"></i>
											</svg></span><span class="kt-menu__link-text">Cms Management</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
									<div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
										<ul class="kt-menu__subnav">
											
											<li class="kt-menu__item  {{ Request::is('admin/cms*') ? 'kt-menu__item--active' : '' }}" aria-haspopup="true"><a href="{{route('cms.index')}}" class="kt-menu__link "><i class="kt-menu__link-icon fa fa-file-alt"><span></span></i><span class="kt-menu__link-text">Cms </span></a></li>

											<li class="kt-menu__item  {{ Request::is('admin/sliders*') ? 'kt-menu__item--active' : '' }}" aria-haspopup="true"><a href="{{route('sliders.index')}}" class="kt-menu__link "><i class="kt-menu__link-icon fa fa-file-alt"><span></span></i><span class="kt-menu__link-text">Slider </span></a></li>

											<li class="kt-menu__item  {{ Request::is('admin/banners*') ? 'kt-menu__item--active' : '' }}" aria-haspopup="true"><a href="{{route('banners.index')}}" class="kt-menu__link "><i class="kt-menu__link-icon fa fa-file-alt"><span></span></i><span class="kt-menu__link-text">Banner </span></a></li>
									</div>
								</li>

								

								

								<li class="kt-menu__item  kt-menu__item--submenu {{ Request::is('admin/seos*') ? 'kt-menu__item--open' : '' }} " aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><a href="javascript:;" class="kt-menu__link kt-menu__toggle"><span class="kt-menu__link-icon">
								<i class="kt-menu__link-icon fas fa-crosshairs"></i>
											</svg></span><span class="kt-menu__link-text">Seo Management</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
									<div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
										<ul class="kt-menu__subnav">
											
											<li class="kt-menu__item  {{ Request::is('admin/seos*') ? 'kt-menu__item--active' : '' }}" aria-haspopup="true"><a href="{{route('seos.index')}}" class="kt-menu__link "><i class="kt-menu__link-icon fa fa-file-alt"><span></span></i><span class="kt-menu__link-text">Seo </span></a></li>

									</div>
								</li>

								<li class="kt-menu__item  kt-menu__item--submenu {{ Request::is('admin/products*') ? 'kt-menu__item--open' : '' }} {{ Request::is('admin/categories*') ? 'kt-menu__item--open' : '' }} {{ Request::is('admin/sub-categories*') ? 'kt-menu__item--open' : '' }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><a href="javascript:;" class="kt-menu__link kt-menu__toggle"><span class="kt-menu__link-icon">
								<i class="kt-menu__link-icon fas fa-bookmark"></i>
											</svg></span><span class="kt-menu__link-text">Product Management</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
									<div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
										<ul class="kt-menu__subnav">
											<li class="kt-menu__item  {{ Request::is('admin/categories*') ? 'kt-menu__item--active' : '' }}" aria-haspopup="true"><a href="{{route('categories.index')}}" class="kt-menu__link "><i class="kt-menu__link-icon fa fa-file-alt"><span></span></i><span class="kt-menu__link-text">Product Category </span></a></li>
											
											<li class="kt-menu__item  {{ Request::is('admin/products*') ? 'kt-menu__item--active' : '' }}" aria-haspopup="true"><a href="{{route('products.index')}}" class="kt-menu__link "><i class="kt-menu__link-icon fa fa-file-alt"><span></span></i><span class="kt-menu__link-text">Products </span></a></li>
										</ul>

											
									</div>
								</li>

								

								
								

								

								

								<li class="kt-menu__item  kt-menu__item--submenu {{ Request::is('admin/testimonials*') ? 'kt-menu__item--open' : '' }} " aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><a href="javascript:;" class="kt-menu__link kt-menu__toggle"><span class="kt-menu__link-icon">
								<i class="kt-menu__link-icon fas fa-folder"></i>
											</svg></span><span class="kt-menu__link-text">Testimonials</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
									<div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
										<ul class="kt-menu__subnav">
											
											<li class="kt-menu__item  {{ Request::is('admin/testimonials*') ? 'kt-menu__item--active' : '' }}" aria-haspopup="true"><a href="{{route('testimonials.index')}}" class="kt-menu__link "><i class="kt-menu__link-icon fas fa-file-invoice"><span></span></i><span class="kt-menu__link-text">Testimonials </span></a></li>

											
									</div>
								</li>

								<li class="kt-menu__item  kt-menu__item--submenu {{ Request::is('admin/enqueires*') ? 'kt-menu__item--open' : '' }} " aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><a href="javascript:;" class="kt-menu__link kt-menu__toggle"><span class="kt-menu__link-icon">
								<i class="kt-menu__link-icon fa fa-users"></i>
											</svg></span><span class="kt-menu__link-text">Enquery Management</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
									<div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
										<ul class="kt-menu__subnav">
											
											<li class="kt-menu__item  {{ Request::is('admin/enqueires*') ? 'kt-menu__item--active' : '' }}" aria-haspopup="true"><a href="{{route('enqueires.index')}}" class="kt-menu__link "><i class="kt-menu__link-icon fa fa-user"><span></span></i><span class="kt-menu__link-text">Enquery List</span></a></li>
										</ul>
									</div>
								</li>
								
								<li class="kt-menu__item  kt-menu__item--submenu {{ Request::is('admin/galleries*') ? 'kt-menu__item--open' : '' }} " aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><a href="javascript:;" class="kt-menu__link kt-menu__toggle"><span class="kt-menu__link-icon">
								<i class="kt-menu__link-icon fas fa-folder"></i>
											</svg></span><span class="kt-menu__link-text">Gallery Management</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
									<div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
										<ul class="kt-menu__subnav">
											
											<li class="kt-menu__item  {{ Request::is('admin/galleries*') ? 'kt-menu__item--active' : '' }}" aria-haspopup="true"><a href="{{route('galleries.index')}}" class="kt-menu__link "><i class="kt-menu__link-icon fas fa-file-invoice"><span></span></i><span class="kt-menu__link-text">Gallery </span></a></li>

											
									</div>
								</li>

								@endif

								<li class="kt-menu__item  kt-menu__item--submenu {{ Request::is('admin/investors*') ? 'kt-menu__item--open' : '' }} " aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><a href="javascript:;" class="kt-menu__link kt-menu__toggle"><span class="kt-menu__link-icon">
								<i class="kt-menu__link-icon fas fa-cube"></i>
											</svg></span><span class="kt-menu__link-text">Investor</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
									<div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
										<ul class="kt-menu__subnav">
											
											<li class="kt-menu__item  {{ Request::is('admin/investors*') ? 'kt-menu__item--active' : '' }}" aria-haspopup="true"><a href="{{route('investors.index')}}" class="kt-menu__link "><i class="kt-menu__link-icon fas fa-file-invoice"><span></span></i><span class="kt-menu__link-text">Investors </span></a></li>
											</ul>
											
									</div>
								</li>


								
								

							</ul>
						</div>
					</div>
                    <!-- end:: Aside Menu -->
                    </div>

				<!-- end:: Aside -->
