@extends('cliente.promociones.perfil.perfil')

@section('profile-content')
	<div class="profile-content">
		{{--Columnas--}}
		<div class="row margin-top-10">
			<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
				<div class="dashboard-stat2">
					<div class="display">
						<div class="number">
							<h3 class="font-green-sharp">7800<small class="font-green-sharp">$</small></h3>
							<small>TOTAL PROFIT</small>
						</div>
						<div class="icon">
							<i class="icon-pie-chart"></i>
						</div>
					</div>
					<div class="progress-info">
						<div class="progress">
							<span style="width: 76%;" class="progress-bar progress-bar-success green-sharp">
							<span class="sr-only">76% progress</span>
							</span>
						</div>
						<div class="status">
							<div class="status-title">
								progress
							</div>
							<div class="status-number">
								76%
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
				<div class="dashboard-stat2">
					<div class="display">
						<div class="number">
							<h3 class="font-red-haze">1349</h3>
							<small>NEW FEEDBACKS</small>
						</div>
						<div class="icon">
							<i class="icon-like"></i>
						</div>
					</div>
					<div class="progress-info">
						<div class="progress">
							<span style="width: 85%;" class="progress-bar progress-bar-success red-haze">
							<span class="sr-only">85% change</span>
							</span>
						</div>
						<div class="status">
							<div class="status-title">
								change
							</div>
							<div class="status-number">
								85%
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
				<div class="dashboard-stat2">
					<div class="display">
						<div class="number">
							<h3 class="font-blue-sharp">567</h3>
							<small>NEW ORDERS</small>
						</div>
						<div class="icon">
							<i class="icon-basket"></i>
						</div>
					</div>
					<div class="progress-info">
						<div class="progress">
							<span style="width: 45%;" class="progress-bar progress-bar-success blue-sharp">
							<span class="sr-only">45% grow</span>
							</span>
						</div>
						<div class="status">
							<div class="status-title">
								grow
							</div>
							<div class="status-number">
								45%
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
				<div class="dashboard-stat2">
					<div class="display">
						<div class="number">
							<h3 class="font-purple-soft">276</h3>
							<small>NEW USERS</small>
						</div>
						<div class="icon">
							<i class="icon-user"></i>
						</div>
					</div>
					<div class="progress-info">
						<div class="progress">
							<span style="width: 57%;" class="progress-bar progress-bar-success purple-soft">
							<span class="sr-only">56% change</span>
							</span>
						</div>
						<div class="status">
							<div class="status-title">
								change
							</div>
							<div class="status-number">
								57%
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-6">
				<!-- BEGIN PORTLET -->
				<div class="portlet light ">
					<div class="portlet-title">
						<div class="caption caption-md">
							<i class="icon-bar-chart theme-font hide"></i>
							<span class="caption-subject font-blue-madison bold uppercase">Your Activity</span>
							<span class="caption-helper hide">weekly stats...</span>
						</div>
						<div class="actions">
							<div class="btn-group btn-group-devided" data-toggle="buttons">
								<label class="btn btn-transparent grey-salsa btn-circle btn-sm active">
									<input type="radio" name="options" class="toggle" id="option1">Today</label>
								<label class="btn btn-transparent grey-salsa btn-circle btn-sm">
									<input type="radio" name="options" class="toggle" id="option2">Week</label>
								<label class="btn btn-transparent grey-salsa btn-circle btn-sm">
									<input type="radio" name="options" class="toggle" id="option2">Month</label>
							</div>
						</div>
					</div>
					<div class="portlet-body">
						<div class="row number-stats margin-bottom-30">
							<div class="col-md-6 col-sm-6 col-xs-6">
								<div class="stat-left">
									<div class="stat-chart">
										<!-- do not line break "sparkline_bar" div. sparkline chart has an issue when the container div has line break -->
										<div id="sparkline_bar"></div>
									</div>
									<div class="stat-number">
										<div class="title"> Total </div>
										<div class="number">246</div>
									</div>
								</div>
							</div>
							<div class="col-md-6 col-sm-6 col-xs-6">
								<div class="stat-right">
									<div class="stat-chart">
										<!-- do not line break "sparkline_bar" div. sparkline chart has an issue when the container div has line break -->
										<div id="sparkline_bar2"></div>
									</div>
									<div class="stat-number">
										<div class="title">
											New
										</div>
										<div class="number">
											719
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="table-scrollable table-scrollable-borderless">
							<table class="table table-hover table-light">
								<thead>
								<tr class="uppercase">
									<th colspan="2">
										MEMBER
									</th>
									<th>
										Earnings
									</th>
									<th>
										CASES
									</th>
									<th>
										CLOSED
									</th>
									<th>
										RATE
									</th>
								</tr>
								</thead>
								<tr>
									<td class="fit">
										<img class="user-pic" src="{{asset('assets/admin/layout4/img/avatar4.jpg')}}">
									</td>
									<td>
										<a href="javascript:;" class="primary-link">Brain</a>
									</td>
									<td>
										$345
									</td>
									<td>
										45
									</td>
									<td>
										124
									</td>
									<td>
										<span class="bold theme-font">80%</span>
									</td>
								</tr>
								<tr>
									<td class="fit">
										<img class="user-pic" src="{{asset('assets/admin/layout4/img/avatar5.jpg')}}">
									</td>
									<td>
										<a href="javascript:;" class="primary-link">Nick</a>
									</td>
									<td>
										$560
									</td>
									<td>
										12
									</td>
									<td>
										24
									</td>
									<td>
										<span class="bold theme-font">67%</span>
									</td>
								</tr>
							</table>
						</div>
					</div>
				</div>
				<!-- END PORTLET -->
			</div>
			<div class="col-md-6">
				<!-- BEGIN PORTLET -->
				<div class="portlet light">
					<div class="portlet-title tabbable-line">
						<div class="caption caption-md">
							<i class="icon-globe theme-font hide"></i>
							<span class="caption-subject font-blue-madison bold uppercase">Feeds</span>
						</div>
						<ul class="nav nav-tabs">
							<li class="active">
								<a href="#tab_1_1" data-toggle="tab">
									System </a>
							</li>
							<li>
								<a href="#tab_1_2" data-toggle="tab">
									Activities </a>
							</li>
						</ul>
					</div>
					<div class="portlet-body">
						<!--BEGIN TABS-->
						<div class="tab-content">
							<div class="tab-pane active" id="tab_1_1">
								<div class="scroller" style="height: 320px;" data-always-visible="1" data-rail-visible1="0" data-handle-color="#D7DCE2">
									<ul class="feeds">
										<li>
											<div class="col1">
												<div class="cont">
													<div class="cont-col1">
														<div class="label label-sm label-success">
															<i class="fa fa-bell-o"></i>
														</div>
													</div>
													<div class="cont-col2">
														<div class="desc">
															You have 4 pending tasks. <span class="label label-sm label-info">
																			Take action <i class="fa fa-share"></i>
																			</span>
														</div>
													</div>
												</div>
											</div>
											<div class="col2">
												<div class="date">
													Just now
												</div>
											</div>
										</li>
										<li>
											<a href="javascript:;">
												<div class="col1">
													<div class="cont">
														<div class="cont-col1">
															<div class="label label-sm label-success">
																<i class="fa fa-bell-o"></i>
															</div>
														</div>
														<div class="cont-col2">
															<div class="desc">
																New version v1.4 just lunched!
															</div>
														</div>
													</div>
												</div>
												<div class="col2">
													<div class="date">
														20 mins
													</div>
												</div>
											</a>
										</li>
										<li>
											<div class="col1">
												<div class="cont">
													<div class="cont-col1">
														<div class="label label-sm label-danger">
															<i class="fa fa-bolt"></i>
														</div>
													</div>
													<div class="cont-col2">
														<div class="desc">
															Database server #12 overloaded. Please fix the issue.
														</div>
													</div>
												</div>
											</div>
											<div class="col2">
												<div class="date">
													24 mins
												</div>
											</div>
										</li>
										<li>
											<div class="col1">
												<div class="cont">
													<div class="cont-col1">
														<div class="label label-sm label-info">
															<i class="fa fa-bullhorn"></i>
														</div>
													</div>
													<div class="cont-col2">
														<div class="desc">
															New order received and pending for process.
														</div>
													</div>
												</div>
											</div>
											<div class="col2">
												<div class="date">
													30 mins
												</div>
											</div>
										</li>
										<li>
											<div class="col1">
												<div class="cont">
													<div class="cont-col1">
														<div class="label label-sm label-success">
															<i class="fa fa-bullhorn"></i>
														</div>
													</div>
													<div class="cont-col2">
														<div class="desc">
															New payment refund and pending approval.
														</div>
													</div>
												</div>
											</div>
											<div class="col2">
												<div class="date">
													40 mins
												</div>
											</div>
										</li>
										<li>
											<div class="col1">
												<div class="cont">
													<div class="cont-col1">
														<div class="label label-sm label-warning">
															<i class="fa fa-plus"></i>
														</div>
													</div>
													<div class="cont-col2">
														<div class="desc">
															New member registered. Pending approval.
														</div>
													</div>
												</div>
											</div>
											<div class="col2">
												<div class="date">
													1.5 hours
												</div>
											</div>
										</li>
										<li>
											<div class="col1">
												<div class="cont">
													<div class="cont-col1">
														<div class="label label-sm label-success">
															<i class="fa fa-bell-o"></i>
														</div>
													</div>
													<div class="cont-col2">
														<div class="desc">
															Web server hardware needs to be upgraded. <span class="label label-sm label-default ">
																			Overdue </span>
														</div>
													</div>
												</div>
											</div>
											<div class="col2">
												<div class="date">
													2 hours
												</div>
											</div>
										</li>
										<li>
											<div class="col1">
												<div class="cont">
													<div class="cont-col1">
														<div class="label label-sm label-default">
															<i class="fa fa-bullhorn"></i>
														</div>
													</div>
													<div class="cont-col2">
														<div class="desc">
															Prod01 database server is overloaded 90%.
														</div>
													</div>
												</div>
											</div>
											<div class="col2">
												<div class="date">
													3 hours
												</div>
											</div>
										</li>
										<li>
											<div class="col1">
												<div class="cont">
													<div class="cont-col1">
														<div class="label label-sm label-warning">
															<i class="fa fa-bullhorn"></i>
														</div>
													</div>
													<div class="cont-col2">
														<div class="desc">
															New group created. Pending manager review.
														</div>
													</div>
												</div>
											</div>
											<div class="col2">
												<div class="date">
													5 hours
												</div>
											</div>
										</li>
										<li>
											<div class="col1">
												<div class="cont">
													<div class="cont-col1">
														<div class="label label-sm label-info">
															<i class="fa fa-bullhorn"></i>
														</div>
													</div>
													<div class="cont-col2">
														<div class="desc">
															Order payment failed.
														</div>
													</div>
												</div>
											</div>
											<div class="col2">
												<div class="date">
													18 hours
												</div>
											</div>
										</li>
										<li>
											<div class="col1">
												<div class="cont">
													<div class="cont-col1">
														<div class="label label-sm label-default">
															<i class="fa fa-bullhorn"></i>
														</div>
													</div>
													<div class="cont-col2">
														<div class="desc">
															New application received.
														</div>
													</div>
												</div>
											</div>
											<div class="col2">
												<div class="date">
													21 hours
												</div>
											</div>
										</li>
										<li>
											<div class="col1">
												<div class="cont">
													<div class="cont-col1">
														<div class="label label-sm label-info">
															<i class="fa fa-bullhorn"></i>
														</div>
													</div>
													<div class="cont-col2">
														<div class="desc">
															Dev90 web server restarted. Pending overall system check.
														</div>
													</div>
												</div>
											</div>
											<div class="col2">
												<div class="date">
													22 hours
												</div>
											</div>
										</li>
										<li>
											<div class="col1">
												<div class="cont">
													<div class="cont-col1">
														<div class="label label-sm label-default">
															<i class="fa fa-bullhorn"></i>
														</div>
													</div>
													<div class="cont-col2">
														<div class="desc">
															New member registered. Pending approval
														</div>
													</div>
												</div>
											</div>
											<div class="col2">
												<div class="date">
													21 hours
												</div>
											</div>
										</li>
										<li>
											<div class="col1">
												<div class="cont">
													<div class="cont-col1">
														<div class="label label-sm label-info">
															<i class="fa fa-bullhorn"></i>
														</div>
													</div>
													<div class="cont-col2">
														<div class="desc">
															L45 Network failure. Schedule maintenance.
														</div>
													</div>
												</div>
											</div>
											<div class="col2">
												<div class="date">
													22 hours
												</div>
											</div>
										</li>
										<li>
											<div class="col1">
												<div class="cont">
													<div class="cont-col1">
														<div class="label label-sm label-default">
															<i class="fa fa-bullhorn"></i>
														</div>
													</div>
													<div class="cont-col2">
														<div class="desc">
															Order canceled with failed payment.
														</div>
													</div>
												</div>
											</div>
											<div class="col2">
												<div class="date">
													21 hours
												</div>
											</div>
										</li>
										<li>
											<div class="col1">
												<div class="cont">
													<div class="cont-col1">
														<div class="label label-sm label-info">
															<i class="fa fa-bullhorn"></i>
														</div>
													</div>
													<div class="cont-col2">
														<div class="desc">
															Web-A2 clound instance created. Schedule full scan.
														</div>
													</div>
												</div>
											</div>
											<div class="col2">
												<div class="date">
													22 hours
												</div>
											</div>
										</li>
										<li>
											<div class="col1">
												<div class="cont">
													<div class="cont-col1">
														<div class="label label-sm label-default">
															<i class="fa fa-bullhorn"></i>
														</div>
													</div>
													<div class="cont-col2">
														<div class="desc">
															Member canceled. Schedule account review.
														</div>
													</div>
												</div>
											</div>
											<div class="col2">
												<div class="date">
													21 hours
												</div>
											</div>
										</li>
										<li>
											<div class="col1">
												<div class="cont">
													<div class="cont-col1">
														<div class="label label-sm label-info">
															<i class="fa fa-bullhorn"></i>
														</div>
													</div>
													<div class="cont-col2">
														<div class="desc">
															New order received. Please take care of it.
														</div>
													</div>
												</div>
											</div>
											<div class="col2">
												<div class="date">
													22 hours
												</div>
											</div>
										</li>
									</ul>
								</div>
							</div>
							<div class="tab-pane" id="tab_1_2">
								<div class="scroller" style="height: 337px;" data-always-visible="1" data-rail-visible1="0" data-handle-color="#D7DCE2">
									<ul class="feeds">
										<li>
											<a href="javascript:;">
												<div class="col1">
													<div class="cont">
														<div class="cont-col1">
															<div class="label label-sm label-success">
																<i class="fa fa-bell-o"></i>
															</div>
														</div>
														<div class="cont-col2">
															<div class="desc">
																New user registered
															</div>
														</div>
													</div>
												</div>
												<div class="col2">
													<div class="date">
														Just now
													</div>
												</div>
											</a>
										</li>
										<li>
											<a href="javascript:;">
												<div class="col1">
													<div class="cont">
														<div class="cont-col1">
															<div class="label label-sm label-success">
																<i class="fa fa-bell-o"></i>
															</div>
														</div>
														<div class="cont-col2">
															<div class="desc">
																New order received
															</div>
														</div>
													</div>
												</div>
												<div class="col2">
													<div class="date">
														10 mins
													</div>
												</div>
											</a>
										</li>
										<li>
											<div class="col1">
												<div class="cont">
													<div class="cont-col1">
														<div class="label label-sm label-danger">
															<i class="fa fa-bolt"></i>
														</div>
													</div>
													<div class="cont-col2">
														<div class="desc">
															Order #24DOP4 has been rejected. <span class="label label-sm label-danger ">
																			Take action <i class="fa fa-share"></i>
																			</span>
														</div>
													</div>
												</div>
											</div>
											<div class="col2">
												<div class="date">
													24 mins
												</div>
											</div>
										</li>
										<li>
											<a href="javascript:;">
												<div class="col1">
													<div class="cont">
														<div class="cont-col1">
															<div class="label label-sm label-success">
																<i class="fa fa-bell-o"></i>
															</div>
														</div>
														<div class="cont-col2">
															<div class="desc">
																New user registered
															</div>
														</div>
													</div>
												</div>
												<div class="col2">
													<div class="date">
														Just now
													</div>
												</div>
											</a>
										</li>
										<li>
											<a href="javascript:;">
												<div class="col1">
													<div class="cont">
														<div class="cont-col1">
															<div class="label label-sm label-success">
																<i class="fa fa-bell-o"></i>
															</div>
														</div>
														<div class="cont-col2">
															<div class="desc">
																New user registered
															</div>
														</div>
													</div>
												</div>
												<div class="col2">
													<div class="date">
														Just now
													</div>
												</div>
											</a>
										</li>
										<li>
											<a href="javascript:;">
												<div class="col1">
													<div class="cont">
														<div class="cont-col1">
															<div class="label label-sm label-success">
																<i class="fa fa-bell-o"></i>
															</div>
														</div>
														<div class="cont-col2">
															<div class="desc">
																New user registered
															</div>
														</div>
													</div>
												</div>
												<div class="col2">
													<div class="date">
														Just now
													</div>
												</div>
											</a>
										</li>
										<li>
											<a href="javascript:;">
												<div class="col1">
													<div class="cont">
														<div class="cont-col1">
															<div class="label label-sm label-success">
																<i class="fa fa-bell-o"></i>
															</div>
														</div>
														<div class="cont-col2">
															<div class="desc">
																New user registered
															</div>
														</div>
													</div>
												</div>
												<div class="col2">
													<div class="date">
														Just now
													</div>
												</div>
											</a>
										</li>
										<li>
											<a href="javascript:;">
												<div class="col1">
													<div class="cont">
														<div class="cont-col1">
															<div class="label label-sm label-success">
																<i class="fa fa-bell-o"></i>
															</div>
														</div>
														<div class="cont-col2">
															<div class="desc">
																New user registered
															</div>
														</div>
													</div>
												</div>
												<div class="col2">
													<div class="date">
														Just now
													</div>
												</div>
											</a>
										</li>
										<li>
											<a href="javascript:;">
												<div class="col1">
													<div class="cont">
														<div class="cont-col1">
															<div class="label label-sm label-success">
																<i class="fa fa-bell-o"></i>
															</div>
														</div>
														<div class="cont-col2">
															<div class="desc">
																New user registered
															</div>
														</div>
													</div>
												</div>
												<div class="col2">
													<div class="date">
														Just now
													</div>
												</div>
											</a>
										</li>
										<li>
											<a href="javascript:;">
												<div class="col1">
													<div class="cont">
														<div class="cont-col1">
															<div class="label label-sm label-success">
																<i class="fa fa-bell-o"></i>
															</div>
														</div>
														<div class="cont-col2">
															<div class="desc">
																New user registered
															</div>
														</div>
													</div>
												</div>
												<div class="col2">
													<div class="date">
														Just now
													</div>
												</div>
											</a>
										</li>
									</ul>
								</div>
							</div>
						</div>
						<!--END TABS-->
					</div>
				</div>
				<!-- END PORTLET -->
			</div>
		</div>

		<div class="row">
			<div class="col-md-6">
				<!-- BEGIN PORTLET -->
				<div class="portlet light">
					<div class="portlet-title">
						<div class="caption caption-md">
							<i class="icon-bar-chart theme-font hide"></i>
							<span class="caption-subject font-blue-madison bold uppercase">Customer Support</span>
							<span class="caption-helper">45 pending</span>
						</div>
						<div class="inputs">
							<div class="portlet-input input-inline input-small ">
								<div class="input-icon right">
									<i class="icon-magnifier"></i>
									<input type="text" class="form-control form-control-solid" placeholder="search...">
								</div>
							</div>
						</div>
					</div>
					<div class="portlet-body">
						<div class="scroller" style="height: 305px;" data-always-visible="1" data-rail-visible1="0" data-handle-color="#D7DCE2">
							<div class="general-item-list">
								<div class="item">
									<div class="item-head">
										<div class="item-details">
											<img class="item-pic" src="{{asset('assets/admin/layout4/img/avatar4.jpg')}}">
											<a href="" class="item-name primary-link">Nick Larson</a>
											<span class="item-label">3 hrs ago</span>
										</div>
										<span class="item-status"><span class="badge badge-empty badge-success"></span> Open</span>
									</div>
									<div class="item-body">
										Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.
									</div>
								</div>
								<div class="item">
									<div class="item-head">
										<div class="item-details">
											<img class="item-pic" src="{{asset('assets/admin/layout4/img/avatar3.jpg')}}">
											<a href="" class="item-name primary-link">Mark</a>
											<span class="item-label">5 hrs ago</span>
										</div>
										<span class="item-status"><span class="badge badge-empty badge-warning"></span> Pending</span>
									</div>
									<div class="item-body">
										Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat tincidunt ut laoreet.
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- END PORTLET -->
			</div>
			<div class="col-md-6">
				<!-- BEGIN PORTLET -->
				<div class="portlet light tasks-widget">
					<div class="portlet-title">
						<div class="caption caption-md">
							<i class="icon-bar-chart theme-font hide"></i>
							<span class="caption-subject font-blue-madison bold uppercase">Tasks</span>
							<span class="caption-helper">16 pending</span>
						</div>
						<div class="inputs">
							<div class="portlet-input input-small input-inline">
								<div class="input-icon right">
									<i class="icon-magnifier"></i>
									<input type="text" class="form-control form-control-solid" placeholder="search...">
								</div>
							</div>
						</div>
					</div>
					<div class="portlet-body">
						<div class="task-content">
							<div class="scroller" style="height: 282px;" data-always-visible="1" data-rail-visible1="0" data-handle-color="#D7DCE2">
								<!-- START TASK LIST -->
								<ul class="task-list">
									<li>
										<div class="task-checkbox">
											<input type="hidden" value="1" name="test"/>
											<input type="checkbox" class="liChild" value="2" name="test"/>
										</div>
										<div class="task-title">
															<span class="task-title-sp">
															Present 2013 Year IPO Statistics at Board Meeting </span>
											<span class="label label-sm label-success">Company</span>
															<span class="task-bell">
															<i class="fa fa-bell-o"></i>
															</span>
										</div>
										<div class="task-config">
											<div class="task-config-btn btn-group">
												<a class="btn btn-xs default" href="javascript:;" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
													<i class="fa fa-cog"></i><i class="fa fa-angle-down"></i>
												</a>
												<ul class="dropdown-menu pull-right">
													<li>
														<a href="javascript:;">
															<i class="fa fa-check"></i> Complete </a>
													</li>
													<li>
														<a href="javascript:;">
															<i class="fa fa-pencil"></i> Edit </a>
													</li>
													<li>
														<a href="javascript:;">
															<i class="fa fa-trash-o"></i> Cancel </a>
													</li>
												</ul>
											</div>
										</div>
									</li>
									<li>
										<div class="task-checkbox">
											<input type="checkbox" class="liChild" value=""/>
										</div>
										<div class="task-title">
															<span class="task-title-sp">
															Hold An Interview for Marketing Manager Position </span>
											<span class="label label-sm label-danger">Marketing</span>
										</div>
										<div class="task-config">
											<div class="task-config-btn btn-group">
												<a class="btn btn-xs default" href="javascript:;" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
													<i class="fa fa-cog"></i><i class="fa fa-angle-down"></i>
												</a>
												<ul class="dropdown-menu pull-right">
													<li>
														<a href="javascript:;">
															<i class="fa fa-check"></i> Complete </a>
													</li>
													<li>
														<a href="javascript:;">
															<i class="fa fa-pencil"></i> Edit </a>
													</li>
													<li>
														<a href="javascript:;">
															<i class="fa fa-trash-o"></i> Cancel </a>
													</li>
												</ul>
											</div>
										</div>
									</li>
									<li>
										<div class="task-checkbox">
											<input type="checkbox" class="liChild" value=""/>
										</div>
										<div class="task-title">
															<span class="task-title-sp">
															AirAsia Intranet System Project Internal Meeting </span>
											<span class="label label-sm label-success">AirAsia</span>
															<span class="task-bell">
															<i class="fa fa-bell-o"></i>
															</span>
										</div>
										<div class="task-config">
											<div class="task-config-btn btn-group">
												<a class="btn btn-xs default" href="javascript:;" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
													<i class="fa fa-cog"></i><i class="fa fa-angle-down"></i>
												</a>
												<ul class="dropdown-menu pull-right">
													<li>
														<a href="javascript:;">
															<i class="fa fa-check"></i> Complete </a>
													</li>
													<li>
														<a href="javascript:;">
															<i class="fa fa-pencil"></i> Edit </a>
													</li>
													<li>
														<a href="javascript:;">
															<i class="fa fa-trash-o"></i> Cancel </a>
													</li>
												</ul>
											</div>
										</div>
									</li>
									<li>
										<div class="task-checkbox">
											<input type="checkbox" class="liChild" value=""/>
										</div>
										<div class="task-title">
															<span class="task-title-sp">
															Technical Management Meeting </span>
											<span class="label label-sm label-warning">Company</span>
										</div>
										<div class="task-config">
											<div class="task-config-btn btn-group">
												<a class="btn btn-xs default" href="javascript:;" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
													<i class="fa fa-cog"></i><i class="fa fa-angle-down"></i>
												</a>
												<ul class="dropdown-menu pull-right">
													<li>
														<a href="javascript:;">
															<i class="fa fa-check"></i> Complete </a>
													</li>
													<li>
														<a href="javascript:;">
															<i class="fa fa-pencil"></i> Edit </a>
													</li>
													<li>
														<a href="javascript:;">
															<i class="fa fa-trash-o"></i> Cancel </a>
													</li>
												</ul>
											</div>
										</div>
									</li>
									<li>
										<div class="task-checkbox">
											<input type="checkbox" class="liChild" value=""/>
										</div>
										<div class="task-title">
															<span class="task-title-sp">
															Kick-off Company CRM Mobile App Development </span>
											<span class="label label-sm label-info">Internal Products</span>
										</div>
										<div class="task-config">
											<div class="task-config-btn btn-group">
												<a class="btn btn-xs default" href="javascript:;" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
													<i class="fa fa-cog"></i><i class="fa fa-angle-down"></i>
												</a>
												<ul class="dropdown-menu pull-right">
													<li>
														<a href="javascript:;">
															<i class="fa fa-check"></i> Complete </a>
													</li>
													<li>
														<a href="javascript:;">
															<i class="fa fa-pencil"></i> Edit </a>
													</li>
													<li>
														<a href="javascript:;">
															<i class="fa fa-trash-o"></i> Cancel </a>
													</li>
												</ul>
											</div>
										</div>
									</li>
									<li>
										<div class="task-checkbox">
											<input type="checkbox" class="liChild" value=""/>
										</div>
										<div class="task-title">
															<span class="task-title-sp">
															Prepare Commercial Offer For SmartVision Website Rewamp </span>
											<span class="label label-sm label-danger">SmartVision</span>
										</div>
										<div class="task-config">
											<div class="task-config-btn btn-group">
												<a class="btn btn-xs default" href="javascript:;" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
													<i class="fa fa-cog"></i><i class="fa fa-angle-down"></i>
												</a>
												<ul class="dropdown-menu pull-right">
													<li>
														<a href="javascript:;">
															<i class="fa fa-check"></i> Complete </a>
													</li>
													<li>
														<a href="javascript:;">
															<i class="fa fa-pencil"></i> Edit </a>
													</li>
													<li>
														<a href="javascript:;">
															<i class="fa fa-trash-o"></i> Cancel </a>
													</li>
												</ul>
											</div>
										</div>
									</li>
									<li>
										<div class="task-checkbox">
											<input type="checkbox" class="liChild" value=""/>
										</div>
										<div class="task-title">
															<span class="task-title-sp">
															Sign-Off The Comercial Agreement With AutoSmart </span>
											<span class="label label-sm label-default">AutoSmart</span>
															<span class="task-bell">
															<i class="fa fa-bell-o"></i>
															</span>
										</div>
										<div class="task-config">
											<div class="task-config-btn btn-group">
												<a class="btn btn-xs default" href="javascript:;" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
													<i class="fa fa-cog"></i><i class="fa fa-angle-down"></i>
												</a>
												<ul class="dropdown-menu pull-right">
													<li>
														<a href="javascript:;">
															<i class="fa fa-check"></i> Complete </a>
													</li>
													<li>
														<a href="javascript:;">
															<i class="fa fa-pencil"></i> Edit </a>
													</li>
													<li>
														<a href="javascript:;">
															<i class="fa fa-trash-o"></i> Cancel </a>
													</li>
												</ul>
											</div>
										</div>
									</li>
									<li>
										<div class="task-checkbox">
											<input type="checkbox" class="liChild" value=""/>
										</div>
										<div class="task-title">
															<span class="task-title-sp">
															Company Staff Meeting </span>
											<span class="label label-sm label-success">Cruise</span>
															<span class="task-bell">
															<i class="fa fa-bell-o"></i>
															</span>
										</div>
										<div class="task-config">
											<div class="task-config-btn btn-group">
												<a class="btn btn-xs default" href="javascript:;" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
													<i class="fa fa-cog"></i><i class="fa fa-angle-down"></i>
												</a>
												<ul class="dropdown-menu pull-right">
													<li>
														<a href="javascript:;">
															<i class="fa fa-check"></i> Complete </a>
													</li>
													<li>
														<a href="javascript:;">
															<i class="fa fa-pencil"></i> Edit </a>
													</li>
													<li>
														<a href="javascript:;">
															<i class="fa fa-trash-o"></i> Cancel </a>
													</li>
												</ul>
											</div>
										</div>
									</li>
									<li class="last-line">
										<div class="task-checkbox">
											<input type="checkbox" class="liChild" value=""/>
										</div>
										<div class="task-title">
															<span class="task-title-sp">
															KeenThemes Investment Discussion </span>
											<span class="label label-sm label-warning">KeenThemes </span>
										</div>
										<div class="task-config">
											<div class="task-config-btn btn-group">
												<a class="btn btn-xs default" href="javascript:;" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
													<i class="fa fa-cog"></i><i class="fa fa-angle-down"></i>
												</a>
												<ul class="dropdown-menu pull-right">
													<li>
														<a href="javascript:;">
															<i class="fa fa-check"></i> Complete </a>
													</li>
													<li>
														<a href="javascript:;">
															<i class="fa fa-pencil"></i> Edit </a>
													</li>
													<li>
														<a href="javascript:;">
															<i class="fa fa-trash-o"></i> Cancel </a>
													</li>
												</ul>
											</div>
										</div>
									</li>
								</ul>
								<!-- END START TASK LIST -->
							</div>
						</div>
						<div class="task-footer">
							<div class="btn-arrow-link pull-right">
								<a href="javascript:;">See All Tasks</a>
							</div>
						</div>
					</div>
				</div>
				<!-- END PORTLET -->
			</div>
		</div>
	</div>
@stop