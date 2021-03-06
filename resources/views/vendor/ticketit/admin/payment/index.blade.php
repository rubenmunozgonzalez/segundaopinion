@extends($master)

@section('page')
    {{ trans('ticketit::lang.index-title') }}
@stop

@section('content')
    @include('ticketit::shared.header')
    @include('ticketit::admin.payment.title')
@stop

@section('footer')
	<script src="//cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js"></script>
	<script src="//cdn.datatables.net/plug-ins/505bef35b56/integration/bootstrap/3/dataTables.bootstrap.js"></script>
	<script src="//cdn.datatables.net/responsive/1.0.7/js/dataTables.responsive.min.js"></script>

	<script>
	    $('.table').DataTable({
	        processing: false,
	        serverSide: true,
	        responsive: true,
        	lengthMenu: {{ json_encode($setting->grab('length_menu')) }},
	        ajax: '{!! route($setting->grab('main_route').'.data', $complete) !!}',
	        language: {
  				decimal:        "{{ trans('ticketit::lang.table-decimal') }}",
  				emptyTable:     "{{ trans('ticketit::lang.table-empty') }}",
  				info:           "{{ trans('ticketit::lang.table-info') }}",
  				infoEmpty:      "{{ trans('ticketit::lang.table-info-empty') }}",
  				infoFiltered:   "{{ trans('ticketit::lang.table-info-filtered') }}",
  				infoPostFix:    "{{ trans('ticketit::lang.table-info-postfix') }}",
  				thousands:      "{{ trans('ticketit::lang.table-thousands') }}",
  				lengthMenu:     "{{ trans('ticketit::lang.table-length-menu') }}",
  				loadingRecords: "{{ trans('ticketit::lang.table-loading-results') }}",
  				processing:     "{{ trans('ticketit::lang.table-processing') }}",
  				search:         "{{ trans('ticketit::lang.table-search') }}",
  				zeroRecords:    "{{ trans('ticketit::lang.table-zero-records') }}",
  				paginate: {
  					first:      "{{ trans('ticketit::lang.table-paginate-first') }}",
  					last:       "{{ trans('ticketit::lang.table-paginate-last') }}",
  					next:       "{{ trans('ticketit::lang.table-paginate-next') }}",
  					previous:   "{{ trans('ticketit::lang.table-paginate-prev') }}"
  				},
  				aria: {
  					sortAscending:  "{{ trans('ticketit::lang.table-aria-sort-asc') }}",
  					sortDescending: "{{ trans('ticketit::lang.table-aria-sort-desc') }}"
  				},
  			},
	      columns: [
	        { data: 'id', name: 'ticketit.id' },
	        { data: 'owner', name: 'users.name' },
	        { data: 'subject', name: 'subject' },
	        { data: 'nid', name: 'users.nid' },
	        { data: 'status', name: 'users.status' },
	        { data: 'updated_at', name: 'ticketit.updated_at' },
	        { data: 'price', name: 'ticketit.price' },
	      ]
	    });
	</script>
@endsection
