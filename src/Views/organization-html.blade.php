<?php
$currentUrl = url()->current();
?>
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
<link href="{{asset('vendor/karbonsoft-orgchart/style.css')}}" rel="stylesheet">
<div id="hwpwrap">
	<div class="custom-wp-admin wp-admin wp-core-ui js   organization-max-depth-0 nav-organizations-php auto-fold admin-bar">
		<div id="wpwrap">
			<div id="wpcontent">
				<div id="wpbody">
					<div id="wpbody-content">

						<div class="wrap">

							<div class="manage-organizations">
								<form method="get" action="{{ $currentUrl }}">
									<label for="organization" class="selected-organization">Select the organization you want to edit:</label>

									{!! OrgChart::select('organization', $organizationlist) !!}

									<span class="submit-btn">
										<input type="submit" class="button-secondary" value="Choose">
									</span>
									<span class="add-new-organization-action"> or <a href="{{ $currentUrl }}?action=edit&organization=0">Create new organization</a>. </span>
								</form>
							</div>
							<div id="nav-organizations-frame">

								@if(request()->has('organization')  && !empty(request()->input("organization")))
								<div id="organization-settings-column" class="metabox-holder">

									<div class="clear"></div>
									// organization as item adder
									<form id="nav-organization-meta" action="" class="nav-organization-meta" method="post" enctype="multipart/form-data">
										<div id="side-sortables" class="accordion-container">
											<ul class="outer-border">
												<li class="control-section accordion-section  open add-page" id="add-page">
													<h3 class="accordion-section-title hndle" tabindex="0"> Custom Link <span class="screen-reader-text">Press return or enter to expand</span></h3>
													<div class="accordion-section-content ">
														<div class="inside">
															<div class="customlinkdiv" id="customlinkdiv">
																<p id="organization-item-url-wrap">
																	<label class="howto" for="custom-organization-item-url"> <span>URL</span>&nbsp;&nbsp;&nbsp;
																		{!! OrgChart::select('organization', $organizationlist) !!}
																		<input id="custom-organization-item-url" name="url" type="text" class="organization-item-textbox " placeholder="url">
																	</label>
																</p>

																<p id="organization-item-name-wrap">
																	<label class="howto" for="custom-organization-item-name"> <span>Label</span>&nbsp;
																		<input id="custom-organization-item-name" name="label" type="text" class="regular-text organization-item-textbox input-with-default-title" title="Label organization">
																	</label>
																</p>

																<p class="button-controls">

																	<a  href="#" onclick="addcustomorganization()"  class="button-secondary submit-add-to-organization right"  >Add organization item</a>
																	<span class="spinner" id="spincustomu"></span>
																</p>

															</div>
														</div>
													</div>
												</li>

											</ul>
										</div>
									</form>

									<div class="clear"></div>
									// person as item
									<form id="nav-organization-meta" action="" class="nav-organization-meta" method="post" enctype="multipart/form-data">
										<div id="side-sortables" class="accordion-container">
											<ul class="outer-border">
												<li class="control-section accordion-section  open add-page" id="add-page">
													<h3 class="accordion-section-title hndle" tabindex="0"> Custom Link <span class="screen-reader-text">Press return or enter to expand</span></h3>
													<div class="accordion-section-content ">
														<div class="inside">
															<div class="customlinkdiv" id="customlinkdiv">
																<p id="organization-item-url-wrap">
																	<label class="howto" for="custom-organization-item-url"> <span>URL</span>&nbsp;&nbsp;&nbsp;
																		<input id="custom-organization-item-url" name="url" type="text" class="organization-item-textbox " placeholder="url">
																	</label>
																</p>

																<p id="organization-item-name-wrap">
																	<label class="howto" for="custom-organization-item-name"> <span>Label</span>&nbsp;
																		<input id="custom-organization-item-name" name="label" type="text" class="regular-text organization-item-textbox input-with-default-title" title="Label organization">
																	</label>
																</p>

																@if(!empty($roles))
																	<p id="organization-item-role_id-wrap">
																		<label class="howto" for="custom-organization-item-name"> <span>Role</span>&nbsp;
																			<select id="custom-organization-item-role" name="role">
																				<option value="0">Select Role</option>
																				@foreach($roles as $role)
																					<option value="{{ $role->$role_pk }}">{{ ucfirst($role->$role_title_field) }}</option>
																				@endforeach
																			</select>
																		</label>
																	</p>
																@endif

																<p class="button-controls">

																	<a  href="#" onclick="addcustomorganization()"  class="button-secondary submit-add-to-organization right"  >Add organization item</a>
																	<span class="spinner" id="spincustomu"></span>
																</p>

															</div>
														</div>
													</div>
												</li>

											</ul>
										</div>
									</form>


								</div>
								@endif
								<div id="organization-management-liquid">
									<div id="organization-management">
										<form id="update-nav-organization" action="" method="post" enctype="multipart/form-data">
											<div class="organization-edit ">
												<div id="nav-organization-header">
													<div class="major-publishing-actions">
														<label class="organization-name-label howto open-label" for="organization-name"> <span>Name</span>
															<input name="organization-name" id="organization-name" type="text" class="organization-name regular-text organization-item-textbox" title="Enter organization name" value="@if(isset($indorganization)){{$indorganization->name}}@endif">
															<input type="hidden" id="idorganization" value="@if(isset($indorganization)){{$indorganization->id}}@endif" />
														</label>

														@if(request()->has('action'))
														<div class="publishing-action">
															<a onclick="createneworganization()" name="save_organization" id="save_organization_header" class="button button-primary organization-save">Create organization</a>
														</div>
														@elseif(request()->has("organization"))
														<div class="publishing-action">
															<a onclick="getorganizations()" name="save_organization" id="save_organization_header" class="button button-primary organization-save">Save organization</a>
															<span class="spinner" id="spincustomu2"></span>
														</div>

														@else
														<div class="publishing-action">
															<a onclick="createneworganization()" name="save_organization" id="save_organization_header" class="button button-primary organization-save">Create organization</a>
														</div>
														@endif
													</div>
												</div>
												<div id="post-body">
													<div id="post-body-content">

														@if(request()->has("organization"))
														<h3>Organization Structure</h3>
														<div class="drag-instructions post-body-plain" style="">
															<p>
																Place each item in the order you prefer. Click on the arrow to the right of the item to display more configuration options.
															</p>
														</div>

														@else
														<h3>Organization Creation</h3>
														<div class="drag-instructions post-body-plain" style="">
															<p>
																Please enter the name and select "Create organization" button
															</p>
														</div>
														@endif

														<ul class="organization ui-sortable" id="organization-to-edit">
															@if(isset($organizations))
															@foreach($organizations as $org)
															<li id="organization-item-{{$org->id}}" class="organization-item organization-item-depth-{{$org->depth}} organization-item-page organization-item-edit-inactive pending" style="display: list-item;">
																<dl class="organization-item-bar">
																	<dt class="organization-item-handle">
																		<span class="item-title"> <span class="organization-item-title"> <span id="organizationtitletemp_{{$org->id}}">{{$org->label}}</span> <span style="color: transparent;">|{{$org->id}}|</span> </span> <span class="is-suborganization" style="@if($org->depth==0)display: none;@endif">Subelement</span> </span>
																		<span class="item-controls"> <span class="item-type">Link</span> <span class="item-order hide-if-js"> <a href="{{ $currentUrl }}?action=move-up-organization-item&organization-item={{$org->id}}" class="item-move-up"><abbr title="Move Up">↑</abbr></a> | <a href="{{ $currentUrl }}?action=move-down-organization-item&organization-item={{$org->id}}" class="item-move-down"><abbr title="Move Down">↓</abbr></a> </span> <a class="item-edit" id="edit-{{$org->id}}" title=" " href="{{ $currentUrl }}?edit-organization-item={{$org->id}}#organization-item-settings-{{$org->id}}"> </a> </span>
																	</dt>
																</dl>

																<div class="organization-item-settings" id="organization-item-settings-{{$org->id}}">
																	<input type="hidden" class="edit-organization-item-id" name="organizationid_{{$org->id}}" value="{{$org->id}}" />
																	<p class="description description-thin">
																		<label for="edit-organization-item-title-{{$org->id}}"> Label
																			<br>
																			<input type="text" id="idlabelorganization_{{$org->id}}" class="widefat edit-organization-item-title" name="idlabelorganization_{{$org->id}}" value="{{$org->label}}">
																		</label>
																	</p>

																	<p class="field-css-classes description description-thin">
																		<label for="edit-organization-item-classes-{{$org->id}}"> Class CSS (optional)
																			<br>
																			<input type="text" id="clases_organization_{{$org->id}}" class="widefat code edit-organization-item-classes" name="clases_organization_{{$org->id}}" value="{{$org->class}}">
																		</label>
																	</p>

																	<p class="field-css-url description description-wide">
																		<label for="edit-organization-item-url-{{$org->id}}"> Url
																			<br>
																			<input type="text" id="url_organization_{{$org->id}}" class="widefat code edit-organization-item-url" id="url_organization_{{$org->id}}" value="{{$org->link}}">
																		</label>
																	</p>

																	@if(!empty($roles))
																	<p class="field-css-role description description-wide">
																		<label for="edit-organization-item-role-{{$org->id}}"> Role
																			<br>
																			<select id="role_organization_{{$org->id}}" class="widefat code edit-organization-item-role" name="role_organization_[{{$org->id}}]" >
																				<option value="0">Select Role</option>
																				@foreach($roles as $role)
																					<option @if($role->id == $org->role_id) selected @endif value="{{ $role->$role_pk }}">{{ ucwords($role->$role_title_field) }}</option>
																				@endforeach
																			</select>
																		</label>
																	</p>
																	@endif

																	<p class="field-move hide-if-no-js description description-wide">
																		<label> <span>Move</span> <a href="{{ $currentUrl }}" class="organizations-move-up" style="display: none;">Move up</a> <a href="{{ $currentUrl }}" class="organizations-move-down" title="Mover uno abajo" style="display: inline;">Move Down</a> <a href="{{ $currentUrl }}" class="organizations-move-left" style="display: none;"></a> <a href="{{ $currentUrl }}" class="organizations-move-right" style="display: none;"></a> <a href="{{ $currentUrl }}" class="organizations-move-top" style="display: none;">Top</a> </label>
																	</p>

																	<div class="organization-item-actions description-wide submitbox">

																		<a class="item-delete submitdelete deletion" id="delete-{{$org->id}}" href="{{ $currentUrl }}?action=delete-organization-item&organization-item={{$org->id}}">Delete</a>
																		<span class="meta-sep hide-if-no-js"> | </span>
																		<a class="item-cancel submitcancel hide-if-no-js button-secondary" id="cancel-{{$org->id}}" href="{{ $currentUrl }}?edit-organization-item={{$org->id}}&cancel=1424297719#organization-item-settings-{{$org->id}}">Cancel</a>
																		<span class="meta-sep hide-if-no-js"> | </span>
																		<a onclick="getorganizations()" class="button button-primary updateorganization" id="update-{{$org->id}}" href="javascript:void(0)">Update item</a>

																	</div>

																</div>
																<ul class="organization-item-transport"></ul>
															</li>
															@endforeach
															@endif
														</ul>
														<div class="organization-settings">

														</div>
													</div>
												</div>
												<div id="nav-organization-footer">
													<div class="major-publishing-actions">

														@if(request()->has('action'))
														<div class="publishing-action">
															<a onclick="createneworganization()" name="save_organization" id="save_organization_header" class="button button-primary organization-save">Create organization</a>
														</div>
														@elseif(request()->has("organization"))
														<span class="delete-action"> <a class="submitdelete deletion organization-delete" onclick="deleteorganization()" href="javascript:void(9)">Delete organization</a> </span>
														<div class="publishing-action">

															<a onclick="getorganizations()" name="save_organization" id="save_organization_header" class="button button-primary organization-save">Save organization</a>
															<span class="spinner" id="spincustomu2"></span>
														</div>

														@else
														<div class="publishing-action">
															<a onclick="createneworganization()" name="save_organization" id="save_organization_header" class="button button-primary organization-save">Create organization</a>
														</div>
														@endif
													</div>
												</div>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>

						<div class="clear"></div>
					</div>

					<div class="clear"></div>
				</div>
				<div class="clear"></div>
			</div>

			<div class="clear"></div>
		</div>
	</div>
</div>
