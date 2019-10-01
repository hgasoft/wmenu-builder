<script>
	var organizations = {
		"oneThemeLocationNoOrganizations" : "",
		"moveUp" : "Move up",
		"moveDown" : "Mover down",
		"moveToTop" : "Move top",
		"moveUnder" : "Move under of %s",
		"moveOutFrom" : "Out from under  %s",
		"under" : "Under %s",
		"outFrom" : "Out from %s",
		"organizationFocus" : "%1$s. Element organization %2$d of %3$d.",
		"subOrganizationFocus" : "%1$s. Organization of subelement %2$d of %3$s."
	};
	var arraydata = [];     
	var addcustomorganizationr= '{{ route("haddcustomorganization") }}';
	var updateitemr= '{{ route("hupdateitem")}}';
	var generateorganizationcontrolr= '{{ route("hgenerateorganizationcontrol") }}';
	var deleteitemorganizationr= '{{ route("hdeleteitemorganization") }}';
	var deleteorganizationgr= '{{ route("hdeleteorganizationg") }}';
	var createneworganizationr= '{{ route("hcreateneworganization") }}';
	var csrftoken="{{ csrf_token() }}";
	var organizationuwr = "{{ url()->current() }}";

	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': csrftoken
		}
	});
</script>
<script type="text/javascript" src="{{asset('vendor/karbonsoft-orgchart/scripts.js')}}"></script>
<script type="text/javascript" src="{{asset('vendor/karbonsoft-orgchart/scripts2.js')}}"></script>
<script type="text/javascript" src="{{asset('vendor/karbonsoft-orgchart/organization.js')}}"></script>