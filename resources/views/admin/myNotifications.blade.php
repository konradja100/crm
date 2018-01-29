@extends('layouts.main')
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="page-header">
            <div class="alert gray-nav ">Pomoc / Moje zgłoszenia</div>
        </div>
    </div>
</div>

@if(isset($message_ok))
    <div class="alert alert-success">
        {{$message_ok}}
    </div>
@endif

    <div class="table-responsive">
        <table id="datatable" class="table table-striped table-bordered thead-inverse" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th style="width: 20%">Data:</th>
                    <th style="width: 40%">Tytuł:</th>
                    <th style="width: 20%">Stan realizacji</th>
                    <th style="width: 10%">Szczegóły</th>
                    <th style="width: 10%">Oceń</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>

@endsection
@section('script')
<script src="{{ asset('/js/dataTables.bootstrap.min.js')}}"></script>
<script>

table = $('#datatable').DataTable({
    "autoWidth": false,
    "processing": true,
    "serverSide": true,
    "drawCallback": function( settings ) {
    },
    "ajax": {
        'url': "{{ route('api.datatableMyNotifications') }}",
        'type': 'POST',
        'headers': {'X-CSRF-TOKEN': '{{ csrf_token() }}'}
    },
    "language": {
        "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Polish.json"
    },"columns":[
        {"data": "created_at"},
        {"data": "title"},
        {"data": function (data, type, dataToSet) {
            var status = data.status;
            if (status == 1) {
                return 'Zgłoszono';
            } else if (status == 2) {
                return 'Przyjęto do realizacji';
            } else if (status == 3) {
                return 'Zakończono';
            }
          }
        },
        {"data": function (data, type, dataToSet) {
              return '<a class="btn btn-default" href="view_notification/'+data.id+'" >Szczegóły</a>';
        },"orderable": false, "searchable": false },
        {"data": function (data, type, dataToSet) {
            var status = data.status;
            if (status != 3) {
                return '<a class="btn btn-default" href="#" data-toggle="tooltip" title="Ocenić wykonanie możesz po zakończonej realizacji!" data-placement="left" disabled>Oceń</a>';
            } else {
                return '<a class="btn btn-default" href="judge_notification/'+data.id+'" >Oceń</a>';
            }

        },"orderable": false, "searchable": false }
        ]
});

</script>
@endsection
